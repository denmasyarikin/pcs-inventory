<?php 

namespace Denmasyarikin\Inventory\Good\Seeder;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Modules\Workspace\Workspace;
use Illuminate\Support\Facades\File;
use Denmasyarikin\Inventory\Good\Good;
use Denmasyarikin\Inventory\Good\GoodCategory;

class Seeder
{
	/**
	 * command
	 *
	 * @var Command
	 */
	protected $command;

	/**
	 * path
	 *
	 * @var string
	 */
	protected $path;

	/**
	 * image category path
	 *
	 * @var string
	 */
	protected $imageCategroyPath = 'inventory/good/category';

	/**
	 * image good path
	 *
	 * @var string
	 */
	protected $imageGoodPath = 'inventory/good/medias';

	/**
	 * Create a new Seeder instance.
	 *
	 * @param Command $command
	 * @param string $path
	 *
	 * @return void
	 */
	public function __construct(Command $command, $path)
	{
		$this->command = $command;
		$this->path = $path;
	}

	/**
	 * seed
	 */
	public function seed()
	{
		$this->command->info('Seeding data good');

		if (!File::exists($this->path)) {
			$this->command->error('No directory found');
		}

		$this->seedDirectories(
			$this->getDirectories($this->path)
		);
	}

	/**
	 * get all directories
	 *
	 * @param string $path
	 * @return array
	 */
	protected function getDirectories($path)
	{
		return File::directories($path);
	}

	/**
	 * seed directories
	 *
	 * @param array $dirs
	 * @param GoodCategory $parent
	 * @return void
	 */
	protected function seedDirectories(array $dirs, GoodCategory $parent = null)
	{
		if (count($dirs) === 0) return;
		
		$categories = [];

		foreach ($dirs as $dir) {
			if ($this->isGood($dir)) {
				$this->seedGood($dir, $parent);
			}

			if ($this->isCategory($dir)) {
				$categories[$dir] = $this->seedCategory($dir, $parent);
			}
		}

		foreach ($categories as $path => $category) {
			$this->seedDirectories(
				$this->getDirectories($path), $category
			);
		}
	}

	/**
	 * determin is category
	 *
	 * @param string $path
	 * @return bool
	 */
	protected function isCategory($path)
	{
		return !$this->isGood($path);
	}

	/**
	 * determin is good
	 *
	 * @param string $path
	 * @return bool
	 */
	protected function isGood($path)
	{
		return File::exists($path.'/good.json');
	}

	/**
	 * seed category
	 *
	 * @param string $path
	 * @param GoodCategory $parent
	 *
	 * @return Category $category
	 */
	protected function seedCategory($path, GoodCategory $parent = null)
	{
		$name = $this->getNameFromPath($path);
		$data = ['name' => $name];

		if (!is_null($parent)) {
			$data['parent_id'] = $parent->id;
		}

		$category = GoodCategory::firstOrNew($data);

		if (is_null($category->image)) {
			$category->image = $this->generateCategoryImagePath($path);
		}

		if ($category->isDirty()) {
			$category->save();
			$category->Workspaces()->sync(Workspace::get()->pluck('id'));
			$this->command->info("Category {$name} seeded");
		} else {
			$this->command->info("Category {$name} skiped");
		}

		return $category;
	}

	/**
	 * seed good
	 *
	 * @param string $path
	 * @param GoodCategory $category
	 *
	 * @return Good $good
	 */
	protected function seedGood($path, GoodCategory $category = null)
	{
		$name = $this->getNameFromPath($path);
		$data = ['name' => $name];
		
		if (!is_null($category)) {
			$data['good_category_id'] = $category->id;
		}

		$good = $this->getJson($path . '/good.json');

		foreach (['description', 'status'] as $field) {
			if (isset($good[$field])) {
				$data[$field] = $good[$field];
			}
		}

		$good = Good::firstOrNew($data);

		if ($good->isDirty()) {
			$good->save();
			$good->Workspaces()->sync(Workspace::get()->pluck('id'));
			$this->command->info("good {$name} seeded");
		} else {
			$this->command->info("good {$name} skiped");
		}

		$this->seedGoodAttributes($path.'/attributes.json', $good);
		$this->seedGoodOptions($path.'/options.json', $good);
		$this->seedGoodMedias($path.'/images', $good);

		return $good;
	}

	/**
	 * seed good attributes
	 *
	 * @param string $path
	 * @param Good $good
	 * @return void
	 */
	protected function seedGoodAttributes($path, Good $good)
	{
		if (File::exists($path)) {
			$attributes = $this->getJson($path);
			foreach ($attributes as $attribute) {
				if (isset($attribute['key']) AND isset($attribute['value'])) {
					$good->attributes()->firstOrCreate([
						'key' => $attribute['key'],
						'value' => $attribute['value']
					]);
				}
			}
		}
	}

	/**
	 * seed good options
	 *
	 * @param string $path
	 * @param Good $good
	 * @return void
	 */
	protected function seedGoodOptions($path, Good $good)
	{
		if (File::exists($path)) {
			$options = $this->getJson($path);
			foreach ($options as $option) {
				if (isset($option['name'])) {
					$opt = $good->options()->firstOrCreate(['name' => $option['name']]);
					if (isset($option['items'])) {
						foreach ($option['items'] as $item) {
							if (isset($item['name'])) {
								$opt->goodOptionItems()->firstOrCreate(['name' => $item['name']]);
							}
						}
					}
				}
			}
		}
	}

	/**
	 * seed good medias
	 *
	 * @param string $path
	 * @param Good $good
	 * @return void
	 */
	protected function seedGoodMedias($path, Good $good)
	{
		if (File::exists($path) AND $good->medias()->count() === 0) {
			$images = $this->getGoodImagesFilePath($path);
			foreach ($images as $index => $filePath) {
				$filePaths = explode('.', $filePath);
				$fileName = $this->generateFilename($path, end($filePaths));
				$imagePath = $this->imageGoodPath .'/'. $fileName;
				$this->saveImageFile($filePath, base_path('media/' . $imagePath));
				$good->medias()->firstOrCreate([
					'type' => 'image',
					'content' => $imagePath,
					'sequence' => $index + 1,
					'primary' => $index === 0
				]);
			}
		}
	}

	/**
	 * get name from path
	 *
	 * @param string $path
	 * @return string
	 */
	protected function getNameFromPath($path)
	{
		$paths = explode('/', $path);

		return str_replace('_', ' ', Str::title(end($paths)));
	}

	/**
	 * get category image file path
	 *
	 * @param string $path
	 * @return string
	 */
	protected function getCategoryImageFilePath($path)
	{
		$files = glob("{$path}/image.*");

		if (count($files) > 0) {
			return $files[0];
		}
	}

	/**
	 * get good images file path
	 *
	 * @param string $path
	 * @return array
	 */
	protected function getGoodImagesFilePath($path)
	{
		return glob("{$path}/*.*");
	}

	/**
	 * generate category image path
	 *
	 * @param stirng $path
	 * @return string
	 */
	protected function generateCategoryImagePath($path)
	{
		$filePath = $this->getCategoryImageFilePath($path);
		
		if (!is_null($filePath)) {
			$filePaths = explode('.', $filePath);
			$fileName = $this->generateFilename($path, end($filePaths));
			$imagePath = $this->imageCategroyPath .'/'. $fileName;
			$this->saveImageFile($filePath, base_path('media/' . $imagePath));
			return $imagePath;
		}
	}

	/**
     * generate image name.
     *
     * @param string $path
     * @param string $ext
     *
     * @return string
     */
    protected function generateFilename($path, $ext)
    {
        $name = str_random(25).'.'.$ext;
        $fullname = $path.'/'.$name;

        if (File::exists($fullname)) {
            return $this->generateFilename($path, $ext);
        }

        return $name;
    }

    /**
     * save image file
     *
     * @param string $from
     * @param string $to
     * @return void
     */
    protected function saveImageFile($from, $to)
    {
    	try {
    		$dirs = explode('/', $to);
    		
    		array_pop($dirs);
    		
    		if (!File::exists($path = implode('/', $dirs))) {
    			File::makeDirectory($path, 0755, true);
    		}

    		File::copy($from, $to);
    	} catch (\Exception $e) {
    		$this->command->error("Error Move File {$e->getMessage()}");
    	}
    }

    /**
     * get json
     *
     * @param string $file
     * @return array
     */
    protected function getJson($file)
    {
    	try {
    		return json_decode(File::get($file), true);
    	} catch (\Exception $e) {
    		$this->command->error("Error reading file {$e->getMessage()}");
    	}
    }
}
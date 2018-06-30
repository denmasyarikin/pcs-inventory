<?php

namespace Denmasyarikin\Inventory\Good\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Denmasyarikin\Inventory\Good\Good;
use Denmasyarikin\Inventory\Good\Requests\DetailGoodVariantRequest;
use Denmasyarikin\Inventory\Good\Requests\DetailGoodVariantMediaRequest;
use Denmasyarikin\Inventory\Good\Requests\CreateGoodVariantMediaRequest;
use Denmasyarikin\Inventory\Good\Requests\UpdateGoodVariantMediaRequest;
use Denmasyarikin\Inventory\Good\Requests\DeleteGoodVariantMediaRequest;
use Denmasyarikin\Inventory\Good\Transformers\GoodVariantMediaListTransformer;
use Denmasyarikin\Inventory\Good\Transformers\GoodVariantMediaDetailTransformer;

class GoodVariantMediaController extends Controller
{
    /**
     * get list.
     *
     * @param DetailGoodVariantRequest $request
     *
     * @return json
     */
    public function getList(DetailGoodVariantRequest $request)
    {
        $goodVariant = $request->getGoodVariant();

        $transform = new GoodVariantMediaListTransformer($goodVariant->medias()->orderBy('primary', 'DESC')->get());

        return new JsonResponse(['data' => $transform->toArray()]);
    }

    /**
     * create media.
     *
     * @param CreateGoodVariantMediaRequest $request
     *
     * @return json
     */
    public function createMedia(CreateGoodVariantMediaRequest $request)
    {
        $goodVariant = $request->getGoodVariant();

        if (0 === $goodVariant->medias->count()) {
            $request->merge(['primary' => true]);
        }

        $media = $goodVariant->medias()->create($request->only([
            'type', 'content', 'sequence', 'primary',
        ]));

        return new JsonResponse([
            'message' => 'Good Media has been created',
            'data' => (new GoodVariantMediaDetailTransformer($media))->toArray(),
        ], 201);
    }

    /**
     * update media.
     *
     * @param UpdateGoodVariantMediaRequest $request
     *
     * @return json
     */
    public function updateMedia(UpdateGoodVariantMediaRequest $request)
    {
        $goodVariant = $request->getGoodVariant();
        $media = $request->getGoodVariantMedia();

        $media->update($request->only([
            'type', 'content', 'sequence',
        ]));

        return new JsonResponse([
            'message' => 'Good Media has been updated',
            'data' => (new GoodVariantMediaDetailTransformer($media))->toArray(),
        ]);
    }

    /**
     * update media primary.
     *
     * @param DetailGoodVariantMediaRequest $request
     *
     * @return json
     */
    public function updateMediaPrimary(DetailGoodVariantMediaRequest $request)
    {
        $goodVariant = $request->getGoodVariant();
        $media = $request->getGoodVariantMedia();

        if ($request->primary) {
            $goodVariant->medias()->update(['primary' => false]);
        }

        $media->update(['primary' => true]);

        return new JsonResponse(['message' => 'Good Media Primary has been updated']);
    }

    /**
     * delete media.
     *
     * @param DeleteGoodVariantMediaRequest $request
     *
     * @return json
     */
    public function deleteMedia(DeleteGoodVariantMediaRequest $request)
    {
        $goodVariant = $request->getGoodVariant();
        $media = $request->getGoodVariantMedia();
        $media->delete();
        $medias = $goodVariant->medias;

        if ($medias->count() > 0 and 0 === $medias->whereStrict('primary', true)->count()) {
            $media = $goodVariant->medias()->first();
            $media->update(['primary' => true]);
        }

        return new JsonResponse(['message' => 'Good media has been deleted']);
    }
}

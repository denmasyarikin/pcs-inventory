<?php

namespace Denmasyarikin\Inventory\Good\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Denmasyarikin\Inventory\Good\Good;
use Denmasyarikin\Inventory\Good\Requests\DetailGoodRequest;
use Denmasyarikin\Inventory\Good\Requests\DetailGoodMediaRequest;
use Denmasyarikin\Inventory\Good\Requests\CreateGoodMediaRequest;
use Denmasyarikin\Inventory\Good\Requests\UpdateGoodMediaRequest;
use Denmasyarikin\Inventory\Good\Requests\DeleteGoodMediaRequest;
use Denmasyarikin\Inventory\Good\Transformers\GoodMediaListTransformer;
use Denmasyarikin\Inventory\Good\Transformers\GoodMediaDetailTransformer;

class GoodMediaController extends Controller
{
    /**
     * get list.
     *
     * @param DetailGoodRequest $request
     *
     * @return json
     */
    public function getList(DetailGoodRequest $request)
    {
        $good = $request->getGood($request);

        $transform = new GoodMediaListTransformer($good->medias()->orderBy('primary', 'DESC')->get());

        return new JsonResponse(['data' => $transform->toArray()]);
    }

    /**
     * create media.
     *
     * @param CreateGoodMediaRequest $request
     *
     * @return json
     */
    public function createMedia(CreateGoodMediaRequest $request)
    {
        $good = $request->getGood();

        if (0 === $good->medias->count()) {
            $request->merge(['primary' => true]);
        }

        $media = $good->medias()->create($request->only([
            'type', 'content', 'sequence', 'primary',
        ]));

        return new JsonResponse([
            'message' => 'Good Media has been created',
            'data' => (new GoodMediaDetailTransformer($media))->toArray(),
        ], 201);
    }

    /**
     * update media.
     *
     * @param UpdateGoodMediaRequest $request
     *
     * @return json
     */
    public function updateMedia(UpdateGoodMediaRequest $request)
    {
        $good = $request->getGood();
        $media = $request->getGoodMedia();

        $media->update($request->only([
            'type', 'content', 'sequence',
        ]));

        return new JsonResponse([
            'message' => 'Good Media has been updated',
            'data' => (new GoodMediaDetailTransformer($media))->toArray(),
        ]);
    }

    /**
     * update media primary.
     *
     * @param DetailGoodMediaRequest $request
     *
     * @return json
     */
    public function updateMediaPrimary(DetailGoodMediaRequest $request)
    {
        $good = $request->getGood();
        $media = $request->getGoodMedia();

        if ($request->primary) {
            $good->medias()->update(['primary' => false]);
        }

        $media->update(['primary' => true]);

        return new JsonResponse(['message' => 'Good Media Primary has been updated']);
    }

    /**
     * delete media.
     *
     * @param DeleteGoodMediaRequest $request
     *
     * @return json
     */
    public function deleteMedia(DeleteGoodMediaRequest $request)
    {
        $good = $request->getGood();
        $media = $request->getGoodMedia();
        $media->delete();
        $medias = $good->medias;

        if ($medias->count() > 0 and 0 === $medias->whereStrict('primary', true)->count()) {
            $media = $good->medias()->first();
            $media->update(['primary' => true]);
        }

        return new JsonResponse(['message' => 'Good media has been deleted']);
    }
}

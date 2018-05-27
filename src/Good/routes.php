<?php


$router->get('/'.(RE ? 'category' : '0001'), ['as' => 'inventory.good.category.list', 'uses' => 'GoodCategoryController@getList']);
$router->get('/'.(RE ? 'category' : '0001').'/{id}', ['as' => 'inventory.good.category.detail', 'uses' => 'GoodCategoryController@getDetail']);
$router->get('/'.(RE ? 'variant' : '0002').'/{id}', ['as' => 'inventory.good.variant.detail', 'uses' => 'GoodVariantController@getDetail']);
$router->get('/', ['as' => 'inventory.good.list', 'uses' => 'GoodController@getList']);
$router->get('/{id}', ['as' => 'inventory.good.detail', 'uses' => 'GoodController@getDetail']);
$router->get('/{id}/'.(RE ? 'attribute' : '0004'), ['as' => 'inventory.good.attribute.list', 'uses' => 'GoodAttributeController@getList']);
$router->get('/{id}/'.(RE ? 'option' : '0005'), ['as' => 'inventory.good.option.list', 'uses' => 'GoodOptionController@getList']);
$router->get('/{id}/'.(RE ? 'option' : '0005').'/{option_id}/item', ['as' => 'inventory.good.option.item.list', 'uses' => 'GoodOptionItemController@getList']);
$router->get('/{id}/'.(RE ? 'media' : '0007'), ['as' => 'inventory.good.media.list', 'uses' => 'GoodMediaController@getList']);
$router->get('/{id}/'.(RE ? 'variant' : '0002'), ['as' => 'inventory.good.variant.list', 'uses' => 'GoodVariantController@getList']);
$router->get('/{id}/'.(RE ? 'variant' : '0002').'/{variant_id}/'.(RE ? 'price' : '0003'), ['as' => 'inventory.good.variant.price.list', 'uses' => 'GoodPriceController@getList']);

$router->group(['middleware' => 'manage:inventory,good,write'], function ($router) {
    $router->post((RE ? 'category' : '0001'), ['as' => 'inventory.good.category.create', 'uses' => 'GoodCategoryController@createCategory']);
    $router->put((RE ? 'category' : '0001').'/{id}', ['as' => 'inventory.good.category.update', 'uses' => 'GoodCategoryController@updateCategory']);
    $router->delete((RE ? 'category' : '0001').'/{id}', ['as' => 'inventory.good.category.delete', 'uses' => 'GoodCategoryController@deleteCategory']);

    $router->post('/', ['as' => 'inventory.good.create', 'uses' => 'GoodController@createGood']);
    $router->put('/{id}', ['as' => 'inventory.good.update', 'uses' => 'GoodController@updateGood']);
    $router->delete('/{id}', ['as' => 'inventory.good.delete', 'uses' => 'GoodController@deleteGood']);

    $router->post('/{id}/'.(RE ? 'attribute' : '0004'), ['as' => 'inventory.good.attribute.create', 'uses' => 'GoodAttributeController@createAttribute']);
    $router->put('/{id}/'.(RE ? 'attribute' : '0004').'/{attribute_id}', ['as' => 'inventory.good.attribute.update', 'uses' => 'GoodAttributeController@updateAttribute']);
    $router->delete('/{id}/'.(RE ? 'attribute' : '0004').'/{attribute_id}', ['as' => 'inventory.good.attribute.delete', 'uses' => 'GoodAttributeController@deleteAttribute']);

    $router->group(['prefix' => '/{id}/'.(RE ? 'option' : '0005')], function ($router) {
        $router->post('/', ['as' => 'inventory.good.option.create', 'uses' => 'GoodOptionController@createOption']);
        $router->put('/{option_id}', ['as' => 'inventory.good.option.update', 'uses' => 'GoodOptionController@updateOption']);
        $router->delete('{option_id}', ['as' => 'inventory.good.option.delete', 'uses' => 'GoodOptionController@deleteOption']);

        $router->group(['prefix' => '/{option_id}/'.(RE ? 'item' : '0006')], function ($router) {
            $router->post('/', ['as' => 'inventory.good.option.item.create', 'uses' => 'GoodOptionItemController@createOptionItem']);
            $router->put('/{item_id}', ['as' => 'inventory.good.option.item.update', 'uses' => 'GoodOptionItemController@updateOptionItem']);
            $router->delete('{item_id}', ['as' => 'inventory.good.option.item.delete', 'uses' => 'GoodOptionItemController@deleteOptionItem']);
        });
    });

    $router->group(['prefix' => '/{id}/'.(RE ? 'media' : '0007')], function ($router) {
        $router->post('/', ['as' => 'inventory.good.media.create', 'uses' => 'GoodMediaController@createMedia']);
        $router->put('/{media_id}', ['as' => 'inventory.good.media.update', 'uses' => 'GoodMediaController@updateMedia']);
        $router->put('/{media_id}/'.(RE ? 'primary' : '0008'), ['as' => 'inventory.good.media.update_primary', 'uses' => 'GoodMediaController@updateMediaPrimary']);
        $router->delete('/{media_id}', ['as' => 'inventory.good.media.delete', 'uses' => 'GoodMediaController@deleteMedia']);
    });

    $router->group(['prefix' => '/{id}/'.(RE ? 'variant' : '0002')], function ($router) {
        $router->post('/', ['as' => 'inventory.good.variant.create', 'uses' => 'GoodVariantController@createVariant']);
        $router->put('/{variant_id}', ['as' => 'inventory.good.variant.update', 'uses' => 'GoodVariantController@updateVariant']);
        $router->delete('/{variant_id}', ['as' => 'inventory.good.variant.delete', 'uses' => 'GoodVariantController@deleteVariant']);

        $router->group(['prefix' => '/{variant_id}/'.(RE ? 'price' : '0003')], function ($router) {
            $router->post('/', ['as' => 'inventory.good.variant.price.create', 'uses' => 'GoodPriceController@createPrice']);
            $router->put('/{price_id}', ['as' => 'inventory.good.variant.price.update', 'uses' => 'GoodPriceController@updatePrice']);
            $router->delete('{price_id}', ['as' => 'inventory.good.variant.price.delete', 'uses' => 'GoodPriceController@deletePrice']);
        });
    });
});

<?php 

$router->get('/category', ['as' => 'inventory.good.category.list', 'uses' => 'GoodCategoryController@getList']);
$router->get('/', ['as' => 'inventory.good.list', 'uses' => 'GoodController@getList']);
$router->get('/{id}/attribute', ['as' => 'inventory.good.attribute.list', 'uses' => 'GoodAttributeController@getList']);
$router->get('/{id}/option', ['as' => 'inventory.good.option.list', 'uses' => 'GoodOptionController@getList']);

$router->group(['middleware' => 'manage:inventory,good,write'], function ($router) {
    $router->post('category', ['as' => 'inventory.good.category.create', 'uses' => 'GoodCategoryController@createCategory']);
    $router->put('category/{id}', ['as' => 'inventory.good.category.update', 'uses' => 'GoodCategoryController@updateCategory']);
    $router->delete('category/{id}', ['as' => 'inventory.good.category.delete', 'uses' => 'GoodCategoryController@deleteCategory']);
    
    $router->post('/', ['as' => 'inventory.good.create', 'uses' => 'GoodController@createGood']);
    $router->put('/{id}', ['as' => 'inventory.good.update', 'uses' => 'GoodController@updateGood']);
    $router->delete('/{id}', ['as' => 'inventory.good.delete', 'uses' => 'GoodController@deleteGood']);
	
    $router->post('/{id}/attribute', ['as' => 'inventory.good.attribute.create', 'uses' => 'GoodAttributeController@createAttribute']);
    $router->put('/{id}/attribute/{attribute_id}', ['as' => 'inventory.good.attribute.update', 'uses' => 'GoodAttributeController@updateAttribute']);
    $router->delete('/{id}/attribute/{attribute_id}', ['as' => 'inventory.good.attribute.delete', 'uses' => 'GoodAttributeController@deleteAttribute']);

	$router->post('/{id}/option', ['as' => 'inventory.good.option.create', 'uses' => 'GoodOptionController@createOption']);
	$router->put('/{id}/option/{option_id}', ['as' => 'inventory.good.option.update', 'uses' => 'GoodOptionController@updateOption']);
	$router->delete('/{id}/option/{option_id}', ['as' => 'inventory.good.option.delete', 'uses' => 'GoodOptionController@deleteOption']);
});
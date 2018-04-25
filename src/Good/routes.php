<?php 

$router->get('/category', ['as' => 'inventory.good.category.list', 'uses' => 'GoodCategoryController@getList']);
$router->group(['middleware' => 'manage:inventory,good,write'], function ($router) {
    $router->post('category', ['as' => 'inventory.good.category.create', 'uses' => 'GoodCategoryController@createCategory']);
    $router->put('category/{id}', ['as' => 'inventory.good.category.update', 'uses' => 'GoodCategoryController@updateCategory']);
    $router->delete('category/{id}', ['as' => 'inventory.good.category.delete', 'uses' => 'GoodCategoryController@deleteCategory']);
});
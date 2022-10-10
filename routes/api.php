<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//api testing
Route::get('apiTesting',function(){
   $data = [
    'message' => 'this is api testing',
   ];

    return response($data,200);
});

// Get Methods
Route::get('product/list',[RouteController::class, 'productList']);
Route::get('product/user/list',[RouteController::class, 'productUserList']);
Route::get('category/list',[RouteController::class , 'categoryList']); // read
Route::get('order/list',[RouteController::class, 'orderList']);
Route::get('contact/list',[RouteController::class,'contactList']);

//post methods
Route::post('create/category',[RouteController::class,'createCategory']); // create
Route::post('create/content',[RouteController::class, 'createContent']);

Route::post('delete/category', [RouteController::class, 'deleteCategory']);// delete post method
Route::get('delete/category/{id}',[RouteController::class,'categoryDelete']);// delete get method

Route::post('category/details',[RouteController::class, 'categoryDetails']);//with post methods
Route::get('category/list/{id}',[RouteController::class, 'DetailsCategory']);// read details get methods

Route::post('category/update',[RouteController::class, 'categoryUpdate']); // update

/**
 *  localhost:8000/api/product/list (product list link with get method)
 *  localhost:8000/api/product/user/list (product list link with get method)
 * localhost:8000/api/category/list (category list link with get method)
 * localhost:8000/api/order/list (get order list )
 * localhost:8000/api/contact/list(get contact list)
 *
 * localhost:8000/api/create/category ( post method )
 * body{
 *  'name' : ""
 * }
 * localhost:8000/api/create/content ( post method )
 * localhost:8000/api/delete/category (post method)
 * localhost:8000/api/delete/category/ id 1.... (GET method body ထဲက data ကအသူံးမ၀◌င်ပါ)
 * localhost:8000/api/category/details .... (post method)/key= catetgoy_id
 * localhost:8000/api/category/list/ id .... (GET method)
 * localhost:8000/api/category/update (POST method)// key = category_id, category_name
 *
 *
 *
 */

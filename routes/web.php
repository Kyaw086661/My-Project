<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;


// login logout register
Route::middleware(['admin_auth'])->group(function(){
    Route::redirect('/', 'loginPage');
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AuthController::class,'regiterPage'])->name('auth#registerPage');
});


Route::middleware([ 'auth'])->group(function () {

    //dashboard
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');
    //admin
    // Route::group(['middleware'=>'admin_auth'],function(){

    // });
    Route::middleware(['admin_auth'])->group(function(){
         // admin-> category
        Route::prefix('category')->group(function(){
            Route::get('list',[CategoryController::class, 'list'])->name('category#list');
            Route::get('create/page',[CategoryController::class, 'createPage'])->name('category#createPage');
            Route::post('create',[CategoryController::class, 'create'])->name('category#create');
            Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
            Route::get('edit/{id}',[CategoryController::class, 'edit'])->name('category#edit');
            Route::post('update',[CategoryController::class, 'update'])->name('category#update');
    });
    // admin->account
        Route::prefix('admin')->group(function(){
            //password
            Route::get('password/changePasswordPage',[AdminController::class, 'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('password/changePassword',[AdminController::class, 'changePassword'])->name('admin#changePassword');
            // profile
            Route::get('details',[AdminController::class, 'details'])->name('admin#details');
            Route::get('edit',[AdminController::class, 'edit'])->name('admin#editPage');
            Route::post('update/{id}',[AdminController::class, 'update'])->name('admin#update');
            // admin account list
            Route::get('list',[AdminController::class,'adminList'])->name('admin#list');
            // Route::get('delete/{id}',[AdminController::class, 'deleteAccount'])->name('admin#delete');
            Route::get('changeRole/{id}',[AdminController::class, 'changeRole'])->name('admin#changeRole');
            Route::post('change/role/{id}',[AdminController::class, 'change'])->name('admin#change');
            Route::get('ajax/changeRole',[AdminController::class, 'ajaxChangeRole'])->name('ajax#changeRole');
        });

        // admin delete account
        Route::get('delete/{id}',[AdminController::class, 'deleteAccount'])->name('admin#delete');


        // pizza product list
        Route::prefix('products')->group(function(){
            Route::get('listPage',[ProductController::class, 'listPage'])->name('products#listPage');
            Route::get('create',[ProductController::class , 'createPage'])->name('products#createPage');
            Route::post('create',[ProductController::class, 'create'])->name('products#create');
            Route::get('delete/{id}',[ProductController::class, 'delete'])->name('products#delete');
            Route::get('edit/{id}',[ProductController::class, 'edit'])->name('products#edit');
            Route::get('updatePage/{id}',[ProductController::class, 'updatePage'])->name('products#updatePage');
            Route::post('update',[ProductController::class, 'update'])->name('products#update');
        });
        //order lis form user
        Route::prefix('order')->group(function(){
            Route::get('list',[OrderController::class,'orderList'])->name('order#list');
            Route::get('change/status',[OrderController::class,'orderChangeStatus'])->name('order#changeStatus');
            Route::get('ajax/changeStatus',[OrderController::class, 'changeStatus'])->name('ajax#changeStatus');
            Route::get('orderListCode/{orderCode}',[OrderController::class, 'orderListCode'])->name('order#listCode');
        });

        // user list
        Route::prefix('admin')->group(function(){
            Route::get('user/list',[UserListController::class,'userList'])->name('admin#userList');
            Route::get('change/role',[UserListController::class, 'userChangeRole'])->name('admin#userChangeRole');
            Route::get('delete/{id}',[UserListController::class, 'userDelete'])->name('admin#deleteUser');
            Route::get('update/{id}',[UserListController::class,'userUpdate'])->name('admin#updateUser');
            Route::post('updateRole/{id}',[UserListController::class,'updateUserRole'])->name('admin#updateUserRole');
        });
        // user message
        Route::prefix('admin')->group(function(){
            Route::get('user/contact',[ContactController::class,'userContactMessage'])->name('admin#userContact');
            Route::get('contact/delete/{id}',[ContactController::class,'contactDelete'])->name('admin#contactDelete');
            Route::get('view/contact/{id}',[ContactController::class,'viewContact'])->name('admin#viewContact');
        });

    });


    //user account
    Route::group(['prefix'=>'user','middleware'=>'user_auth'],function(){
        // Route::get('home',function(){
        //     return view('user.home');
        // })->name('user#home');
        Route::get('homePage',[UserController::class, 'home'])->name('user#home');
        Route::get('filter/{id}',[UserController::class,'filter'])->name('user#filter');
        Route::get('history',[UserController::class, 'history'])->name('user#history');
        Route::get('contactAdmin',[UserController::class,'contactAdmin'])->name('user#contactAdmin');

        // for user pizza choose
        Route::prefix('pizza')->group(function(){
            Route::get('details/{id}',[UserController::class, 'pizzaDetails'])->name('pizza#details');
        });
        Route::prefix('cart')->group(function(){
            Route::get('cartList',[CartController::class, 'cartList'])->name('cart#list');
        });

        Route::prefix('password')->group(function(){
            Route::get('change',[UserController::class, 'changePasswordPage'])->name('user#changePasswordPage');
            Route::post('change',[UserController::class, 'changePassword'])->name('user#changePassword');

        });
        Route::prefix('account')->group(function(){
            Route::get('change',[UserController::class, 'accountChangePage'])->name('account#accountChangePage');
            Route::post('change/{id}',[UserController::class, 'accountChange'])->name('account#change');
        });
        Route::prefix('ajax')->group(function(){
            Route::get('pizza/list',[AjaxController::class, 'pizzaList'])->name('ajaz#pizzaList');
            Route::get('addToCard',[AjaxController::class, 'addToCard'])->name('ajax#addToCard');
            Route::get('order',[AjaxController::class, 'order'])->name('ajax#order');
            Route::get('clear/cart',[AjaxController::class, 'clearCart'])->name('ajax#clearCart');
            Route::get('clear/current/product',[AjaxController::class, 'clearCurrentProduct'])->name('ajax#clearCurrentProduct');
            Route::get('increase/viewCount',[AjaxController::class,'increaseViewCount'])->name('ajax#increaseViewCount');

        });
        // user contact to admin
        Route::prefix('contact')->group(function(){
            Route::post('userContact',[ContactController::class,'userContact'])->name('user#contact');
        });
    });
});


// api testing
// Route::get('webTesting',function(){
//     $data = [
//      'message' => 'this is web testing',
//     ];
//      return response($data,200);
//  });
//  localhost:8000/webTesting
// localhost:8000/api/apiTesting



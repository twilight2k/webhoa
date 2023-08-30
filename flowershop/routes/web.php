<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[
    'as'=>'home',
    'uses'=>'PageController@getHome'
]);
Route::get('login',[
    'as'=>'login',
    'uses'=>'PageController@getLogin'
]);
Route::post('login',[
    'as'=>'login',
    'uses'=>'PageController@postLogin'
]);
Route::get('register',[
    'as'=>'register',
    'uses'=>'PageController@getRegister'
]);
Route::post('register',[
    'as'=>'register',
    'uses'=>'PageController@postRegister'
]);
Route::get('logout',[
    'as'=>'logout',
    'uses'=>'PageController@postLogout'
]);
Route::get('category/{type}',[
    'as'=>'category',
    'uses'=>'PageController@getCategory' 
]);
Route::get('holiday/{type}',[
    'as'=>'holiday',
    'uses'=>'PageController@holiday' 
]);
Route::get('shop/{type}',[
    'as'=>'shop',
    'uses'=>'PageController@getShop' 
]);
Route::get('productdetails/{id}',[
    'as'=>'productdetails',
    'uses'=>'PageController@getProductDetails'
]);
Route::get('add-to-cart/{id}',[
    'as'=>'addtocart',
    'uses'=>'PageController@getAddtoCart'
]);
Route::get('add-qty-cart/{id}',[
    'as'=>'addqtycart',
    'uses'=>'PageController@cartItemUpdate'
]);
Route::get('del-cart/{id}',[
    'as'=>'deletecart',
    'uses'=>'PageController@getDelItemCart'
]);
Route::get('update-cart/{id}',[
    'as'=>'capnhatgiohang',
    'uses'=>'PageController@cartUpdate'
]);
Route::get('checkout',[
    'as'=>'checkout',
    'uses'=>'PageController@getCheckout'
]);

Route::post('/select-delivery','PageController@select_delivery');

Route::post('checkout',[
    'as'=>'checkout',
   'uses'=>'PageController@postCheckout'
]);
Route::get('cart',[
    'as'=>'cart',
    'uses'=>'PageController@getCart'
]);
Route::get('search',[
    'as'=>'search',
    'uses'=>'PageController@getSearch'
]);
Route::get('profile-user',[
    'as'=>'profileuser',
    'uses'=>'PageController@getProfileUser'
]);

Route::post('profile-user/{id}',[
    'as'=>'updateprofileuser',
    'uses'=>'PageController@postProfileUser'
]);
Route::get('profile-coupon',[
    'as'=>'profilecoupon',
    'uses'=>'PageController@getProfileCoupon'
]);
Route::get('purchase-history',[
    'as'=>'purchasehistory',
   'uses'=>'PageController@getPurchaseHistory'
]);
Route::get('contact',[
    'as'=>'contact',
   'uses'=>'PageController@getContact'
]);
Route::post('contact',[
    'as'=>'contact',
   'uses'=>'PageController@postContact'
]);
Route::get('blog',[
    'as'=>'blog',
   'uses'=>'PageController@getBlog'
]);
Route::get('blog_details/{id}',[
    'as'=>'blogdetails',
    'uses'=>'PageController@getBlogDetails'
]);

Route::post('/color','PageController@color');
Route::post('/quickview','PageController@quickView');
Route::get('language/{language}', 'PageController@getLanguage')->name('language.index');

Route::post('comment/{id}','PageController@postComment');
Route::post('check-coupon','PageController@check_coupon');
Route::get('unset-coupon','PageController@unset_coupon');
// Paypal
Route::get('payment', 'PayPalController@payment')->name('payment');
Route::get('cancel', 'PayPalController@cancel')->name('payment.cancel');
Route::get('payment/success', 'PayPalController@success')->name('payment.success');
//
route::get('/registerAdmin',function(){
    $uss=  Hash::make(1234567890);
    dd($uss);
});
//ADMIN//////////////////////////////////////////////////////////////////////////////////
Route::get('admin/login','AdminController@getAdminLogin');
Route::post('admin/login','AdminController@postdangnhapAdmin');
Route::get('admin/logout','AdminController@getAdminLogout');

Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){
    Route::group(['prefix'=>'home'],function(){
        Route::get('/','AdminController@getHome');
    });
    
    Route::group(['prefix'=>'user'],function(){
        Route::get('list-user','AdminController@getUser');
        Route::post('add','AdminController@postAddUser');
        Route::get('edit/{id}','AdminController@getEditUser');
        Route::post('edit/{id}','AdminController@postEditUser');
        Route::get('delete/{id}','AdminController@postDeleteUser');
    });
    Route::group(['prefix'=>'category'],function(){
        Route::get('list-category','AdminController@getCategory');
        Route::post('add','AdminController@postAddCategory');
        Route::get('edit/{id}','AdminController@getEditCategory');
        Route::post('edit/{id}','AdminController@postEditCategory');
        Route::get('delete/{id}','AdminController@postDeleteCategory');
    });
    Route::group(['prefix'=>'product'],function(){
        Route::get('list-product','AdminController@getProduct');
        Route::get('add','AdminController@getAddProduct');
        Route::get('adds','AdminController@getAddProducts');
        Route::post('add','AdminController@postAddProduct');
        Route::get('edit/{id}','AdminController@getEditProduct');
        Route::post('edit/{id}','AdminController@postEditProduct');
        Route::get('delete/{id}','AdminController@postDeleteProduct');
        Route::get('importExportView','AdminController@importExportView');
        Route::get('export','AdminController@export')->name('export');
        Route::post('import', 'AdminController@import')->name('import');
        Route::get('updatefile', 'AdminController@getupdatefile')->name('updatefile');
        Route::post('updatefile', 'AdminController@updatefile')->name('updatefile');

    });
    Route::group(['prefix'=>'coupon'],function(){
        Route::get('list-coupon','AdminController@getCoupon');
        Route::post('add','AdminController@postAddCoupon');
        Route::get('edit/{id}','AdminController@getEditCoupon');
        Route::post('edit/{id}','AdminController@postEditCoupon');
        Route::get('delete/{id}','AdminController@postDeleteCoupon');
    });
    Route::group(['prefix'=>'event'],function(){
        Route::get('list-event','AdminController@getEvent');
        Route::get('add','AdminController@getAddEvent');
        Route::post('add','AdminController@postAddEvent');
        Route::get('edit/{id}','AdminController@getEditEvent');
        Route::post('edit/{id}','AdminController@postEditEvent');
        Route::get('delete/{id}','AdminController@postDeleteEvent');
    });
    Route::group(['prefix'=>'sale'],function(){
        Route::get('sale-of','AdminController@getSaleOf');
        Route::get('add','AdminController@getAddSale');
        Route::post('add','AdminController@postAddSale');
        Route::get('edit/{id}','AdminController@getEditSale');
        Route::post('edit/{id}','AdminController@postEditSale');
        Route::get('delete/{id}','AdminController@postDeleteSale');
    });
    Route::group(['prefix'=>'shop'],function(){
        Route::get('list-shop','AdminController@getShop');
        Route::post('add','AdminController@postAddShop');
        Route::get('add','AdminController@getAddShop');
        Route::get('edit/{id}','AdminController@getEditShop');
        Route::post('edit/{id}','AdminController@postEditShop');
        Route::get('delete/{id}','AdminController@postDeleteShop');
    });
    Route::group(['prefix'=>'contact'],function(){
        Route::get('list-contact','AdminController@getContact');
        Route::get('edit/{id}','AdminController@getEditContact');
        Route::post('edit/{id}','AdminController@postEditContact');
        Route::get('delete/{id}','AdminController@postDeleteContact');
    });
    Route::group(['prefix'=>'bill'],function(){
        Route::get('list-bill','AdminController@getBill');
        Route::get('list-bill-1','AdminController@getBill1');
        Route::get('list-bill-2','AdminController@getBill2');
        Route::get('list-bill-finish','AdminController@getBillFinish');
        Route::get('edit/{id}','AdminController@getEditBill');
        Route::post('edit/{id}','AdminController@postEditBill');
        Route::get('delete/{id}','AdminController@postDeleteBill');
    });
});
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::get('notification/list-notifikasi','AdminController@getNotification');
<?php

namespace App\Providers;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\ProductType;
use App\Models\Shop;
use App\Models\Cart;
use App\Models\User;
use Carbon\Carbon;
use Session;
use URL;
use Auth;
use Schema;
use App\Models\HolidaysOfYear;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    
    public function boot()
    {   
        view()->composer(['front-end.layout.header','front-end.layout.productdetails','front-end.layout.search','front-end.layout.shop','front-end.layout.blog','front-end.layout.blog_details'],function($view){
            $loai = ProductType::where('status',0)->orderby('id','desc')->get();
            $view->with('loai',$loai);
        });
        view()->composer(['front-end.layout.header','front-end.layout.footer','front-end.layout.productdetails','front-end.layout.search','front-end.layout.shop'],function($view){
            $shop=Shop::where('status',0)->get();
            $view->with('shop',$shop);
        });
        view()->composer(['front-end.layout.header','front-end.layout.footer','front-end.layout.productdetails','front-end.layout.search','front-end.layout.shop'],function($view){
            $today = Carbon::now('Asia/Ho_Chi_Minh')->month;
            $holiday = HolidaysOfYear::where('status',0)->where('date','=',$today)->paginate();
            $view->with('holiday',$holiday);
        });
        view()->composer(['back-end.layout.header'],function($view){
            $user = User::where('status',0)->get();
            $view->with('user',$user);        
        });
        view()->composer(['front-end.layout.header','front-end.layout.checkout'],function($view){
            if( Session('cart')){
                $SsCart=Session::get('cart');
                $cart = new Cart($SsCart);
                $view->with(['cart'=>Session::get('cart'),'product_cart'=>$cart->items,'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
            }
            
        });
        
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);

        
        //Chay website voi Https://
        // URL::forceScheme('https');
    }
}

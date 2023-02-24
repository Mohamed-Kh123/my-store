<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Config;
use App\Models\Product;
use App\Models\User;
use App\Models\WishList;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Payment\PaymentMethod;
use App\Repositories\Payment\PaypalPayment;
use App\Repositories\Payment\StripePayment;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('paypal.client', function($app){
            $config = config('services.paypal');
            if($config['mode'] == 'sandbox'){
                $environment = new SandboxEnvironment($config['client_id'], $config['secret_key']);
            }else{
                $environment = new ProductionEnvironment($config['client_id'], $config['secret_key']);
            }
            $client = new PayPalHttpClient($environment);
            return $client;
        });

        $this->app->bind(PaymentMethod::class, function(){
            if(config('payment.driver') == 'paypal'){
                return new PaypalPayment();
            }
            if(config('payment.driver') == 'stripe'){
                return new StripePayment();
            }
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $prod = $this->app->isProduction();
        Model::preventLazyLoading(!$prod);
        Model::unguard();
      


        $settings = Cache::get('app-settings');
        if(!$settings){
            $settings = Config::all();
            Cache::put('app-settings', $settings);
        }
        
        foreach($settings as $config){
            config()->set($config->name, $config->value);
        }


        view()->composer('layouts.store', function($view){
            $view->with('user', User::where('type', 'super-admin')->first());
        });

        
                
        view()->composer('components.wish-list', function($view){
            $items = WishList::where('cookie_id', Cookie::get('wishlist'))
                ->get('product_id');
            $view->with([
                'count' => $items->count('id'),
            ]);
        });


        

        
        
        view()->composer('components.cart-menu', function($view){
            $cart = Cart::where('cookie_id', Cookie::get('cart_cookie_id'))->get();
            $total = $cart->sum(function ($item){
                $total = $item->quantity * $item->product->last_price;
                return $total;
            });
            $coupon = Session::get('coupon');
            $newTotal = $total - ($coupon['discount'] ?? 0);
            $view->with([
                'cart' => $cart,
                'total' => $newTotal,
                'quantity' => $cart->sum('quantity'),
            ]);
        });

        Paginator::useBootstrap();
        
    }

}

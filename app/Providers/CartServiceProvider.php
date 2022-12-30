<?php

namespace App\Providers;

use App\Repositories\Cart\CartRepository;
use App\Repositories\Cart\SessionRepository;
use App\Repositories\Cart\CookieRepository;
use App\Repositories\Cart\DataBaseRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CartRepository::class, function(){
            if(Config('cart.driver' == 'cookie')){
                return new CookieRepository();
            }
            
            if(Config('cart.driver' == 'session')){
                    return new SessionRepository();
            }
            
            return new DataBaseRepository();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

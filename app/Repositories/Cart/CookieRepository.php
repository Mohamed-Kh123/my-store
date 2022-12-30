<?php

namespace App\Repositories\Cart;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class CookieRepository implements CartRepository
{
    protected $name = 'cart';

    public function all()
    {
        $items = Cookie::get($this->name);
        if($items){
            return unserialize($items);
        }

        return [];
    }

    public function add($item, $qty = 1)
    {
        $items = $this->all();
        $items[] = $item;
        Cookie::queue($this->name, $items, 60*24*30);
    }

    public function clear()
    {
        return Cookie::forget($this->name, '', -60*24*30);
    }

}
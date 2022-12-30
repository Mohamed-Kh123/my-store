<?php

namespace App\View\Components;

use App\Models\Product;
use App\Models\User;
use App\Models\WishList as ModelsWishList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\Component;

class WishList extends Component
{

    public function all()
    {
        
    }
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->items = collect([]);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        
        $items = collect([]);

        if(!$items->count()){
            $items = ModelsWishList::where('user_id', Auth::id())
                ->orWhere('cookie_id', Cookie::get('wishlist'))
                ->get('product_id');
        }   


        if($items){
            $products = Product::whereIn('id', $items)->get();
            $count = $products->count('id');
        }else{
            $count = 0;
        }





        return view('components.wish-list', [
            'count' => $count,
            // 'items' => $this->items,
            // 'user' => $user,
            // 'user_id' => $user_id,
        ]);
    }
}

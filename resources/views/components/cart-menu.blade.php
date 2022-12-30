<li class="hm-minicart">
    <div class="hm-minicart-trigger">
        <span class="item-icon"></span>
        <span class="item-text">${{$cart->total()}}
            <span class="cart-item-count">{{$cart->quantity()}}</span>
        </span>
    </div>
    <span></span>
    <div class="minicart">
        <ul class="minicart-product-list">
            @foreach ($cart->all() as $item)    
                <li id="{{$item->id}}">
                    <a href="{{route('single.product', $item->product->slug)}}" class="minicart-product-image">
                        <img src="{{ $item->product->image_url}}" alt="cart products">
                    </a>
                    <div class="minicart-product-details">
                        <h6><a href="{{route('single.product', $item->product->slug)}}">{{$item->product->name}}</a></h6>
                        <span>£{{$item->quantity * $item->product->price}}</span>
                    </div>
                    <a href="" id="removeCart" data-id="{{$item->id}}" class="close" title="Remove">
                        <i class="fa fa-close"></i>
                    </a>
                </li>
            @endforeach
        </ul>
        <p class="minicart-total">TOTAL: <span>£{{$cart->total()}}</span></p>
        <div class="minicart-button">
            <a href="{{route('cart')}}" class="li-button li-button-fullwidth li-button-dark">
                <span>View Full Cart</span>
            </a>
            <a href="{{route('checkout')}}" class="li-button li-button-fullwidth">
                <span>Checkout</span>
            </a>
        </div>
    </div>
</li>

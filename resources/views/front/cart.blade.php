@extends('layouts.store')
@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!--Shopping Cart Area Strat-->
    <div class="Shopping-cart-area pt-60 pb-60">
        <div class="container">
            <div class="row">
                <div class="col-12">
                        <div class="table-content table-responsive">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $message)
                                    <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="li-product-remove">remove</th>
                                        <th class="li-product-thumbnail">images</th>
                                        <th class="cart-product-name">Product</th>
                                        <th class="li-product-price">Unit Price</th>
                                        <th class="li-product-quantity">Quantity</th>
                                        <th class="li-product-subtotal">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart->all() as $item)
                                    
                                    <tr id="{{$item->id}}">
                                        
                                        <td class="li-product-remove"><a href="" data-id="{{$item->id}}" id="removeCart"><i class="fa fa-times"></i></a></td>
                                        <td class="li-product-thumbnail"><a href="{{route('single.product', $item->product->slug)}}"><img
                                                    src="{{$item->product->image_url}}" alt="Li's Product Image" width="60" height="60"></a></td>
                                        <td class="li-product-name"><a href="{{route('single.product', $item->product->slug)}}">{{$item->product->name}}</a></td>
                                        <td class="li-product-price"><span class="amount">${{$item->product->price}}</span></td>
                                        <td class="quantity">
                                            <label>Quantity</label>
                                            <div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box item-quantity" id="item-quantity" data-id="{{$item->id}}" name="quantity" value="{{$item->quantity}}">
                                                    <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                    <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                            </div>
                                        </td>
                                        <td class="product-subtotal"><span class="amount">${{$item->product->price * $item->quantity}}</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="coupon-all">
                                    @if(!$coupon)
                                    <div class="coupon">
                                        <form action="{{route('coupons.apply')}}" method="post">
                                            @csrf
                                            <input id="code" class="input-text" name="code"
                                                placeholder="Coupon code" type="text">
                                            <button class="button" name="apply_coupon" type="submit">Apply coupon</button>
                                        </form>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 ml-auto">
                                <div class="cart-page-total">
                                    <h2>Cart totals</h2>
                                    <ul>
                                        <li>Subtotal <span>${{$cart->subTotal()}}</span></li>
                                        @if($coupon)
                                        <li id="{{$coupon['id']}}">Discount<span>-${{$discount}}</span> 
                                            <a href="" id="removeCoupon" data-id="{{$coupon['id']}}" class="removeCoupon"><img src="{{asset('assets/front/images/trash-solid.svg')}}" class="trash"></a>    
                                        </li>
                                        @endif
                                        <li>Total <span>${{$cart->total() - $discount}}</span></li>
                                    </ul>
                                    <a href="{{route('checkout')}}">Proceed to checkout</a>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection


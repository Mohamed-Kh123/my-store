@extends('layouts.store')
@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{route('home')}}">{{__('Home')}}</a></li>
                    <li class="active">{{__('Shopping Cart')}}</li>
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
                                        <th class="li-product-remove">{{__('remove')}}</th>
                                        <th class="li-product-thumbnail">{{__('images')}}</th>
                                        <th class="cart-product-name">{{__('Product')}}</th>
                                        <th class="li-product-price">{{__('Unit Price')}}</th>
                                        <th class="li-product-quantity">{{__('Quantity')}}</th>
                                        <th class="li-product-subtotal">{{__('Total')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart->all() as $item)
                                    
                                    <tr class="{{$item->id}}">
                                        
                                        <td class="li-product-remove"><a href="" data-id="{{$item->id}}" id="removeCart"><i class="fa fa-times"></i></a></td>
                                        <td class="li-product-thumbnail"><a href="{{route('single.product', $item->product->slug)}}"><img
                                                    src="{{$item->product->image_url}}" alt="Li's Product Image" width="60" height="60"></a></td>
                                        <td class="li-product-name"><a href="{{route('single.product', $item->product->slug)}}">{{$item->product->name}}</a></td>
                                        <td class="li-product-price"><span class="{{$item->id}}price" data-price="{{$item->product->last_price}}">{{$item->product->last_price}}</span></td>
                                        <td class="quantity">
                                            <label>Quantity</label>
                                            <div>
                                                    <input class="cart-plus-minus-box item-quantity" id="item-quantity" data-id="{{$item->id}}" name="quantity" value="{{$item->quantity}}">
                                            </div>
                                        </td>
                                        <td class="product-subtotal"><span class="amount" id="{{$item->id}}total">${{$item->product->last_price * $item->quantity}}</span></td>
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
                                            <input id="code" class="input-text" name="code"
                                                placeholder="{{__('Coupon code')}}" type="text">
                                            <button id="addCoupon" type="submit">{{__('Apply coupon')}}</button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 ml-auto">
                                <div class="cart-page-total">
                                    <h2>{{__('Cart totals')}}</h2>
                                    <ul id="coupon"> 
                                        <li>{{__('Subtotal')}} <span class="subTotal">${{$cart->subTotal()}}</span></li>
                                        @if($coupon)
                                            <li id="{{$coupon['id']}}">Discount<span>-${{$discount}}</span> 
                                            <form action="{{route('coupons.remove')}}" method="post">
                                                @csrf
                                                <button type="submit"><a id="removeCoupon" ><img src="{{asset('assets/front/images/trash-solid.svg')}}" class="trash"></a>    </button>
                                            </form>
                                            </li>
                                        @endif
                                            <li>{{__('Total')}} <span class="TOTAL" data-total="{{$cart->total() - $discount}}">${{$cart->total() - $discount}}</span></li>
                                    </ul>
                                    <a href="{{route('checkout')}}">{{__('Proceed to checkout')}}</a>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection


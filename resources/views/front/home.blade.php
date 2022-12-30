@extends('layouts.store')
@section('content')
    <!-- Begin Product Area -->
    <div class="product-area pt-60 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="li-product-tab">
                        <ul class="nav li-product-menu">
                            <li><a class="active" data-toggle="tab" href="#li-new-product"><span>New Arrival</span></a></li>
                            <li><a data-toggle="tab" href="#li-bestseller-product"><span>Bestseller</span></a></li>
                            <li><a data-toggle="tab" href="#li-featured-product"><span>Featured Products</span></a></li>
                        </ul>
                    </div>
                    <!-- Begin Li's Tab Menu Content Area -->
                </div>
            </div>
            <div class="tab-content">
                <div id="li-new-product"class="tab-pane active show" role="tabpanel">
                    <div class="row">
                        <div class="product-active owl-carousel">
                            @foreach ($latestProducts as $latestProduct)
                                <div class="col-lg-12">
                                    <!-- single-product-wrap start -->
                                    <div class="single-product-wrap">
                                        <div class="product-image">
                                            <a href="{{ route('single.product', $latestProduct->slug) }}">
                                                <img src="{{ $latestProduct->image_url}}"
                                                    alt="Li's Product Image">
                                            </a>
                                            <span class="sticker">New</span>
                                        </div>
                                        <div class="product_desc">
                                            <div class="product_desc_info">
                                                <div class="product-review">
                                                    <h5 class="manufacturer">
                                                        <a href="{{route('category.index')}}">{{$latestProduct->category->name}}</a>
                                                    </h5>
                                                    <div class="rating-box">
                                                        <ul class="rating">
                                                            @for($i=1; $i<=$latestProduct->total_ratings; $i++)
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            @endfor
                                                            @for($j = $latestProduct->total_ratings+1; $j <= 5; $j++)
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                            @endfor
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h4><a class="product_name"
                                                        href="{{ route('single.product', $latestProduct->slug) }}">{{ $latestProduct->name }}</a>
                                                </h4>
                                                <div class="price-box">
                                                    <span class="new-price">${{ $latestProduct->price  - (($latestProduct->discount / 100) * $latestProduct->price) }}</span>
                                                    @if($latestProduct->discount)
                                                    <span class="old-price">${{$latestProduct->price }}</span>
                                                    <span class="discount-percentage">-{{$latestProduct->discount}}%</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul class="add-actions-link">
                                                        <input type="hidden" name="product_id" value="{{$latestProduct->id}}">
                                                        <input type="hidden" name="user_id" value="{{Auth::id()}}">
                                                        <a href="" onclick="addToCart({{$latestProduct->id}}, {{Auth::id() ?? 'null'}}, event)"><li class="add-cart">Add to cart</li></a>
                                                        <a onclick="addToWishList({{$latestProduct->id}}, event)"><li class="wishlist"><i class="fa fa-heart-o"></i></li></a>
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-product-wrap end -->
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div id="li-bestseller-product" class="tab-pane" role="tabpanel">
                    <div class="row">
                        <div class="product-active owl-carousel">
                            @foreach ($bestSales as $bestSale)
                                <div class="col-lg-12">
                                    <!-- single-product-wrap start -->
                                    <div class="single-product-wrap">
                                        <div class="product-image">
                                            <a href="{{ route('single.product', $bestSale->slug) }}">
                                                <img src="{{ $bestSale->image_url}}"
                                                    alt="Li's Product Image">
                                            </a>
                                            <span class="sticker">New</span>
                                        </div>
                                        <div class="product_desc">
                                            <div class="product_desc_info">
                                                <div class="product-review">
                                                    <h5 class="manufacturer">
                                                        <a href="{{route('category.index')}}">{{$bestSale->category->name}}</a>
                                                    </h5>
                                                    @php
                                                    @endphp
                                                    <div class="rating-box">
                                                        <ul class="rating">
                                                            @for($i=1; $i<=$bestSale->total_ratings; $i++)
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            @endfor
                                                            @for($j = $bestSale->total_ratings+1; $j <= 5; $j++)
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                            @endfor
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h4><a class="product_name"
                                                        href="{{ route('single.product', $bestSale->slug) }}">{{ $bestSale->name }}</a>
                                                </h4>
                                                <div class="price-box">
                                                    <span class="new-price">${{ $bestSale->price - (($bestSale->discount / 100) * $bestSale->price) }}</span>
                                                    @if($bestSale->discount)
                                                    <span class="old-price">${{$bestSale->price }}</span>
                                                    <span class="discount-percentage">-{{$bestSale->discount}}%</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul class="add-actions-link">
                                                    
                                                        <input type="hidden" name="product_id" value="{{$bestSale->id}}">
                                                        <a onclick="addToCart({{$bestSale->id}}, {{Auth::id() ?? 'null'}}, event)"><li class="add-cart">Add to cart</li></a>

                                                        <a onclick="addToWishList({{$bestSale->id}}, event)"><li class="wishlist"><i class="fa fa-heart-o"></i></li></a>
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-product-wrap end -->
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div id="li-featured-product" class="tab-pane" role="tabpanel">
                    <div class="row">
                        <div class="product-active owl-carousel">
                            @foreach ($latestProducts as $latestProduct)
                                <div class="col-lg-12">
                                    <!-- single-product-wrap start -->
                                    <div class="single-product-wrap">
                                        <div class="product-image">
                                            <a href="{{ route('single.product', $latestProduct->slug) }}">
                                                <img src="{{ $latestProduct->image_url }}"
                                                    alt="Li's Product Image">
                                            </a>
                                            <span class="sticker">New</span>
                                        </div>
                                        <div class="product_desc">
                                            <div class="product_desc_info">
                                                <div class="product-review">
                                                    <h5 class="manufacturer">
                                                        <a href="{{route('category.index')}}">{{$latestProduct->category->name}}</a>
                                                    </h5>
                                                    <div class="rating-box">
                                                        <ul class="rating">
                                                            @for($i=1; $i<=$latestProduct->total_ratings; $i++)
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            @endfor
                                                            @for($j = $latestProduct->total_ratings+1; $j <= 5; $j++)
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                            @endfor
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h4><a class="product_name"
                                                        href="{{ route('single.product', $latestProduct->slug) }}">{{ $latestProduct->name }}</a>
                                                </h4>
                                                <div class="price-box">
                                                    <span class="new-price">${{ $latestProduct->price  - (($latestProduct->discount / 100) * $latestProduct->price) }}</span>
                                                    @if($latestProduct->discount)
                                                    <span class="old-price">${{$latestProduct->price }}</span>
                                                    <span class="discount-percentage">-{{$latestProduct->discount}}%</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul class="add-actions-link">
                                                        <input type="hidden" name="product_id" value="{{$latestProduct->id}}">
                                                        <a onclick="addToCart({{$latestProduct->id}}, {{Auth::id() ?? 'null'}}, event)"><li class="add-cart">Add to cart</li></a>

                                                        <a onclick="addToWishList({{$latestProduct->id}}, event)"><li class="wishlist"><i class="fa fa-heart-o"></i></li></a>

                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-product-wrap end -->
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Area End Here -->
    
    <!-- Begin Li's Laptop Product Area -->
    <section class="product-area li-laptop-product pt-60 pb-45">
        <div class="container">
            <div class="row">
                <!-- Begin Li's Section Area -->
                <div class="col-lg-12">
                    <div class="li-section-title">
                        <h2>
                            <span>Laptop</span>
                        </h2>
                        <ul class="li-sub-category-list">
                            <li class="active"><a href="">Prime Video</a></li>
                            <li><a href="">Computers</a></li>
                            <li><a href="">Electronics</a></li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="product-active owl-carousel">
                            @foreach ($lapProducts as $key => $value)
                                <div class="col-lg-12">
                                    <!-- single-product-wrap start -->
                                    <div class="single-product-wrap">
                                        <div class="product-image">
                                            <a href="{{ route('single.product', $value->slug) }}">
                                                <img src="{{ $value->image_url }}"
                                                    alt="Li's Product Image">
                                            </a>
                                            <span class="sticker">New</span>
                                        </div>
                                        <div class="product_desc">
                                            <div class="product_desc_info">
                                                <div class="product-review">
                                                    <h5 class="manufacturer">
                                                        <a href="{{route('category.index')}}">{{$value->category->name}}</a>
                                                    </h5>
                                                    <div class="rating-box">
                                                        <ul class="rating">
                                                            @for($i=1; $i<=$value->total_ratings; $i++)
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            @endfor
                                                            @for($j = $value->total_ratings+1; $j <= 5; $j++)
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                            @endfor
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h4><a class="product_name"
                                                        href="{{ route('single.product', $value->slug) }}">{{ $value->name }}</a>
                                                </h4>
                                                <div class="price-box">
                                                    <span class="new-price">${{ $value->price  - (($value->discount / 100) * $value->price) }}</span>
                                                    @if($value->discount)
                                                    <span class="old-price">${{$value->price }}</span>
                                                    <span class="discount-percentage">-{{$value->discount}}%</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul class="add-actions-link">
                                                        <input type="hidden" name="product_id" value="{{$value->id}}">
                                                        <a href="" onclick="addToCart({{$value->id}}, {{Auth::id() ?? 'null'}}, event)"><li class="add-cart">Add to cart</li></a>
                                                    </form>
                                                    <a onclick="addToWishList({{$value->id}}, event)"><li class="wishlist"><i class="fa fa-heart-o"></i></li></a>
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-product-wrap end -->
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Li's Section Area End Here -->
            </div>
        </div>
    </section>
    <!-- Li's Laptop Product Area End Here -->
    <!-- Begin Li's TV & Audio Product Area -->
    <section class="product-area li-laptop-product li-tv-audio-product pb-45">
        <div class="container">
            <div class="row">
                <!-- Begin Li's Section Area -->
                <div class="col-lg-12">
                    <div class="li-section-title">
                        <h2>
                            <span>TV & Audio</span>
                        </h2>
                        <ul class="li-sub-category-list">
                            <li class="active"><a href="{{route('category.index')}}">Chamcham</a></li>
                            <li><a href="{{route('category.index')}}">Sanai</a></li>
                            <li><a href="{{route('category.index')}}">Meito</a></li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="product-active owl-carousel">
                            @foreach ($tvProducts as $tvProduct)
                                <div class="col-lg-12">
                                    <!-- single-product-wrap start -->
                                    <div class="single-product-wrap">
                                        <div class="product-image">
                                            <a href="{{ route('single.product', $tvProduct->slug) }}">
                                                <img src="{{ $tvProduct->image_url }}"
                                                    alt="Li's Product Image">
                                            </a>
                                            <span class="sticker">New</span>
                                        </div>
                                        <div class="product_desc">
                                            <div class="product_desc_info">
                                                <div class="product-review">
                                                    <h5 class="manufacturer">
                                                        <a href="{{route('category.index')}}">{{$tvProduct->category->name}}</a>
                                                    </h5>
                                                    <div class="rating-box">
                                                        <ul class="rating">
                                                            @for($i=1; $i<=$tvProduct->total_ratings; $i++)
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            @endfor
                                                            @for($j = $tvProduct->total_ratings+1; $j <= 5; $j++)
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                            @endfor
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h4><a class="product_name"
                                                        href="{{ route('single.product', $tvProduct->slug) }}">{{ $tvProduct->name }}</a>
                                                </h4>
                                                <div class="price-box">
                                                    <span class="new-price">${{ $tvProduct->price  - (($tvProduct->discount / 100) * $tvProduct->price) }}</span>
                                                    @if($tvProduct->discount)
                                                    <span class="old-price">${{$tvProduct->price }}</span>
                                                    <span class="discount-percentage">-{{$tvProduct->discount}}%</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul class="add-actions-link">
                                                    <input type="hidden" name="product_id" value="{{$tvProduct->id}}">
                                                    <a href="" onclick="addToCart({{$tvProduct->id}}, {{Auth::id() ?? 'null'}}, event)"><li class="add-cart">Add to cart</li></a>
                                                    <a onclick="addToWishList({{$tvProduct->id}}, event)"><li class="wishlist"><i class="fa fa-heart-o"></i></li></a>
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-product-wrap end -->
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Li's Section Area End Here -->
            </div>
        </div>
    </section>
    <!-- Li's TV & Audio Product Area End Here -->
   
    <!-- Begin Li's Trending Product Area -->
    <section class="product-area li-trending-product pt-60 pb-45">
        <div class="container">
            <div class="row">
                <!-- Begin Li's Tab Menu Area -->
                <div class="col-lg-12">
                    <div class="li-product-tab li-trending-product-tab">
                        <h2>
                            <span>Trendding Products</span>
                        </h2>
                        <ul class="nav li-product-menu li-trending-product-menu">
                            <li><a class="active" data-toggle="tab" href="#home1"><span>Sanai</span></a></li>
                            <li><a data-toggle="tab" href="#home2"><span>Camera Accessories</span></a></li>
                            <li><a data-toggle="tab" href="#home3"><span>XailStation</span></a></li>
                        </ul>
                    </div>
                    <!-- Begin Li's Tab Menu Content Area -->
                    <div class="tab-content li-tab-content li-trending-product-content">
                        <div id="home1" class="tab-pane show fade in active">
                            <div class="row">
                                <div class="product-active owl-carousel">
                                    @foreach ($trendingProducts as $trendingProduct)
                                            <div class="col-lg-12">
                                                <!-- single-product-wrap start -->
                                                <div class="single-product-wrap">
                                                    <div class="product-image">
                                                        <a href="{{ route('single.product', $trendingProduct->slug) }}">
                                                            <img src="{{ $trendingProduct->image_url }}"
                                                                alt="Li's Product Image">
                                                        </a>
                                                        <span class="sticker">New</span>
                                                    </div>
                                                    <div class="product_desc">
                                                        <div class="product_desc_info">
                                                            <div class="product-review">
                                                                <h5 class="manufacturer">
                                                                    <a href="{{route('category.index')}}">{{$trendingProduct->category->name}}</a>
                                                                </h5>
                                                                <div class="rating-box">
                                                                    <ul class="rating">
                                                                        @for($i=1; $i<=$trendingProduct->total_ratings; $i++)
                                                                        <li><i class="fa fa-star-o"></i></li>
                                                                        @endfor
                                                                        @for($j = $trendingProduct->total_ratings+1; $j <= 5; $j++)
                                                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                        @endfor
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <h4><a class="product_name"
                                                                    href="{{ route('single.product', $trendingProduct->slug) }}"></a>{{ $trendingProduct->name }}
                                                            </h4>
                                                            <div class="price-box">
                                                                <span class="new-price">${{ $trendingProduct->price  - (($trendingProduct->discount / 100) * $trendingProduct->price) }}</span>
                                                                @if($trendingProduct->discount)
                                                                <span class="old-price">${{$trendingProduct->price }}</span>
                                                                <span class="discount-percentage">-{{$trendingProduct->discount}}%</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="add-actions">
                                                            <ul class="add-actions-link">
                                                                    <input type="hidden" name="product_id" value="{{$trendingProduct->id}}">
                                                                    <a href="" onclick="addToCart({{$trendingProduct->id}}, {{Auth::id() ?? 'null'}}, event)"><li class="add-cart">Add to cart</li></a>                                     
                                                                    <a onclick="addToWishList({{$trendingProduct->id}}, event)"><li class="wishlist"><i class="fa fa-heart-o"></i></li></a>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- single-product-wrap end -->
                                            </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div id="home2" class="tab-pane fade">
                            <div class="row">
                                <div class="product-active owl-carousel">
                                    <div class="col-lg-12">
                                        <!-- single-product-wrap start -->
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                <a href="single-product.html">
                                                    <img src="{{ asset('assets/front/images/product/large-size/11.jpg') }}"
                                                        alt="Li's Product Image">
                                                </a>
                                                <span class="sticker">New</span>
                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                            <a href="{{route('category.index')}}">Graphic Corner</a>
                                                        </h5>
                                                        <div class="rating-box">
                                                            <ul class="rating">
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <h4><a class="product_name" href="single-product.html">Accusantium
                                                            dolorem1</a></h4>
                                                    <div class="price-box">
                                                        <span class="new-price">$46.80</span>
                                                    </div>
                                                </div>
                                                <div class="add-actions">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart active"><a href="#">Add to cart</a></li>
                                                        <li><a class="links-details" href="wishlist.html"><i
                                                                    class="fa fa-heart-o"></i></a></li>
                                                        <li><a href="#" title="quick view" class="quick-view-btn"
                                                                data-toggle="modal" data-target="#exampleModalCenter"><i
                                                                    class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- single-product-wrap end -->
                                    </div>
                                    <div class="col-lg-12">
                                        <!-- single-product-wrap start -->
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                <a href="single-product.html">
                                                    <img src="{{ asset('assets/front/images/product/large-size/7.jpg') }}"
                                                        alt="Li's Product Image">
                                                </a>
                                                <span class="sticker">New</span>
                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                            <a href="{{route('category.index')}}">Studio Design</a>
                                                        </h5>
                                                        <div class="rating-box">
                                                            <ul class="rating">
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <h4><a class="product_name" href="single-product.html">Mug Today is
                                                            a good day</a></h4>
                                                    <div class="price-box">
                                                        <span class="new-price new-price-2">$71.80</span>
                                                        <span class="old-price">$77.22</span>
                                                        <span class="discount-percentage">-7%</span>
                                                    </div>
                                                </div>
                                                <div class="add-actions">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart active"><a href="#">Add to cart</a>
                                                        </li>
                                                        <li><a class="links-details" href="wishlist.html"><i
                                                                    class="fa fa-heart-o"></i></a></li>
                                                        <li><a href="#" title="quick view" class="quick-view-btn"
                                                                data-toggle="modal" data-target="#exampleModalCenter"><i
                                                                    class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- single-product-wrap end -->
                                    </div>
                                    <div class="col-lg-12">
                                        <!-- single-product-wrap start -->
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                <a href="single-product.html">
                                                    <img src="{{ asset('assets/front/images/product/large-size/9.jpg') }}"
                                                        alt="Li's Product Image">
                                                </a>
                                                <span class="sticker">New</span>
                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                            <a href="{{route('category.index')}}">Graphic Corner</a>
                                                        </h5>
                                                        <div class="rating-box">
                                                            <ul class="rating">
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <h4><a class="product_name" href="single-product.html">Accusantium
                                                            dolorem1</a></h4>
                                                    <div class="price-box">
                                                        <span class="new-price">$46.80</span>
                                                    </div>
                                                </div>
                                                <div class="add-actions">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart active"><a href="#">Add to cart</a>
                                                        </li>
                                                        <li><a class="links-details" href="wishlist.html"><i
                                                                    class="fa fa-heart-o"></i></a></li>
                                                        <li><a href="#" title="quick view" class="quick-view-btn"
                                                                data-toggle="modal" data-target="#exampleModalCenter"><i
                                                                    class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- single-product-wrap end -->
                                    </div>
                                    <div class="col-lg-12">
                                        <!-- single-product-wrap start -->
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                <a href="single-product.html">
                                                    <img src="{{ asset('assets/front/images/product/large-size/5.jpg') }}"
                                                        alt="Li's Product Image">
                                                </a>
                                                <span class="sticker">New</span>
                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                            <a href="{{route('category.index')}}">Studio Design</a>
                                                        </h5>
                                                        <div class="rating-box">
                                                            <ul class="rating">
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <h4><a class="product_name" href="single-product.html">Mug Today is
                                                            a good day</a></h4>
                                                    <div class="price-box">
                                                        <span class="new-price new-price-2">$71.80</span>
                                                        <span class="old-price">$77.22</span>
                                                        <span class="discount-percentage">-7%</span>
                                                    </div>
                                                </div>
                                                <div class="add-actions">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart active"><a href="#">Add to cart</a>
                                                        </li>
                                                        <li><a class="links-details" href="wishlist.html"><i
                                                                    class="fa fa-heart-o"></i></a></li>
                                                        <li><a href="#" title="quick view" class="quick-view-btn"
                                                                data-toggle="modal" data-target="#exampleModalCenter"><i
                                                                    class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- single-product-wrap end -->
                                    </div>
                                    <div class="col-lg-12">
                                        <!-- single-product-wrap start -->
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                <a href="single-product.html">
                                                    <img src="{{ asset('assets/front/images/product/large-size/7.jpg') }}"
                                                        alt="Li's Product Image">
                                                </a>
                                                <span class="sticker">New</span>
                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                            <a href="{{route('category.index')}}">Graphic Corner</a>
                                                        </h5>
                                                        <div class="rating-box">
                                                            <ul class="rating">
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <h4><a class="product_name" href="single-product.html">Accusantium
                                                            dolorem1</a></h4>
                                                    <div class="price-box">
                                                        <span class="new-price">$46.80</span>
                                                    </div>
                                                </div>
                                                <div class="add-actions">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart active"><a href="#">Add to cart</a>
                                                        </li>
                                                        <li><a class="links-details" href="wishlist.html"><i
                                                                    class="fa fa-heart-o"></i></a></li>
                                                        <li><a href="#" title="quick view" class="quick-view-btn"
                                                                data-toggle="modal" data-target="#exampleModalCenter"><i
                                                                    class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- single-product-wrap end -->
                                    </div>
                                    <div class="col-lg-12">
                                        <!-- single-product-wrap start -->
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                <a href="single-product.html">
                                                    <img src="{{ asset('assets/front/images/product/large-size/5.jpg') }}"
                                                        alt="Li's Product Image">
                                                </a>
                                                <span class="sticker">New</span>
                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                            <a href="{{route('category.index')}}">Studio Design</a>
                                                        </h5>
                                                        <div class="rating-box">
                                                            <ul class="rating">
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <h4><a class="product_name" href="single-product.html">Mug Today is
                                                            a good day</a></h4>
                                                    <div class="price-box">
                                                        <span class="new-price new-price-2">$71.80</span>
                                                        <span class="old-price">$77.22</span>
                                                        <span class="discount-percentage">-7%</span>
                                                    </div>
                                                </div>
                                                <div class="add-actions">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart active"><a href="#">Add to cart</a>
                                                        </li>
                                                        <li><a class="links-details" href="wishlist.html"><i
                                                                    class="fa fa-heart-o"></i></a></li>
                                                        <li><a href="#" title="quick view" class="quick-view-btn"
                                                                data-toggle="modal" data-target="#exampleModalCenter"><i
                                                                    class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- single-product-wrap end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="home3" class="tab-pane fade">
                            <div class="row">
                                <div class="product-active owl-carousel">
                                    <div class="col-lg-12">
                                        <!-- single-product-wrap start -->
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                <a href="single-product.html">
                                                    <img src="{{ asset('assets/front/images/product/large-size/3.jpg') }}"
                                                        alt="Li's Product Image">
                                                </a>
                                                <span class="sticker">New</span>
                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                            <a href="{{route('category.index')}}">Graphic Corner</a>
                                                        </h5>
                                                        <div class="rating-box">
                                                            <ul class="rating">
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <h4><a class="product_name" href="single-product.html">Accusantium
                                                            dolorem1</a></h4>
                                                    <div class="price-box">
                                                        <span class="new-price">$46.80</span>
                                                    </div>
                                                </div>
                                                <div class="add-actions">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart active"><a href="#">Add to cart</a>
                                                        </li>
                                                        <li><a class="links-details" href="wishlist.html"><i
                                                                    class="fa fa-heart-o"></i></a></li>
                                                        <li><a href="#" title="quick view" class="quick-view-btn"
                                                                data-toggle="modal" data-target="#exampleModalCenter"><i
                                                                    class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- single-product-wrap end -->
                                    </div>
                                    <div class="col-lg-12">
                                        <!-- single-product-wrap start -->
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                <a href="single-product.html">
                                                    <img src="{{ asset('assets/front/images/product/large-size/7.jpg') }}"
                                                        alt="Li's Product Image">
                                                </a>
                                                <span class="sticker">New</span>
                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                            <a href="{{route('category.index')}}">Studio Design</a>
                                                        </h5>
                                                        <div class="rating-box">
                                                            <ul class="rating">
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <h4><a class="product_name" href="single-product.html">Mug Today is
                                                            a good day</a></h4>
                                                    <div class="price-box">
                                                        <span class="new-price new-price-2">$71.80</span>
                                                        <span class="old-price">$77.22</span>
                                                        <span class="discount-percentage">-7%</span>
                                                    </div>
                                                </div>
                                                <div class="add-actions">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart active"><a href="#">Add to cart</a>
                                                        </li>
                                                        <li><a class="links-details" href="wishlist.html"><i
                                                                    class="fa fa-heart-o"></i></a></li>
                                                        <li><a href="#" title="quick view" class="quick-view-btn"
                                                                data-toggle="modal" data-target="#exampleModalCenter"><i
                                                                    class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- single-product-wrap end -->
                                    </div>
                                    <div class="col-lg-12">
                                        <!-- single-product-wrap start -->
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                <a href="single-product.html">
                                                    <img src="{{ asset('assets/front/images/product/large-size/9.jpg') }}"
                                                        alt="Li's Product Image">
                                                </a>
                                                <span class="sticker">New</span>
                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                            <a href="{{route('category.index')}}">Graphic Corner</a>
                                                        </h5>
                                                        <div class="rating-box">
                                                            <ul class="rating">
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <h4><a class="product_name" href="single-product.html">Accusantium
                                                            dolorem1</a></h4>
                                                    <div class="price-box">
                                                        <span class="new-price">$46.80</span>
                                                    </div>
                                                </div>
                                                <div class="add-actions">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart active"><a href="#">Add to cart</a>
                                                        </li>
                                                        <li><a class="links-details" href="wishlist.html"><i
                                                                    class="fa fa-heart-o"></i></a></li>
                                                        <li><a href="#" title="quick view" class="quick-view-btn"
                                                                data-toggle="modal" data-target="#exampleModalCenter"><i
                                                                    class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- single-product-wrap end -->
                                    </div>
                                    <div class="col-lg-12">
                                        <!-- single-product-wrap start -->
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                <a href="single-product.html">
                                                    <img src="{{ asset('assets/front/images/product/large-size/1.jpg') }}"
                                                        alt="Li's Product Image">
                                                </a>
                                                <span class="sticker">New</span>
                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                            <a href="{{route('category.index')}}">Studio Design</a>
                                                        </h5>
                                                        <div class="rating-box">
                                                            <ul class="rating">
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <h4><a class="product_name" href="single-product.html">Mug Today is
                                                            a good day</a></h4>
                                                    <div class="price-box">
                                                        <span class="new-price new-price-2">$71.80</span>
                                                        <span class="old-price">$77.22</span>
                                                        <span class="discount-percentage">-7%</span>
                                                    </div>
                                                </div>
                                                <div class="add-actions">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart active"><a href="#">Add to cart</a>
                                                        </li>
                                                        <li><a class="links-details" href="wishlist.html"><i
                                                                    class="fa fa-heart-o"></i></a></li>
                                                        <li><a href="#" title="quick view"
                                                                class="quick-view-btn" data-toggle="modal"
                                                                data-target="#exampleModalCenter"><i
                                                                    class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- single-product-wrap end -->
                                    </div>
                                    <div class="col-lg-12">
                                        <!-- single-product-wrap start -->
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                <a href="single-product.html">
                                                    <img src="{{ asset('assets/front/images/product/large-size/11.jpg') }}"
                                                        alt="Li's Product Image">
                                                </a>
                                                <span class="sticker">New</span>
                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                            <a href="{{route('category.index')}}">Graphic Corner</a>
                                                        </h5>
                                                        <div class="rating-box">
                                                            <ul class="rating">
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <h4><a class="product_name" href="single-product.html">Accusantium
                                                            dolorem1</a></h4>
                                                    <div class="price-box">
                                                        <span class="new-price">$46.80</span>
                                                    </div>
                                                </div>
                                                <div class="add-actions">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart active"><a href="#">Add to cart</a>
                                                        </li>
                                                        <li><a class="links-details" href="wishlist.html"><i
                                                                    class="fa fa-heart-o"></i></a></li>
                                                        <li><a href="#" title="quick view"
                                                                class="quick-view-btn" data-toggle="modal"
                                                                data-target="#exampleModalCenter"><i
                                                                    class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- single-product-wrap end -->
                                    </div>
                                    <div class="col-lg-12">
                                        <!-- single-product-wrap start -->
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                <a href="single-product.html">
                                                    <img src="{{ asset('assets/front/images/product/large-size/9.jpg') }}"
                                                        alt="Li's Product Image">
                                                </a>
                                                <span class="sticker">New</span>
                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                            <a href="{{route('category.index')}}">Studio Design</a>
                                                        </h5>
                                                        <div class="rating-box">
                                                            <ul class="rating">
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <h4><a class="product_name" href="single-product.html">Mug Today is
                                                            a good day</a></h4>
                                                    <div class="price-box">
                                                        <span class="new-price new-price-2">$71.80</span>
                                                        <span class="old-price">$77.22</span>
                                                        <span class="discount-percentage">-7%</span>
                                                    </div>
                                                </div>
                                                <div class="add-actions">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart active"><a href="#">Add to cart</a>
                                                        </li>
                                                        <li><a class="links-details" href="wishlist.html"><i
                                                                    class="fa fa-heart-o"></i></a></li>
                                                        <li><a href="#" title="quick view"
                                                                class="quick-view-btn" data-toggle="modal"
                                                                data-target="#exampleModalCenter"><i
                                                                    class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- single-product-wrap end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tab Menu Content Area End Here -->
                </div>
                <!-- Tab Menu Area End Here -->
            </div>
        </div>
    </section>
    <!-- Li's Trending Product Area End Here -->
    <!-- Begin Li's Trendding Products Area -->
    <section class="product-area li-laptop-product li-trendding-products best-sellers pb-45">
        <div class="container">
            <div class="row">
                <!-- Begin Li's Section Area -->
                <div class="col-lg-12">
                    <div class="li-section-title">
                        <h2>
                            <span>Bestsellers</span>
                        </h2>
                    </div>
                    <div class="row">
                        <div class="product-active owl-carousel">
                            @foreach ($bestSales as $bestSale)
                                <div class="col-lg-12">
                                    <!-- single-product-wrap start -->
                                    <div class="single-product-wrap">
                                        <div class="product-image">
                                            <a href="{{ route('single.product', $bestSale->slug) }}">
                                                <img src="{{ $bestSale->image_url }}"
                                                    alt="Li's Product Image">
                                            </a>
                                            <span class="sticker">New</span>
                                        </div>
                                        <div class="product_desc">
                                            <div class="product_desc_info">
                                                <div class="product-review">
                                                    <h5 class="manufacturer">
                                                        <a href="{{route('category.index')}}">{{$bestSale->category->name}}</a>
                                                    </h5>
                                                    <div class="rating-box">
                                                        <ul class="rating">
                                                            @for($i=1; $i<=$bestSale->total_ratings; $i++)
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            @endfor
                                                            @for($j = $bestSale->total_ratings+1; $j <= 5; $j++)
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                            @endfor
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h4><a class="product_name"
                                                        href="{{ route('single.product', $bestSale->slug) }}">{{ $bestSale->name }}</a>
                                                </h4>
                                                <div class="price-box">
                                                    <span class="new-price">${{ $bestSale->price - (($bestSale->discount / 100) * $bestSale->price) }}</span>
                                                    @if($bestSale->discount)
                                                    <span class="old-price">${{$bestSale->price }}</span>
                                                    <span class="discount-percentage">-{{$bestSale->discount}}%</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul class="add-actions-link">
                                                        <input type="hidden" name="product_id" value="{{$bestSale->id}}">
                                                        <a href="" onclick="addToCart({{$bestSale->id}}, {{Auth::id() ?? 'null'}}, event)"><li class="add-cart">Add to cart</li></a>
                                                    <li>
                                                            <input type="hidden" name="product_id" value="{{$bestSale->id}}">
                                                            <a onclick="addToWishList({{$bestSale->id}}, event)"><li class="wishlist"><i class="fa fa-heart-o"></i></li></a>
                                                    </li>
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-product-wrap end -->
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Li's Section Area End Here -->
            </div>
        </div>
    </section>
    <!-- Li's Trendding Products Area End Here -->
@endsection

@section('modal_area')
    <div class="modal fade modal-wrapper" id="exampleModalCenter">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-inner-area row">
                        <div class="col-lg-5 col-md-6 col-sm-6">
                            <!-- Product Details Left -->
                            <div class="product-details-left">
                                <div class="product-details-images slider-navigation-1">
                                    <div class="lg-image">
                                        <img src="{{ asset('assets/front/images/product/large-size/1.jpg') }}"
                                            alt="product image">
                                    </div>
                                    <div class="lg-image">
                                        <img src="{{ asset('assets/front/images/product/large-size/2.jpg') }}"
                                            alt="product image">
                                    </div>
                                    <div class="lg-image">
                                        <img src="{{ asset('assets/front/images/product/large-size/3.jpg') }}"
                                            alt="product image">
                                    </div>
                                    <div class="lg-image">
                                        <img src="{{ asset('assets/front/images/product/large-size/4.jpg') }}"
                                            alt="product image">
                                    </div>
                                    <div class="lg-image">
                                        <img src="{{ asset('assets/front/images/product/large-size/5.jpg') }}"
                                            alt="product image">
                                    </div>
                                    <div class="lg-image">
                                        <img src="{{ asset('assets/front/images/product/large-size/6.jpg') }}"
                                            alt="product image">
                                    </div>
                                </div>
                                <div class="product-details-thumbs slider-thumbs-1">
                                    <div class="sm-image"><img
                                            src="{{ asset('assets/front/images/product/small-size/1.jpg') }}"
                                            alt="product image thumb"></div>
                                    <div class="sm-image"><img
                                            src="{{ asset('assets/front/images/product/small-size/2.jpg') }}"
                                            alt="product image thumb"></div>
                                    <div class="sm-image"><img
                                            src="{{ asset('assets/front/images/product/small-size/3.jpg') }}"
                                            alt="product image thumb"></div>
                                    <div class="sm-image"><img
                                            src="{{ asset('assets/front/images/product/small-size/4.jpg') }}"
                                            alt="product image thumb"></div>
                                    <div class="sm-image"><img
                                            src="{{ asset('assets/front/images/product/small-size/5.jpg') }}"
                                            alt="product image thumb"></div>
                                    <div class="sm-image"><img
                                            src="{{ asset('assets/front/images/product/small-size/6.jpg') }}"
                                            alt="product image thumb"></div>
                                </div>
                            </div>
                            <!--// Product Details Left -->
                        </div>

                        <div class="col-lg-7 col-md-6 col-sm-6">
                            <div class="product-details-view-content pt-60">
                                <div class="product-info">
                                    <h2></h2>
                                    <span class="product-details-ref">Reference: demo_15</span>
                                    <div class="rating-box pt-20">
                                        <ul class="rating rating-with-review-item">
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                            <li class="review-item"><a href="#">Read Review</a></li>
                                            <li class="review-item"><a href="#">Write Review</a></li>
                                        </ul>
                                    </div>
                                    <div class="price-box pt-20">
                                        <span class="new-price new-price-2">$</span>
                                    </div>
                                    <div class="product-desc">
                                        <p>
                                            <span>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="product-variants">
                                        <div class="produt-variants-size">
                                            <label>Dimension</label>
                                            <select class="nice-select">
                                                <option value="">...</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="single-add-to-cart">
                                        <form action="#" class="cart-quantity">
                                            <div class="quantity">
                                                <label>Quantity</label>
                                                <div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box" value="1" type="text">
                                                    <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                    <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                                </div>
                                            </div>
                                            <button class="add-to-cart" type="submit">Add to cart</button>
                                        </form>
                                    </div>
                                    <div class="product-additional-info pt-25">
                                        <a class="wishlist-btn" href="wishlist.html"><i class="fa fa-heart-o"></i>Add
                                            to wishlist</a>
                                        <div class="product-social-sharing pt-25">
                                            <ul>
                                                <li class="facebook"><a href="#"><i
                                                            class="fa fa-facebook"></i>Facebook</a></li>
                                                <li class="twitter"><a href="#"><i
                                                            class="fa fa-twitter"></i>Twitter</a></li>
                                                <li class="google-plus"><a href="#"><i
                                                            class="fa fa-google-plus"></i>Google +</a></li>
                                                <li class="instagram"><a href="#"><i
                                                            class="fa fa-instagram"></i>Instagram</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

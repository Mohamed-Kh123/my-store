@extends('layouts.store')
@section('content')
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="active">Categories</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!-- Begin Li's Content Wraper Area -->
    <div class="content-wraper pt-60 pb-60 pt-sm-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 order-1 order-lg-2">
                    <!-- Begin Li's Banner Area -->
                    <div class="single-banner shop-page-banner">
                        <a href="#">
                            <img src="{{ asset('assets/front/images/bg-banner/2.jpg') }}" alt="Li's Static Banner">
                        </a>
                    </div>
                    <!-- Li's Banner Area End Here -->
                    <!-- shop-top-bar start -->
                    <div class="shop-top-bar mt-30">
                        <div class="shop-bar-inner">
                            <div class="product-view-mode">
                                <!-- shop-item-filter-list start -->
                                <ul class="nav shop-item-filter-list" role="tablist">
                                    <li class="active" role="presentation"><a aria-selected="true" class="active show"
                                            data-toggle="tab" role="tab" aria-controls="grid-view" href="#grid-view"><i
                                                class="fa fa-th"></i></a></li>
                                </ul>
                                <!-- shop-item-filter-list end -->
                            </div>
                            <div class="toolbar-amount">
                                <span>Showing 1 to 9 of 15</span>
                            </div>
                        </div>
                        <!-- product-select-box start -->
                            <div class="product-select-box">
                                <div class="product-short">
                                    <p>Sort By:</p>
                                    <select class="nice-select" name="sortBy" id="category-select">
                                            <option value="trending" @if(request()->sortBy == 'trending') selected @endif>Relevance</option>
                                            <option value="name"  @if(request()->sortBy  == 'name') selected @endif>Name (A - Z)</option>
                                            <option value="-name" @if(request()->sortBy  == '-name') selected @endif>Name (Z - A)</option>
                                            <option value="price" @if(request()->sortBy  == 'price') selected @endif>Price (Low &gt; High)</option>
                                            <option value="-rating" @if(request()->sortBy  == '-rating') selected @endif>Rating (Lowest)</option>
                                    </select>
                                </div>
                            </div>
                        <!-- product-select-box end -->
                    </div>
                    <!-- shop-top-bar end -->
                    <!-- shop-products-wrapper start -->
                    <div class="shop-products-wrapper">
                        <div class="tab-content">
                            <div id="grid-view" class="tab-pane fade active show" role="tabpanel">
                                <div class="product-area shop-product-area" >
                                    <div class="row" id="prod-det">
                                        @foreach ($products as $product)
                                            <div class="col-lg-4 col-md-4 col-sm-6 mt-40" >
                                                <!-- single-product-wrap start -->
                                                <div class="single-product-wrap">
                                                    <div class="product-image">
                                                        <a href="{{ $product->link }}">
                                                            <img src="{{ $product->image_url }}"
                                                                alt="Li's Product Image">
                                                        </a>
                                                        <span class="sticker">New</span>
                                                    </div>
                                                    <div class="product_desc">
                                                        <div class="product_desc_info">
                                                            <div class="product-review">
                                                                <h5 class="manufacturer">
                                                                    <a href="{{ $product->link }}">{{ $product->category->name }}</a>
                                                                </h5>
                                                                <div class="rating-box">
                                                                    <ul class="rating">
                                                                        @for($i=1; $i<=$product->total_ratings; $i++)
                                                                        <li><i class="fa fa-star-o"></i></li>
                                                                        @endfor
                                                                        @for($j = $product->total_ratings+1; $j <= 5; $j++)
                                                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                        @endfor
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <h4><a class="product_name"
                                                                    href="{{$product->link}}">{{$product->name}}</a></h4>
                                                            <div class="price-box">
                                                                <span class="new-price">${{$product->price}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="add-actions">
                                                            <ul class="add-actions-link">
                                                                <form action="{{route('cart.store')}}" method="post">
                                                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                                                    @csrf
                                                                    <button type="submit"> 
                                                                    <li class="add-cart active">Add to cart</li>
                                                                    </button>
                                                                </form>
                                                                <li>
                                                                    <a href="#" title="quick view"
                                                                    class="quick-view-btn" data-toggle="modal" 
                                                                    data-target="#exampleModalCenter">
                                                                    <i class="fa fa-eye"></i>
                                                                    </a>
                                                                </li>
                                                                    <form action="{{ route('wishlist.store') }}" method="post">
                                                                        @csrf
                                                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                                        <button type="submit" class="heart"><a class="links-details" href="#"><i class="fa fa-heart-o"></i></a></button>
                                                                    </form>
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
                            
                            <div class="paginatoin-area">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 pt-xs-15">
                                        <p>Showing 1-12 of 13 item(s)</p>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <ul class="pagination-box pt-xs-20 pb-xs-15">
                                            <li><a href="#" class="Previous"><i class="fa fa-chevron-left"></i>
                                                    Previous</a>
                                            </li>
                                            <li class="active"><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li>
                                                <a href="#" class="Next"> Next <i
                                                        class="fa fa-chevron-right"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- shop-products-wrapper end -->
                </div>
                
                <div class="col-lg-3 order-2 order-lg-1">
                    <!--sidebar-categores-box start  -->
                    <div class="sidebar-categores-box mt-sm-30 mt-xs-30">
                        
                        <div class="sidebar-title">
                            <h2></h2>
                        </div>
                        <!-- category-sub-menu start -->
                        <div class="category-sub-menu">
                            <ul>
                                
                                <li class="has-sub"><a href="#"></a>
                                    <ul>
                                        <li><a href="#"></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!-- category-sub-menu end -->
                    </div>
                    <!--sidebar-categores-box end  -->
                    <!--sidebar-categores-box start  -->
                    <div class="sidebar-categores-box">
                        <div class="sidebar-title">
                            <h2>Filter By</h2>
                        </div>
                        <!-- btn-clear-all start -->
                        <button class="btn-clear-all mb-sm-30 mb-xs-30">Clear all</button>
                        <!-- btn-clear-all end -->
                        <!-- filter-sub-area start -->
                        <form method="get" id="filter-data" action="{{route('category.index')}}">
                        <div class="filter-sub-area">
                            <h5 class="filter-sub-titel">Brand</h5>
                            <div class="categori-checkbox">
                                @foreach($brands as $brand)
                                    <ul>
                                        <li><input type="checkbox" name="brand[]" value="{{$brand->id}}"@if(request()->brand == $brand->id) checked @endif> {{$brand->name}}</li>
                                    </ul>
                                @endforeach
                            </div>
                        </div>
                        <!-- filter-sub-area end -->
                        <!-- filter-sub-area start -->
                        <div class="filter-sub-area pt-sm-10 pt-xs-10">
                            <h5 class="filter-sub-titel">Categories</h5>
                            <div class="categori-checkbox">
                                    <ul>
                                        @foreach($categories as $category)
                                        <li><input type="checkbox" name="category[]" value="{{$category->id}}" @if(request()->category == $category->id) checked @endif> {{$category->name}} ()</li>
                                        @endforeach
                                    </ul>
                            </div>
                        </div>
                        <!-- filter-sub-area end -->
                        <!-- filter-sub-area start -->
                        <div class="filter-sub-area pt-sm-10 pt-xs-10">
                            <h5 class="filter-sub-titel">Size</h5>
                            <div class="size-checkbox">
                                    <ul>
                                        @foreach($sizes as $size)
                                        <li><input type="checkbox" name="size[]" value="{{$size->id}}"  @if(request()->size == $size->id) checked @endif> {{strtoupper($size->size)}}</li>
                                        @endforeach
                                    </ul>
                            </div>
                        </div>
                        <!-- filter-sub-area end -->
                        <!-- filter-sub-area start -->
                        <div class="filter-sub-area pt-sm-10 pt-xs-10">
                            <h5 class="filter-sub-titel">Color</h5>
                            <div class="size-checkbox">
                                    <ul>
                                        @foreach($colors as $color)
                                        <li><input type="checkbox" name="color[]" value="{{$color->id}}" @if(request()->color == $color->id) checked @endif> {{$color->name}}</li>
                                        @endforeach
                                    </ul>
                            </div>
                        </div>
                        <!-- filter-sub-area end -->
                        <!-- filter-sub-area start -->
                        <div class="filter-sub-area pt-sm-10 pb-sm-15 pb-xs-15">
                            <h5 class="filter-sub-titel">Dimension</h5>
                            <div class="categori-checkbox">
                                    <ul>
                                        @foreach($dimensions as $dimension)
                                        <li><input type="checkbox" name="dimension[]" value="{{$dimension->id}}" @if(request()->dimension == $dimension->id) checked @endif> {{$dimension->dimension}}</li>
                                        @endforeach
                                    </ul>
                        <button class="btn-primary mb-sm-30 mb-xs-30" type="submit">Apply Filter</button>
                        </form>
                            </div>
                        </div>
                        <!-- filter-sub-area end -->
                    </div>
                    <!--sidebar-categores-box end  -->
                    <!-- category-sub-menu start -->
                    <div class="sidebar-categores-box mb-sm-0 mb-xs-0">
                        <div class="sidebar-title">
                            <h2>Laptop</h2>
                        </div>
                        <div class="category-tags">
                            <ul>
                                @foreach($tags as $tag)
                                <li name="tag[]"    value="{{$tag->id}}">{{$tag->name}}</li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- category-sub-menu end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Wraper Area End Here -->
@endsection
<!-- Begin Quick View | Modal Area -->
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
                                    <h2>Today is a good day Framed poster</h2>
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
                                        <span class="new-price new-price-2">$57.98</span>
                                    </div>
                                    <div class="product-desc">
                                        <p>
                                            <span>100% cotton double printed dress. Black and white striped top and orange
                                                high waisted skater skirt bottom. Lorem ipsum dolor sit amet, consectetur
                                                adipisicing elit. quibusdam corporis, earum facilis et nostrum dolorum
                                                accusamus similique eveniet quia pariatur.
                                            </span>
                                        </p>
                                    </div>
                                    <div class="product-variants">
                                        <div class="produt-variants-size">
                                            <label>Dimension</label>
                                            <select class="nice-select">
                                                <option value="1" title="S" selected="selected">40x60cm
                                                </option>
                                                <option value="2" title="M">60x90cm</option>
                                                <option value="3" title="L">80x120cm</option>
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
    <!-- Quick View | Modal Area End Here -->
    </div>
    <!-- Body Wrapper End Here -->
@endsection

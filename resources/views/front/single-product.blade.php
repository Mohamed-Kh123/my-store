@extends('layouts.store')
@section('content')
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="active">{{ $product->name }}</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="content-wraper">
        <div class="container">
            <div class="row single-product-area">
                <div class="col-lg-5 col-md-6">
                    <!-- Product Details Left -->
                    <div class="product-details-left">
                        <div class="product-details-images slider-navigation-1">
                                    <div class="lg-image">
                                        <a class="popup-img venobox vbox-item" href="{{ $product->image_url }}"
                                            data-gall="myGallery">
                                            <img src="{{ $product->image_url }}" alt="product image">
                                        </a>
                                    </div>
                        </div>
                            <div class="product-details-thumbs slider-thumbs-1">
                                    <div class="sm-image"><img src="{{ $product->image_url }}" alt="product image thumb"></div>
                            </div>
                    </div>
                    <!--// Product Details Left -->
                </div>

                <div class="col-lg-7 col-md-6">
                    <div class="product-details-view-content pt-60">
                        <div class="product-info">
                            <h2>{{ $product->name }}</h2>
                            <span class="product-details-ref">Reference: demo_15</span>
                            
                            <div class="rating-box pt-20">
                                <ul class="rating rating-with-review-item">
                                    @for($i=1; $i<=$product->total_ratings; $i++)
                                        <li><i class="fa fa-star-o"></i></li>
                                    @endfor
                                    @for($j = $product->total_ratings+1; $j <= 5; $j++)
                                        <li class="no-star"><i class="fa fa-star-o"></i></li>
                                    @endfor
                                    <li class="review-item"><a href="#">Read Review</a></li>
                                    <li class="review-item"><a href="#">Write Review</a></li>
                                </ul>
                            </div>
                            <div class="price-box pt-20">
                                <span class="new-price">${{ $product->price - (($product->discount / 100) * $product->price) }}</span>
                                @if($product->discount)
                                <span class="old-price">${{$product->price }}</span>
                                <span class="discount-percentage">-{{$product->discount}}%</span>
                                @endif
                            </div>
                            <div class="product-desc">
                                <p>
                                    <span>{{ $product->description }}.
                                    </span>
                                </p>
                            </div>
                            <div class="product-variants">
                                <div class="produt-variants-size">
                                    @if($product->dimensions)
                                    <label>Dimension</label>
                                    <select class="nice-select">
                                        @foreach($product->dimensions as $dimension)
                                        <option value="{{$dimension->dimension}}">{{$dimension->dimension}}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                </div>
                            </div>
                            <div class="single-add-to-cart">
                                <form action="{{ route('cart') }}" class="cart-quantity" method="post" id="add-to-cart">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div class="quantity">
                                        <label>Quantity</label>
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" name="quantity" value="1">
                                            <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                            <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                        </div>
                                    </div>
                                    <button class="add-to-cart" type="submit">Add to cart</button>
                                </form>
                            </div>
                            <div class="product-additional-info pt-25">
                                <form action="{{ route('wishlist.store') }}" method="post">
                                    @csrf
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $message)
                                                    <li>{{ $message }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="wishlist-btn">
                                        <i class="fa fa-heart-o"></i>Add to wishlist
                                    </button>
                                </form>
                                <div class="product-social-sharing pt-25">
                                    <ul>
                                        <li class="facebook"><a href="#"><i class="fa fa-facebook"></i>Facebook</a>
                                        </li>
                                        <li class="twitter"><a href="#"><i class="fa fa-twitter"></i>Twitter</a>
                                        </li>
                                        <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i>Google
                                                +</a></li>
                                        <li class="instagram"><a href="#"><i
                                                    class="fa fa-instagram"></i>Instagram</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="block-reassurance">
                                <ul>
                                    <li>
                                        <div class="reassurance-item">
                                            <div class="reassurance-icon">
                                                <i class="fa fa-check-square-o"></i>
                                            </div>
                                            <p>Security policy (edit with Customer reassurance module)</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="reassurance-item">
                                            <div class="reassurance-icon">
                                                <i class="fa fa-truck"></i>
                                            </div>
                                            <p>Delivery policy (edit with Customer reassurance module)</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="reassurance-item">
                                            <div class="reassurance-icon">
                                                <i class="fa fa-exchange"></i>
                                            </div>
                                            <p> Return policy (edit with Customer reassurance module)</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wraper end -->
    <!-- Begin Product Area -->
    <div class="product-area pt-35">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="li-product-tab">
                        <ul class="nav li-product-menu">
                            <li><a class="active" data-toggle="tab" href="#description"><span>Description</span></a></li>
                            <li><a data-toggle="tab" href="#reviews"><span>Reviews</span></a></li>
                        </ul>
                    </div>
                    <!-- Begin Li's Tab Menu Content Area -->
                </div>
            </div>
            <div class="tab-content">
                <div id="description" class="tab-pane active show" role="tabpanel">
                    <div class="product-description">
                        <span>{{ $product->description }}</span>
                    </div>
                </div>
                <div id="reviews" class="tab-pane" role="tabpanel">
                    <div class="product-reviews">
                        <div class="product-details-comment-block">
                            <div class="comment-review">
                                <span>Grade</span>
                                <ul class="rating">
                                    @for($i=1; $i<=$product->total_ratings; $i++)
                                        <li><i class="fa fa-star-o"></i></li>
                                    @endfor
                                    @for($j = $product->total_ratings+1; $j <= 5; $j++)
                                        <li class="no-star"><i class="fa fa-star-o"></i></li>
                                    @endfor
                                </ul>
                            </div>
                            <br><br>
                            <div class="review-btn">
                                <a class="review-links" href="#" data-toggle="modal" data-target="#mymodal">Write
                                    Your Review!</a>
                            </div>
                            <!-- Begin Quick View | Modal Area -->
                            <div class="modal fade modal-wrapper" id="mymodal">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <h3 class="review-page-title">Write Your Review</h3>
                                            <div class="modal-inner-area row">
                                                <div class="col-lg-6">
                                                    <div class="li-review-product">
                                                        
                                                            <img src="{{ $product->image_url }}" alt="Li's Product"
                                                                width="200" height="200">
                                                        <div class="li-review-product-desc">
                                                            <p class="li-product-name">{{ $product->name }}
                                                            </p>
                                                            <p>
                                                                <span>{{ $product->description }}</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="li-review-content">
                                                        <!-- Begin Feedback Area -->
                                                        <div class="feedback-area">
                                                            <div class="feedback">
                                                                <h3 class="feedback-title">Our Feedback</h3>
                                                                <form action="{{route('rating.store')}}" method="post" id="add-rating">
                                                                    @csrf
                                                                    @if ($errors->any())
                                                                        <div class="alert alert-danger">
                                                                            <ul>
                                                                                @foreach ($errors->all() as $message)
                                                                                    <li>{{ $message }}</li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    @endif
                                                                    <input type="hidden" name="product_id"
                                                                        value="{{ $product->id }}">
                                                                    
                                                                    <p class="your-opinion">
                                                                        <label>Your Rating</label>
                                                                        <span>
                                                                            <select class="star-rating" name="ratings" id="ratings">
                                                                                <option
                                                                                    value="1"@if ($rating->ratings == 1) selected @endif>
                                                                                    1</option>
                                                                                <option
                                                                                    value="2"@if ($rating->ratings == 2) selected @endif>
                                                                                    2</option>
                                                                                <option
                                                                                    value="3"@if ($rating->ratings == 3) selected @endif>
                                                                                    3</option>
                                                                                <option
                                                                                    value="4"@if ($rating->ratings == 4) selected @endif>
                                                                                    4</option>
                                                                                <option
                                                                                    value="5"@if ($rating->ratings == 5) selected @endif>
                                                                                    5</option>
                                                                            </select>
                                                                        </span>
                                                                    </p>
                                                                    <p class="feedback-form">
                                                                        <label for="feedback">Your Review</label>
                                                                        <textarea id="feedback" name="review" cols="45" rows="8" aria-required="true"></textarea>
                                                                    </p>
                                                                    <div class="feedback-input">
                                                                        <div class="feedback-btn pb-15">
                                                                            <a href="#" class="close"
                                                                                data-dismiss="modal"
                                                                                aria-label="Close">Close</a>
                                                                            <button type="submit">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <!-- Feedback Area End Here -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Quick View | Modal Area End Here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Area End Here -->
    <!-- Begin Li's Laptop Product Area -->
    <section class="product-area li-laptop-product pt-30 pb-50">
        <div class="container">
            <div class="row">
                <!-- Begin Li's Section Area -->
                <div class="col-lg-12">
                    <div class="li-section-title">
                        <h2>
                            <span>15 other products in the same category:</span>
                        </h2>
                    </div>
                    <div class="row">
                        <div class="product-active owl-carousel">

                            @foreach ($productsInSameCategory as $value)
                                <div class="col-lg-12">
                                    <!-- single-product-wrap start -->
                                    <div class="single-product-wrap">

                                        <div class="product_desc">
                                            <div class="product-image">
                                                <a href="{{ $value->link }}">
                                                    
                                                        <img src="{{ $value->image_url }}" alt="Li's Product Image">
                                                </a>
                                                <span class="sticker">New</span>
                                            </div>
                                            <div class="product_desc_info">
                                                <div class="product-review">
                                                    <h5 class="manufacturer">
                                                        <a href="product-details.html">Graphic Corner</a>
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
                                                        href="{{$value->link}}">{{ $value->name }}</a></h4>
                                                <div class="price-box">
                                                    <span class="new-price">${{ $value->price - (($value->discount / 100) * $value->price) }}</span>
                                                    @if($value->discount)
                                                    <span class="old-price">${{$value->price }}</span>
                                                    <span class="discount-percentage">-{{$value->discount}}%</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul class="add-actions-link">
                                                    <li class="add-cart active"><a href="route('cart.store')">Add to cart</a></li>
                                                    <li><a href="#" title="quick view" class="quick-view-btn"
                                                            data-toggle="modal" data-target="#exampleModalCenter"><i
                                                                class="fa fa-eye"></i></a></li>
                                                    <li><a class="links-details" href="{{ route('wishlist') }}"><i
                                                                class="fa fa-heart-o"></i></a></li>
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
                                        <img src="images/product/large-size/1.jpg" alt="product image">
                                    </div>
                                    <div class="lg-image">
                                        <img src="images/product/large-size/2.jpg" alt="product image">
                                    </div>
                                    <div class="lg-image">
                                        <img src="images/product/large-size/3.jpg" alt="product image">
                                    </div>
                                    <div class="lg-image">
                                        <img src="images/product/large-size/4.jpg" alt="product image">
                                    </div>
                                    <div class="lg-image">
                                        <img src="images/product/large-size/5.jpg" alt="product image">
                                    </div>
                                    <div class="lg-image">
                                        <img src="images/product/large-size/6.jpg" alt="product image">
                                    </div>
                                </div>
                                <div class="product-details-thumbs slider-thumbs-1">
                                    <div class="sm-image"><img src="images/product/small-size/1.jpg"
                                            alt="product image thumb"></div>
                                    <div class="sm-image"><img src="images/product/small-size/2.jpg"
                                            alt="product image thumb"></div>
                                    <div class="sm-image"><img src="images/product/small-size/3.jpg"
                                            alt="product image thumb"></div>
                                    <div class="sm-image"><img src="images/product/small-size/4.jpg"
                                            alt="product image thumb"></div>
                                    <div class="sm-image"><img src="images/product/small-size/5.jpg"
                                            alt="product image thumb"></div>
                                    <div class="sm-image"><img src="images/product/small-size/6.jpg"
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
                                        <a class="wishlist-btn" href="wishlist.html"><i class="fa fa-heart-o"></i>Add to
                                            wishlist</a>
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

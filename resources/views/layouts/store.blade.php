<!doctype html>
<html class="no-js" lang="zxx">

<!-- index28:48-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
    <!-- Material Design Iconic Font-V2.2.0 -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/material-design-iconic-font.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/font-awesome.min.css') }}">
    <!-- Font Awesome Stars-->
    <link rel="stylesheet" href="{{ asset('assets/front/css/fontawesome-stars.css') }}">
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/meanmenu.css') }}">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/owl.carousel.min.css') }}">
    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/slick.css') }}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/animate.css') }}">
    <!-- Jquery-ui CSS -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/jquery-ui.min.css') }}">
    <!-- Venobox CSS -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/venobox.css') }}">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/nice-select.css') }}">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/magnific-popup.css') }}">
    <!-- Bootstrap V4.1.3 Fremwork CSS -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}">
    <!-- Helper CSS -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/helper.css') }}">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/front/style.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/front/all.min.css') }}"> --}}
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/responsive.css') }}">
    <!-- Modernizr js -->

    <script src="{{ asset('assets/front/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body>
    @php
        $user = App\Models\User::where('type', 'super-admin')->first();
    @endphp
    <!--[if lt IE 8]>
  <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
 <![endif]-->
    <!-- Begin Body Wrapper -->
    <div class="body-wrapper">
        <!-- Begin Header Area -->
        <header>
            <!-- Begin Header Top Area -->
            <div class="header-top">
                <div class="container">
                    <div class="row">
                        <!-- Begin Header Top Left Area -->
                        <div class="col-lg-3 col-md-4">
                            <div class="header-top-left">
                                <ul class="phone-wrap">
                                    <li><span>Telephone Enquiry: </span>{{$user->phone_number}}</li>
                                </ul>
                            </div>
                        </div>
                        <!-- Header Top Left Area End Here -->
                        <!-- Begin Header Top Right Area -->
                        <div class="col-lg-9 col-md-8">
                            <div class="header-top-right">
                                <ul class="ht-menu">
                                    <!-- Begin Setting Area -->
                                    <li>
                                        <div class="ht-setting-trigger"><span>Setting</span></div>
                                        <div class="setting ht-setting">
                                            <ul class="ht-setting-list">
                                                <li><a href="{{ route('profile') }}">My Account</a></li>
                                                <li><a href="{{route('checkout')}}">Checkout</a></li>
                                                @if(!Auth::user())
                                                <li><a href="{{ route('login') }}">Sign In</a></li>
                                                <li><a href="{{ route('register') }}">Sign Up</a></li>
                                                @endif
                                                <li>
                                                    <form method="POST" action="{{ route('logout') }}">
                                                        @csrf

                                                        <x-dropdown-link :href="route('logout')"
                                                            onclick="event.preventDefault();
                                                                            this.closest('form').submit();">
                                                            {{ __('Log Out') }}
                                                        </x-dropdown-link>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <!-- Setting Area End Here -->
                                    <!-- Begin Currency Area -->
                                    <li>
                                        <span class="currency-selector-wrapper">Currency :</span>
                                        <div class="ht-currency-trigger"><span>USD $</span></div>
                                    </li>
                                    <!-- Currency Area End Here -->
                                    <!-- Begin Language Area -->
                                    <li>
                                        <span class="language-selector-wrapper">Language :</span>
                                        <div class="ht-language-trigger"><span>English</span></div>
                                        <div class="language ht-language">
                                            <ul class="ht-setting-list">
                                                <li class="active"><a href="#"><img
                                                            src="{{ asset('assets/front/images/menu/flag-icon/1.jpg') }}"
                                                            alt="">English</a></li>
                                        </div>
                                    </li>
                                    <!-- Language Area End Here -->
                                </ul>
                            </div>
                        </div>
                        <!-- Header Top Right Area End Here -->
                    </div>
                </div>
            </div>
            <!-- Header Top Area End Here -->
            <!-- Begin Header Middle Area -->
            <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
                <div class="container">
                    <div class="row">
                        <!-- Begin Header Logo Area -->
                        <div class="col-lg-3">
                            <div class="logo pb-sm-30 pb-xs-30">
                                <a href="{{ route('home') }}">
                                    <img src="{{ asset('assets/front/images/menu/logo/1.jpg') }}" alt="">
                                </a>
                            </div>
                        </div>
                        <!-- Header Logo Area End Here -->
                        <!-- Begin Header Middle Right Area -->
                        <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
                            <!-- Begin Header Middle Searchbox Area -->
                            <form action="{{route('search')}}" method="get" class="hm-searchbox">
                                <input type="text" placeholder="Enter your search key ..." name="search">
                                <button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
                            </form>
                            <!-- Header Middle Searchbox Area End Here -->
                            <!-- Begin Header Middle Right Area -->
                            <div class="header-middle-right">
                                <ul class="hm-menu">
                                    <!-- Begin Header Middle Wishlist Area -->
                                    <x-wishlist />
                                    <!-- Header Middle Wishlist Area End Here -->
                                    <!-- Begin Header Mini Cart Area -->
                                    <x-cart-menu />
                                    <!-- Header Mini Cart Area End Here -->
                                </ul>
                            </div>
                            <!-- Header Middle Right Area End Here -->
                        </div>
                        <!-- Header Middle Right Area End Here -->
                    </div>
                </div>
            </div>
            <!-- Header Middle Area End Here -->
            <!-- Begin Header Bottom Area -->
            <div class="header-bottom header-sticky d-none d-lg-block d-xl-block">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Begin Header Bottom Menu Area -->
                            <div class="hb-menu">
                                <nav>
                                    <ul>
                                        <li class="dropdown-holder"><a href="{{ route('home') }}">Home</a>
                                        </li>
                                        <li class="catmenu-dropdown megamenu-holder"><a
                                                href="{{ route('category.index') }}">Categories</a>
                                        </li>
                                        <li><a href="{{ route('about.index') }}">About Us</a></li>
                                        <li><a href="{{ route('contact.index') }}">Contact Us</a></li>
                                        <li><a href="{{ route('orders') }}">Orders</a></li>
                                    </ul>
                                </nav>
                            </div>
                            <!-- Header Bottom Menu Area End Here -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header Bottom Area End Here -->
            <!-- Begin Mobile Menu Area -->
            <div class="mobile-menu-area d-lg-none d-xl-none col-12">
                <div class="container">
                    <div class="row">
                        <div class="mobile-menu">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu Area End Here -->
        </header>
        <x-alert />
        @yield('content')
        <!-- Begin Footer Area -->
        <div class="footer">
            <!-- Begin Footer Static Top Area -->
            <div class="footer-static-top">
                <div class="container">
                    <!-- Begin Footer Shipping Area -->
                    <div class="footer-shipping pt-60 pb-55 pb-xs-25">
                        <div class="row">
                            <!-- Begin Li's Shipping Inner Box Area -->
                            <div class="col-lg-3 col-md-6 col-sm-6 pb-sm-55 pb-xs-55">
                                <div class="li-shipping-inner-box">
                                    <div class="shipping-icon">
                                        <img src="{{ asset('assets/front/images/shipping-icon/1.png') }}"
                                            alt="Shipping Icon">
                                    </div>
                                    <div class="shipping-text">
                                        <h2>Free Delivery</h2>
                                        <p>And free returns. See checkout for delivery dates.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Li's Shipping Inner Box Area End Here -->
                            <!-- Begin Li's Shipping Inner Box Area -->
                            <div class="col-lg-3 col-md-6 col-sm-6 pb-sm-55 pb-xs-55">
                                <div class="li-shipping-inner-box">
                                    <div class="shipping-icon">
                                        <img src="{{ asset('assets/front/images/shipping-icon/2.png') }}"
                                            alt="Shipping Icon">
                                    </div>
                                    <div class="shipping-text">
                                        <h2>Safe Payment</h2>
                                        <p>Pay with the world's most popular and secure payment methods.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Li's Shipping Inner Box Area End Here -->
                            <!-- Begin Li's Shipping Inner Box Area -->
                            <div class="col-lg-3 col-md-6 col-sm-6 pb-xs-30">
                                <div class="li-shipping-inner-box">
                                    <div class="shipping-icon">
                                        <img src="{{ asset('assets/front/images/shipping-icon/3.png') }}"
                                            alt="Shipping Icon">
                                    </div>
                                    <div class="shipping-text">
                                        <h2>Shop with Confidence</h2>
                                        <p>Our Buyer Protection covers your purchasefrom click to delivery.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Li's Shipping Inner Box Area End Here -->
                            <!-- Begin Li's Shipping Inner Box Area -->
                            <div class="col-lg-3 col-md-6 col-sm-6 pb-xs-30">
                                <div class="li-shipping-inner-box">
                                    <div class="shipping-icon">
                                        <img src="{{ asset('assets/front/images/shipping-icon/4.png') }}"
                                            alt="Shipping Icon">
                                    </div>
                                    <div class="shipping-text">
                                        <h2>24/7 Help Center</h2>
                                        <p>Have a question? Call a Specialist</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Li's Shipping Inner Box Area End Here -->
                        </div>
                    </div>
                    <!-- Footer Shipping Area End Here -->
                </div>
            </div>
            <!-- Footer Static Top Area End Here -->
            <!-- Begin Footer Static Middle Area -->
            <div class="footer-static-middle">
                <div class="container">
                    <div class="footer-logo-wrap pt-50 pb-35">
                        <div class="row">
                            <!-- Begin Footer Logo Area -->
                            <div class="col-lg-4 col-md-6">
                                <div class="footer-logo">
                                    <img src="{{ asset('assets/front/images/menu/logo/1.jpg') }}" alt="Footer Logo">
                                    <p class="info">
                                        We are a team of designers and developers that create high quality HTML Template
                                        & Woocommerce, Shopify Theme.
                                    </p>
                                </div>
                                <ul class="des">
                                    <li>
                                        <span>Address: </span>
                                        6688Princess Road, London, Greater London BAS 23JK, UK
                                    </li>
                                    <li>
                                        <span>Phone: </span>
                                        <span> {{ $user->phone_number }}</span>
                                    </li>
                                    <li>
                                        <span>Email: </span>
                                        <a href="mailto://info@yourdomain.com">{{ $user->email }}</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Footer Logo Area End Here -->

                            <!-- Begin Footer Block Area -->
                            <div class="col-lg-4">
                                <div class="footer-block">
                                    <h3 class="footer-block-title">Follow Us</h3>
                                    <ul class="social-link">
                                        <li class="twitter">
                                            <a href="https://twitter.com/" data-toggle="tooltip" target="_blank"
                                                title="Twitter">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li class="rss">
                                            <a href="https://rss.com/" data-toggle="tooltip" target="_blank"
                                                title="RSS">
                                                <i class="fa fa-rss"></i>
                                            </a>
                                        </li>
                                        <li class="google-plus">
                                            <a href="https://www.plus.google.com/discover" data-toggle="tooltip"
                                                target="_blank" title="Google Plus">
                                                <i class="fa fa-google-plus"></i>
                                            </a>
                                        </li>
                                        <li class="facebook">
                                            <a href="https://www.facebook.com/" data-toggle="tooltip" target="_blank"
                                                title="Facebook">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                        </li>
                                        <li class="youtube">
                                            <a href="https://www.youtube.com/" data-toggle="tooltip" target="_blank"
                                                title="Youtube">
                                                <i class="fa fa-youtube"></i>
                                            </a>
                                        </li>
                                        <li class="instagram">
                                            <a href="https://www.instagram.com/" data-toggle="tooltip"
                                                target="_blank" title="Instagram">
                                                <i class="fa fa-instagram"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Footer Block Area End Here -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer Static Middle Area End Here -->
            <!-- Begin Footer Static Bottom Area -->
            <div class="footer-static-bottom pt-55 pb-55">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Begin Footer Payment Area -->
                            <div class="copyright text-center">
                                <a href="">
                                    <img src="{{ asset('assets/front/images/payment/1.png') }}" alt="">
                                </a>
                            </div>
                            <!-- Footer Payment Area End Here -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer Static Bottom Area End Here -->
        </div>
        <!-- Footer Area End Here -->
        <!-- Begin Quick View | Modal Area -->
        @yield('modal_area')
        <!-- Quick View | Modal Area End Here -->
    </div>
    <!-- Body Wrapper End Here -->
    <!-- jQuery-V1.12.4 -->
    <script src="{{ asset('assets/front/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <!-- Popper js -->
    <script src="{{ asset('assets/front/js/vendor/popper.min.js') }}"></script>
    <!-- Bootstrap V4.1.3 Fremwork js -->
    <script src="{{ asset('assets/front/js/bootstrap.min.js') }}"></script>
    <!-- Ajax Mail js -->
    <script src="{{ asset('assets/front/js/ajax-mail.js') }}"></script>
    <!-- Meanmenu js -->
    <script src="{{ asset('assets/front/js/jquery.meanmenu.min.js') }}"></script>
    <!-- Wow.min js -->
    <script src="{{ asset('assets/front/js/wow.min.js') }}"></script>
    <!-- Slick Carousel js -->
    <script src="{{ asset('assets/front/js/slick.min.js') }}"></script>
    <!-- Owl Carousel-2 js -->
    <script src="{{ asset('assets/front/js/owl.carousel.min.js') }}"></script>
    <!-- Magnific popup js -->
    <script src="{{ asset('assets/front/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Isotope js -->
    <script src="{{ asset('assets/front/js/isotope.pkgd.min.js') }}"></script>
    <!-- Imagesloaded js -->
    <script src="{{ asset('assets/front/js/imagesloaded.pkgd.min.js') }}"></script>
    <!-- Mixitup js -->
    <script src="{{ asset('assets/front/js/jquery.mixitup.min.js') }}"></script>
    <!-- Countdown -->
    <script src="{{ asset('assets/front/js/jquery.countdown.min.js') }}"></script>
    <!-- Counterup -->
    <script src="{{ asset('assets/front/js/jquery.counterup.min.js') }}"></script>
    <!-- Waypoints -->
    <script src="{{ asset('assets/front/js/waypoints.min.js') }}"></script>
    <!-- Barrating -->
    <script src="{{ asset('assets/front/js/jquery.barrating.min.js') }}"></script>
    <!-- Jquery-ui -->
    <script src="{{ asset('assets/front/js/jquery-ui.min.js') }}"></script>
    <!-- Venobox -->
    <script src="{{ asset('assets/front/js/venobox.min.js') }}"></script>
    <!-- Nice Select js -->
    <script src="{{ asset('assets/front/js/jquery.nice-select.min.js') }}"></script>
    <!-- ScrollUp js -->
    <script src="{{ asset('assets/front/js/scrollUp.min.js') }}"></script>
    <!-- Main/Activator js -->
    <script src="{{ asset('assets/front/js/main.js') }}"></script>
    {{-- <script src="{{ asset('assets/front/all.min.js') }}"></script> --}}

    @yield('script')
    <script>
        (function($) {
            $('input#item-quantity').on('click', function(e) {
                // alert('hi')
                e.preventDefault();
                $.ajax({
                    url: '/cart/' + $(this).data('id'),
                    method: 'post',
                    data: {
                        quantity: $(this).val(),
                        _token: $("meta[name='csrf-token']").attr("content")
                    }
                })
            })
        })(jQuery);

        (function($) {
            $('a#removeCart').on('click', function(e) {
                e.preventDefault();
                // alert('hi')
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        $.ajax({
                            url: '/cart/' + id,
                            method: 'delete',
                            data: {
                                _token: $("meta[name='csrf-token']").attr("content")
                            },
                            success: function(response) {
                                $(`#${id}`).remove();
                            }
                        })
                    }
                })
            })
        })(jQuery);

        function addToCart(product_id, user_id, event) {
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/cart',
                method: 'post',
                data: {
                    product_id: product_id,
                    user_id: user_id,
                },
                dataType: 'json',
                success: function(data) {
                    if (data.status == 1) {
                        Swal.fire(
                            'Item added to cart!'
                        );
                    }

                },
            })
        }
        (function($) {
            $('#removeCoupon').on('click', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                $.ajax({
                    method: "post",
                    url: '/coupon/remove/' + id,
                    data: {
                        _token: $("meta[name='csrf-token']").attr("content"),
                    },
                    success: function(response) {
                        $(`#${id}`).hide();
                    }
                });
            })
        })(jQuery);

        function addToWishList(product_id, event) {
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: 'wishlist',
                method: 'post',
                data: {
                    product_id: product_id,
                },
                success: function(result) {
                    if(result.success){
                        Swal.fire(
                        'Item already in wishlist!',
                    )
                    }else{
                        Swal.fire(
                            'Item added to wishlist!',
                        )
                    }
                }
            })
        }

        (function($){
            $('#category-select').on('change', function(e){
                $.ajax({
                    method: "get",
                    url: '/categories',
                    success: function(response) {
                        if(response.data){
                            $('#prod-det').empty();
                            for(i in response.data){
                                product = response.data[i];
                                $('#prod-det').append(`
                                                <div class="col-lg-4 col-md-4 col-sm-6 mt-40" >
                                                    <!-- single-product-wrap start -->
                                                    <div class="single-product-wrap">
                                                        <div class="product-image">
                                                            <a href="${product.link}">
                                                                <img src="${product.image_url}"
                                                                    alt="Li's Product Image">
                                                            </a>
                                                            <span class="sticker">New</span>
                                                        </div>
                                                        <div class="product_desc">
                                                            <div class="product_desc_info">
                                                                <div class="product-review">
                                                                    <h5 class="manufacturer">
                                                                        <a href="${product.link}"></a>
                                                                    </h5>
                                                                </div>
                                                                <h4><a class="product_name"
                                                                        href="${product.link}">${product.name}</a></h4>
                                                                <div class="price-box">
                                                                    <span class="new-price">$${product.price}</span>
                                                                </div>
                                                            </div>
                                                            <div class="add-actions">
                                                                <ul class="add-actions-link">
                                                                    <form action="{{route('cart.store')}}" method="post">
                                                                        <input type="hidden" name="product_id" value="${product.id}">
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
                                                                            <input type="hidden" name="product_id" value="${product.id}">
                                                                            <button type="submit" class="heart"><a class="links-details" href="#"><i class="fa fa-heart-o"></i></a></button>
                                                                        </form>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- single-product-wrap end -->
                                                </div>
                                            `);
                            };
                        }
                    }
                });
            })
        })(jQuery)
    </script>
</body>

<!-- index30:23-->

</html>

@extends('layouts.store')
@section('content')
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="active">Wishlist</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!--Wishlist Area Strat-->
    <div class="wishlist-area pt-60 pb-60">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="#">
                        <div class="table-content table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="li-product-remove">remove</th>
                                        <th class="li-product-thumbnail">images</th>
                                        <th class="cart-product-name">Product</th>
                                        <th class="li-product-price">Unit Price</th>
                                        <th class="li-product-stock-status">Stock Status</th>
                                        <th class="li-product-add-cart">add to cart</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($wish_lists as $value)
                                    <tr id="{{$value->id}}">
                                        <td class="li-product-remove">
                                                <button type="submit" data-id="{{$value->id}}" id="remove" class="delete-record">
                                                    <i class="fa fa-times" ></i>
                                                </button>
                                            </form>
                                        </td>
                                        <div>
                                            <td class="li-product-thumbnail"><a href="{{route('single.product', $value->products->id)}}"><img src="{{$value->products->image_url}}" width="50" height="50" id="img"></a></td>
                                            <td class="li-product-name"><a href="{{$value->products->link}}" id="prod_name">{{$value->products->name}}</a></td>
                                            <td class="li-product-price"><span class="amount">${{$value->products->price}}</span></td>
                                            <td class="li-product-stock-status"><span class="in-stock">{{$value->products->status}}</span></td>
                                            <form action="{{route('cart.store')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{$value->products->id}}">
                                                <td class="li-product-add-cart"><button type="submit" id="submit">add to cart</button></td>
                                            </form>
                                        </div>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Wishlist Area End-->
@endsection

@section('modal_area')
    <div class="modal fade open-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i
                            class="fa fa-close"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Begin Modal Image Area -->
                        <div class="col-md-5">
                            <!-- Begin Modal Tab Content Area -->
                            <div class="tab-content product-details-large myTabContent">
                                <div class="tab-pane fade show active" id="single-slide1" role="tabpanel"
                                    aria-labelledby="single-slide-tab-1">
                                    <!--Single Product Image Start-->
                                    <div class="single-product-img img-full">
                                        <img src="{{asset('assets/front/images/product/large-size/1.jpg')}}" alt="">
                                    </div>
                                    <!--Single Product Image End-->
                                </div>
                                <div class="tab-pane fade" id="single-slide2" role="tabpanel"
                                    aria-labelledby="single-slide-tab-2">
                                    <!--Single Product Image Start-->
                                    <div class="single-product-img img-full">
                                        <img src="{{asset('assets/front/images/product/large-size/2.jpg')}}" alt="">
                                    </div>
                                    <!--Single Product Image End-->
                                </div>
                                <div class="tab-pane fade" id="single-slide3" role="tabpanel"
                                    aria-labelledby="single-slide-tab-3">
                                    <!--Single Product Image Start-->
                                    <div class="single-product-img img-full">
                                        <img src="{{asset('assets/front/images/product/large-size/3.jpg')}}" alt="">
                                    </div>
                                    <!--Single Product Image End-->
                                </div>
                                <div class="tab-pane fade" id="single-slide4" role="tabpanel"
                                    aria-labelledby="single-slide-tab-4">
                                    <!--Single Product Image Start-->
                                    <div class="single-product-img img-full">
                                        <img src="{{asset('assets/front/images/product/large-size/4.jpg')}}" alt="">
                                    </div>
                                    <!--Single Product Image End-->
                                </div>
                                <div class="tab-pane fade" id="single-slide5" role="tabpanel"
                                    aria-labelledby="single-slide-tab-4">
                                    <!--Single Product Image Start-->
                                    <div class="single-product-img img-full">
                                        <img src="{{asset('assets/front/images/product/large-size/5.jpg')}}" alt="">
                                    </div>
                                    <!--Single Product Image End-->
                                </div>
                                <div class="tab-pane fade" id="single-slide6" role="tabpanel"
                                    aria-labelledby="single-slide-tab-4">
                                    <!--Single Product Image Start-->
                                    <div class="single-product-img img-full">
                                        <img src="{{asset('assets/front/images/product/large-size/6.jpg')}}" alt="">
                                    </div>
                                    <!--Single Product Image End-->
                                </div>
                            </div>
                            <!-- Modal Tab Content Area End Here -->
                            <!-- Begin Modal Tab Menu Area -->
                            <div class="single-product-menu">
                                <div class="nav single-slide-menu owl-carousel" role="tablist">
                                    <div class="single-tab-menu img-full">
                                        <a class="active" data-toggle="tab" id="single-slide-tab-1"
                                            href="#single-slide1"><img src="{{asset('assets/front/images/product/small-size/1.jpg')}}"
                                                alt=""></a>
                                    </div>
                                    <div class="single-tab-menu img-full">
                                        <a data-toggle="tab" id="single-slide-tab-2" href="#single-slide2"><img
                                                src="{{asset('assets/front/images/product/small-size/2.jpg')}}" alt=""></a>
                                    </div>
                                    <div class="single-tab-menu img-full">
                                        <a data-toggle="tab" id="single-slide-tab-3" href="#single-slide3"><img
                                                src="{{asset('assets/front/images/product/small-size/3.jpg')}}" alt=""></a>
                                    </div>
                                    <div class="single-tab-menu img-full">
                                        <a data-toggle="tab" id="single-slide-tab-4" href="#single-slide4"><img
                                                src="{{asset('assets/front/images/product/small-size/4.jpg')}}" alt=""></a>
                                    </div>
                                    <div class="single-tab-menu img-full">
                                        <a data-toggle="tab" id="single-slide-tab-5" href="#single-slide5"><img
                                                src="{{asset('assets/front/images/product/small-size/5.jpg')}}" alt=""></a>
                                    </div>
                                    <div class="single-tab-menu img-full">
                                        <a data-toggle="tab" id="single-slide-tab-6" href="#single-slide6"><img
                                                src="{{asset('assets/front/images/product/small-size/6.jpg')}}" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Tab Menu End Here -->
                        </div>
                        <!-- Modal Image Area End Here -->
                        <!-- Begin Modal Content Area -->
                        <div class="col-md-7">
                            <div class="modal-product-info">
                                <h2>Accusantium dolorem1</h2>
                                <div class="modal-product-price">
                                    <span class="new-price">$46.80</span>
                                </div>
                                <div class="cart-description">
                                    <p>Vector graphic, format: svg. Download for personal, private and non-commercial use.
                                    </p>
                                </div>
                                <div class="quantity">
                                    <input class="input-text qty text" step="1" min="1" max="200"
                                        name="quantity" value="1" title="Qty" size="4" type="number">
                                </div>
                            </div>
                        </div>
                        <!-- Modal Content Area End Here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {            
            
            $(".delete-record").click('submit', function(e){
                e.preventDefault();
                var id = $(this).data("id");
                var token = $("meta[name='csrf-token']").attr("content");
                $.ajax(
                {
                    url: "/wishlist/"+id,
                    type: 'DELETE',
                    data: {
                        "id": id,
                        "_token": token,
                    },
                    success: function (response){
                        $(`#${id}`).remove();
                    }
                });
                
            });
        });
    </script>
    @endsection
    

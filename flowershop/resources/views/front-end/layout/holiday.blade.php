@extends('front-end.layout.index')
@section('content')

<div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> {{__('home')}}</a>
                        <a href="#">{{__('highlights')}}</a>
                        <span>{{$holiday->name}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">
                    <div class="filter-widget">
                        <h4 class="fw-title">{{__('highlights')}}</h4>
                        <ul class="filter-catagories">
                        @foreach($holiday_type as $l)
                            <li><a href="{{route('holiday',$l->id)}}">{{$l->name}}</a></li>
                        @endforeach
                        </ul>
                    </div>
                    <div class="filter-widget">
                        <h4 class="fw-title">{{__('tag')}}</h4>
                        <div class="fw-tags">
                            <a href="#">Wendy Flowers</a>
                            <a href="#">{{$holiday->name}}</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="product-show-option">
                        <div class="row">
                            <div class="col-lg-7 col-md-7">
                                <div class="select-option">
                                    <select class="sorting">
                                        <option value="">{{__('default')}}</option>
                                    </select>
                                    <select class="p-show">
                                        <option value="">{{__('show')}}: </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 text-right">
                                <p>{{__('show')}} 01 - 09 {{__('of')}} {{count($product_holiday)}} {{__('product')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="product-list">
                        <div class="row">
                        @foreach($product_holiday as $sp)
                            <div class="col-lg-4 col-sm-6">
                                <div class="product-item">
                                    <div class="pi-pic">
                                        <img id="wishlist_productimage{{$sp->product->id}}" src="{{$sp->product->image}}" alt="">
                                        @if($sp->product->promotion_price!=0)
                                        <div class="sale pp-sale">Sale</div>
                                        @endif
                                        <form>
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input type="hidden" value="{{$sp->product->name}}" id="wishlist_productname{{$sp->product->id}}"/>
                                            <input type="hidden" value="@if($sp->product->promotion_price==0) {{number_format($sp->product->unit_price)}} @else {{number_format($sp->product->promotion_price)}} @endif" id="wishlist_productprice{{$sp->product->id}}"/>
                                        </form>
                                        <div class="icon">
                                            @if(Auth::check())
                                                <a class="button_wishlist" id="{{$sp->product->id}}" onclick="add_wistlist(this.id);"><i class="icon_heart_alt" style="color:#6db340"></i></a>
                                            @else
                                                <a href="{{route('login')}}"><i class="icon_heart_alt" style="color:#6db340" title="Bạn cần đăng nhập"></i></a>
                                            @endif
                                        </div>
                                        <ul>
                                        <!-- href="{{route('addtocart',$sp->id)}}"> -->
                                            <li class="w-icon active"><a href="{{route('addtocart',$sp->product->id)}}" class="add-item-cart"> <i class="icon_bag_alt"></i></a></li>
                                            <li class="quick-view"><a class="QuickView" href="#" data-id="{{$sp->product->id}}" data-toggle="modal" data-target="#QuickView">+ {{__('quickview')}}</a></li>
                                            <li class="w-icon"><a id="wishlist_producturl{{$sp->product->id}}" href="{{route('productdetails',$sp->product->id)}}"><i class="fa fa-random"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="pi-text">
                                        <div class="catagory-name">{{$sp->product->product_type->name}}</div>
                                        <a href="#">
                                            <h5>{{$sp->product->name}}</h5>
                                        </a>
                                        <div class="product-price">
                                        @if($sp->product->promotion_price==0)
                                            {{number_format($sp->product->unit_price)}}
                                        @else
                                            {{number_format($sp->product->promotion_price)}}
                                            <span>{{number_format($sp->product->unit_price)}}</span>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="loading-more">
                        {{$product_holiday->links()}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->
    <script type="text/javascript" src="client_asset/assets/dest/js/jquery.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $(document).ready(function () {
                $('.cs-item a').click(function(e) {

                    $('.nav a.active').removeClass('active');

                    var $parent = $(this).parent();
                    $parent.addClass('active');
                    e.preventDefault();
                });
            });
        });
    </script>
@endsection
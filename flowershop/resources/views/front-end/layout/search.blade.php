@extends('front-end.layout.index')
@section('content')

<div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> {{__('home')}}</a>
                        <span>{{__('search')}}</span>
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
                        <h4 class="fw-title">{{__('category')}}</h4>
                        <ul class="filter-catagories">
                        @foreach($loai as $l)
                            <li><a href="{{route('category',$l->id)}}">{{$l->name}}</a></li>
                        @endforeach
                        </ul>
                    </div>
                    <div class="filter-widget">
                        <h4 class="fw-title">{{__('shop')}}</h4>
                        <div class="fw-brand-check">
                            @foreach($shop as $ch)
                            <div class="bc-item">
                                <label for="{{$ch->name}}">
                                <a href="{{route('shop',$ch->id)}}">{{$ch->name}}</a>
                                    <input type="checkbox" id="{{$ch->name}}" @foreach($product as $sp) @if($sp->id_shop==$ch->id) checked @endif @endforeach>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            @endforeach
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
                                        <option value="">{{__('show')}}:</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 text-right">
                                <p>{{__('show')}} 01 - 09 {{__('of')}} {{count($product)}} {{__('product')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="product-list">
                        <div class="row">
                        @foreach($product as $sp)
                            <div class="col-lg-4 col-sm-6">
                                <div class="product-item">
                                    <div class="pi-pic">
                                        <img id="wishlist_productimage{{$sp->id}}" src="{{$sp->image}}" alt="">
                                        @if($sp->promotion_price!=0)
                                        <div class="sale pp-sale">Sale</div>
                                        @endif
                                        <form>
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input type="hidden" value="{{$sp->name}}" id="wishlist_productname{{$sp->id}}"/>
                                            <input type="hidden" value="@if($sp->promotion_price==0) {{number_format($sp->unit_price)}} @else {{number_format($sp->promotion_price)}} @endif" id="wishlist_productprice{{$sp->id}}"/>
                                        </form>
                                        <div class="icon">
                                            @if(Auth::check())
                                                <a class="button_wishlist" id="{{$sp->id}}" onclick="add_wistlist(this.id);"><i class="icon_heart_alt" style="color:#6db340"></i></a>
                                            @else
                                                <a href="{{route('login')}}"><i class="icon_heart_alt" style="color:#6db340" title="Bạn cần đăng nhập"></i></a>
                                            @endif
                                        </div>
                                        <ul>
                                            <li class="w-icon active"><a href="{{route('addtocart',$sp->id)}}"><i class="icon_bag_alt"></i></a></li>
                                            <li class="quick-view"><a class="QuickView" href="#" data-id="{{$sp->id}}" data-toggle="modal" data-target="#QuickView">+ {{__('quickview')}}</a></li>
                                            <li class="w-icon"><a id="wishlist_producturl{{$sp->id}}" href="{{route('productdetails',$sp->id)}}"><i class="fa fa-random"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="pi-text">
                                        <div class="catagory-name">{{$sp->product_type->name}}</div>
                                        <a href="#">
                                            <h5>{{$sp->name}}</h5>
                                        </a>
                                        <div class="product-price">
                                        @if($sp->promotion_price==0)
                                            {{number_format($sp->unit_price)}}
                                        @else
                                            {{number_format($sp->promotion_price)}}
                                            <span>{{number_format($sp->unit_price)}}</span>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="loading-more">
                        {{$product->links()}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->
@endsection
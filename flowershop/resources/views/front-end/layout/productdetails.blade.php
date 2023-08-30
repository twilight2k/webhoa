@extends('front-end.layout.index')
@section('content')
<div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="{{route('home')}}"><i class="fa fa-home"></i> {{__('home')}}</a>
                        <a>{{__('details')}}</a>
                        <span>{{$sanpham->name}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad page-details">
        <div class="bg-logo">
            <img src="client_asset/assets/dest/img/logo_flowershopdalat.png" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="filter-widget">
                        <h4 class="fw-title">{{__('category')}}</h4>
                        <ul class="filter-catagories">
                        @foreach($loai as $l)
                            <li><a href="{{route('category',$l->id)}}">{{$l->name}}({{count($l->product)}})</a></li>
                        @endforeach
                        </ul>
                    </div>
                    <div class="filter-widget">
                        <h4 class="fw-title">{{__('shop')}}</h4>
                        <div class="fw-brand-check">
                            <div class="bc-item">
                                <label for="bc-calvin">
                                    {{$sanpham->product_shop->name}}
                                    <input type="checkbox" id="bc-calvin" checked=true>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="filter-widget">
                        <h4 class="fw-title">{{__('price')}}</h4>
                        <div class="filter-range-wrap">
                            <div class="range-slider">
                                <div class="price-input">
                                    <input type="text" id="minamount">
                                    <input type="text" id="maxamount">
                                </div>
                            </div>
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                data-min="100000" data-max="10000000">
                                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                            </div>
                        </div>
                        <a class="filter-btn">{{__('filter')}}</a>
                    </div>
                    <div class="filter-widget">
                        <h4 class="fw-title">{{__('color')}}</h4>
                        <div class="fw-color-choose">
                            <div class="cs-item">
                                <input type="radio" id="cs-black">
                                <label class="cs-black" for="cs-black">Black</label>
                            </div>
                            <div class="cs-item">
                                <input type="radio" id="cs-violet">
                                <label class="cs-violet" for="cs-violet">Violet</label>
                            </div>
                            <div class="cs-item">
                                <input type="radio" id="cs-blue">
                                <label class="cs-blue" for="cs-blue">Blue</label>
                            </div>
                            <div class="cs-item">
                                <input type="radio" id="cs-yellow">
                                <label class="cs-yellow" for="cs-yellow">Yellow</label>
                            </div>
                            <div class="cs-item">
                                <input type="radio" id="cs-red">
                                <label class="cs-red" for="cs-red">Red</label>
                            </div>
                            <div class="cs-item">
                                <input type="radio" id="cs-green">
                                <label class="cs-green" for="cs-green">Green</label>
                            </div>
                        </div>
                    </div>
                    <div class="filter-widget">
                        <h4 class="fw-title">{{__('tag')}}</h4>
                        <div class="fw-tags">
                            <a href="#">flowershopdat</a>
                            <a href="#">{{$sanpham->product_type->name}}</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-pic-zoom">
                                <img id="wishlist_productimage{{$sanpham->id}}" class="product-big-img" src="{{$sanpham->image}}" alt="">
                                <div class="zoom-icon">
                                    <i class="fa fa-search-plus"></i>
                                </div>
                            </div>
                            <div class="product-thumbs">
                                <div class="product-thumbs-track ps-slider owl-carousel">
                                    <div class="pt active" data-imgbigurl="{{$sanpham->image}}"><img
                                            src="{{$sanpham->image}}" alt=""></div>
                                    @foreach($image as $img)
                                    <div class="pt" data-imgbigurl="{{$img->image}}">
                                        <img src="{{$img->image}}" alt="">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="product-details">
                                <div class="pd-title">
                                    <span>{{$sanpham->product_type->name}}</span>
                                    <h3>{{$sanpham->name}}</h3>
                                        <form>
                                            <a type="hidden" id="wishlist_producturl{{$sanpham->id}}" href="{{route('productdetails',$sanpham->id)}}"></a>
                                            <input type="hidden" value="{{$sanpham->name}}" id="wishlist_productname{{$sanpham->id}}"/>
                                            <input type="hidden" value="@if($sanpham->promotion_price==0) {{number_format($sanpham->unit_price)}} @else {{number_format($sanpham->promotion_price)}} @endif" id="wishlist_productprice{{$sanpham->id}}"/>
                                        </form>
                                    <a id="{{$sanpham->id}}" onclick="add_wistlist(this.id);" class="heart-icon"><i class="icon_heart_alt" style="color:#6db340"></i></a>
                                </div>
                                <div class="pd-rating">
                                            <ul class="list-inline" title="Average Rating" ><p>{{__('rating')}}: </p>	
												@for($count = 1; $count <= 5; $count++)
													@php
														if($count <= $rating)
														{
															$color = 'color:#ffcc00';
														}
														else{
															$color = 'color:#ccc';
														}
													@endphp
												<li class="star" style="cursor:pointer;{{$color}}; font-size:15px; float:left;" title="Đánh giá sao:">&#9733;</li>
												@endfor
											</ul>
                                    <span> ({{$sanpham->star}})</span>
                                </div>
                                <div class="pd-desc">
                                    <p>{!! $sanpham->description !!}</p>
                                    @if($sanpham->promotion_price==0)
                                    <h4>{{number_format($sanpham->unit_price)}} VNĐ</h4>
                                    @else
                                    <h4>{{number_format($sanpham->promotion_price)}} VNĐ <span>{{number_format($sanpham->unit_price)}} VNĐ</span></h4>
                                    @endif
                                </div>
                                <div class="pd-color">
                                    <h6>{{__('color')}}</h6>
                                    <div class="pd-color-choose">
                                        <div class="cc-item">
                                            <input type="radio" id="cc-green">
                                            <label for="cc-green" class="cc-green"></label>
                                        </div>
                                        <div class="cc-item">
                                            <input type="radio" id="cc-yellow">
                                            <label for="cc-yellow" class="cc-yellow"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="quantity">
                                <form action="{{route('addqtycart',$sanpham->id)}}" method="GET">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="pro-qty">
                                        <input type="text" name="qty" value="1">
                                    </div>
                                    <button type="submit" class="primary-btn pd-cart"><i style="color:#fff" class="fa fa-plus" aria-hidden="true"></i> {{__('add')}}</button>
                                </form>
                                </div>
                                <ul class="pd-tags">
                                    <li><span>{{__('category')}}</span>: {{$sanpham->product_type->name}}</li>
                                    <li><span>{{__('shop')}}</span>: {{$sanpham->product_shop->name}}</li>
                                    <li><span>{{__('tag')}}</span>: flowershopdat</li>
                                </ul>
                                <div class="pd-share">
                                    <div class="p-code">{{__('code')}} : {{$sanpham->code_product}}</div>
                                    <div class="pd-social">
                                        <a href="#"><i class="ti-facebook"></i></a>
                                        <a href="#"><i class="ti-twitter-alt"></i></a>
                                        <a href="#"><i class="ti-linkedin"></i></a>
                                        <a href="#"><i class="ti-google"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-tab">
                        <div class="tab-item">
                            <ul class="nav" role="tablist">
                                <li>
                                    <a class="active" data-toggle="tab" href="#tab-1" role="tab">{{__('description')}}</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab-2" role="tab">{{__('specifications')}}</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab-3" role="tab">{{__('comment')}} ({{count($comment)}})</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-item-content">
                            <div class="tab-content">
                                <div class="tab-pane fade-in active" id="tab-1" role="tabpanel">
                                    <div class="product-content">
                                        <div class="row">
                                            <div class="col-lg-7">
                                                <h5>{{__('introduce')}}</h5>
                                                <p>{!! $sanpham->description !!}</p>
                                                <h5>{{__('features')}}</h5>
                                                <p>{{$sanpham->unit}}</p>
                                            </div>
                                            <div class="col-lg-5">
                                                <img src="{{$sanpham->image}}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-2" role="tabpanel">
                                    <div class="specification-table">
                                        <table>
                                            <tr>
                                                <td class="p-catagory">{{__('customer_reviews')}}</td>
                                                <td>
                                                    <div class="pd-rating" style="padding-left:230px;">
                                                            <ul class="list-inline"  title="Average Rating">
                                                                @for($count = 1; $count <= 5; $count++)
                                                                    @php
                                                                        if($count <= $rating)
                                                                        {
                                                                            $color = 'color:#ffcc00';
                                                                        }
                                                                        else{
                                                                            $color = 'color:#ccc';
                                                                        }
                                                                    @endphp
                                                                <li class="star" style="cursor:pointer;{{$color}}; font-size:15px;float: left;" title="Đánh giá sao:">&#9733;</li>
                                                                @endfor
                                                            </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">{{__('price')}}</td>
                                                <td>
                                                    @if($sanpham->promotion_price==0)
                                                    <div class="p-price">{{number_format($sanpham->unit_price)}} VNĐ</div>
                                                    @else
                                                    <div class="p-price">{{number_format($sanpham->promotion_price)}} VNĐ</div>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">{{__('add_cart')}}</td>
                                                <td>
                                                    <div class="cart-add">+ Thêm</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">{{__('availability')}}</td>
                                                <td>
                                                    <div class="p-stock">...</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Nặng</td>
                                                <td>
                                                    <div class="p-weight">...</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">{{__('size')}}</td>
                                                <td>
                                                    <div class="p-size">...</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">{{__('color')}}</td>
                                                <td><span class="cs-color"></span></td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">{{__('code')}}</td>
                                                <td>
                                                    <div class="p-code">{{$sanpham->code_product}}</div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-3" role="tabpanel">
                                    <div class="customer-review-option">
                                        <h4>{{count($comment)}} {{__('comment')}}</h4>
                                        <div class="comment-option">
                                            @foreach($sanpham->comment as $cm)
                                            <div class="co-item">
                                                <div class="avatar-pic">
                                                    <!--Lưu ý (chỉnh sửa sau): Có xảy lỗi đọc thuộc tính-->
                                                    @if($cm->user->image != Null)<img src="client_asset/image/slide/{{$cm->user->image}}">@else <img src="client_asset/image/slide/profile_user.jpg">  @endif
                                                </div>
                                                <div class="avatar-text">
                                                    <div class="at-rating">
                                                            <ul class="list-inline" title="Average Rating" >
                                                                @for($count = 1; $count <= 5; $count++)
                                                                    @php
                                                                        if($count <= $cm->star)
                                                                        {
                                                                            $color = 'color:#ffcc00';
                                                                        }
                                                                        else{
                                                                            $color = 'color:#ccc';
                                                                        }
                                                                    @endphp
                                                                <li class="star" style="cursor:pointer;{{$color}}; font-size:15px;float: left;" title="Đánh giá sao:">&#9733;</li>
                                                                @endfor
                                                            </ul>
                                                        <span> ({{$cm->star}})</span>
                                                    </div>
                                                    <h5>{{$cm->user->name}} <span>{{$cm->created_at}}</span></h5>
                                                    <div class="at-reply">{{$cm->NoiDung}} !</div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        @if(Auth::check())
                                        <div class="leave-comment">
                                            <h4>{{__('leave_a_comment')}}</h4>
                                            <form action="comment/{{$sanpham->id}}" method="post" role="form" class="comment-form">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="stars">
                                                            <input class="star star-5" id="star-5" type="radio" name="star" value="5" />
                                                            <label class="star star-5" for="star-5"></label> 
                                                            <input class="star star-4" id="star-4" type="radio" name="star" value="4" /> 
                                                            <label class="star star-4" for="star-4"></label> 
                                                            <input class="star star-3" id="star-3" type="radio" name="star" value="3" /> 
                                                            <label class="star star-3" for="star-3"></label> 
                                                            <input class="star star-2" id="star-2" type="radio" name="star" value="2" /> 
                                                            <label class="star star-2" for="star-2"></label> 
                                                            <input class="star star-1" id="star-1" type="radio" name="star" value="1" /> 
                                                            <label class="star star-1" for="star-1"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <textarea name="NoiDung" placeholder="{{__('description')}}" required></textarea>
                                                        <button type="submit" class="site-btn">{{__('submit')}}</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->
    <!-- Sản phẩm đề xuất -->
    <section class="women-banner spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="filter-control">
                        <ul>
                            <li class="active">{{__('recommend_products')}}</li>
                        </ul>
                    </div>
                    <div class="product-slider owl-carousel">
                    @foreach($products as $product)
                    @if($product->similarity*100 >=70)
                        <div class="product-item">
                            <div class="pi-pic">
                                <img id="wishlist_productimage{{$product->id}}" src="{{$product->image}}" alt="">
                                @if($product->promotion_price!=0)
                                    <div class="sale">Sale</div>
                                @endif
                                <form>
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" value="{{$product->name}}" id="wishlist_productname{{$product->id}}"/>
                                    <input type="hidden" value="@if($product->promotion_price==0) {{number_format($product->unit_price)}} @else {{number_format($product->promotion_price)}} @endif" id="wishlist_productprice{{$product->id}}"/>
                                </form>
                                <div class="icon">
                                    @if(Auth::check())
                                    <a class="button_wishlist" id="{{$product->id}}" onclick="add_wistlist(this.id);"><i class="icon_heart_alt" style="color:#6db340"></i></a>
                                    @else
                                        <a href="{{route('login')}}"><i class="icon_heart_alt" style="color:#6db340" title="Bạn cần đăng nhập"></i></a>
                                    @endif
                                </div>
                                <ul>
                                    <li class="w-icon active"><a href="{{route('addtocart',$product->id)}}"><i class="icon_bag_alt"></i></a></li>
                                    <li class="quick-view"><a class="QuickView" href="#" data-id="{{$product->id}}" data-toggle="modal" data-target="#QuickView">+ {{__('quickview')}}</a></li>
                                    <li class="w-icon"><a id="wishlist_producturl{{$product->id}}" href="{{route('productdetails',$product->id)}}"><i class="fa fa-random"></i></a></li>
                                </ul>
                            </div>
                            <div class="pi-text">
                                <div class="catagory-name">{{__('recommend')}}</div>
                                <a href="#">
                                    <h5>{{$product->name}}</h5>
                                </a>
                                <div class="product-price">
                                @if($product->promotion_price==0)
                                    {{number_format($product->unit_price)}}
                                @else
                                    {{number_format($product->promotion_price)}}
                                    <span>{{number_format($product->unit_price)}}</span>
                                @endif
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Sản phẩm đề xuất End -->
    <!-- Related Products Section End -->
    <div class="related-products spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="filter-control">
                        <ul>
                            <li class="active">{{__('related_products')}}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
            @foreach($sp_tuongtu as $sptt)
                <div class="col-lg-3 col-sm-6">
                    <div class="product-item">
                        <div class="pi-pic">
                            <img id="wishlist_productimage{{$sptt->id}}" src="{{$sptt->image}}" alt="">
                            @if($sptt->promotion_price!=0)
                            <div class="sale">Sale</div>
                            @endif
                            <form>
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" value="{{$sptt->name}}" id="wishlist_productname{{$sptt->id}}"/>
                                <input type="hidden" value="@if($sptt->promotion_price==0) {{number_format($sptt->unit_price)}} @else {{number_format($sptt->promotion_price)}} @endif" id="wishlist_productprice{{$sptt->id}}"/>
                            </form>
                            <div class="icon">
                                @if(Auth::check())
                                    <a class="button_wishlist" id="{{$sptt->id}}" onclick="add_wistlist(this.id);"><i class="icon_heart_alt" style="color:#6db340"></i></a>
                                @else
                                    <a href="{{route('login')}}"><i class="icon_heart_alt" style="color:#6db340" title="Bạn cần đăng nhập"></i></a>
                                @endif
                            </div>
                            <ul>
                                <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                <li class="quick-view"><a class="QuickView" href="#" data-id="{{$sptt->id}}" data-toggle="modal" data-target="#QuickView">+ {{__('quickview')}}</a></li>
                                <li class="w-icon"><a id="wishlist_producturl{{$sptt->id}}" href="{{route('productdetails',$sptt->id)}}"><i class="fa fa-random"></i></a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">{{$sptt->product_type->name}}</div>
                            <a href="#">
                                <h5>{{$sptt->name}}</h5>
                            </a>
                            <div class="product-price">
                                @if($sptt->promotion_price==0)
                                    {{number_format($sptt->unit_price)}}
                                @else
                                    {{number_format($sptt->promotion_price)}}
                                    <span>{{number_format($sptt->unit_price)}}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
            <div class="loading-more">
            {{$sp_tuongtu->links()}}
            </div>
        </div>
        
    </div>
    <!-- Related Products Section End -->
@endsection
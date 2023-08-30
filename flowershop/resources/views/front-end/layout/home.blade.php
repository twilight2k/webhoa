@extends('front-end.layout.index')
@section('content')
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <!-- Hero Section Begin -->
    <section class="hero-section">
        <div class="hero-items owl-carousel">
            @foreach ($slides as $slide)
                <div class="single-hero-items set-bg" data-setbg="{{ $slide->image }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-5">
                                <span>{{ __('event') }}</span>
                                <h2>{{ $slide->name }}</h2>
                                <p>{{ $slide->NoiDung }}</p>
                                <a href="{{ $slide->link }}" class="primary-btn">{{ __('buy_now') }}</a>
                            </div>
                        </div>
                        <div class="off-card">
                            <h2>{{ __('sale') }} @if ($slide->condition == 1)
                                    <span>{{ $slide->number }}%</span>
                                @elseif($slide->condition == 2)
                                    <span style="font-size:16px">{{ number_format($slide->number) }} VNĐ</span>
                                @else
                                    <span></span>
                                @endif
                            </h2>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Banner Section Begin -->
    <div class="banner-section spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="single-banner">
                        <img src="client_asset/assets/dest/img/banner-1.jpg" alt="">
                        <div class="inner-text">
                            <h4>Trao tặng</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-banner">
                        <img src="client_asset/assets/dest/img/banner-2.jpg" alt="">
                        <div class="inner-text">
                            <h4>Gửi gắm</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-banner">
                        <img src="client_asset/assets/dest/img/banner-3.jpg" alt="">
                        <div class="inner-text">
                            <h4>Trưng bày</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Section End -->

    <!-- Sản phẩm mới -->
    <section class="women-banner spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="filter-control">
                        <ul>
                            <li class="active">{{ __('new_products') }}</li>

                        </ul>
                    </div>
                    <div class="product-slider owl-carousel">
                        @foreach ($new_product as $spm)
                            @if ($spm->product_type->status == 0 && $spm->product_shop->status == 0)
                                <div class="product-item">
                                    <div class="pi-pic">
                                        <img id="wishlist_productimage{{ $spm->id }}" src="{{ $spm->image }}"
                                            alt="">
                                        @if ($spm->promotion_price != 0)
                                            <div class="sale">Sale</div>
                                        @endif
                                        <form>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" value="{{ $spm->name }}"
                                                id="wishlist_productname{{ $spm->id }}" />
                                            <input type="hidden"
                                                value="@if ($spm->promotion_price == 0) {{ number_format($spm->unit_price) }} @else {{ number_format($spm->promotion_price) }} @endif"
                                                id="wishlist_productprice{{ $spm->id }}" />
                                        </form>
                                        <div class="icon">
                                            @if (Auth::check())
                                                <a class="button_wishlist" id="{{ $spm->id }}"
                                                    onclick="add_wistlist(this.id);"><i class="icon_heart_alt"
                                                        style="color:#6db340"></i></a>
                                            @else
                                                <a href="{{ route('login') }}"><i class="icon_heart_alt"
                                                        style="color:#6db340" title="Bạn cần đăng nhập"></i></a>
                                            @endif
                                        </div>
                                        <ul>
                                            <li class="w-icon active"><a href="{{ route('addtocart', $spm->id) }}"><i
                                                        class="icon_bag_alt"></i></a></li>
                                            <li class="quick-view"><a class="QuickView" href="#"
                                                    data-id="{{ $spm->id }}" data-toggle="modal"
                                                    data-target="#QuickView">+ {{ __('quickview') }}</a></li>
                                            <li class="w-icon"><a id="wishlist_producturl{{ $spm->id }}"
                                                    href="{{ route('productdetails', $spm->id) }}"><i
                                                        class="fa fa-random"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="pi-text">
                                        <div class="catagory-name">{{ $spm->product_type->name }}</div>
                                        <a href="#">
                                            <h5>{{ $spm->name }}</h5>
                                        </a>
                                        <div class="product-price" id="wishlist_productprice{{ $spm->id }}">
                                            @if ($spm->promotion_price == 0)
                                                {{ number_format($spm->unit_price) }}
                                            @else
                                                {{ number_format($spm->promotion_price) }}
                                                <span>{{ number_format($spm->unit_price) }}</span>
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
    <!-- Sản phẩm mới End -->

    <!-- Sản phẩm bán chạy -->
    <section class="women-banner spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="filter-control">
                        <ul>
                            <li class="active">{{ __('best_products') }}</li>
                        </ul>
                    </div>
                    <div class="product-slider owl-carousel">
                        @foreach ($sanpham_banchay as $spbc)
                            @if ($spbc->product_type->status == 0 && $spbc->product_shop->status == 0)
                                <div class="product-item">
                                    <div class="pi-pic">
                                        <img id="wishlist_productimage{{ $spbc->id }}" src="{{ $spbc->image }}"
                                            alt="">
                                        @if ($spm->promotion_price != 0)
                                            <div class="sale">Sale</div>
                                        @endif
                                        <form>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" value="{{ $spbc->name }}"
                                                id="wishlist_productname{{ $spbc->id }}" />
                                            <input type="hidden"
                                                value="@if ($spbc->promotion_price == 0) {{ number_format($spbc->unit_price) }} @else {{ number_format($spbc->promotion_price) }} @endif"
                                                id="wishlist_productprice{{ $spbc->id }}" />
                                        </form>
                                        <div class="icon">
                                            <!--Lưu ý (Việc chưa hoàn thành): Khi nhấn yêu thích sản phẩm, việc thay đổi cơ chế còn thiếu xót-->
                                            @if (Auth::check())
                                                <a class="button_wishlist" id="{{ $spbc->id }}"
                                                    onclick="add_wistlist(this.id);"><i class="icon_heart_alt"
                                                        style="color:#6db340"></i></a>
                                            @else
                                                <a href="{{ route('login') }}"><i class="icon_heart_alt"
                                                        style="color:#6db340" title="Bạn cần đăng nhập"></i></a>
                                            @endif
                                        </div>
                                        <ul>
                                            <li class="w-icon active"><a href="{{ route('addtocart', $spbc->id) }}"><i
                                                        class="icon_bag_alt"></i></a></li>
                                            <li class="quick-view"><a class="QuickView" href="#"
                                                    data-id="{{ $spbc->id }}" data-toggle="modal"
                                                    data-target="#QuickView">+ {{ __('quickview') }}</a></li>
                                            <li class="w-icon"><a id="wishlist_producturl{{ $spbc->id }}"
                                                    href="{{ route('productdetails', $spbc->id) }}"><i
                                                        class="fa fa-random"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="pi-text">
                                        <div class="catagory-name">{{ $spbc->product_type->name }}</div>
                                        <a href="#">
                                            <h5>{{ $spbc->name }}</h5>
                                        </a>
                                        <div class="product-price">
                                            @if ($spbc->promotion_price == 0)
                                                {{ number_format($spbc->unit_price) }}
                                            @else
                                                {{ number_format($spbc->promotion_price) }}
                                                <span>{{ number_format($spbc->unit_price) }}</span>
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
    <!-- Sản phẩm bán chạy End -->

    <!-- Deal Of The Week Section Begin-->
    <section class="deal-of-week set-bg spad" data-setbg="client_asset/assets/dest/img/saleofweek.jpg">
        <div class="container">
            @foreach ($sale as $sal)
                <div class="row">
                    <div class="col-lg-6 text-center">
                        <form>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" id="date_time" value="{{ $sal->date_end }}">
                        </form>
                        <div class="section-title">
                            <h2>{{ __('the_event') }}</h2>
                            <p> {!! $sal->description !!} </p>
                            <div class="product-price">
                                {{ number_format($sal->product->promotion_price) }} VNĐ
                                <span>/ {{ $sal->product->unit }}</span>
                            </div>
                        </div>
                        <div class="countdown-timer" id="countdown">
                            <div class="cd-item">
                                <span></span>
                                <p>Ngày</p>
                            </div>
                            <div class="cd-item">
                                <span></span>
                                <p>Giờ</p>
                            </div>
                            <div class="cd-item">
                                <span></span>
                                <p>Phút</p>
                            </div>
                            <div class="cd-item">
                                <span></span>
                                <p>Giây</p>
                            </div>
                        </div>

                        <a href="{{ route('productdetails', $sal->product->id) }}"
                            class="primary-btn">{{ __('buy_now') }}</a>

                    </div>

                    <div style="padding-top:30px;" class="col-lg-6 text-center">
                        <div class="countdown-timer">
                            <img style="border-radius: 50%;border: 5px solid #6db340;" src="{{ $sal->product->image }}"
                                width="320" height="320" />
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!-- Deal Of The Week Section End -->

    <!-- Sản phẩm khuyến mãi -->
    <section class="man-banner spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="filter-control">
                        <ul>
                            <li class="active">{{ __('discount_products') }}</li>
                        </ul>
                    </div>
                    <div class="product-slider owl-carousel">
                        @foreach ($sanpham_khuyenmai as $spkm)
                            @if ($spkm->product_type->status == 0 && $spkm->product_shop->status == 0)
                                <div class="product-item">
                                    <div class="pi-pic">
                                        <img id="wishlist_productimage{{ $spkm->id }}" src="{{ $spkm->image }}"
                                            alt="">
                                        @if ($spkm->promotion_price != 0)
                                            <div class="sale">Sale</div>
                                        @endif
                                        <form>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" value="{{ $spkm->name }}"
                                                id="wishlist_productname{{ $spkm->id }}" />
                                            <input type="hidden"
                                                value="@if ($spkm->promotion_price == 0) {{ number_format($spkm->unit_price) }} @else {{ number_format($spkm->promotion_price) }} @endif"
                                                id="wishlist_productprice{{ $spkm->id }}" />
                                        </form>
                                        <div class="icon">
                                            @if (Auth::check())
                                                <a class="button_wishlist" id="{{ $spkm->id }}"
                                                    onclick="add_wistlist(this.id);"><i class="icon_heart_alt"
                                                        style="color:#6db340"></i></a>
                                            @else
                                                <a href="{{ route('login') }}"><i class="icon_heart_alt"
                                                        style="color:#6db340" title="Bạn cần đăng nhập"></i></a>
                                            @endif
                                        </div>
                                        <ul>
                                            <li class="w-icon active"><a href="{{ route('addtocart', $spkm->id) }}"><i
                                                        class="icon_bag_alt"></i></a></li>
                                            <li class="quick-view"><a class="QuickView" href="#"
                                                    data-id="{{ $spkm->id }}" data-toggle="modal"
                                                    data-target="#QuickView">+ {{ __('quickview') }}</a></li>
                                            <li class="w-icon"><a id="wishlist_producturl{{ $spkm->id }}"
                                                    href="{{ route('productdetails', $spkm->id) }}"><i
                                                        class="fa fa-random"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="pi-text">
                                        <div class="catagory-name">{{ $spkm->product_type->name }}</div>
                                        <a href="#">
                                            <h5>{{ $spkm->name }}</h5>
                                        </a>
                                        <div class="product-price">
                                            @if ($spkm->promotion_price == 0)
                                                {{ number_format($spkm->unit_price) }}
                                            @else
                                                {{ number_format($spkm->promotion_price) }}
                                                <span>{{ number_format($spkm->unit_price) }}</span>
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
    <!-- Sản phẩm khuyến mãi End -->
    <!-- Contact Section Begin -->
    <section class="contact-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="contact-form">
                        <div class="leave-comment">
                            <iframe width="500" height="300"
                                src="https://www.youtube.com/embed/N_61_oXmfvQ?si=69GQCY8_8rZuuyDN"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <div class="contact-form">
                        <div class="leave-comment">
                            <h4>{{ __('positive_feedback') }}</h4>
                            <p>{{ __('comment_good') }}</p>
                            <div class="opinion-slider owl-carousel">
                                @foreach ($binhluan_hangdau as $bl_hd)
                                    <div class="product-item">
                                        <div class="pi-pic" style="border-radius: 50%;border: 5px solid #FD9796;">
                                            <img src="client_asset/image/slide/{{ $bl_hd->image }}" alt="">

                                        </div>
                                        <div class="pi-text">
                                            <div class="catagory-name">{{ $bl_hd->user }}</div>
                                            <a href="#">
                                                <h5>{{ $bl_hd->nhanxet }}</h5>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->
    <!-- Latest Blog Section Begin -->
    <section class="latest-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>{{ __('featured_articles') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($blog as $blg)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-latest-blog">
                            <a href="{{ route('blogdetails', $blg->id) }}">
                                <img src="client_asset\image\blog\{{ $blg->image }}" alt="">
                            </a>
                            <div class="latest-text">
                                <div class="tag-list">
                                    <div class="tag-item">
                                        <i class="fa fa-calendar-o"></i>
                                        {{ date('d-m-Y', strtotime($blg->created_at)) }}
                                    </div>
                                    <div class="tag-item">
                                        <i class="fa fa-comment-o"></i>
                                        5
                                    </div>
                                </div>
                                <a href="{{ route('blogdetails', $blg->id) }}">
                                    <h4>{{ $blg->name }}</h4>
                                </a>
                                <p>{{ Str::limit($blg->description, 50) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="benefit-items">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="single-benefit">
                            <div class="sb-icon">
                                <img src="client_asset/assets/dest/img/icon-1.png" alt="">
                            </div>
                            <div class="sb-text">
                                <h6>{{ __('ship') }}</h6>
                                <p>{{ __('for_order') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single-benefit">
                            <div class="sb-icon">
                                <img src="client_asset/assets/dest/img/icon-2.png" alt="">
                            </div>
                            <div class="sb-text">
                                <h6>{{ __('on_time') }}</h6>
                                <p>{{ __('if_no') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single-benefit">
                            <div class="sb-icon">
                                <img src="client_asset/assets/dest/img/icon-1.png" alt="">
                            </div>
                            <div class="sb-text">
                                <h6>{{ __('safe_payments') }}</h6>
                                <p>{{ __('100%') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Blog Section End -->
    <!-- Logout Modal-->
@endsection

 <!-- Page Preloder -->


    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="header-top">
            <div class="container">
                <div class="ht-left">
                    <div class="mail-service">
                        <i class=" fa fa-envelope"></i>
                        Shop bán hoa
                    </div>
                    <div class="phone-service" style="height:40px;width:420px;"><marquee>
                    <i class="fa fa-ambulance"></i>
                    {{__('thongbao')}}</marquee>
                    </div>
                </div>
                <div class="ht-right">
                    @if(Auth::check())
                    <a href="{{route('logout')}}" class="login-panel" style="padding-left: 10px;"><i class="fa fa-sign-out" style="font-size:17px" title="Đăng xuất"></i></a>
                    <a href="#" class="login-panel" style="padding-left: 10px;">/</a>
                    <a href="{{route('profileuser')}}" title="Xem thông tin" class="login-panel" style="padding-left: 30px;">@if(Auth::user()->image)<img style="border-radius:15px" width="20px" height="20px" src="client_asset/image/slide/{{Auth::user()->image}}" class="" alt="Thông tin cá nhân">@else<img style="border-radius:15px" width="20px" height="20px" src="client_asset/image/slide/profile_user.jpg" class="" alt="Thông tin cá nhân">@endif {{Auth::user()->name}}</a>
                    @else
                    <a href="{{route('register')}}" class="login-panel" style="padding-left: 10px;">{{__('register')}}</a>
                    <a href="#" class="login-panel" style="padding-left: 10px;">/</a>
                    <a href="{{route('login')}}" class="login-panel" style="padding-left: 30px;"><i class="fa fa-user-circle" aria-hidden="true" style="font-size:20px"></i>{{__('login')}}</a>
                    @endif

                    <div class="lan-selector"style="padding-left:20px;padding-right:20px;border-right:1px solid #ccc">
                        <ul class="depart-hover" style="list-style-type: none;">
                            <li style="display: inline-block;" title="{{__('vi')}}"><a href="{{route('language.index',['vi'])}}"><img src="client_asset/assets/dest/img/flag-3.png"></a></li>
                            <li style="display: inline-block;">|</li>
                            <li style="display: inline-block;" title="{{__('en')}}"><a href="{{route('language.index',['en'])}}"><img src="client_asset/assets/dest/img/flag-1.jpg"></a></li>
                        </ul>
                    </div>
                    <div class="top-social">
                        <a href="https://www.facebook.com/takemehand2000/"><i class="ti-facebook"></i></a>
                        {{-- <a href="#"><i class="ti-twitter-alt"></i></a> --}}
                        <a href="https://www.instagram.com/shan.tn2000/"><i class="ti-linkedin"></i></a>
                        {{-- <a href="#"><i class="ti-google"></i></a> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="inner-header">
                <div class="row">
                    <div class="col-lg-2 col-md-2">
                        <div class="logo">
                            <a href="{{route('home')}}">
                                <img src="client_asset/assets/dest/img/lgwendy.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7">
                    <form role="search" method="get" id="searchform" action="{{route('search')}}">
                        <div class="advanced-search">
                            <button type="button" class="category-btn">{{__('search_category')}}</button>
                            <div class="input-group search">
                                <input type="text" value="" name="key" id="s"  placeholder="{{__('search_nd')}}?">
                                <button type="submit" id="searchsubmit" style="border-radius: 0 50px 50px 0;"><i class="ti-search"></i></button>
                            </div>
                        </div>
                    </form>
                    </div>
                    <div class="col-lg-3 text-right col-md-3">
                        <ul class="nav-right">
                            @if(Auth::check())
                                <li class="cart-icon">
                                    <a href="#">
                                    <i class="icon_heart_alt" style="color:red" title="Sản phẩm yêu thích"></i>
                                    </a>
                                    <div class="cart-hover" style="border:1px solid #ccc">
                                        <div class="select-items" >
                                            <div >
                                            <table>
                                                <tbody>
                                                    <tr id="row_wishlist" class="fav">
                                                    </tr>
                                                    <tr></tr>
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                        <div class="select-button"><a class="primary-btn view-card" onclick="delete_withlist();">{{__('delete_fav')}}</a></div>
                                    </div>
                                </li>
                            @else
                                <li class="cart-icon">
                                    <a href="{{route('login')}}">
                                        <i class="icon_heart_alt"  style="color:black" style="color:#6db340" title="Bạn cần phải đăng nhập"></i>
                                    </a>
                                </li>
                            @endif
                            <li class="cart-icon">
                                <a href="#">
                                <i class="fa fa-shopping-bag" title="Giỏ hàng"></i>
                                    <span>@if(Session::has('cart')){{Session('cart')->totalQty}} @else 0 @endif</span>
                                </a>
                                <div class="cart-hover" style="border:1px solid #ccc">
                                @if(Session::has('cart'))
                                    <div class="select-items">
                                        <table>
                                            <tbody>
                                                @foreach($product_cart as $product)
                                                <tr>
                                                    <td class="si-pic"><img src="{{$product['item']['image']}}" alt=""></td>
                                                    <td class="si-text">
                                                        <div class="product-selected">
                                                            <p>{{$product['qty']}}*<span>@if($product['item']['promotion_price']==0) {{number_format($product['item']['unit_price'])}} VNĐ @else {{number_format($product['item']['promotion_price'])}} VNĐ @endif</p>
                                                            <h6>{{$product['item']['name']}}</h6>
                                                        </div>
                                                    </td>
                                                    <td class="si-close">
                                                        <a href="{{route('deletecart',$product['item']['id'])}}"><i class="ti-close"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="select-total">
                                        <span>{{__('total')}}:</span>
                                        <h5>{{number_format(Session('cart')->totalPrice)}} VNĐ</h5>
                                    </div>
                                    @endif
                                    <div class="select-button">
                                        @if(Session::has('cart'))
                                            <a href="{{route('cart')}}" class="primary-btn view-card">{{__('view_cart')}}</a>
                                            <a href="{{route('checkout')}}" class="primary-btn checkout-btn">{{__('checkout')}}</a>
                                        @else
                                            <span><h5>{{__('notcart')}}</h5></span>
                                        @endif
                                    </div>

                                </div>
                            </li>
                            <li class="cart-price">@if(Session::has('cart')){{number_format(Session('cart')->totalPrice)}} VNĐ @else 0 VNĐ @endif</li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-item">
            <div class="container">
                <div class="nav-depart">
                    <div class="depart-btn">
                        <i class="ti-menu"></i>
                        <span>{{__('category')}}</span>
                        <ul class="depart-hover">
                        @foreach($loai as $categr)
                            <li><a href="{{route('category',$categr->id)}}">{{$categr->name}}</a></li>
                        @endforeach
                        </ul>
                    </div>
                </div>
                <nav class="nav-menu mobile-menu">
                    <ul>
                        <li class="active"><a href="{{route('home')}}">{{__('home')}}</a></li>
                        <li><a>{{__('shop')}}</a>
                            <ul class="dropdown">
                                @foreach($shop as $ch)
                                    <li><a href="{{route('shop',$ch->id)}}">{{$ch->name}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a> {{__('highlights')}} <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                            <ul class="dropdown">
                            @foreach($holiday as $hl)
                                <li><a href="{{route('holiday',$hl->id)}}">{{$hl->name}}</a></li>
                            @endforeach
                            </ul>
                        </li>
                        <li><a href="{{route('blog')}}">{{__('blog')}}</a></li>
                        <li><a href="#">{{__('pages')}} <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                            <ul class="dropdown">
                                <li><a href="{{route('blog')}}">{{__('blog')}}</a></li>
                                <li><a href="{{route('cart')}}">{{__('cart')}}</a></li>
                                <li><a>{{__('introduce')}}</a></li>
                                <li><a href="{{route('contact')}}">{{__('contact')}}</a></li>
                                @if(Auth::check())
                                <li><a href="{{route('logout')}}">{{__('logout')}} <i class="fa fa-sign-out"></i></a></li>
                                @else
                                <li><a href="{{route('register')}}">{{__('register')}}</a></li>
                                <li><a href="{{route('login')}}">{{__('login')}}</a></li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                </nav>
                <div id="mobile-menu-wrap"></div>
            </div>
        </div>
    </header>
    <script>
        function AddNewOption(userRoutes, text, id)
{
        var option = document.createElement("option");
        option.text = text;
        option.value = id;
        option.selected = "selected";
        userdRoutes.add(option);
}
    </script>
        <!-- Header End -->

@extends('front-end.layout.index')
@section('content')
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="{{route('home')}}"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Mã giảm giá</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="register-login-section spad">
        <div class="container">
            <div class="row profile">
                <div class="col-lg-3">
                    <div class="profile-sidebar">
                        <div class="profile-userpic">
                            @if(Auth::user()->image)
                            <img src="client_asset/image/slide/{{Auth::user()->image}}" class="img-responsive" alt="Thông tin cá nhân">
                            @else
                            <img src="client_asset/image/slide/profile_user.jpg" class="img-responsive" alt="Thông tin cá nhân">
                            @endif
                        </div>
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name">{{Auth::user()->name}}</div>
                            <div class="profile-usertitle-job">
                                @if(Auth::user()->id_levels==1)
                                    Vip Admin
                                @elseif(Auth::user()->total > 10000000)
                                    <div class="kimcuong"style="color:#33ccff">Hoa Kim Cương </div>
                                @elseif(Auth::user()->total > 5000000)
                                    <div class="vang"style="color:#ffcc00">Hoa Vàng </div>
                                @elseif(Auth::user()->total > 2000000)
                                    <div class="bac"style="color:#dddddd">Hoa Bạc </div>
                                @elseif(Auth::user()->total > 100000)
                                    <div class="dong" style="color:#cc6600"><i class="fa fa-user"></i> Hoa Đồng </div>
                                @elseif(Auth::user()->total >= 0)
                                    <div class="tv" style="color:green">Hoa Dại</div>
                                @endif
                            </div>
                            <div class="total_checkout">Tổng tiền đã mua:{{number_format(Auth::user()->total)}} VNĐ</div>
                        </div>
                            <div class="profile-userbuttons">
                                <a class="btn btn-success" href="{{route('home')}}">Trang chủ</a>
                                <a class="btn btn-danger" href="{{route('cart')}}">Giỏ hàng</a>
                            </div>
                            <div class="profile-usermenu">
                                <ul class="nav">
                                    <li ><a href="{{route('profileuser')}}"><i class="fa fa-user"></i>Cập nhật thông tin</a></li>
                                    <li><a href="{{route('purchasehistory')}}"><i class="fa fa-shopping-cart"></i>Lịch sử mua hàng </a></li>
                                    <li class="active"><a href="{{route('profilecoupon')}}"><i class="fa fa-gift"></i>Mã giảm giá (@if($coupon_user){{count($coupon_user)}}@else 0 @endif)</a></li>
                                </ul>
                            </div>
                    </div>
                </div>
                <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="filter-control">
                            <ul>
                                <li class="active">Danh sách mã giảm giá</li>
                            </ul>
                        </div>
                    </div>
                </div>
                    <div class="profile-content-cp">
                                @if(count($errors)>0)
                                    <div class="alert alert-danger">
                                        @foreach($errors->all() as $err)
                                            {{$err}}<br>

                                        @endforeach
                                    </div>
                                @endif
                                @if(session('thongbao'))
                                    <div class="alert alert-success">
                                        {{session('thongbao')}}
                                    </div>
                                @endif
                        <div class="space20">&nbsp;</div>
                        @foreach($coupon_user as $key => $cou)
                        <div class="coupon">
                                <span style="font-size:18px">{{$cou->name}}</span></br>
                                <img src="client_asset/assets/dest/img/lgwendy.png" alt="Avatar" style=" padding-right:10px;float:left;width:30%; height:100%;">
                                <span style="font-size:16px"><span class="down-code">@if($cou->condition==1)
                                    Giảm {{$cou->number}}%
                                    @else
                                    Giảm {{number_format($cou->number)}} đ
                                    @endif</span> cho hóa đơn thanh toán</span> </br>
                                <span>Mã khuyến mại: <span class="promo">{{$cou->code}}</span></span></br>
                                <span class="expire">Hết hạn: {{$cou->date_end}}</span>
                        </div>
                        <div class="space10">&nbsp;</div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('front-end.layout.index')
@section('content')
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="{{route('home')}}"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Thông tin tài khoản</span>
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
                                @if(Auth::user()->id_levels == 1)
                                    {{Auth::user()->level_type->name}}
                                @elseif(Auth::user()->id_levels == 2)
                                    {{Auth::user()->level_type->name}}
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
                                    <li class="active"><a href="{{route('profileuser')}}"><i class="fa fa-user"></i>Cập nhật thông tin</a></li>                                             
                                    <li><a href="{{route('purchasehistory')}}"><i class="fa fa-shopping-cart"></i>Lịch sử mua hàng </a></li>          
                                    <li><a href="{{route('profilecoupon')}}"><i class="fa fa-gift"></i>Mã giảm giá</a></li>             
                                </ul>                
                            </div>                            
                    </div>     
                </div>      
                <div class="col-lg-9"> 
                    <div class="profile-content">
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="filter-control">
                            <ul>
                                <li class="active">Thông tin thành viên</li>
                            </ul>
                        </div>
                    </div>
                </div>
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
                        <form id="registration-form" action="profile-user/{{Auth::user()->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <div class="group-input">
                                <label>Chọn ảnh đại diện</label>
                                <input type="file" name="image">
                            </div>
                            <div class="group-input">
                                <label for="email">Địa chỉ Email<span style="color:red">*</span></label>
                                <input type="email" id="email" name="email" value="{{Auth::user()->email}}" disabled>
                            </div>
                            <div class="group-input">
                                <label for="name">Họ tên<span style="color:red">*</span></label>
                                <input type="text" id="name"  name="name" value="{{Auth::user()->name}}"  >
                            </div>
                            <div class="group-input">
                                <label for="adress">Địa chỉ<span style="color:red">*</span></label>
                                <input type="text" id="address"  name="address" value="{{Auth::user()->address}}"  >
                            </div>
                            <div class="group-input">
                                <label for="phone">Điện thoại<span style="color:red">*</span></label>
                                <input type="text" id="phone" name="phone" value="{{Auth::user()->phone}}"  >
                            </div>
                            <div class="group-input">
                                <label for="password">Mật khẩu</label>
                                <input type="password" id="password" name="password" disabled>
                            </div>
                            <div class="group-input">
                                <label for="re-password">Nhập lại mật khẩu</label>
                                <input type="password" id="re_password" name="re_password" disabled>                               
                            </div>
                            <div class="group-input">
                                <button type="submit" class="btn btn-success">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>     
            </div>
        </div>
    </div>
@endsection
@extends('front-end.layout.index')
@section('content')
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="{{route('home')}}"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Lịch sử mua hàng</span>
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
                                    <li class="active"><a href="{{route('purchasehistory')}}"><i class="fa fa-shopping-cart"></i>Lịch sử mua hàng </a></li>          
                                    <li ><a href="{{route('profilecoupon')}}"><i class="fa fa-gift"></i>Mã giảm giá</a></li>             
                                </ul>                
                            </div>                            
                    </div>     
                </div>      
                <div class="col-lg-9"> 
                <div class="row">
                    <div class="col-lg-12">
                        <div class="filter-control">
                            <ul>
                                <li class="active">Danh sách hóa đơn</li>
                            </ul>
                        </div>
                    </div>
                </div>
                    <div class="profile-content-cp">
                    <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <div class="loc" >
                                    <form action="" method="GET" class="form-inline" role="form">
                                        <div class="form-group" style="width:200px;float:left;padding-right:5px">
                                            <input type="date" class="form-control" name="date_form" placeholder="Select Day" />
                                        </div>
                                        <div class="form-group"style="width:200px;float:left;padding-right:5px">
                                            <input type="date" class="form-control" name="date_to" placeholder="Select Day" />
                                        </div>
                                        <button type="submit" class="btn btn-primary">Lọc</button>
                                    </form>
                                </div>
                            <div class="col-md-12">
                                <thead>
                                    <tr role="row">
                                        <th>Mã đơn hàng</th>
                                        <th>Theo dõi đơn hàng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                    @foreach($customers as $customer)
                                    @if($customer->user_code == Auth::user()->user_code)
                                        <tr>
                                            <td>FL-{{$customer->token}}-COL</td>
                                            <td>
                                                <div class="progress-track">
                                                    <ul id="progressbar">
                                                        @if($customer->status==0)
                                                            <li class="step0 active " id="step1">Đã đặt hàng</li>
                                                            <li class="step0  text-center" id="step2">Đã vận chuyển</li>
                                                            <li class="step0  text-right" id="step3">Trên đường</li>
                                                            <li class="step0  text-right" id="step4">Đã giao hàng</li>
                                                        @elseif($customer->status==1)
                                                            <li class="step0 active " id="step1">Đã đặt hàng</li>
                                                            <li class="step0 active text-center" id="step2">Đã vận chuyển</li>
                                                            <li class="step0 text-right" id="step3">Trên đường</li>
                                                            <li class="step0 text-right" id="step4">Đã giao hàng</li>
                                                        @elseif($customer->status==2)
                                                            <li class="step0 active " id="step1">Đã đặt hàng</li>
                                                            <li class="step0 active text-center" id="step2">Đã vận chuyển</li>
                                                            <li class="step0 active text-right" id="step3">Trên đường</li>
                                                            <li class="step0 text-right" id="step4">Đã giao hàng</li>
                                                        @else($customer->status==3) 
                                                            <li class="step0 active " id="step1">Đã đặt hàng</li>
                                                            <li class="step0 active text-center" id="step2">Đã vận chuyển</li>
                                                            <li class="step0 active text-right" id="step3">Trên đường</li>
                                                            <li class="step0 active text-right" id="step4">Đã giao hàng</li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif  
                                    @endforeach
                                </tbody>
                            </div>
                        </table>
                    </div>
                </div>
                    </div>
                </div>     
            </div>
        </div>
    </div>
@endsection
@extends('front-end.layout.index')
@section('content')
<!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> {{__('home')}}</a>
                        <span>{{__('register')}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Form Section Begin -->

    <!-- Register Section Begin -->
    <div class="register-login-section spad">
        <div class="container">
                    @if(count($errors)>0)
					<div class="alert alert-danger">
						@foreach($errors->all() as $err)
						{{$err}}
						@endforeach
					</div>
					@endif
					@if(Session::has('thanhcong'))
					<div class="alert alert-success">{{Session::get('thanhcong')}}</div>
					@endif
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="register-form">
                        <h2>{{__('register')}}</h2>
                        <form action="{{route('register')}}" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="group-input">
                                <label for="email">{{__('email')}}<span style="color:red">*</span></label>
							    <input type="email" id="email" name="email" required>
                            </div>
                            <div class="group-input">
                                <label for="name">{{__('name')}}<span style="color:red">*</span></label>
                                <input type="text"  name="name" required>
                            </div>
                            <div class="group-input">
                                <label for="adress">{{__('address')}}<span style="color:red">*</span></label>
                                <input type="text" id="address"  name="address" required>
                            </div>
                            <div class="group-input">
                                <label for="phone">{{__('phone_number')}}<span style="color:red">*</span></label>
                                <input type="text" id="phone" name="phone" required>
                            </div>
                            <div class="group-input">
                                <label for="password">{{__('password')}}<span style="color:red">*</span></label>
                                <input type="password" id="password" name="password">
                            </div>
                            <div class="group-input">
                                <label for="re-password">{{__('confirm_pass')}}<span style="color:red">*</span></label>
                                <input type="password" id="re-password" name="re_password">
                            </div>
                            <button type="submit" class="site-btn register-btn">{{__('resgister')}}</button>
                        </form>
                        <div class="switch-login">
                            <a href="{{route('login')}}" class="or-login">{{__('or')}} {{__('login')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->
@endsection
@extends('front-end.layout.index')
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> {{__('home')}}</a>
                        <span>{{__('login')}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Form Section Begin -->

    <!-- Register Section Begin -->
    <div class="register-login-section spad">
        <div class="container">
            @if(Session::has('message'))
                <div class="alert alert-success">{{Session::get('message')}}</div>
            @endif
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="login-form">
                        <h2>{{__('login')}}</h2>
                        <form action="{{route('login')}}" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="group-input">
                                <label for="email">Email <span style="color:red">*</span></label>
                                <input type="email" id="email" name="email">
                            </div>
                            <div class="group-input">
                                <label for="password">{{__('password')}} <span style="color:red">*</span></label>
                                <input type="password" id="password" name="password">
                            </div>
                            <div class="group-input gi-check">
                                <div class="gi-more">
                                    <label for="save-pass">
                                        {{__('save_pass')}}
                                        <input type="checkbox" id="save-pass">
                                        <span class="checkmark"></span>
                                    </label>
                                    <a href="#" class="forget-pass">{{__('forgot_pass')}}</a>
                                </div>
                            </div>
                            <button type="submit" class="site-btn login-btn">{{__('login')}}</button>
                        </form>
                        <div class="switch-login">
                            <a href="{{route('register')}}" class="or-login">{{__('or')}} {{__('register')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->

@endsection
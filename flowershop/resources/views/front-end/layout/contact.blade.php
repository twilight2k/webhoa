@extends('front-end.layout.index')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="{{route('home')}}"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Liên hệ</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Map Section Begin -->
    <div class="map spad">
        <div class="container">
            <div class="map-inner">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3903.3010369629583!2d108.44283160630062!3d11.953647224850219!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317112d959f88991%3A0x9c66baf1767356fa!2sDalat%20University!5e0!3m2!1sen!2sbd!4v1619784577381!5m2!1sen!2sbd"
                    height="610" style="border:0" allowfullscreen="">
                </iframe>
                <div class="icon">
                    <i class="fa fa-map-marker"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- Map Section Begin -->

    <!-- Contact Section Begin -->
    <section class="contact-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="contact-title">
                        <h4>Liên hệ với chúng tôi</h4>
                        <p>Nhằm giải đáp khúc mắc và hỗ trợ khách hàng một cách nhanh và tốt nhất, hãy liên hệ với chúng tôi qua các hình thức sau:</p>
                    </div>
                    <div class="contact-widget">
                        <div class="cw-item">
                            <div class="ci-icon">
                                <i class="ti-location-pin"></i>
                            </div>
                            <div class="ci-text">
                                <span>Địa chỉ:</span>
                                <p>Tổ 3 - Thị trấn Sông Cầu, Huyện Đồng Hỷ, Thành phố Thái Nguyên.</p>
                            </div>
                        </div>
                        <div class="cw-item">
                            <div class="ci-icon">
                                <i class="ti-mobile"></i>
                            </div>
                            <div class="ci-text">
                                <span>Số điện thoại:</span>
                                <p>+84 865 450 411</p>
                            </div>
                        </div>
                        <div class="cw-item">
                            <div class="ci-icon">
                                <i class="ti-email"></i>
                            </div>
                            <div class="ci-text">
                                <span>Email:</span>
                                <p>luckyluke9102000@gmail.com</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <div class="contact-form">
                        <div class="leave-comment">
                            <h4>Để lại phản hồi</h4>
                            <p>Nhân viên của chúng tôi sẽ gọi lại sau và giải đáp các thắc mắc của bạn.</p>
                            @if(Session::has('thongbao'))
                                <div class="alert alert-success">{{Session::get('thongbao')}}</div>
                            @endif
                            <form action="{{route('contact')}}" method="POST" class="comment-form">
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="text" name="name" placeholder="Tên của bạn">
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="email" name="email" placeholder="Địa chỉ Email">
                                    </div>
                                    <div class="col-lg-12">
                                        <textarea name="description" placeholder="Nội dung..."></textarea>
                                        <button type="submit" class="site-btn">Gửi tin nhắn</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->
    
@endsection
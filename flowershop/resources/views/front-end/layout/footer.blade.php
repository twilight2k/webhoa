<!-- Partner Logo Section Begin -->
<div class="partner-logo">
        <div class="container"style="text-align:center">
            <div class="logo-carousel owl-carousel" >
            @foreach($shop as $lg)
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="{{$lg->image}}" alt="">
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
    <!-- Partner Logo Section End -->
<!-- Footer Section Begin -->
<footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer-left">
                        <div class="footer-logo">
                            <a href="#"><img src="client_asset/assets/dest/img/lgwendy" alt=""></a>
                        </div>
                        <ul>
                            <li>{{__('address')}}: Tổ 3 - Thị trấn Sông Cầu , Đồng Hỷ ,  Tp.Thái Nguyên</li>
                            <li>{{__('phone_number')}}: +84 865 450 411</li>
                            <li>{{__('email')}}: luckyluke9102000@.gmail.com</li>
                        </ul>
                        <div class="footer-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1">
                    <div class="footer-widget">
                        <h5>{{__('infomation')}}</h5>
                        <ul>
                            <li><a href="#">{{__('aboutus')}}</a></li>
                            <li><a href="#">{{__('checkout')}}</a></li>
                            <li><a href="#">{{__('contact')}}</a></li>
                            <li><a href="#">{{__('serivius')}}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="footer-widget">
                        <h5>{{__('myaccount')}}</h5>
                        <ul>
                            <li><a href="#">{{__('serivius')}}</a></li>
                            <li><a href="#">{{__('contact')}}</a></li>
                            <li><a href="#">{{__('cart')}}</a></li>
                            <li><a href="#">{{__('shop')}}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="newslatter-item">
                        <h5>{{__('joinournewsletternow')}}</h5>
                        <p>{{__('gete-mail')}}</p>
                        <form action="#" class="subscribe-form">
                            <input type="text" placeholder="Enter Your Mail">
                            <button type="button">{{__('sbuscribe')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-reserved">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright-text">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
    Copyright &copy;<script>document.write(new Date().getFullYear());</script> {{__('all_rights_reserved')}} | {{__('template')}} <i class="fa fa-heart-o" aria-hidden="true"></i> {{__('by')}} <a href="https://www.facebook.com/nkok.lacpro/" target="_blank">Col Col</a>
    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </div>
                        <div class="payment-pic">
                            <img src="client_asset/assets/dest/img/payment-method.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

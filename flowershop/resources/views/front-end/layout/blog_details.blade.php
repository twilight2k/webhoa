@extends('front-end.layout.index')
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="{{route('home')}}"><i class="fa fa-home"></i> Trang chủ</a>
                        <a href="{{route('blog')}}"> Diễn đàn</a>
                        <a href="{{route('blog')}}"> {{$blog_details->blog_type->name}}</a>
                        <span>{{$blog_details->name}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Blog Section Begin -->
    <section class="blog-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1">
                    <div class="blog-sidebar">
                        <div class="search-form">
                            <h4>Tìm kiếm</h4>
                            <form action="#">
                                <input type="text" placeholder="Bạn muốn tìm . . .  ">
                                <button type="submit"><i style="color:#fff" class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="blog-catagory">
                            <h4>Danh mục</h4>
                            <ul>
                            @foreach($blog_type as $blt)
                                <li><a href="#">{{$blt->name}}</a></li>
                            @endforeach
                            </ul>
                        </div>
                        <div class="recent-post">
                            <h4>Bài đăng gần đây</h4>
                            <div class="recent-blog">
                            @foreach($blog_nearest as $bl)
                                <a href="{{route('blogdetails',$bl->id)}}" class="rb-item">
                                    <div class="rb-pic">
                                        <img style="width:81px;height:81px;" src="client_asset/image/blog/{{$bl->image}}" alt="">
                                    </div>
                                    <div class="rb-text">
                                        <h6>{{$bl->name}}</h6>
                                        <p>{{$bl->blog_type->name}} <span>- {{$bl->updated_at}}</span></p>
                                    </div>
                                </a>
                            @endforeach
                            </div>
                        </div>
                        <div class="blog-tags">
                            <h4>Từ khóa đính kèm</h4>
                            <div class="tag-item">
                            @foreach($loai as $lo)
                                <a href="{{route('category',$lo->id)}}">{{$lo->name}}</a>
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 order-1 order-lg-2">
                   <!-- Blog Details Section Begin -->
                    <section class="blog-details spad">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="blog-details-inner">
                                        <div class="blog-detail-title">
                                            <h2>{{$blog_details->name}}</h2>
                                            <p>{{$blog_details->blog_type->name}} <span>- {{$blog_details->updated_at}}</span></p>
                                        </div>
                                        <div class="blog-large-pic">
                                            <img src="client_asset/image/blog/{{$blog_details->image}}" alt="">
                                        </div>
                                        <div class="blog-detail-desc">
                                            <p>{{$blog_details->description}}
                                            </p>
                                        </div>
                                        <!-- <div class="blog-more">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <img src="img/blog/blog-detail-1.jpg" alt="">
                                                </div>
                                                <div class="col-sm-4">
                                                    <img src="img/blog/blog-detail-2.jpg" alt="">
                                                </div>
                                                <div class="col-sm-4">
                                                    <img src="img/blog/blog-detail-3.jpg" alt="">
                                                </div>
                                            </div>
                                        </div> -->
                                        <!-- <p>Sum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                                            et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                            nisi ut aliquip ex ea commodo consequat. Duis aute irure Lorem ipsum dolor sit amet,
                                            consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                                            aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                            ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate.</p> -->
                                        <div class="tag-share">
                                            <div class="details-tag">
                                                <ul>
                                                    <li><i class="fa fa-tags"></i></li>
                                                    @foreach($blog_type as $blt)
                                                    <li>{{$blt->name}}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="blog-share">
                                                <span>Share:</span>
                                                <div class="social-links">
                                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                                    <a href="#"><i class="fa fa-youtube-play"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="blog-post">
                                            <div class="row">
                                                @foreach($blog_previous as $bln)
                                                <div class="col-lg-5 col-md-6">
                                                    <a href="#" class="prev-blog">
                                                        <div class="pb-pic">
                                                            <i class="ti-arrow-left"></i>
                                                            <img src="client_asset/image/blog/{{$bln->image}}" alt="">
                                                        </div>
                                                        <div class="pb-text">
                                                            <span>Trước:</span>
                                                            <h5>{{$bln->name}}</h5>
                                                        </div>
                                                    </a>
                                                </div>
                                                @endforeach
                                                @foreach($blog_next as $bln)
                                                <div class="col-lg-5 offset-lg-2 col-md-6">
                                                    <a href="#" class="next-blog">
                                                        <div class="nb-pic">
                                                            <img src="client_asset/image/blog/{{$bln->image}}" alt="">
                                                            <i class="ti-arrow-right"></i>
                                                        </div>
                                                        <div class="nb-text">
                                                            <span>Sau:</span>
                                                            <h5>{{$bln->name}}</h5>
                                                        </div>
                                                    </a>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="posted-by">
                                            <div class="pb-pic">
                                                <img src="img/blog/post-by.png" alt="">
                                            </div>
                                            <div class="pb-text">
                                                <a href="#">
                                                    <h5>Lộc Nguyễn</h5>
                                                </a>
                                                <p>Cảm nhận sự tuyệt đẹp từ những bông hoa</p>
                                            </div>
                                        </div>
                                        <div class="leave-comment">
                                            <h4>Bình luận</h4>
                                            <form action="#" class="comment-form">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <input type="text" placeholder="Tên">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <input type="text" placeholder="Địa chỉ Email">
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <textarea placeholder="Nội dung"></textarea>
                                                        <button type="submit" class="site-btn">Đăng</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Blog Details Section End -->
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection
@extends('front-end.layout.index')
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="{{route('home')}}"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Diễn đàn</span>
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
                    <div class="row">
                    @foreach($blog as $bl)
                        <div class="col-lg-6 col-sm-6">
                            <div class="blog-item">
                                <div class="bi-pic">
                                    <a href="{{route('blogdetails',$bl->id)}}"><img src="client_asset/image/blog/{{$bl->image}}" alt=""></a>
                                </div>
                                <div class="bi-text">
                                    <a href="{{route('blogdetails',$bl->id)}}">
                                        <h4>{{$bl->name}}</h4>
                                    </a>
                                    <p>{{$bl->blog_type->name}} <span>- {{$bl->updated_at}}</span></p>
                                </div>
                            </div>
                        </div>
                    @endforeach       
                        <div class="col-lg-12">
                            <div class="loading-more">
                                {{$blog->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection
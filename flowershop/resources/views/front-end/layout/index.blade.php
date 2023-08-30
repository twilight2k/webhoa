<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="{{$meta_desc}}">
    <meta name="keywords" content="{{$meta_keywords}}">
    <meta name="robots" content="INDEX,FOLLOW">
    <meta name="title" content="{{$meta_title}}">
    <link rel="canonical" href="{{$url_canonical}}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta property="og:site_name" content="http://localhost:8080/flowershop/public/" />
    <meta property="og:description" content="{{$meta_desc}}" />
    <meta property="og:title" content="{{$meta_title}}" />
    <meta property="og:url" content="{{$url_canonical}}" />
    <meta property="og:type" content="website" />
    <title>{{$meta_title}}</title>
    <base href="{{asset(' ')}}"/>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="client_asset/assets/dest/img/lgwendy.png"/>
    <!-- Css Styles -->
    <link rel="stylesheet" href="client_asset/assets/dest/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="client_asset/assets/dest/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="client_asset/assets/dest/css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="client_asset/assets/dest/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="client_asset/assets/dest/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="client_asset/assets/dest/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="client_asset/assets/dest/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="client_asset/assets/dest/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="client_asset/assets/dest/css/style.css" type="text/css">
</head>

<body>

    @include('front-end.layout.header')
    @yield('content')
    <!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="QuickView" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{__('product_information')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product-pic-zoom" id="product_quickview_image">
                        <img class="product-big-img" src="" alt="">
                        <div class="zoom-icon">
                            <i class="fa fa-search-plus"></i>
                        </div>
                    </div>
                    <div class="product-thumbs">
                        <div class="product-thumbs-track ps-slider owl-carousel">
                            <div id="product_quickview_image_active">
                                <div class="pt active"  data-imgbigurl="">
                                    <img src="" alt="">
                                </div>
                            </div>
                            <div>
                                <div class="pt" id="product_quickview_gallery" data-imgbigurl="">
                                    <img src="" alt="">
                                </div>
                            </div
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product-details">
                        <div class="pd-title">
                            <span id="product_quickview_category"></span>
                            <h3 id="product_quickview_title"></h3>
                        </div>
                        <div class="pd-rating" >
                            <span id="product_quickview_star"></span>
                        </div>
                        <div class="pd-desc">
                            <p id="product_quickview_desc"></p>
                                <h4 id="product_quickview_price"> <span></span></h4>
                        </div>
                        <div class="pd-color">
                            <h6>{{__('color')}}</h6>
                            <div class="pd-color-choose" id="product_quickview_color">
                            </div>
                        </div>
                                <div class="quantity" id="product_quickview_add">
                                </div>
                                <ul class="pd-tags">
                                    <li id="product_quickview_shop"></li>
                                </ul>
                                <div class="pd-share">
                                    <div class="p-code" id="product_quickview_code"></div>
                                    <div class="pd-social">
                                        <a href="#"><i class="ti-facebook"></i></a>
                                        <a href="#"><i class="ti-twitter-alt"></i></a>
                                        <a href="#"><i class="ti-linkedin"></i></a>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @include('front-end.layout.footer')

    <!-- Js Plugins -->
    <script src="client_asset/assets/dest/js/jquery-3.3.1.min.js"></script>
    <script src="client_asset/assets/dest/js/bootstrap.min.js"></script>
    <script src="client_asset/assets/dest/js/sweetalert.min.js"></script>
    <script src="client_asset/assets/dest/js/jquery-ui.min.js"></script>
    <script src="client_asset/assets/dest/js/jquery.countdown.min.js"></script>
    <script src="client_asset/assets/dest/js/jquery.nice-select.min.js"></script>
    <script src="client_asset/assets/dest/js/jquery.zoom.min.js"></script>
    <script src="client_asset/assets/dest/js/jquery.dd.min.js"></script>
    <script src="client_asset/assets/dest/js/jquery.slicknav.js"></script>
    <script src="client_asset/assets/dest/js/owl.carousel.min.js"></script>
    <script src="client_asset/assets/dest/js/main.js"></script>
    <script src="client_asset/assets/dest/js/push.min.js"></script>

    <script>
        function view(){
            if(localStorage.getItem('data')!=null){
                var data = JSON.parse(localStorage.getItem('data'));

                data.reverse();

                for(i=0;i<data.length;i++){
                    var name = data[i].name;
                    var price = data[i].price;
                    var image = data[i].image;
                    var url = data[i].url;
                    var id = data[i].id;

                    $("#row_wishlist").append('<tr class="fav"><td class="si-pic"><img src="'+image+'" alt=""></td><td class="si-text"><div class="product-selected"><p><span>'+price+' VNĐ </span></p><h6>'+name+'</h6><a href="'+url+'"><p>Chi tiết</p></a></div></td></tr>');
                }

            }
        }
        view();

        function add_wistlist(clicked_id) {
            var id = clicked_id;
            var name = document.getElementById('wishlist_productname'+ id).value;
            var price = document.getElementById('wishlist_productprice'+ id).value;
            var image = document.getElementById('wishlist_productimage'+ id).src;
            var url = document.getElementById('wishlist_producturl'+ id).href;

            var newItem = {
                'url':url,
                'id':id,
                'name':name,
                'price':price,
                'image':image
            }
            if(localStorage.getItem('data')==null){
                localStorage.setItem('data','[]');
            }
            var old_data = JSON.parse(localStorage.getItem('data'));

            var matches = $.grep(old_data,function(obj){
                return obj.id == id;
            })
            if(matches.length){
                swal("Wendy-Flowers", "Không thể yêu thích sản phẩm thêm lần nữa", "warning");
            }else{
                swal("Wendy-Flowers", "Cảm ơn bạn đã yêu thích sản phẩm", "success");
                old_data.push(newItem);
                $("#row_wishlist").append('<tr class="fav"><td class="si-pic"><img src="'+newItem.image+'" alt=""></td><td class="si-text"><div class="product-selected"><p><span>'+newItem.price+' VNĐ </span></p><h6>'+newItem.name+'</h6><a href="'+newItem.url+'"><p>Chi tiết</p></a></div></td></tr>');
            }
            localStorage.setItem('data',JSON.stringify(old_data));
        };
        function delete_withlist() {
            if(localStorage.getItem('data')!=null){
                localStorage.removeItem('data');
                swal("Wendy-Flowers", "Bạn đã tất cả sản phẩm yêu thích", "success").then(ok=>{window.location.reload()});
            }
            else
            {
                swal("Wendy-Flowers", "Không tồn tại sản phẩm yêu thích!!!", "warning");
            }
            localStorage.setItem('data',JSON.stringify(old_data));
        };
    </script>
    <script type="text/javascript">
        $('.QuickView').click(function(){
            var product_id = $(this).data('id');
            var _token = $('input[name="_token"]').val();
            // alert(product_id);
            // alert(_token);
            $.ajax({
                url:"{{url('/quickview')}}",
                type:'POST',
                dataType:"JSON",
                data:{product_id:product_id,_token:_token},
                success:function(data){
                    $('#product_quickview_title').html(data.product_name);
                    $('#product_quickview_shop').html(data.product_shop);
                    $('#product_quickview_category').html(data.product_category);
                    $('#product_quickview_price').html(data.product_price);
                    $('#product_quickview_image').html(data.product_image);
                    $('#product_quickview_image_active').html(data.product_image_active);
                    $('#product_quickview_gallery').html(data.product_gallery);
                    $('#product_quickview_desc').html(data.product_desc);
                    $('#product_quickview_code').html(data.product_code);
                    $('#product_quickview_star').html(data.product_star);
                    $('#product_quickview_add').html(data.product_add);
                    $('#product_quickview_color').html(data.product_color);
                }
            })
        });
    </script>
    <script>
        const iconPath = 'client_asset/assets/dest/img/roselg.png';
        const url = '{{route('home')}}';
        Push.create("Chào bạn đến với Wendy Flowers!", {
            body: "Bạn cần chúng tôi giúp gì không'?",
            icon: iconPath,
            timeout: 4000,
            tag: 'foo',
            onClick: function () {
                window.location=url;
                this.close();
            }

        });
        Push.close('foo');
    </script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('6c0ffd045a97cd18cf4a', {
        cluster: 'ap1'
        });

        var channel = pusher.subscribe('my-channel-product');
        channel.bind('my-event-product', function(data) {
        // alert(JSON.stringify(data));
            const id = ''+data.product.id+'';
            const iconPath = ''+data.product.image+'';
            const url = '{{route('productdetails','')}}'+'/'+id;
            var promise = Push.create(''+data.product.name+'',
            {
                body: 'Nhấn để xem ngay nào!!!',
                icon: iconPath,
                timeout: 4000,
                onClick: function (){
                window.location=url;
                this.close();
                }
            });
            promise.then(function(notification) {
                notification.close();
            });
        });
    </script>
    <a id="back-to-top" href="#" class="btn btn-light btn-lg back-to-top" role="button"><i class="fa fa-chevron-up"></i></a>

</body>

</html>

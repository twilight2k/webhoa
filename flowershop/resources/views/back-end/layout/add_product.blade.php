@extends('back-end.layout.index')
@section('content')
 <!-- Begin Page Content -->
 <div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Thêm sản phẩm</h6>
    </div>
    <div class="row">
                    <div class="col-lg-12">
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
                    </div>
                <div class="col-lg-7" style="padding:20px">
                <form action="admin/product/add" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <div class="form-group">
                                <label>Mã sản phẩm</label>
                                <input class="form-control" name="code_product" placeholder="Hãy nhập mã sản phẩm" />
                            </div>
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input class="form-control" name="name" placeholder="Hãy nhập tên sản phẩm" />
                            </div>
                            <div class="form-group">
                                <label>Màu sắc đặc trưng</label>
                                <select class="form-control" name="feature" id="feature">
                                    <option value="">--Chọn màu sắc đặc trưng--</option>
                                    @foreach($color as $cl)
                                        <option value="{{$cl->id}}">{{$cl->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea id="my-editor" name="description" class="form-control">{!! old('description', 'Hãy nhập nội dung') !!}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Tên cửa hàng</label>
                                <select class="form-control" name="id_shop" id="id_shop">
                                    <option value="">--Chọn tên cửa hàng--</option>
                                    @foreach($shop as $ch)
                                        <option value="{{$ch->id}}">{{$ch->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Danh mục</label>
                                <select class="form-control" name="id_type" id="theloai">
                                    <option value="">--Chọn thể loại--</option>
                                    @foreach($product_type as $tl)
                                    <option value="{{$tl->id}}">{{$tl->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Giá gốc</label>
                                <input class="form-control" type="number" name="unit_price" placeholder="Hãy nhập giá gốc" />
                            </div>
                            <div class="form-group">
                                <label>Giá Sale (nếu có)</label>
                                <input class="form-control" type="number" name="promotion_price" placeholder="Hãy nhập giá Sale" />
                            </div>
                            <div class="form-group">
                                <label>Đơn vị</label>
                                <input class="form-control" name="unit" placeholder="Hãy nhập đơn vị sản phẩm" />
                            </div>
                            <div class="form-group">
                                <label>Độ ưu tiên</label>
                                <label class="radio-inline">
                                    <input name="new" value="1" checked="" type="radio">Có
                                </label>
                                <label class="radio-inline">
                                    <input name="new" value="0" type="radio">Không
                                </label>
                            </div>
                </div>

                <div class="col-lg-4" >
                    <div class="contact-form" >
                        <div class="leave-comment">
                        </br>
                            <h4 style="text-align:center;">Ảnh đại diện</h4>
                            <div class="input-group" style="border-bottom:3px solid #ccc">
                                {{-- <span class="input-group-btn">
                                    <input id="file" type="file" style="display: none;" name="image">
                                    <a class="btn btn-warning" id="lfm" data-input="thumbnail" data-preview="preview_thumbnail" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Chọn ảnh
                                    </a>
                                </span>

                                <input id="thumbnail" class="form-control" type="text" name="image">
                                <div class="col-lg-12">
                                <div id="preview_thumbnail" class="preview-img" style="padding-top:30px;text-align:center">
                                    <img src="{{ asset('admin_asset/assets/dest/img/img_fuild.png') }}" style="height:15rem;">

                                </div> --}}
                                <span class="input-group-btn">
                                    <input id="file" type="file" style="display: none;" name="image">
                                    <label for="file" class="btn btn-warning" data-input="thumbnail"
                                        data-preview="preview_thumbnail" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Chọn ảnh
                                    </label>
                                </span>
                                <input id="thumbnail" class="form-control" type="text">
                                <div class="col-lg-12">
                                    <div id="preview_thumbnail" class="preview-img" style="padding-top: 30px; text-align: center">
                                        <img id="image_preview" src="{{ asset('admin_asset/assets/dest/img/img_fuild.png') }}" style="height: 9rem;">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- <div class="row" id="reset_image_dk">
                        <div class="col-lg-12" style="text-align:center">
                            <h5>Ảnh đính kèm</h5>
                        </div>

                        <div class="col-lg-6">
                            <div class="contact-form">
                                <div class="leave-comment">
                                    <div class="input-group">
                                        <div id="preview_thumbnail_1" class="preview-img">
                                            <img src="admin_asset/assets/dest/img/img_fuild.png" style="height:10rem;padding:20px">
                                        </div>
                                        <span class="input-group-btn">
                                            <a class="btn btn-warning" id="lfm_dk_1" data-input="thumbnail_dk_1" data-preview="preview_thumbnail_1">
                                                <i class="fa fa-picture-o"></i> Chọn ảnh 1
                                            </a>
                                        </span>
                                        <input id="thumbnail_dk_1" class="form-control" type="type" name="image_dk_1">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="contact-form">
                                <div class="leave-comment" >
                                    <div class="input-group">
                                        <div id="preview_thumbnail_2" class="preview-img">
                                            <img src="admin_asset/assets/dest/img/img_fuild.png" style="height:10rem;padding:20px">
                                        </div>
                                        <span class="input-group-btn">
                                            <a class="btn btn-warning" id="lfm_dk_2" data-input="thumbnail_dk_2" data-preview="preview_thumbnail_2">
                                                <i class="fa fa-picture-o"></i> Chọn ảnh 2
                                            </a>
                                        </span>
                                        <input id="thumbnail_dk_2" class="form-control" type="type" name="image_dk_2">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                <div class="modal-footer">
                    <a class="btn btn-secondary" href="admin/product/list-product">Thoát</a>
                    <button id="btn" class="btn btn-success" type="submit">Thêm</button>

                </div>
            <form>
            </div>
</div>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
    <script src="vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image');
        $('#lfm_dk_1').filemanager('image');
        $('#lfm_dk_2').filemanager('image');
    </script>
<!-- /.container-fluid -->
<script src="client_asset/assets/dest/js/push.min.js"></script>
    <script>

        var btn = document.getElementById('btn');
        btn.addEventListener('click',function(){
            // alert('123');
            const iconPath = 'client_asset/assets/dest/img/logo.png';
            const url = '{{route('home')}}';
            Push.create("Sản phẩm mới từ Wendy Flowers!", {
                body: " Test",
                icon: iconPath,
                timeout: 4000,
                onClick: function () {
                    window.location=url;
                    this.close();
                }
            });
        });

        document.getElementById('file').addEventListener('change', function(event) {
                        var input = event.target;
                        var reader = new FileReader();

                        reader.onload = function() {
                            var preview = document.getElementById('image_preview');
                            preview.src = reader.result;
                        };

                        reader.readAsDataURL(input.files[0]);
                    });
                    $('#lfm').filemanager('image');
    </script>

@endsection

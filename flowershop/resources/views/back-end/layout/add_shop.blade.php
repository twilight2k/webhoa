@extends('back-end.layout.index')
@section('content')
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thêm cửa hàng</h6>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $err)
                                {{ $err }}<br>
                            @endforeach
                        </div>
                    @endif
                    @if (session('thongbao'))
                        <div class="alert alert-success">
                            {{ session('thongbao') }}
                        </div>
                    @endif
                </div>
                <div class="col-lg-7" style="padding:20px">
                    <form action="admin/shop/add" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group">
                            <label>Tên cửa hàng</label>
                            <input class="form-control" name="name" placeholder="Hãy nhập tên thể loại" />
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <input class="form-control" name="description" placeholder="Hãy nhập mô tả cho thể loại" />
                        </div>
                </div>

                <div class="col-lg-4">
                    <div class="contact-form">
                        <div class="leave-comment">
                            </br>
                            <h4 style="text-align:center;">Ảnh đại diện</h4>
                            <div class="input-group">
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
                                </br>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <a class="btn btn-secondary" href="admin/shop/list-shop">Trở về</a>
                            <button class="btn btn-success" type="submit">Thêm</button>
                        </div>
                        <form>
                    </div>
                </div>
                <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
                <script src="vendor/laravel-filemanager/js/stand-alone-button.js"></script>
                <script>
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

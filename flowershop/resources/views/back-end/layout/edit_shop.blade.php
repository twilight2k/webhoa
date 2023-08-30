@extends('back-end.layout.index')
@section('content')
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Sửa thông tin cửa hàng: {{ $shop_type->name }}</h6>
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
                    <form action="admin/shop/edit/{{ $shop_type->id }}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group">
                            <label>Trạng thái: </label>
                            <label class="radio-inline">
                                <input name="status" value="1"
                                    @if ($shop_type->status == 1) {{ 'checked' }} @endif type="radio"> <span
                                    style="color:red">Hủy kết nối</span>
                            </label>
                            <label class="radio-inline">
                                <input name="status" value="0"
                                    @if ($shop_type->status == 0) {{ 'checked' }} @endif type="radio"> <span
                                    style="color:#32cd32">Kết nối</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Tên cửa hàng</label>
                            <input class="form-control" name="name" value="{{ $shop_type->name }}"
                                placeholder="Hãy nhập tên cửa hàng" />
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <input class="form-control" name="description" value="{{ $shop_type->description }}"
                                placeholder="Hãy nhập mô tả cho cửa hàng" />
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
                                <input id="thumbnail" class="form-control" type="text" name="image">
                                <div class="col-lg-12">
                                    <div id="preview_thumbnail" class="preview-img"
                                        style="padding-top:30px;text-align:center">
                                        <img id="image_preview" src="{{ $shop_type->image }}" style="height:9rem;">
                                        <div>
                                        </div>

                                    </div>
                                </div>
                                </br>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <a href="admin/shop/list-shop" class="btn btn-danger">Trở về</a>
                            <button class="btn btn-success" type="submit">Sửa</button>
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

@extends('back-end.layout.index')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Sửa sản phẩm: {{$product->name}}</h6>
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
                <form action="admin/product/edit/{{$product->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <div class="form-group">
                                <label>Trạng thái: </label>
                                <label class="radio-inline">
                                    <input name="status" value="1"
                                    @if($product->status == 1)
                                    {{"checked"}}
                                    @endif
                                      type="radio"> <span style="color:red">Hủy kết nối</span>
                                </label>
                                <label class="radio-inline">
                                    <input name="status" value="0"
                                    @if($product->status == 0)
                                    {{"checked"}}
                                    @endif type="radio"> <span style="color:#32cd32">Kết nối</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label>Mã sản phẩm</label>
                                <input class="form-control" name="code_product" value="{{$product->code_product}}" placeholder="Hãy nhập mã sản phẩm" />
                            </div>
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input class="form-control" name="name"  value="{{$product->name}}" placeholder="Hãy nhập tên sản phẩm" />
                            </div>
                            <div class="form-group">
                                <label>Màu sắc đặc trưng</label>
                                <select class="form-control" name="feature" id="feature">
                                    @foreach($color as $ch)
                                        <option
                                        @if($product->feature == $ch->id)
                                            {{"selected"}}
                                        @endif
                                            value="{{$ch->id}}">{{$ch->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea id="my-editor" name="description" class="form-control">{{$product->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Tên cửa hàng</label>
                                <select class="form-control" name="id_shop" id="id_shop">
                                    @foreach($shop as $ch)
                                        <option
                                        @if($product->id_shop == $ch->id)
                                            {{"selected"}}
                                        @endif
                                            value="{{$ch->id}}">{{$ch->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Thể loại</label>
                                <select class="form-control" name="id_type" id="id_type">
                                @foreach($product_type as $pd)
                                    <option
                                        @if($product->id_type == $pd->id)
                                            {{"selected"}}
                                        @endif
                                            value="{{$pd->id}}">{{$pd->name}}
                                    </option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Giá gốc</label>
                                <input class="form-control" type="number" name="unit_price" value="{{$product->unit_price}}" placeholder="Hãy nhập giá gốc" />
                            </div>
                            <div class="form-group">
                                <label>Giá Sale (nếu có)</label>
                                <input class="form-control" type="number" name="promotion_price" value="{{$product->promotion_price}}" placeholder="Hãy nhập giá Sale" />
                            </div>
                            <div class="form-group">
                                <label>Đơn vị</label>
                                <input class="form-control" name="unit" value="{{$product->unit}}" placeholder="Hãy nhập đơn vị sản phẩm" />
                            </div>
                            <div class="form-group">
                                <label>Độ ưu tiên</label>
                                <label class="radio-inline">
                                    <input name="new" value="1" type="radio"
                                    @if($product->new==1)
                                    {{"checked"}}
                                    @endif
                                     >Có
                                </label>
                                <label class="radio-inline">
                                    <input name="new" value="0" type="radio"
                                    @if($product->new==0)
                                    {{"checked"}}
                                    @endif
                                    >Không
                                </label>
                            </div>
                </div>

                {{-- <div class="col-lg-4">
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
                                        <img id="image_preview" src="{{ $product->image }}" style="height:9rem;">
                                        <div>
                                        </div>

                                    </div>
                                </div>
                                <span class="input-group-btn">
                                    <input id="file" type="file" style="display: none;" name="image">

                                    <a class="btn btn-warning" id="lfm" data-input="thumbnail" data-preview="preview_thumbnail" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Chọn ảnh
                                    </a>
                                </span>
                                <input id="thumbnail" class="form-control" type="text" name="image">
                                <div class="col-lg-12">
                                <div id="preview_thumbnail" class="preview-img" style="padding-top:30px;text-align:center">
                                    <img src="{{$product->image}}" style="height:15rem;">
                                <div>
                                </div>

                            </div>
                        </div>
                        </br>
                    </div>
                </div>
                </br>
                <div class="modal-footer">
                    <a class="btn btn-secondary" href="admin/product/list-product">Thoát</a>
                    <button class="btn btn-success" type="submit">Sửa</button>
                </div> --}}
                {{-- <div class="row" id="reset_image_dk">
                    <div class="col-lg-12" style="text-align:center">
                        <h5>Ảnh đính kèm</h5>
                    </div>
                    @if($pr_image == true)
                    <div class="col-lg-6">
                            <div class="contact-form">
                                <div class="leave-comment">
                                    <div class="input-group">
                                        <div id="preview_thumbnail_2" class="preview-img">
                                            <img src="admin_asset/assets/dest/img/img_fuild.png" style="height:10rem;padding:20px">
                                        </div>
                                        <span class="input-group-btn">
                                            <a class="btn btn-warning" id="lfm_dk_2" data-input="thumbnail_dk_2" data-preview="preview_thumbnail_2">
                                                <i class="fa fa-picture-o"></i> Chọn ảnh
                                            </a>
                                        </span>
                                        <input id="thumbnail_dk_2" class="form-control" type="type" name="image_dk_2">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($pr_image == true)
                        @foreach($pr_image as $img)
                        <div class="col-lg-6">
                            <div class="contact-form">
                                <div class="leave-comment">
                                    <div class="input-group">
                                        <div id="preview_thumbnail_1" class="preview-img">
                                            <img src="{{$img->image}}" style="height:10rem;padding:20px;text-align:center">
                                        </div>
                                        <span class="input-group-btn">
                                            <a class="btn btn-warning" id="lfm_dk_1" data-input="thumbnail_dk_1" data-preview="preview_thumbnail_1">
                                                <i class="fa fa-picture-o"></i> Chọn ảnh
                                            </a>
                                        </span>
                                        <input id="thumbnail_dk_1" class="form-control" type="type" name="image_dk_1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    @endif
                </div> --}}
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
                                        <img id="image_preview" src="{{ $product->image }}" style="height:9rem;">
                                        <div>
                                        </div>

                                    </div>
                                </div>
                                </br>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <a href="admin/product/list-product" class="btn btn-danger">Trở về</a>
                            <button class="btn btn-success" type="submit">Sửa</button>
                        </div>
                        <form>
                    </div>
                </div>
</div>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
    <script src="vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image');
        $('#lfm_dk_1').filemanager('image');
        $('#lfm_dk_2').filemanager('image');
    </script>

@endsection
@section('js')
<script type="text/javascript" src="client_asset/assets/dest/js/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#theloai").change(function(){
            var id_type = $ (this).val();
            $("#theloai").html(data);
            })
        });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#shop").change(function(){
            var id_shop = $ (this).val();
            $("#shop").html(data);
            })
        });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#feature").change(function(){
            var color = $ (this).val();
            $("#feature").html(data);
            })
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

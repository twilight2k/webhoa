@extends('back-end.layout.index')
@section('content')
<div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Thêm nhiều sản phẩm bằng file Excel</h6>
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
                <form style="float:left" action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="form-control" require>
                    <br>
                    <span class="input-group-btn">
                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                        <i class="fa fa-picture-o"></i> Nhập hình ảnh cho File Excel
                        </a>
                    </span>
                    <a class="btn btn-warning" href="{{ route('export') }}">Xuất file Excel</a>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" href="admin/product/list-product">Trở về</a>
                        <button class="btn btn-success" type="submit">Thêm</button>
                    </div>
                </form>
            </div>
</div>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
    <script src="vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image');
    </script>
    
@endsection
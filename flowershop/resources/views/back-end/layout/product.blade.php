@extends('back-end.layout.index')
@section('content')
 <!-- Begin Page Content -->
 <div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm</h6>
    </div>
    <div class="card-header py-3">
        <div class="dropdown-divider"></div>
            <a class="btn btn-success" href="admin/product/add/">
                <i class="fa fa-plus"></i> Thêm sản phẩm
            </a>
            <a class="btn btn-warning" href="admin/product/adds/">
                <i class="fa fa-plus"></i> Thêm nhiều sản phẩm
            </a>
    </div>
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
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Trạng thái</th>
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Màu đặc trưng</th>
                        <th>Danh mục</th>
                        <th>Cửa hàng</th>
                        <th>Mô tả</th>
                        <th>Giá</th>
                        <th>Giá giảm</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Trạng thái</th>
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Màu đặc trưng</th>
                        <th>Danh mục</th>
                        <th>Cửa hàng</th>
                        <th>Mô tả</th>
                        <th>Giá</th>
                        <th>Giá giảm</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($product as $pr)
                    <tr>
                        <td style="text-align:center;">
                        @if($pr->status == 0)
                            <span style="color:#32cd32">Kích hoạt</span>
                        @else
                            <span style="color:red">Huỷ kích hoạt</span>
                        @endif
                        </td>
                        <td>{{$pr->code_product}}</td>
                        <td>{{$pr->name}}</td>
                        <td><img style="width:100px; height:100px;" src="{{$pr->image}}"/></td>
                        <td><i style="color:{!! $pr->product_color->code !!}" class="fas fa-tint"></i> {{$pr->product_color->name}}</td>
                        <td>{{$pr->product_type->name}}</td>
                        <td>{{$pr->product_shop->name}}</td>
                        <td>{!!$pr->description!!}</td>
                        <td>{{$pr->unit_price}}</td>
                        <td>{{$pr->promotion_price}}</td>
                        <td><a href="admin/product/edit/{{$pr->id}}"><i class="fa fa-edit"></i></a></td>
                        <td><a href="admin/product/delete/{{$pr->id}}"><i class="fa fa-trash"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
    <script src="vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
         $('#lfm').filemanager('image');
    </script>
@endsection

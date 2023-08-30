@extends('back-end.layout.index')
@section('content')
 <!-- Begin Page Content -->
 <div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách cửa hàng</h6>
    </div>
    <div class="card-header py-3">
        <div class="dropdown-divider"></div>
            <a class="btn btn-success" href="admin/shop/add">
                <i class="fa fa-plus"></i> Thêm cửa hàng
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
                        <th>Tên cửa hàng</th>
                        <th>Hình ảnh</th>
                        <th>Mô tả</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Trạng thái</th>
                        <th>Tên cửa hàng</th>
                        <th>Hình ảnh</th>
                        <th>Mô tả</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($shop_type as $ch_t)
                    <tr>
                        <td style="text-align:center;">
                        @if($ch_t->status == 0)
                            <span style="color:#32cd32">Kích hoạt</span>
                        @else
                            <span style="color:red">Huỷ kích hoạt</span>
                        @endif
                        </td>
                        <td>{{$ch_t->name}}</td>
                        <td><img style="width:100px; height:100px;" src="{{$ch_t->image}}"/></td>
                        <td>{{$ch_t->description}}</td>
                        <td><a href="admin/shop/edit/{{$ch_t->id}}"><i class="fa fa-edit"></i></a></td>
                        <td><a href="admin/shop/delete/{{$ch_t->id}}" ><i class="fa fa-trash"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<!--JavaScript -->
<script type="text/javascript" src="client_asset/assets/dest/js/jquery.min.js"></script>
    <script type="text/javascript">
        $("#edit").click(function() {
            alert(this.id);
        });
    </script>
@endsection
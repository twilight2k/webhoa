@extends('back-end.layout.index')
@section('content')
 <!-- Begin Page Content -->
 <div class="container-fluid">
<!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách sự kiện</h6>
            <div class="card-header py-3">
                <div class="dropdown-divider"></div>
                    <a class="btn btn-success" href="admin/event/add">
                        <i class="fa fa-plus"></i> Thêm sự kiện
                    </a>
                </div>
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
                        <th>Tên sự kiện</th>
                        <th>Đường dẫn truy cập</th>
                        <th>Hình ảnh</th>
                        <th>Mô tả</th>
                        <th>Sale</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Trạng thái</th>
                        <th>Tên sự kiện</th>
                        <th>Đường dẫn truy cập</th>
                        <th>Hình ảnh</th>
                        <th>Mô tả</th>
                        <th>Sale</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($event as $e)
                    <tr>
                        <td style="text-align:center;">
                        @if($e->status == 0)
                            <span style="color:#32cd32">Kích hoạt</span>
                        @else
                            <span style="color:red">Huỷ kích hoạt</span>
                        @endif
                        </td>
                        <td>{{$e->name}}</td>
                        <td>{{$e->link}}</td>
                        <td><img style="width:250px; height:100px;" src="{{$e->image}}"/></td>
                        <td>{{$e->NoiDung}}</td>
                        <td>
                        @if($e->condition==1)
                            <span>{{$e->number}} %</span>
                        @else($e->condition==2)
                            <span>{{number_format($e->number)}} VNĐ</span>
                        @endif
                        </td>
                        <td><a href="admin/event/edit/{{$e->id}}"><i class="fa fa-edit"></i></a></td>
                        <td><a href="admin/event/delete/{{$e->id}}" ><i class="fa fa-trash"></i></a></td>
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
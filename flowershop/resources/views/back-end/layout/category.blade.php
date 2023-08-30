@extends('back-end.layout.index')
@section('content')
 <!-- Begin Page Content -->
 <div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách thể loại</h6>
    </div>
    <div class="card-header py-3">
        <div class="dropdown-divider"></div>
            <a class="btn btn-success" href="#" data-toggle="modal" data-target="#AddCategoryModal">
                <i class="fa fa-plus"></i> Thêm thể loại
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
                        <th>Tên thể loại</th>
                        <th>Mô tả</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                    <th>Trạng thái</th>
                        <th>Tên thể loại</th>
                        <th>Mô tả</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($product_type as $pr_t)
                    <tr>
                        <td style="text-align:center;">
                        @if($pr_t->status == 0)
                            <span style="color:#32cd32">Kích hoạt</span>
                        @else
                            <span style="color:red">Huỷ kích hoạt</span>
                        @endif
                        </td>
                        <td>{{$pr_t->name}}</td>
                        <td>{{$pr_t->description}}</td>
                        <td><a href="admin/category/edit/{{$pr_t->id}}"><i class="fa fa-edit"></i></a></td>
                        <td><a href="#" data-toggle="modal" data-target="#DeleteCategoryModal"><i class="fa fa-trash"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
 <!-- Add Modal-->
 <div class="modal fade" id="AddCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm thể loại</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                        <form action="admin/category/add" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                <div class="form-group">
                                    <label>Tên thể loại</label>
                                    <input class="form-control" name="name" placeholder="Hãy nhập tên thể loại" />
                                </div>
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <input class="form-control" name="description" placeholder="Hãy nhập mô tả cho thể loại" />
                                </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Thoát</button>
                                <button class="btn btn-success" type="submit">Thêm</button>
                            </div>
                        <form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Logout Modal-->
<div class="modal fade" id="DeleteCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sẵn sàng xóa thể loại?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Chọn "Xóa" bên dưới nếu bạn đã sẵn sàng kết thúc phiên hiện tại của mình.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Thoát</button>
                    <a class="btn btn-success" href="admin/category/delete/{{$pr_t->id}}">Xóa</a>
                </div>
            </div>
        </div>
    </div>
<!-- /.container-fluid -->

<!-- /.container-fluid -->
<!--JavaScript -->
<script type="text/javascript" src="client_asset/assets/dest/js/jquery.min.js"></script>
    <script type="text/javascript">
        $("#edit").click(function() {
            alert(this.id);
        });
    </script>
@endsection
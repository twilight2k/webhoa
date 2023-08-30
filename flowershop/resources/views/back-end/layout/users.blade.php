@extends('back-end.layout.index')
@section('content')
<script type="text/javascript" src="client_asset/assets/dest/js/jquery.min.js"></script>
<script type="text/javascript">
    $('select').on('change',function(){
    var city =  $( "select option:selected" ).val();
    var token = $(this).data('token');
    var base_url = $(this).data('url');
    $.ajax({
        url:base_url+'/updaterole',
        type: 'POST',
        data: { _token :token,city_id:city_id },
        success:function(msg){
        alert("success");
        }
    });


    })
</script>
 <!-- Begin Page Content -->
 <div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách tài khoản người dùng</h6>
    </div>
    <div class="card-header py-3">
        <div class="dropdown-divider"></div>
            <a class="btn btn-success" href="#" data-toggle="modal" data-target="#AddUserModal">
                <i class="fa fa-plus"></i> Thêm người dùng
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
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Mã tài khoản</th>
                        <th>Chức vụ</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Trạng thái</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Mã tài khoản</th>
                        <th>Chức vụ</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($user as $tk)
                    <tr>
                        <td style="text-align:center;">
                        @if($tk->status == 0)
                            <span style="color:#32cd32">Kích hoạt</span>
                        @else
                            <span style="color:red">Huỷ kích hoạt</span>
                        @endif
                        </td>
                        <td>{{$tk->name}}</td>
                        <td>{{$tk->email}}</td>
                        <td>{{$tk->user_code}}</td>
                        <td>{{$tk->level_type->name}}</td>
                        @if($tk->id_levels > 1)
                        <td><a href="admin/user/edit/{{$tk->id}}"><i class="fa fa-edit"></i></a></td>
                        <td><a href="admin/user/delete/{{$tk->id}}"><i class="fa fa-trash"></i></a></td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
 <!-- Add Modal-->
 <div class="modal fade" id="AddUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm tài khoản người dùng</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                        <form action="admin/user/add" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <div class="form-group">
                                <label>Họ tên</label>
                                <input class="form-control" name="name" placeholder="Hãy nhập họ tên" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" type="email" name="email" placeholder="Hãy nhập email" />
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input class="form-control" name="password" placeholder="Hãy nhập mật khẩu" type="password" />
                            </div>
                            <div class="form-group">
                                <label>Nhập lại mật khẩu</label>
                                <input class="form-control" name="re_password" placeholder="Hãy nhập lại mật khẩu" type="password" />
                            </div>
                            <div class="form-group">
                                <label>Quyền người dùng: </label>
                                <label class="radio-inline">
                                    <input name="id_levels" value="2"  type="checkbox">Quản trị
                                </label>
                                <label class="radio-inline">
                                    <input name="id_levels" value="3" type="checkbox">Người dùng
                                </label>
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
<!-- /.container-fluid -->
@endsection
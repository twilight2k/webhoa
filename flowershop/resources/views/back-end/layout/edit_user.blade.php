@extends('back-end.layout.index')
@section('content')
<script type="text/javascript" src="client_asset/assets/dest/js/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
     $("#changePassword").change(function(){
        if($(this).is(":checked"))
        {
            $("#password").removeAttr('disabled');
            $("#re_password").removeAttr('disabled');
        }
        else
        {
            $("#password").attr('disabled','');
            $("#re_password").attr('disabled','');
        }
     }); 
    });
</script>
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <small>Sửa thông tin tài khoản: {{$user->name}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
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
                        <form action="admin/user/edit/{{$user->id}}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                <div class="form-group">
                                    <label>Trạng thái: </label>
                                    <label class="radio-inline">
                                        <input name="status" value="1"
                                        @if($user->status == 1)
                                        {{"checked"}}
                                        @endif
                                        type="radio"> <span style="color:red">Hủy kết nối</span>
                                    </label>
                                    <label class="radio-inline">
                                        <input name="status" value="0" 
                                        @if($user->status == 0)
                                        {{"checked"}}
                                        @endif type="radio"> <span style="color:#32cd32">Kết nối</span>
                                    </label>
                                </div>
                            <div class="form-group">
                                <label>Họ tên</label>
                                <input class="form-control" name="name" placeholder="Hãy nhập họ tên" value="{{$user->name}}" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" type="email" name="email" placeholder="Hãy nhập email" value="{{$user->email}}" readonly=""/>
                            </div>
                            
                            <div class="form-group">
                            <input type="checkbox" name="changePassword" id="changePassword"/>
                                <label>Đổi mật khẩu</label>
                                <input class="form-control" type="password" name="password" id="password" placeholder="Hãy nhập mật khẩu"  disabled="" />
                            </div>
                            <div class="form-group">
                                <label>Nhập lại mật khẩu</label>
                                <input class="form-control" type="password" name="re_password" id="re_password" placeholder="Hãy nhập lại mật khẩu"  disabled="" />
                            </div>
                            <div class="form-group">
                                <label>Quyền người dùng: </label>
                                <label class="radio-inline">
                                    <input name="id_levels" value="2"
                                    @if($user->id_levels==2)
                                    {{"checked"}}
                                    @endif
                                      type="checkbox">Author
                                </label>
                                <label class="radio-inline">
                                    <input name="id_levels" value="3" 
                                    @if($user->id_levels==3)
                                    {{"checked"}}
                                    @endif type="checkbox">Người dùng
                                </label>
                            </div>
                            <button type="submit" class="btn btn-success">Sửa</button>
                            <a href="admin/user/list-user" class="btn btn-danger">Trở về</a>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

@endsection


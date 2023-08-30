@extends('back-end.layout.index')
@section('content')
 <!-- Begin Page Content -->
 <div class="container-fluid">
<!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách phản hồi</h6>
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
                            <th>Nội dung</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Trạng thái</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Nội dung</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($contact as $cont)
                        <tr>
                            <td style="text-align:center;">
                            @if($cont->status == 0)
                                <span style="color:red">Chưa xử lý</span>
                            @else
                                <span style="color:#32cd32">Đã xử lý</span>
                            @endif
                            </td>
                            <td>{{$cont->name}}</td>
                            <td>{{$cont->email}}</td>
                            <td>{{$cont->description}}</td>
                            <td><a href="admin/contact/edit/{{$cont->id}}"><i class="fa fa-edit"></i></a></td>
                            <td><a href="admin/contact/delete/{{$cont->id}}"><i class="fa fa-trash"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách phản hồi đã xử lý</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Trạng thái</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Nội dung</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Trạng thái</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Nội dung</th>
                            <th>Xóa</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($contact_xl as $cont)
                        <tr>
                            <td style="text-align:center;">
                            @if($cont->status == 0)
                                <span style="color:red">Chưa xử lý</span>
                            @else
                                <span style="color:#32cd32">Đã xử lý</span>
                            @endif
                            </td>
                            <td>{{$cont->name}}</td>
                            <td>{{$cont->email}}</td>
                            <td>{{$cont->description}}</td>
                            <td><a href="admin/contact/delete/{{$cont->id}}"><i class="fa fa-trash"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
@endsection
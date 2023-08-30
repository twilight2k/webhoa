@extends('back-end.layout.index')
@section('content')
 <!-- Begin Page Content -->
 <div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách hóa đơn chưa giao</h6>
    </div>
    <div class="card-header py-3">
        <div class="dropdown-divider"></div>
            <a class="btn btn-danger" href="admin/bill/list-bill">
                <i class="fas fa-calendar"></i> Hóa đơn chưa xử lý
            </a>
            <a class="btn btn-info" href="admin/bill/list-bill-2">
                <i class="fas fa-calendar"></i> Hóa đơn đang giao
            </a>
            <a class="btn btn-success" href="admin/bill/list-bill-finish">
                <i class="fas fa-calendar"></i> Hóa đơn đã giao
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
                        <th>Địa chỉ</th>
                        <th>Thời gian đặt hàng</th>
                        <th>Email</th>
                        <th>Chi tiết</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Trạng thái</th>
                        <th>Tên thể loại</th>
                        <th>Địa chỉ</th>
                        <th>Thời gian đặt hàng</th>
                        <th>Email</th>
                        <th>Chi tiết</th>
                        <th>Xóa</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($customers as $customer)
                    <tr>
                        <td style="text-align:center;">
                        @if($customer->status==0)
                            <p style="color:red;">{{'Chờ xử lý'}}</p>
                        @elseif($customer->status==1)
                            <p style="color:blue;">{{'Chưa giao'}}</p>
                        @elseif($customer->status==2)
                            <p style="color:#F4A91D;">{{'Đang giao'}}</p>
                        @else($customer->status==3) 
                            <p style="color:green;">{{'Đã giao'}}</p>
                        @endif
                        </td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->address_streets }},{{ $customer->devvn_xaphuong->name }},{{ $customer->devvn_quanhuyen->name }},{{$customer->devvn_tinhthanhpho->name}}</td>
                        <td>{{ $customer->created_at }}</td>
                        <td>{{ $customer->email }}</td>
                        <td><a href="admin/bill/edit/{{$customer->id}}">Chi tiết</a></td>
                        <td><a href="admin/bill/delete/{{$customer->id}}"><i class="fa fa-trash"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection
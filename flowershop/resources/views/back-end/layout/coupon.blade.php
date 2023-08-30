@extends('back-end.layout.index')
@section('content')
 <!-- Begin Page Content -->
 <div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách mã giảm giá</h6>
    </div>
    <div class="card-header py-3">
        <div class="dropdown-divider"></div>
            <a class="btn btn-success" href="#" data-toggle="modal" data-target="#AddCouponModal">
                <i class="fa fa-plus"></i> Thêm mã giảm giá
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
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th>Code</th>
                        <th>Tên mã giảm</th>
                        <th>Mức giảm</th>
                        <th>Số lượng</th>
                        <th>Tình trạng</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                    <th>Trạng thái</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th>Code</th>
                        <th>Tên mã giảm</th>
                        <th>Mức giảm</th>
                        <th>Số lượng</th>
                        <th>Tình trạng</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($coupon as $cp)
                    <tr>
                        <td style="text-align:center;">
                        @if($cp->status == 0)
                            <span style="color:#32cd32">Kích hoạt</span>
                        @else
                            <span style="color:red">Huỷ kích hoạt</span>
                        @endif
                        </td>
                        <td>{{$cp->date_start}}</td>
                        <td>{{$cp->date_end}}</td>
                        <td>{{$cp->code}}</td>
                        <td>{{$cp->name}}</td>
                        <td>
                        @if($cp->condition==1)
                            <span>{{$cp->number}} %</span>
                        @else($cp->condition==2)
                            <span>{{number_format($cp->number)}} VNĐ</span>
                        @endif
                        </td>
                        <td>{{$cp->time}}</td>
                        <td>
                        @if($cp->date_end >= $today)
                            <span style="color:#32cd32">Còn hạn</span>
                        @else
                            <span style="color:red">Hết hạn</span>
                        @endif
                        </td>
                        <td><a href="admin/coupon/edit/{{$cp->id}}"><i class="fa fa-edit"></i></a></td>
                        <td><a href="#" data-toggle="modal" data-target="#DeleteCouponModal"><i class="fa fa-trash"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
 <!-- Add Modal-->
 <div class="modal fade" id="AddCouponModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm mã giảm giá</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                        <form action="admin/coupon/add" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <div class="form-group">
                                <label>Tên mã giảm giá</label>
                                <input class="form-control" name="name" placeholder="Hãy nhập tên mã giảm giá" />
                            </div>
                            <div class="form-group">
                                <label>Mã nhập</label>
                                <input class="form-control" name="code" placeholder="Hãy nhập mã giảm giá" />
                            </div>
                            <div class="form-group">
                                <label>Thời gian bắt đầu</label>
                                <input type="date" class="form-control" name="date_start" placeholder="Chọn ngày bắt đầu" />
                            </div>
                            <div class="form-group">
                                <label>Thời gian kết thúc</label>
                                <input type="date" class="form-control" name="date_end" placeholder="Chọn ngày kết thúc" />
                            </div>
                            <div class="form-group">
                                <label>Số lượng</label>
                                <input class="form-control" name="time" placeholder="Hãy nhập số lượng mã" />
                            </div>
                            <div class="form-group">
                                <label>Tính năng giảm giá</label>
                                <select class="form-control" name="condition">
                                    <option value="0">Chọn loại giảm</option>
                                    <option value="1">Giảm theo %</option>
                                    <option value="2">Giảm theo tiền</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nhập số % hoặc số tiền</label>
                                <input class="form-control" name="number" placeholder="Hãy nhập mức % hoặc số tiền" />
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
<div class="modal fade" id="DeleteCouponModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sẵn sàng xóa mã giảm giá?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Chọn "Xóa" bên dưới nếu bạn đã sẵn sàng kết thúc phiên hiện tại của mình.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Thoát</button>
                    <a class="btn btn-success" href="admin/coupon/delete/{{$cp->id}}">Xóa</a>
                </div>
            </div>
        </div>
    </div>
<!-- /.container-fluid -->
@endsection
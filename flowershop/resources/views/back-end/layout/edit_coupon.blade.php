@extends('back-end.layout.index')
@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <small>Sửa thông tin giảm giá: {{$coupon->name}}</small>
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
                        <form action="admin/coupon/edit/{{$coupon->id}}" method="POST">
                            <div class="modal-body">
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                <div class="form-group">
                                <label>Trạng thái: </label>
                                <label class="radio-inline">
                                    <input name="status" value="1"
                                    @if($coupon->status == 1)
                                    {{"checked"}}
                                    @endif
                                      type="radio"> <span style="color:red">Hủy kết nối</span>
                                </label>
                                <label class="radio-inline">
                                    <input name="status" value="0" 
                                    @if($coupon->status == 0)
                                    {{"checked"}}
                                    @endif type="radio"> <span style="color:#32cd32">Kết nối</span>
                                </label>
                            </div>
                                <div class="form-group">
                                    <label>Tên mã giảm giá</label>
                                    <input class="form-control" name="name" placeholder="Hãy nhập tên thể loại" value="{{$coupon->name}}"/>
                                </div>
                                <div class="form-group">
                                    <label>Mã nhập</label>
                                    <input class="form-control" name="code" value="{{$coupon->code}}" placeholder="Hãy nhập mô tả cho thể loại" />
                                </div>
                            <div class="form-group">
                                <label>Thời gian bắt đầu</label>
                                <input type="date" class="form-control" name="date_start"  value="{{$coupon->date_start}}" placeholder="Chọn ngày bắt đầu" />
                            </div>
                            <div class="form-group">
                                <label>Thời gian kết thúc</label>
                                <input type="date" class="form-control" name="date_end"  value="{{$coupon->date_end}}" placeholder="Chọn ngày kết thúc" />
                            </div>
                            <div class="form-group">
                                <label>Số lượng</label>
                                <input class="form-control" name="time" placeholder="Hãy nhập số lượng mã" value="{{$coupon->time}}" />
                            </div>
                            <div class="form-group">
                                <label>Tính năng giảm giá</label>
                                <select class="form-control" name="condition">
                                    @if($coupon->condition == 1)
                                        <option value="1">Giảm theo %</option>
                                        <option value="2">Giảm theo tiền</option>
                                    @else($coupon->condition ==2)
                                        <option value="2">Giảm theo tiền</option>
                                        <option value="1">Giảm theo %</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nhập số % hoặc số tiền</label>
                                <input class="form-control" name="number" value="{{$coupon->number}}" placeholder="Hãy nhập mức % hoặc số tiền" />
                            </div>
                            </div>
                            <button type="submit" class="btn btn-success">Sửa</button>
                            <a href="admin/coupon/list-coupon" class="btn btn-danger">Trở về</a>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

@endsection


@extends('back-end.layout.index')
@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <small>Chi tiết hóa đơn của khách hàng: {{$customerInfo->name}}  </small>
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
                        <!-- Main content -->
                        <section class="content">
                        
                            <!-- Default box -->
                            <div class="box">
                                <div class="box-header with-border">
                                    <div class="row">
                                            <div class="container">
                                            <button class="btn btn-success" onclick="window.print()">In hóa đơn</button>
                                                <h4></h4>
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="col-md-4">Thông tin khách hàng</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Thông tin người đặt hàng</td>
                                                            <td>{{ $customerInfo->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Ngày đặt hàng</td>
                                                            <td>{{ $customerInfo->created_at }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Số điện thoại</td>
                                                            <td>{{ $customerInfo->phone_number }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Địa chỉ</td>
                                                            <td>{{ $customerInfo->address_streets }},{{ $customerInfo->devvn_xaphuong->name }},{{ $customerInfo->devvn_quanhuyen->name }},{{$customerInfo->devvn_tinhthanhpho->name}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Email</td>
                                                            <td>{{ $customerInfo->email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Ghi chú</td>
                                                            <td>{{ $customerInfo->note }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Phí vận chuyển</td>
                                                            <td>{{ $customerInfo->ship }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <table id="myTable" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                                <thead>
                                                <tr role="row">
                                                    <th>STT</th>
                                                    <th>Tên sản phẩm</th>
                                                    <th>Số lượng</th>
                                                    <th>Giá tiền</th>
                                                </thead>
                                                <tbody>
                                                @foreach($billInfo as $key => $bill)
                                                    <tr>
                                                        <td>{{ $key+1 }}</td>
                                                        <td>{{ $bill->product_name }}</td>
                                                        <td>{{$bill->quantity}}</td>
                                                        <td>{{ number_format($bill->unit_price) }} VNĐ</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="3"><b>Tổng tiền</b></td>
                                                    <td colspan="1"><b class="text-red">{{ number_format($customerInfo->total) }} VNĐ</b></td>
                                                </tr>
                                                @if($customerInfo->code)
                                                <tr>
                                                    <td colspan="3"><b>Mã giảm giá</b></td>
                                                    <td colspan="1"><b class="text-red">{{$customerInfo->code}}</b></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"><b>Tổng tiền sau kiểm tra mã giảm giá</b></td>
                                                    <td colspan="1"><b class="text-red">{{ number_format($customerInfo->total_coupon) }} VNĐ</b></td>
                                                </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <form action="admin/bill/edit/{{$customerInfo->id}}" method="POST">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                        <div class="col-md-12">
                                        
                                            <div class="form-inline" >
                                            @if($customerInfo->status!=3)
                                                <label>Trạng thái giao hàng: </label>
                                                <select name="status" class="form-control input-inline" style="width: 200px">
                                                    <option value="1">Chưa giao</option>
                                                    <option value="2">Đang giao</option>
                                                    <option value="3">Đã giao</option>
                                                </select>
                                                <input type="submit" value="Xử lý" class="btn btn-primary">
                                                @endif
                                                <a href="admin/bill/list-bill" class="btn btn-danger">Trở về</a>
                                            </div>
                                        
                                        </div>
                                    </form>
                            </div>
                        </section>
                        
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

@endsection


@extends('back-end.layout.index')
@section('content')
 <!-- Begin Page Content -->
 <div class="container-fluid">
<!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách sự kiện giảm giá</h6>
            <div class="card-header py-3">
                <div class="dropdown-divider"></div>
                    <a class="btn btn-success" href="admin/sale/add">
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
                        <th>Mô tả</th>
                        <th>Hình ảnh</th>
                        <th>Giá gốc</th>
                        <th>Giá giảm</th>
                        <th>Thời gian bắt đầu</th>
                        <th>Thời gian kết thúc</th>
                        <th>Thời hạn</th>
                        <th>Mức thời gian</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Trạng thái</th>
                        <th>Mô tả</th>
                        <th>Hình ảnh</th>
                        <th>Giá gốc</th>
                        <th>Giá giảm</th>
                        <th>Thời gian bắt đầu</th>
                        <th>Thời gian kết thúc</th>
                        <th>Thời hạn</th>
                        <th>Mức thời gian</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($sale as $sal)
                    <tr>
                        <td style="text-align:center;">
                        @if($sal->status == 0)
                            <span style="color:#32cd32">Kích hoạt</span>
                        @else
                            <span style="color:red">Huỷ kích hoạt</span>
                        @endif
                        </td>
                        <td>{!!$sal->description!!}</td>
                        <td><img style="width:200px; height:200px;" src="{{$sal->product->image}}"/></td>
                        <td>{{number_format($sal->product->unit_price)}} VNĐ</td>
                        <td>{{number_format($sal->product->promotion_price)}} VNĐ</td>
                        <td>{{date('d-m-Y', strtotime($sal->date_start))}}</td>
                        <td>{{date('d-m-Y', strtotime($sal->date_end))}}</td>
                        
                        @if($sal->date_start > $today)
                            <td style="color:blue">Chưa bắt đầu</td>
                        @elseif($sal->date_end >= $today && $today >= $sal->date_start)
                            <td style="color:#32cd32">Còn hạn</td>
                        @else
                            <td style="color:red">Hết hạn</td>
                        @endif
                        @php
                            $diff = abs(strtotime($sal->date_end) - strtotime($sal->date_start));
                            $years = floor($diff / (365*60*60*24));
                            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24) / (60*60*24));
                            $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));
                            $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60) / 60);
                            $seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60));
                            $date_time = $years." năm, ".$months." tháng, ".$days." ngày, ".$hours." giờ, ".$minutes." phút, ".$seconds." giây";
                        @endphp
                        <td>{{$date_time}}</td>
                        <td><a href="admin/sale/edit/{{$sal->id}}"><i class="fa fa-edit"></i></a></td>
                        <td><a href="admin/sale/delete/{{$sal->id}}" ><i class="fa fa-trash"></i></a></td>
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
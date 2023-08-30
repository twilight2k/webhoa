@extends('back-end.layout.index')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Điều khiển</h1>
    <a  class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Tải báo cáo</a>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                           Tổng sản phẩm</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($re_product)}} sản phẩm</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Tổng doanh thu</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format($total)}} VNĐ</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tổng thành viên
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($re_user)}} thành viên</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Phản hồi</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($re_contact)}} phản hồi</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tổng quan về thu nhập</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Tiêu đề:</div>
                        <a class="dropdown-item" href="#">Hoạt động</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Khác</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                    @php
                        $total1 = $total_rev1;
                        $total2 = $total_rev2;
                        $total3 = $total_rev3;
                        $total4 = $total_rev4;
                        $total5 = $total_rev5;
                        $total6 = $total_rev6;
                        $total7 = $total_rev7;
                        $total8 = $total_rev8;
                        $total9 = $total_rev9;
                        $total10 = $total_rev10;
                        $total11 = $total_rev11;
                        $total12 = $total_rev12;

                    @endphp
                    <input type="hidden" id="t1" value="{{$total1}}">
                    <input type="hidden" id="t2" value="{{$total2}}">
                    <input type="hidden" id="t3" value="{{$total3}}">
                    <input type="hidden" id="t4" value="{{$total4}}">
                    <input type="hidden" id="t5" value="{{$total5}}">
                    <input type="hidden" id="t6" value="{{$total6}}">
                    <input type="hidden" id="t7" value="{{$total7}}">
                    <input type="hidden" id="t8" value="{{$total8}}">
                    <input type="hidden" id="t9" value="{{$total9}}">
                    <input type="hidden" id="t10" value="{{$total10}}">
                    <input type="hidden" id="t11" value="{{$total11}}">
                    <input type="hidden" id="t12" value="{{$total12}}">
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Nguồn doanh thu</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Tiêu đề:</div>
                        <a class="dropdown-item" href="#">Hoạt động</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Khác</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-3 pb-2">
                    <canvas id="myPieChart"></canvas>
                </div>
                <div class="mt-3 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Flower Shop
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Ly Shop
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-info"></i> Dolphin Shop
                    </span>
                    {{-- <span class="mr-2">
                        <i class="fas fa-circle text-danger"></i> Col Shop
                    </span> --}}
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->
@endsection
@section('js')
<!-- Page level plugins -->
<script src="admin_asset/assets/dest/vendor/chart.js/Chart.min.js"></script>
<!-- Page level custom scripts -->
<script src="admin_asset/assets/dest/js/demo/chart-area-demo.js"></script>
<script src="admin_asset/assets/dest/js/demo/chart-pie-demo.js"></script>
@endsection

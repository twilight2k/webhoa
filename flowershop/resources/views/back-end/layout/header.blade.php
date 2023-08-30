<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary-1 sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
    <div class="sidebar-brand-icon rotate-n-15">
        <!-- <i class="fas fa-laugh-wink"></i> -->
        <img src="client_asset/assets/dest/loader/loader.png" style="width:60px;height:50px">
    </div>
    <div class="sidebar-brand-text mx-3">Manage <sup>Wendy Flowers</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="admin/home/">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Bảng điều khiển</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Giao diện
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Các thành phần</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Các thành phần tùy chỉnh:</h6>
            <a class="collapse-item" >Nút</a>
            <a class="collapse-item" >Thẻ</a>
        </div>
    </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Tiện ích</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Các tiện ích tùy chỉnh:</h6>
            <a class="collapse-item" >Màu sắc</a>
            <a class="collapse-item" >Đường kẻ</a>
            <a class="collapse-item" >Hình ảnh</a>
            <a class="collapse-item" >Khác</a>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Chức năng
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Trang</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Màn hình:</h6>
            <a class="collapse-item">Đăng nhập</a>
            <a class="collapse-item" >Đăng ký</a>
            <a class="collapse-item" >Quên mật khẩu</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Trang khác:</h6>
            <a class="collapse-item" >Trang 404</a>
            <a class="collapse-item" >Trang trống</a>
        </div>
    </div>
</li>

<!-- Nav Item - Charts -->
<li class="nav-item">
    <a class="nav-link" href="admin/home/">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Biểu đồ</span></a>
</li>

<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTables"
        aria-expanded="true" aria-controls="collapseTables">
        <i class="fas fa-fw fa-folder"></i>
        <span>Bảng</span>
    </a>
    <div id="collapseTables" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Danh sách:</h6>
            @if(Auth::user()->id_levels == 1)
            <a class="collapse-item" href="admin/bill/list-bill">Hóa đơn</a>
            <a class="collapse-item" href="admin/event/list-event">Sự kiện</a>
            <a class="collapse-item" href="admin/sale/sale-of">Sự kiện giảm giá</a>
            <a class="collapse-item" href="admin/category/list-category">Danh mục</a>
            <a class="collapse-item" href="admin/shop/list-shop">Cửa hàng</a>
            <a class="collapse-item" href="admin/product/list-product">Sản phẩm</a>
            <a class="collapse-item" href="admin/coupon/list-coupon">Mã giảm giá</a>
            <a class="collapse-item" href="admin/user/list-user">Người dùng</a>
            <a class="collapse-item" href="admin/contact/list-contact">Phản hồi</a>
            @else
            <a class="collapse-item" href="admin/product/list-product">Sản phẩm</a>
          @endif
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>
</ul>
<!-- End of Sidebar -->
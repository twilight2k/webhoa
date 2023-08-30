@extends('back-end.layout.index')
@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <small>Sửa thông tin thể loại: {{$product_type->name}}</small>
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
                        <form action="admin/category/edit/{{$product_type->id}}" method="POST">
                            <div class="modal-body">
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                <div class="form-group">
                                    <label>Trạng thái: </label>
                                    <label class="radio-inline">
                                        <input name="status" value="1"
                                        @if($product_type->status == 1)
                                        {{"checked"}}
                                        @endif
                                        type="radio"> <span style="color:red">Hủy kết nối</span>
                                    </label>
                                    <label class="radio-inline">
                                        <input name="status" value="0" 
                                        @if($product_type->status == 0)
                                        {{"checked"}}
                                        @endif type="radio"> <span style="color:#32cd32">Kết nối</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Tên thể loại</label>
                                    <input class="form-control" name="name" placeholder="Hãy nhập tên thể loại" value="{{$product_type->name}}"/>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <input class="form-control" name="description" value="{{$product_type->description}}" placeholder="Hãy nhập mô tả cho thể loại" />
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Sửa</button>
                            <a href="admin/category/list-category" class="btn btn-danger">Trở về</a>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

@endsection


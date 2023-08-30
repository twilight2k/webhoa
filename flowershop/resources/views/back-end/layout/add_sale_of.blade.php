@extends('back-end.layout.index')
@section('content')
<div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Thêm sự kiện giảm giá</h6>
    </div>
    <div class="row">
                    <div class="col-lg-12">
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
                    </div>
                    <div class="col-lg-7" style="padding:20px">
                        <form action="admin/sale/add" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                <div class="form-group">
                                    <label>Sản phẩm cho sự kiện</label>
                                    <select class="form-control" name="id_product">
                                    <option value="">--Chọn sản phẩm--</option>
                                    @foreach($product as $sp)
                                        <option value="{{$sp->id}}">{{$sp->name}}</option>
                                    @endforeach
                                </select>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea id="my-editor" name="description" class="form-control" required>{!! old('description', 'Hãy nhập nội dung') !!}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Thời gian bắt đầu</label>
                                    <input type="date" class="form-control" name="date_start" required/>
                                </div>
                                <div class="form-group">
                                    <label>Thời gian kết thúc</label>
                                    <input type="date" class="form-control" name="date_end" required/>
                                </div>
                                <div class="modal-footer">
                                    <a class="btn btn-secondary" href="admin/sale/sale-of">Trở về</a>
                                    <button class="btn btn-success" type="submit">Thêm</button>
                                </div>
                        <form>
                    </div>
            </div>
</div>
@endsection
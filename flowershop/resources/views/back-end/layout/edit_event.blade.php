@extends('back-end.layout.index')
@section('content')
<div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Sửa sự kiện: {{$event->name}}</h6>
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
                <form action="admin/event/edit/{{$event->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <div class="form-group">
                                <label>Trạng thái: </label>
                                <label class="radio-inline">
                                    <input name="status" value="1"
                                    @if($event->status == 1)
                                    {{"checked"}}
                                    @endif
                                      type="radio"> <span style="color:red">Hủy kết nối</span>
                                </label>
                                <label class="radio-inline">
                                    <input name="status" value="0" 
                                    @if($event->status == 0)
                                    {{"checked"}}
                                    @endif type="radio"> <span style="color:#32cd32">Kết nối</span>
                                </label>
                            </div>
                            <div class="form-group">
                                    <label>Tên sự kiện</label>
                                    <input class="form-control" name="name" value="{{$event->name}}" placeholder="Hãy nhập tên sự kiện" />
                                </div>
                                <div class="form-group">
                                    <label>Đường dẫn truy cập</label>
                                    <input class="form-control" name="link" value="{{$event->link}}" placeholder="Hãy nhập đường dẫn truy cập" />
                                </div>
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <input class="form-control" name="NoiDung" value="{{$event->NoiDung}}" placeholder="Hãy nhập mô tả cho sự kiện" />
                                </div>
                                <div class="form-group">
                                    <label>Tính năng giảm giá</label>
                                    <select class="form-control" name="condition">
                                        @if($event->condition == 1)
                                            <option value="1">Giảm theo %</option>
                                            <option value="2">Giảm theo tiền</option>
                                        @else($event->condition ==2)
                                            <option value="2">Giảm theo tiền</option>
                                            <option value="1">Giảm theo %</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nhập số % hoặc số tiền</label>
                                    <input class="form-control" name="number" value="{{$event->number}}" placeholder="Hãy nhập mức % hoặc số tiền" />
                                </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="contact-form">
                        <div class="leave-comment">
                        </br>
                            <h4 style="text-align:center;">Ảnh đại diện</h4>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a class="btn btn-warning" id="lfm" data-input="thumbnail" data-preview="preview_thumbnail" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Chọn ảnh
                                    </a>
                                </span>
                                <input id="thumbnail" class="form-control" type="text" name="image">
                                <div class="col-lg-12">
                                <div id="preview_thumbnail" class="preview-img" style="padding-top:30px;text-align:center">
                                    <img src="{{$event->image}}" style="height:9rem;">
                                <div>
                                </div>
                                
                            </div>
                        </div>
                        </br>
                    </div>
                </div>
            
                <div class="modal-footer">
                    <a class="btn btn-secondary" href="admin/event/list-event">Trở về</a>
                    <button class="btn btn-success" type="submit">Sửa</button>
                </div>
            <form>
            </div>
</div>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
    <script src="vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image');
    </script>
@endsection
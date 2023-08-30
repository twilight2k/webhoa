@extends('back-end.layout.index')
@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <small>Xử lý phản hồi của: {{$contact->name}}</small>
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
                        <form action="admin/contact/edit/{{$contact->id}}" method="POST">
                            <div class="modal-body">
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                <div class="form-group">
                                    <label>Trạng thái: </label>
                                    <label class="radio-inline">
                                        <input name="status" value="1"
                                        @if($contact->status == 1)
                                        {{"checked"}}
                                        @endif
                                        type="radio"> <span style="color:#32cd32">Đã xử lý</span>
                                    </label>
                                    <label class="radio-inline">
                                        <input name="status" value="0" 
                                        @if($contact->status == 0)
                                        {{"checked"}}
                                        @endif type="radio"> <span style="color:red">Chưa xử lý</span>
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Sửa</button>
                            <a href="admin/contact/list-contact" class="btn btn-danger">Trở về</a>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

@endsection


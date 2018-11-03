@extends('layout.default')

@section('contents')
    <!--引入CSS-->
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">

    <!--引入JS-->
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    @include('layout._errors')
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            <h1>商家注册</h1>
        </div>
    </div>
    <div class="row">
        <form class="form-horizontal" action="{{route('user.register')}}" method="post" enctype="multipart/form-data">
        <div class="col-md-10 .col-md-offset-2">
            <div  >
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" id="inputEmail3" placeholder="用户名" value="{{old('name')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">邮箱</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="邮箱" value="{{old('email')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
                    <div class="col-sm-10">
                        <input type="password"  name="password" class="form-control" id="inputPassword3" placeholder="密码" value="{{old('password')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">确认密码</label>
                    <div class="col-sm-10">
                        <input type="password" name="password_confirmation" class="form-control" id="inputPassword3" placeholder="密码" value="{{old('password_confirmation')}}">
                    </div>
                </div>
            </div>
        <div class="col-md-11 col-md-offset-1">
            <div class="form-group">
                <label for="exampleInputEmail1">店铺分类</label>
                <select class="form-control" name="shop_category_id">
                    @foreach($shopcategories as $shopcategory)
                        <option value="{{$shopcategory->id}}" selected>{{$shopcategory->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">名称</label>
                <input name="shop_name" type="text" class="form-control" id="exampleInputEmail1" placeholder="名称" value="{{old('shop_name')}}">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">评分</label>
                <input name="shop_rating" type="text" class="form-control" id="exampleInputEmail1" placeholder="评分">
            </div>
            <div>
            <span>
                <label for="exampleInputEmail1">是否是品牌:</label>
            <input type="radio" name="brand" value="1">是
            <input type="radio" name="brand" value="0">不是
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </span>

                <span>
                <label for="exampleInputEmail1">是否准时送达:</label>
            <input type="radio" name="on_time" value="1">是
            <input type="radio" name="on_time" value="0">不是
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </span>

                <span>
                <label for="exampleInputEmail1">是否蜂鸟配送:</label>
            <input type="radio" name="fengniao" value="1">是
            <input type="radio" name="fengniao" value="0">不是
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </span>

                <span>
                <label for="exampleInputEmail1">是否保标记:</label>
            <input type="radio" name="bao" value="1">是
            <input type="radio" name="bao" value="0">不是
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </span>

                <span>
                <label for="exampleInputEmail1">是否票标记:</label>
            <input type="radio" name="piao" value="1">是
            <input type="radio" name="piao" value="0">不是
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </span>

                <span>
                <label for="exampleInputEmail1">是否准标记:</label>
            <input type="radio" name="zhun" value="1">是
            <input type="radio" name="zhun" value="0">不是
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </span>
            </div>
            <div class="form-group">

            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">起送金额</label>
                <input name="start_send" type="text" class="form-control" id="exampleInputEmail1" placeholder="起送金额" value="{{old('start_send')}}">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">配送费</label>
                <input name="send_cost" type="text" class="form-control" id="exampleInputEmail1" placeholder="配送费" value="{{old('send_cost')}}">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">店公告</label>
                <textarea class="form-control" rows="3" name="notice" placeholder="店公告">{{old('notice')}}</textarea>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">优惠信息</label>
                <textarea class="form-control" rows="3" name="discount" placeholder="优惠信息">{{old('discount')}}</textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">店铺图片</label>
                {{--<input type="file" name="shop_img">--}}
                <input type="hidden"  name="shop_img" id="img">
                <div id="uploader-demo">
                    <!--用来存放item-->
                    <div id="fileList" class="uploader-list"></div>
                    <div id="filePicker">选择图片</div>
                </div>
                <img id="pic" src="{{old('shop_img')}}"/>
            </div>
        </div>

                {{csrf_field()}}
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">注册</button>
                    </div>
                </div>
            </form>
    </div>

@stop
@section('javascript')
    <script>
        var uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,

            // swf文件路径
            // swf: BASE_URL + '/js/Uploader.swf',

            // 文件接收服务端。
            server: '{{ route('upload') }}',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            },
            formData:{
                _token:'{{csrf_token()}}'
            }
        });
        uploader.on( 'uploadSuccess', function(file,response) {
            $("#pic").attr('src',response.path)
            $("#img").val(response.path)
        });
    </script>

@stop
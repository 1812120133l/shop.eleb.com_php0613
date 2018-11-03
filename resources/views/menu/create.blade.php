@extends('layout.default')

@section('contents')
    <!--引入CSS-->
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">

    <!--引入JS-->
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    @include('layout._errors')
    @include('layout._notice')
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            <h1>添加菜品</h1>
        </div>
    </div>
    <form action="{{route('menu.store')}}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInput">菜品名称</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="菜品名称" name="goods_name" value="{{old('goods_name')}}">
        </div>

        <div class="form-group">
            <label for="exampleInput">评分</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="评分" name="rating" value="{{old('rating')}}">
        </div>

        <div class="form-group">
            <label for="exampleInput">分类</label>
            <select class="form-control" name="category_id">
                @foreach ($menucategories as $menucategory)
                <option value="{{$menucategory->id}}">{{$menucategory->name}}</option>
                    @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="exampleInput">价格</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="价格" name="goods_price" value="{{old('goods_price')}}">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">描述</label>
            <textarea class="form-control" rows="3" placeholder="描述" name="description" value="{{old('description')}}"></textarea>
        </div>

        <div class="form-group">
            <label for="exampleInput">月销量</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="月销量" name="month_sales" value="{{old('month_sales')}}">
        </div>

        <div class="form-group">
            <label for="exampleInput">评分数量</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="评分数量" name="rating_count" value="{{old('rating_count')}}">
        </div>

        <div class="form-group">
            <label for="exampleInput">提示信息</label>
            <textarea class="form-control" rows="3" placeholder="提示信息" name="tips" value="{{old('description')}}"></textarea>
        </div>

        <div class="form-group">
            <label for="exampleInput">满意度数量</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="满意度数量" name="satisfy_count" value="{{old('satisfy_count')}}">
        </div>

        <div class="form-group">
            <label for="exampleInput">满意度评分</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="满意度评分" name="satisfy_rate" value="{{old('rating')}}">
        </div>

        <div class="form-group">
            <label for="exampleInput">商品图片</label>
            <input type="hidden"  name="goods_img" id="img">
            <div id="uploader-demo">
                <!--用来存放item-->
                <div id="fileList" class="uploader-list"></div>
                <div id="filePicker">选择图片</div>
            </div>
            <img id="pic" src="{{old('goods_img')}}"/>
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="status" value="1"> 是否上架
            </label>
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-default">添加菜品</button>
    </form>
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
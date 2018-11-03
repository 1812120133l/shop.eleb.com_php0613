@extends('layout.default')

@section('contents')
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">

    <!--引入JS-->
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    @include('layout._errors')
    @include('layout._notice')
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            <h1>修改菜品</h1>
        </div>
    </div>
    <form action="{{route('menu.update',[$menu])}}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInput">菜品名称</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="菜品名称" name="goods_name" value="{{$menu->goods_name}}">
        </div>

        <div class="form-group">
            <label for="exampleInput">评分</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="评分" name="rating" value="{{$menu->rating}}">
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
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="价格" name="goods_price" value="{{$menu->goods_price}}">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">描述</label>
            <textarea class="form-control" rows="3" placeholder="描述" name="description" >{{$menu->description}}</textarea>
        </div>

        <div class="form-group">
            <label for="exampleInput">月销量</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="月销量" name="month_sales" value="{{$menu->month_sales}}">
        </div>

        <div class="form-group">
            <label for="exampleInput">评分数量</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="评分数量" name="rating_count" value="{{$menu->rating_count}}">
        </div>

        <div class="form-group">
            <label for="exampleInput">提示信息</label>
            <textarea class="form-control" rows="3" placeholder="提示信息" name="tips" >{{$menu->tips}}</textarea>
        </div>

        <div class="form-group">
            <label for="exampleInput">满意度数量</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="满意度数量" name="satisfy_count" value="{{$menu->satisfy_count}}">
        </div>

        <div class="form-group">
            <label for="exampleInput">满意度评分</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="满意度评分" name="satisfy_rate" value="{{$menu->satisfy_rate}}">
        </div>

        <div class="form-group">
            <label for="exampleInput">商品图片</label>
            <input type="hidden" value="{{$menu->goods_img}}" name="goods_img2">
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
                <input type="checkbox" name="status" value="1" @if($menu->status) checked @endif> 是否上架
            </label>
        </div>
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <button type="submit" class="btn btn-default">修改菜品</button>
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
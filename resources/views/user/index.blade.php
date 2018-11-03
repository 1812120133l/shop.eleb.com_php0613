@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <form action="#" method="post" enctype="multipart/form-data">
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
            <input name="shop_name" type="text" class="form-control" id="exampleInputEmail1" placeholder="名称">
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
            <input name="start_send" type="text" class="form-control" id="exampleInputEmail1" placeholder="起送金额">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">配送费</label>
            <input name="send_cost" type="text" class="form-control" id="exampleInputEmail1" placeholder="配送费">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">店公告</label>
            <textarea class="form-control" rows="3" name="notice" placeholder="店公告"></textarea>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">优惠信息</label>
            <textarea class="form-control" rows="3" name="discount" placeholder="优惠信息"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">店铺图片</label>
            <input type="file" name="shop_img">
        </div>
        {{csrf_field()}}
        <button type="submit" class="btn btn-default">提交</button>
    </form>

@stop
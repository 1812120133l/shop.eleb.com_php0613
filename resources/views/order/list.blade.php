@extends('layout.default')

@section('contents')
    @include('layout._errors')
    @include('layout._notice')
    <h1>订单详情</h1>
    <table class="table table-hover">
        <tr>
            <th>商品ID</th>
            <th>商品名称</th>
            <th>商品图片</th>
            <th>商品价格</th>
            <th>购买数量</th>
            <th>购买时间</th>
            <th>操作</th>
        </tr>
        @foreach($rows as $row)
        <tr>
            <td>{{$row->goods_id}}</td>
            <td>{{$row->goods_name}}</td>
            <td><img src="{{$row->goods_img}}" width="100px"></td>
            <td>{{$row->goods_price}}</td>
            <td>{{$row->amount}}</td>
            <td>{{$row->created_at}}</td>
            <td></td>
        </tr>
            @endforeach
    </table>
@stop
@extends('layout.default')

@section('contents')
    @include('layout._errors')
    @include('layout._notice')

    <table class="table table-hover">
        <tr>
            <th>名称</th>
            <th>商品图片</th>
            <th>所属分类</th>
            <th>价格</th>
            <th>描述</th>
            <th>月销量</th>
            <th>评分数量</th>
            <th>提示信息</th>
            <th>满意度数量</th>
            <th>满意度评分</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($menus as $menu)
            <tr>
                <td>{{$menu->goods_name}}</td>
                <td><img src="{{$menu->goods_img}}" width="50px"></td>
                <td>{{$menu->menucategory->name}}</td>
                <td>{{$menu->goods_price}}</td>
                <td>{{$menu->description}}</td>
                <td>{{$menu->month_sales}}</td>
                <td>{{$menu->rating_count}}</td>
                <td>{{$menu->tips}}</td>
                <td>{{$menu->satisfy_count}}</td>
                <td>{{$menu->satisfy_rate}}</td>
                <td>@if($menu->status==1) 上架中 @elseif($menu->status==0) 未上架 @else 禁用 @endif</td>
                <td><a class="btn btn-default" href="{{route('menu.edit',[$menu])}}" role="button">修改</a> <form method="post" action="{{route('menu.destroy',[$menu])}}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger">删除</button>
                    </form> </td>

            </tr>
        @endforeach
    </table>

    @stop
@extends('layout.default')

@section('contents')
    @include('layout._errors')
    @include('layout._notice')
    <h1>订单列表</h1>
    <table class="table table-hover">
        <tr>
            <th>订单ID</th>
            <th>订单编号</th>
            <th>收货地址</th>
            <th>收货人姓名</th>
            <th>收货人电话</th>
            <th>价格</th>
            <th>状态</th>
            <th>下单时间</th>
            <th>操作</th>
        </tr>
        @foreach($orders as $order)
        <tr>
            <td>{{$order->id}}</td>
            <td>{{$order->sn}}</td>
            <td>{{$order->address}}</td>
            <td>{{$order->name}}</td>
            <td>{{$order->tel}}</td>
            <td>{{$order->total}}</td>
            <td>@if($order->status==0) 待支付 @elseif($order->status==-1) 订单已取消 @elseif($order->status==1) 已发货 @endif </td>
            <td>{{$order->created_at}}</td>
            <td>
                @if($order->status==0)
                <a class="btn btn-default" href="{{route('order.list',['id'=>$order->id])}}">详情</a>

                <a class="btn btn-default" href="{{route('order.cancel',['id'=>$order->id,'status'=>-1])}}">取消订单</a>@elseif($order->status==1)
                <a class="btn btn-default" href="{{route('order.cancel',['id'=>$order->id,'status'=>1])}}">发货</a>
                    @endif
            </td>
            {{--<td><a class="btn btn-default" href="{{route('menu.edit',[$menu])}}" role="button">修改</a> <form method="post" action="{{route('menu.destroy',[$menu])}}">--}}
            {{--{{ csrf_field() }}--}}
            {{--{{ method_field('DELETE') }}--}}
            {{--<button class="btn btn-danger">删除</button>--}}
            {{--</form> </td>--}}
        </tr>
        @endforeach
    </table>

@stop
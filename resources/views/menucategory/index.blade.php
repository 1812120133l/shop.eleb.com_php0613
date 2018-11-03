@extends('layout.default')

@section('contents')
    @include('layout._errors')
    @include('layout._notice')
    <table class="table">
        <tr>
            <th>id</th>
            <th>分类名称</th>
            <th>菜品编号</th>
            <th>所属商家</th>
            <th>描述</th>
            <th>是否默认</th>
            <th>操作</th>
        </tr>
        @foreach($menucategoies as $menucategory)
        <tr>
            <td>{{$menucategory->id}}</td>
            <td>{{$menucategory->name}}</td>
            <td>{{$menucategory->type_accumulation}}</td>
            <td>{{$menucategory->user->name}}</td>
            <td>{{$menucategory->description}}</td>
            <td>@if($menucategory->is_selected==1) 是 @else 否 @endif</td>
            <td><a class="btn btn-default" href="{{route('menucategory.edit',[$menucategory])}}" role="button">修改</a> <form method="post" action="{{route('menucategory.destroy',[$menucategory])}}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button class="btn btn-danger">删除</button>
                </form> </td>
        </tr>
            @endforeach
    </table>


@stop
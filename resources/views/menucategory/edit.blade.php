@extends('layout.default')

@section('contents')
    @include('layout._errors')
    @include('layout._notice')
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            <h1>修改菜品</h1>
        </div>
    </div>
    <form action="{{route('menucategory.update',[$menucategory])}}" method="post">
        <div class="form-group">
            <label for="exampleInput">菜品名称</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="菜品名称" name="name" value="{{$menucategory->name}}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">描述</label>
            <textarea class="form-control" rows="3" placeholder="描述" name="description" >{{$menucategory->description}}</textarea>
        </div>
        <div class="checkbox">
            <label>
                @if($menucategory->is_selected)
                <input type="checkbox" name="is_selected" value="0"> 取消默认
                    @else
                    <input type="checkbox" name="is_selected" value="1"> 设置为默认
                @endif
            </label>
        </div>
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <button type="submit" class="btn btn-default">修改菜品</button>
    </form>
@stop
@extends('layout.default')

@section('contents')
    @include('layout._errors')
    @include('layout._notice')
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            <h1>添加菜品</h1>
        </div>
    </div>
    <form action="{{route('menucategory.store')}}" method="post">
        <div class="form-group">
            <label for="exampleInput">菜品名称</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="菜品名称" name="name" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">描述</label>
            <textarea class="form-control" rows="3" placeholder="描述" name="description" value="{{old('description')}}"></textarea>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="is_selected" value="1"> 设置为默认
            </label>
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-default">添加菜品</button>
    </form>
    @stop
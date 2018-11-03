@extends('layout.default')

@section('contents')
    @include('layout._errors')
    @include('layout._notice')
    <div class="row">
        <div class="col-xs-3">
            <ul class="nav nav-pills nav-stacked">
                <li role="presentation" class="active"><a href="{{route('shop.index')}}">所有</a></li>
                @foreach ($menucaregories as $menucaregory)
                <li role="presentation"><a href="{{route('shop.index',['caregory' => $menucaregory->id])}}">{{$menucaregory->name}}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="col-xs-9">
            <div class="col-xs-12">
                <form class="navbar-form navbar-left" role="search" action="{{route('shop.index')}}" method="post">
                    <div class="form-group">
                        <input type="hidden" name="caregory" value="{{ $caregory ?? 1 }}">
                        <input type="text" class="form-control" name="name" placeholder="菜名">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="text" class="form-control" id="exampleInputEmail3" placeholder="￥" style="width: 80px" name="money"> —
                        <input type="text" class="form-control" id="exampleInputEmail3" placeholder="￥" style="width: 80px" name="money2">
                    </div>
                    {{ csrf_field() }}
                    {{ method_field('GET') }}
                    <button type="submit" class="btn btn-default">搜索</button>
                </form>
               <br>
            </div>

            <div class="col-xs-12">
                <h3>菜单：</h3>
                <hr>
            </div>
            @foreach($menus as $menu)
                <div class="col-xs-12" style="margin-bottom:30px">
                    <div class="col-xs-3">
                        <img src="{{ $menu->goods_img }}" alt="图片加载失败" class="img-thumbnail" width="130px">
                    </div>
                    <div class="col-xs-9">
                        <div class="col-xs-4">
                            <p>
                                <strong>所属分类:</strong>
                                {{$menu->menucategory->name}}
                            </p>
                            <p>
                                <strong>菜名:</strong>
                                {{$menu->goods_name}}
                            </p>
                            <p>
                                <strong>评分:</strong>
                                {{$menu->rating}}
                            </p>
                        </div>
                        <div class="col-xs-8">
                            <p>
                                <strong>价格:</strong>
                                {{$menu->goods_price}}
                            </p>
                            <p>
                                <strong>月销量:</strong>
                                {{$menu->month_sales}}
                            </p>
                            <p>
                                <strong>描述:</strong>
                                {{$menu->description}}
                            </p>

                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>

@stop
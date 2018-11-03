@extends('layout.default')

@section('contents')
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            <h1>修改密码</h1>
            @include('layout._errors')
            @include('layout._notice')
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 .col-md-offset-2">
            <form class="form-horizontal" action="{{route('user.update')}}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" id="inputEmail3"  value="{{$user->name}}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">原密码</label>
                    <div class="col-sm-10">
                        <input type="password"  name="former" class="form-control" id="inputPassword3" placeholder="原密码">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">新密码</label>
                    <div class="col-sm-10">
                        <input type="password"  name="password" class="form-control" id="inputPassword3" placeholder="新密码">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">确认新密码</label>
                    <div class="col-sm-10">
                        <input type="password" name="password_confirmation" class="form-control" id="inputPassword3" placeholder="确认新密码">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">验证码</label>
                    <div class="col-md-3">
                        <input id="captcha" class="form-control" name="captcha" >
                    </div>
                    <div class="col-md-2">
                        <img class="thumbnail captcha" src="{{ captcha_src('inverse') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
                    </div>
                </div>
                {{csrf_field()}}
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">修改</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@stop
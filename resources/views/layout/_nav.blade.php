<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Brand</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <li class="active"><a href="{{route('shop.index')}}">主页 <span class="sr-only">(current)</span></a></li>

                @auth
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">菜品管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('menucategory.index')}}">菜品分类列表</a></li>
                        <li><a href="{{route('menucategory.create')}}">添加菜品分类</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('menu.index')}}">菜品列表</a></li>
                        <li><a href="{{route('menu.create')}}">添加菜品</a></li>
                        <li><a href="{{route('order.greens')}}">菜品销量统计</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">订单 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('order.index')}}">订单列表</a></li>
                        <li><a href="{{route('order.stat')}}">订单统计</a></li>
                       //
                    </ul>
                </li>
                @endauth
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @guest
                {{--<li><img src=""></li>--}}
                <li><a href="{{route('login')}}">登录</a></li>
                <li><a href="{{route('user')}}">注册</a></li>
                @endguest
                @auth
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-user"></span> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="">用户中心</a></li>
                        <li><a href="{{route('user.edit')}}">修改密码</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('user.destroy')}}">退出</a></li>
                    </ul>
                </li>
                @endauth
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
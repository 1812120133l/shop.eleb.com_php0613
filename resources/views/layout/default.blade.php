@include('layout._head')

<div class="container">
    @include('layout._nav')
    @yield('contents')
</div>
@yield('javascript')

@include('layout._foot')
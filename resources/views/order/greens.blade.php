@extends('layout.default')

@section('contents')

        <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ECharts</title>
    <!-- 引入 echarts.js -->
    <script src="/js/echarts.min.js"></script>
</head>
<body>
<h1>最近一周的菜品销量</h1>
<table class="table table-hover">
    <tr>
        <th>菜品名称</th>
        @foreach($weeks as $k=>$v)
            <th>{{$v}}</th>
        @endforeach
    </tr>
    @foreach($series as $serie)
    <tr>

            <td>{{$serie['name']}}</td>
            @foreach($serie['data'] as $k=>$v)
                    <td>{{$v}}</td>
                @endforeach

    </tr>
    @endforeach
</table>
<!-- 为ECharts准备一个具备大小（宽高）的Dom -->
<div id="main" style="width: 800px;height:400px;"></div>
<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('main'));

    // 指定图表的配置项和数据
    var option = {
        title: {
            text: '最近一周的菜品销量'
        },
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data:@php $a=[]; foreach($series as $serie){ $a[]=$serie['name']; } echo json_encode(array_values($a)) @endphp
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        toolbox: {
            feature: {
                saveAsImage: {}
            }
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: @php $a=[]; foreach($weeks as $k=>$v){ $a[]=$v; } echo json_encode(array_values($a)) @endphp
        },
        yAxis: {
            type: 'value'
        },
        series: @php echo json_encode($series) @endphp
    };


    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
</script>
<br/>
<br/>
<br/>

<h1>最近三个月的菜品销量</h1>
<table class="table table-hover">
    <tr>
        <th>菜品名称</th>
        @foreach($months as $k=>$v)
            <th>{{$v}}</th>
        @endforeach
    </tr>
    @foreach($months_series as $serie)
        <tr>

            <td>{{$serie['name']}}</td>
            @foreach($serie['data'] as $k=>$v)
                <td>{{$v}}</td>
            @endforeach

        </tr>
    @endforeach
</table>
<!-- 为ECharts准备一个具备大小（宽高）的Dom -->
<div id="main2" style="width: 800px;height:400px;"></div>
<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('main2'));

    // 指定图表的配置项和数据
    var option = {
        title: {
            text: '最近三个月的菜品销量'
        },
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data:@php $a=[]; foreach($months_series as $serie){ $a[]=$serie['name']; } echo json_encode(array_values($a)) @endphp
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        toolbox: {
            feature: {
                saveAsImage: {}
            }
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: @php $a=[]; foreach($months as $k=>$v){ $a[]=$v; } echo json_encode(array_values($a)) @endphp
        },
        yAxis: {
            type: 'value'
        },
        series: @php echo json_encode($months_series) @endphp
    };


    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
</script>

</body>
</html>
@stop
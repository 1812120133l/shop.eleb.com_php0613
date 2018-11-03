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
<h1>最近一周订单量</h1>
<table class="table table-hover">
    <tr>
        @foreach($results as $date=>$count)
        <th>{{$date}}</th>
        @endforeach
    </tr>
    <tr>
        @foreach($results as $date=>$count)
            <th>{{$count}}</th>
        @endforeach
    </tr>
</table>
<!-- 为ECharts准备一个具备大小（宽高）的Dom -->
<div id="main" style="width: 600px;height:400px;"></div>
<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('main'));

    // 指定图表的配置项和数据
    var option = {
        xAxis: {
            type: 'category',
            data: @php echo json_encode(array_keys($results)) @endphp
        },
        yAxis: {
            type: 'value'
        },
        series: [{
            type: 'line',
            data: @php echo json_encode(array_values($results)) @endphp
        }]
    };

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
</script>


<h1>最近三个月订单量</h1>
<table class="table table-hover">
    <tr>
        @foreach($months as $date=>$count)
            <th>{{$date}}</th>
        @endforeach
    </tr>
    <tr>
        @foreach($months as $date=>$count)
            <th>{{$count}}</th>
        @endforeach
    </tr>
</table>
<!-- 为ECharts准备一个具备大小（宽高）的Dom -->
<div id="main2" style="width: 600px;height:400px;"></div>
<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('main2'));

    // 指定图表的配置项和数据
    var option = {
        xAxis: {
            type: 'category',
            data: @php echo json_encode(array_keys($months)) @endphp
        },
        yAxis: {
            type: 'value'
        },
        series: [{
            type: 'line',
            data: @php echo json_encode(array_values($months)) @endphp
        }]
    };

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
</script>
</body>
</html>
@stop
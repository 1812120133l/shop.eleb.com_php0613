<?php

namespace App\Http\Controllers\Orders;

use App\Models\Order;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function index(){
        $shop_id=Auth::user()->shop_id;
        //dd($shop_id);
        $orders=Order::where('shop_id',$shop_id)->get();
        //dd($order);
        return view('order.index',compact('orders'));
    }

    public function list(){
        $id=$_GET['id'];
        //dd($id);
        $rows=DB::select("select * from order_details where order_id=?",[$id]);

        return view('order.list',compact('rows'));
    }

        public function cancel(){
        $id=$_GET['id'];
        $status=$_GET['status'];
        if($status == -1){
            DB::update("update orders set status=-1 where id=?",[$id]);
            return redirect()->route('order.index')->with('success','取消订单成功');
        }elseif ($status == 1){
            DB::update("update orders set status=1 where id=?",[$id]);
            return redirect()->route('order.index')->with('success','发货成功');
        }
    }

    public function stat(){
        $a=DB::select("select count(*) from `orders`");
        $shop_id=Auth::user()->shop_id;
        $time=date('Y-m-d 00:00:00',strtotime("-6 day"));
        $time2=date('Y-m-d 23:59:59');
        //dd($time2);
        $rows=DB::select("select date(created_at) as date,count(*) as count from `orders` where created_at > '{$time}' and created_at < '{$time2}' and shop_id='{$shop_id}'  group by date");
        //dd($rows);
        $results=[];
        for($i=0;$i<7;$i++){
            $results[date('m-d',strtotime("-{$i} day"))]=0;
        }
        foreach($rows as $row){
           $results[substr($row->date,5,5)]=$row->count;
        }

        $month=date('Y-m-d 00:00:00',strtotime("-3 month"));
        $month2=date('Y-m-d 23:59:59');
        $greens=DB::select("select DATE_FORMAT(created_at,'%Y-%m') as date,count(*) as count from `orders` where created_at > '{$month}' and created_at <= '{$month2}' and shop_id='{$shop_id}' GROUP BY date");
        //dd($greens);
        $months=[];
        for($i=0;$i<3;$i++){
            $months[date('Y-m',strtotime("-{$i} month"))]=0;
        }
        foreach($greens as $green){
            $months[substr($green->date,0,8)]=$green->count;
        }
        return view('order.stat',compact('results','months'));
    }

    public function greens(){

        $time=date('Y-m-d 00:00:00',strtotime("-6 day"));
        $time2=date('Y-m-d 23:59:59');
        $sql="select DATE(o.created_at) as date,COUNT(*) as count,o.goods_id,o.goods_name from order_details o JOIN menus m on o.goods_id=m.id where o.created_at > '{$time}' and o.created_at <= '{$time2}' and m.shop_id=5 GROUP BY date,o.goods_id,o.goods_name";
        $rows=DB::select($sql);
        dd($rows);
        $weeks=[];
        for($i=0;$i<7;$i++){
            $weeks[date('m-d',strtotime("-{$i} day"))]=0;
        }
        foreach ($weeks as $k=>$v){

        }
        dd($weeks);
        foreach($rows as $row){
            $weeks[substr($row->date,5,5)][]=$row->count;
        }
        //dd($weeks);

        $month=date('Y-m-d 00:00:00',strtotime("-3 month"));
        $month2=date('Y-m-d 23:59:59');
        $sql2="select DATE_FORMAT(o.created_at,'%Y-%m') as date,COUNT(*) as count,o.goods_name as name from order_details o JOIN menus m on o.goods_id=m.id where o.created_at > '{$month}' and o.created_at <= '{$month2}' and m.shop_id=5 GROUP BY date,o.goods_name";
        $greens=DB::select($sql2);
        dd($greens);
        $months=[];
        for($i=0;$i<3;$i++){
            $months[date('Y-m',strtotime("-{$i} month"))]=0;
        }
        foreach($greens as $green){
            $months[substr($green->date,0,8)]=$green->count;
        }
        return view('order.greens',compact('weeks','months'));

    }
}

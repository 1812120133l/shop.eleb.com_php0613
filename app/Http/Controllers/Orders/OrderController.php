<?php

namespace App\Http\Controllers\Orders;

use App\Models\Menu;
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
        $shop_id=Auth::user()->id;
        $time=date('Y-m-d 00:00:00',strtotime("-6 day"));
        $time2=date('Y-m-d 23:59:59');
        $sql="select DATE(o.created_at) as date,COUNT(*) as count,o.goods_id,o.goods_name,SUM(o.amount) as amount from order_details o JOIN menus m on o.goods_id=m.id where o.created_at > '{$time}' and o.created_at <= '{$time2}' and m.shop_id=5 GROUP BY date,o.goods_id,o.goods_name";
        $rows=DB::select($sql);

        $menus = Menu::where('shop_id',$shop_id)->select(['id','goods_name'])->get();
        $keyed=[];
        foreach($menus as $menu){
            $keyed[$menu->id]=$menu->goods_name;
        }

        $weeks=[];
        for($i=0;$i<7;$i++){
            $weeks[]=date('Y-m-d',strtotime("-{$i} day"));
        }
        $result=[];
        foreach($keyed as $id=>$name){
            foreach($weeks as $day){
                $result[$id][$day]=0;
            }
        }
        //dd($weeks);
        foreach($rows as $row){
            $result[$row->goods_id][$row->date]=$row->amount;
        }
        //dd($result);
        //dd($weeks);
        $series=[];
       foreach($result as $id=>$data){
           $serie = [
               'name'=> $keyed[$id],
               'type'=>'line',
               'data'=>array_values($data)
           ];
           $series[] = $serie;
       }

        //dd($series);

        $month=date('Y-m-d 00:00:00',strtotime("-3 month"));
        $month2=date('Y-m-d 23:59:59');
        $sql2="select DATE_FORMAT(o.created_at,'%Y-%m') as date,COUNT(*) as count,o.goods_name as name ,SUM(o.amount) as amount,o.goods_id from order_details o JOIN menus m on o.goods_id=m.id where o.created_at > '{$month}' and o.created_at <= '{$month2}' and m.shop_id=5 GROUP BY date,o.goods_name,o.goods_id";
        $greens=DB::select($sql2);
        //dd($greens);
        $months_id=[];
        foreach($menus as $menu){
            $months_id[$menu->id]=$menu->goods_name;
        }
        $months=[];
        for($i=0;$i<3;$i++){
            $months[]=date('Y-m',strtotime("-{$i} month"));
        }
        $months_result=[];
        foreach($months_id as $id=>$name){
            foreach($months as $day){
                $months_result[$id][$day]=0;
            }
        }
        foreach($greens as $green){
            $months_result[$green->goods_id][$green->date]=$green->amount;
        }

        $months_series=[];
        foreach($months_result as $id=>$data){
            $serie = [
                'name'=> $months_id[$id],
                'type'=>'line',
                'data'=>array_values($data)
            ];
            $months_series[] = $serie;
        }
       // dd($months_series);

        return view('order.greens',compact('series','weeks','months_series','months'));

    }
}

<?php

namespace App\Http\Controllers\Shop;

use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth',[

        ]);
    }

    public function index(Request $request){

        $menucaregories=MenuCategory::all();

        if($request->name || $request->money){

            if(!$request->caregory && !$request->money){
                $name=$request->name;
                $menus=Menu::where('goods_name','like','%'.$name.'%')->get();
                return view('shop.index',compact('menucaregories','menus','caregory'));
            }
            if($request->caregory && $request->name){
                $name=$request->name;
                $menus=Menu::where('category_id',$request->caregory)->where('goods_name','like','%'.$name.'%')->get();
                return view('shop.index',compact('menucaregories','menus','caregory'));
            }

            if(!$request->caregory && !$request->name){
                $money=$request->money;
                $money2=$request->money2;
                $menus=Menu::where('goods_price','>',$money)->where('goods_price','<',$money2)->get();
                return view('shop.index',compact('menucaregories','menus','caregory'));
            }

            if($request->name && $request->money && !$request->caregory){
                $money=$request->money;
                $money2=$request->money2;
                $name=$request->name;
                $menus=Menu::where('goods_name','like','%'.$name.'%')->where('goods_price','>',$money)->where('goods_price','<',$money2)->get();
                return view('shop.index',compact('menucaregories','menus','caregory'));
            }

            if($request->money && $request->name){
                $money=$request->money;
                $money2=$request->money2;
                $menus=Menu::where('category_id',$request->caregory)->where('goods_price','>',$money)->where('goods_price','<',$money2)->get();
                return view('shop.index',compact('menucaregories','menus','caregory'));
            }


        }
        $caregory=$_GET['caregory'] ?? 0;
        if($caregory){
            $menus=Menu::where('category_id',$caregory)->get();
            return view('shop.index',compact('menucaregories','menus','caregory'));
        }

        if($caregory==0){
            $menus=Menu::paginate(5);
            return view('shop.index',compact('menucaregories','menus','caregory'));
        }

   }


}

<?php

namespace App\Http\Controllers\Menu;

use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>['']
        ]);
    }

    public function create(){
        $menucategories=MenuCategory::all();
        return view('menu.create',compact('menucategories'));
    }

    public function store(Request $request){

        $this->validate($request,[
            'goods_name' => 'required',
            'rating' => 'required',
            'goods_price' => 'required',
            'description' => 'required',
            'month_sales' => 'required',
            'rating_count' => 'required',
            'tips' => 'required',
            'satisfy_count' => 'required',
            'satisfy_rate' => 'required',
            'goods_img' => 'required',
        ],[
            'goods_name.required' => '名称不能为空',
            'rating.required' => '	评分不能为空',
            'goods_price.required' => '价格不能为空',
            'description.required' => '描述不能为空',
            'month_sales.required' => '月销量不能为空',
            'rating_count.required' => '评分数量不能为空',
            'tips.required' => '提示信息不能为空',
            'satisfy_count.required' => '满意度数量不能为空',
            'satisfy_rate.required' => '满意度评分不能为空',
            'goods_img.required' => '商品图片不能为空',
        ]);
        $id=Auth::user()->id;

        Menu::create([
            'goods_name' => $request->goods_name,
            'rating' => $request->rating,
            'shop_id' => $id,
            'category_id' => $request->category_id,
            'goods_price' => $request->goods_price,
            'description' => $request->description,
            'month_sales' => $request->month_sales,
            'rating_count' => $request->rating_count,
            'tips' => $request->tips,
            'satisfy_count' => $request->satisfy_count,
            'satisfy_rate' => $request->satisfy_rate,
            'goods_img' => $request->goods_img,
            'status' => $request->status ?? 0,
        ]);

        return redirect()->route('menu.index')->with('success','添加成功');
    }

    public function index(){
        $menus=Menu::paginate(5);
        return view('menu.index',compact('menus'));
    }

    public function edit(Menu $menu){
        $menucategories=MenuCategory::all();
        return view('menu.edit',compact('menucategories','menu'));
    }

    public function update(Menu $menu,Request $request){

        $this->validate($request,[
            'goods_name' => 'required',
            'rating' => 'required',
            'goods_price' => 'required',
            'description' => 'required',
            'month_sales' => 'required',
            'rating_count' => 'required',
            'tips' => 'required',
            'satisfy_count' => 'required',
            'satisfy_rate' => 'required',
        ],[
            'goods_name.required' => '名称不能为空',
            'rating.required' => '	评分不能为空',
            'goods_price.required' => '价格不能为空',
            'description.required' => '描述不能为空',
            'month_sales.required' => '月销量不能为空',
            'rating_count.required' => '评分数量不能为空',
            'tips.required' => '提示信息不能为空',
            'satisfy_count.required' => '满意度数量不能为空',
            'satisfy_rate.required' => '满意度评分不能为空',
        ]);

        $path=$request->goods_img ?? $path=$request->goods_img2;

        $menu->update([
            'goods_name' => $request->goods_name,
            'rating' => $request->rating,
            'category_id' => $request->category_id,
            'goods_price' => $request->goods_price,
            'description' => $request->description,
            'month_sales' => $request->month_sales,
            'rating_count' => $request->rating_count,
            'tips' => $request->tips,
            'satisfy_count' => $request->satisfy_count,
            'satisfy_rate' => $request->satisfy_rate,
            'goods_img' => $path,
            'status' => $request->status ?? 0,
        ]);

        return redirect()->route('menu.index')->with('success','修改成功');
    }

    public function destroy(Menu $menu){
        $menu->delete();
        return redirect()->route('menu.index')->with('success','删除成功');
    }

    public function upload(Request $request){
       $path=$request->file('file')->store('public/img');
       return ['path' => Storage::url($path)];
    }
}

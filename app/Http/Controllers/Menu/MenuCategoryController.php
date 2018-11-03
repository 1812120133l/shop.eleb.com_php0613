<?php

namespace App\Http\Controllers\Menu;

use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuCategoryController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth',[
            'except' => ['']
            ]
        );

    }
    public function create(){
        return view('menucategory.create');
    }

    public function store(Request $request){

        $id=Auth::user()->id;
        if($request->is_selected){
            if(DB::select("select * from menu_categories where shop_id='{$id}' and is_selected=1")){
                return back()->with('danger','已有默认菜品，不能再添加默认菜品')->withInput();
            }
        }
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
        ],[
            'name.required' => '分类名不能为空',
            'description.required' => '描述不能为空',
        ]);

        $srt='123456789';
        $type_accumulation=time().str_shuffle($srt);
        $shop_id=Auth::user()->id;
        MenuCategory::create([
            'name' => $request->name,
            'type_accumulation' => $type_accumulation,
            'shop_id' => $shop_id,
            'description' => $request->description,
            'is_selected' => $request->is_selected ?? 0,
        ]);
        return redirect()->route('menucategory.index')->with('success','添加成功');
    }

    public function index(){
        $menucategoies=MenuCategory::paginate(5);
        return view('menucategory.index',compact('menucategoies'));
    }

    public function edit(MenuCategory $menucategory){
       // dd($menucategory);
        return view('menucategory.edit',compact('menucategory'));
    }

    public function update(MenuCategory $menucategory,Request $request){

        $id=Auth::user()->id;
        if($request->is_selected){
            if(DB::select("select * from menu_categories where shop_id='{$id}' and is_selected=1")){
                return back()->with('danger','已有默认菜品，不能再添加默认菜品')->withInput();
            }
        }

        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
        ],[
            'name.required' => '分类名不能为空',
            'description.required' => '描述不能为空',
        ]);

        $menucategory->update([
           'name' => $request->name,
           'description' => $request->description,
           'is_selected' => $request->is_selected ?? 0,
        ]);

        echo '成功';

    }

    public function destroy(MenuCategory $menucategory){
        $id=$menucategory->id;
        if(DB::table('menu')->where('category_id',$id)->first()){
            return back()->with('danger','该分类不为空，不能删除')->withInput();
        }
        $menucategory->delete();
        return redirect()->route('menucategory.index')->with('success','删除成功');
    }

}

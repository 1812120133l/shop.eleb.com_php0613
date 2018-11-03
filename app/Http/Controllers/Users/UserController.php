<?php

namespace App\Http\Controllers\Users;

use App\Models\Shop;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function user(){
        $shopcategories = DB::select('select * from stop_categories');
        return view('user.user',compact('shopcategories'));
    }

    public function register(Request $request){

        $this->validate($request,[
            'name' =>'required|max:15|min:3',
            'email' =>'required|email',
            'password' =>'confirmed',

            'shop_name' => 'required',
            'shop_img' => 'required',
            'shop_rating' => 'required',
            'start_send' => 'required',
            'send_cost' => 'required',
            'notice' => 'required',
        ],[
            'name.required' => '用户名不能为空',
            'name.max' => '用户名不能大于15位',
            'name.min' => '用户名不能小于3位',
            'email.required' => '邮箱不能为空',
            'password.confirmed' => '两次密码不一致',

            'shop_name.required' => '店铺名称不能为空',
            'shop_img.required' => '店铺图片不能为空',
            'shop_rating.required' => '评分不能为空',
            'start_send.required' => '起送金额不能为空',
            'send_cost.required' => '配送费不能为空',
            'notice.required' => '店公告不能为空',
        ]);

        DB::beginTransaction();
        try {
       $shop= Shop::create([
            'shop_category_id' => $request->shop_category_id,
            'shop_name' => $request->shop_name,
            'shop_img' => $request->shop_img,
            'shop_rating' => $request->shop_rating,
            'brand' => $request->brand,
            'on_time' => $request->on_time,
            'fengniao' => $request->fengniao,
            'bao' => $request->bao,
            'piao' => $request->piao,
            'zhun' => $request->zhun,
            'start_send' => $request->start_send,
            'send_cost' => $request->send_cost,
            'notice' => $request->notice,
            'discount' => $request->discount,
            'status' => 0,
        ]);

            $user= User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'status' => 1,
                'shop_id' => $shop->id,
                'remember_token' => str_random(50),
            ]);

            if($user&&$shop){
                DB::commit();
                echo '账号注册成功';
            }
        } catch (\Exception $e) {
            DB::rollBack();
            echo '失败';
        }
      //  return request()->route('shop.index')->with('success','账号注册成功');
        return redirect()->route('shop.index')->with('success','账号注册成功');
    }

    public function index(){
        return view('user.login');
    }

    public function userlogin(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'password'=>'required',
           // 'captcha' => 'required|captcha',
        ],[
            'name.required' => '用户名不能为空',
            'password.required' => '密码不能为空',
            'captcha.required' =>'验证码不能为空',
            'captcha.captcha' =>'验证码错误',
        ]);


        if(DB::select("select * from users where `name`='{$request->name}' and status=0")){
            return back()->with('danger','用户已被禁用')->withInput();

        }elseif(Auth::attempt(['name'=> $request->name,'password'=>$request->password])){

            return redirect()->route('shop.index')->with('success','登录成功');
        }else{
            return back()->with('danger','用户名或密码错误，请重新登录')->withInput();
        }
    }

    public function destroy(){
        Auth::logout();
        return redirect()->route('login')->with('success','退出成功');
    }

    public function edit(){
        $user=Auth::user();
        return view('user.update',compact('user'));
    }

    public function update(Request $request){
        $id=Auth::user()->id;
        $password=Auth::user()->password;
        if(!Hash::check($request->former,$password)){
            return back()->with('danger','原密码不正确')->withInput();
        }
        $this->validate($request,[
            'password' =>'required|confirmed',
             'captcha' => 'required|captcha',
        ],[
            'password.required' => '新密码不能为空',
            'captcha.required' =>'验证码不能为空',
            'captcha.captcha' =>'验证码错误',
            'password.confirmed' => '两次密码不一致',
        ]);
        $password=bcrypt($request->password);

        DB::update("update users set password='{$password}' where id=?",[$id]);

        return redirect()->route('shop.index')->with('success','密码修改成功');
    }

}

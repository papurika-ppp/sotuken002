<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Password_list;
use App\Models\G_password_list;
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{
    //
    private $request;

    public function __construct(){
        //リクエストパラメーター
        $this->request['get'] = $_GET;
        $this->request['post'] = $_POST;
 
        //モデルオブジェクトの生成
        
    }


    
    public function index() : View
    {
        //ユーザのレコード全取得
        $s_users = User::all();
        return view('s_user/index',['s_users'=>$s_users]);
    }

    public function store(Request $request): RedirectResponse
    {
        $s_user = new User();
        $s_user->user_name = $request->user_name;
        $s_user->save();

        return redirect('/s_users');
    }

    public function password_list(): View
    {
        $password_lists = Password_list::where('user_id','=',Auth::user()->user_id)->get();
        $g_password_lists = G_password_list::where('user_id','=',Auth::user()->user_id)->get();
        /*foreach($g_password_lists as $g_password_list)
        {
            $a = $g_password_list->team;
        }*/
        
        return view('s_user/password_list',['password_lists'=>$password_lists,'g_password_lists'=>$g_password_lists]);
    }

    public function home(): View
    {
        return view('s_user/home');
    }

    public function add() : RedirectResponse {
        
        return redirect();
    }

    public function password_manage(): View
    {
        
        $password = Password_list::where('management_number',$this->request['get']['id'])->get();
        return view('s_user/password_manage',['password'=>$password,]);
    } 

    public function g_password_manage(): View
    {
        $g_password = G_password_list::where('management_number',$this->request['get']['id'])->get();
        return view('s_user/g_password_manage',['g_password'=>$g_password]);
    } 

    


    

}

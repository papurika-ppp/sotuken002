<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Team;
use App\Models\Group_key;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\G_user;

class TeamController extends Controller
{
    //
    private $request;

    public function __construct(){
        //リクエストパラメーター
        $this->request['get'] = $_GET;
        $this->request['post'] = $_POST;
    }

    public static function createKey(?array $options = [
        'digest_alg' => 'sha256',
        'private_key_bits' => 2048,
        'private_key_type' => OPENSSL_KEYTYPE_RSA,
    ])//: OpenSSLAsymmetricKey | false
    {
        return openssl_pkey_new($options);
    }

    public static function getPublicKey($instance): string | false
    {
        $details = openssl_pkey_get_details($instance);
        if ($details === false) {
            return false;
        }
        return $details['key'];
    }
    
    public static function getPrivateKey($instance): string | false
    {
        $privateKey = '';
        if (openssl_pkey_export($instance, $privateKey)) {
            return $privateKey;
        } else {
            return false;
        }
    }

    public function group_manage(): View
    {
         $team_lists = Team::where('user_id','=',Auth::user()->user_id)->get();
        // $user = User::where('user_id','=','group.')->;
        // $team_lists = DB::table('teams')->where('user_id',Auth::user()->user_id);
        // $users = DB::table('users')->select('user_id,user_name')->whereIn('user_id',$)
        /*foreach($g_password_lists as $g_password_list)
        {
            $a = $g_password_list->team;
        }*/
        
        return view('g_user/home',['team_lists'=>$team_lists]);
    }

    public function group_create(): View
    {
        
        return view('g_user/create');
    }

    public function store(Request $request)
    {
        
        
        
        try {
            $group_key = new Group_key;
            $group_key->setConnection('mysql_second');
            $instance = static::createKey();
            $publicKey = static::getPublicKey($instance);
            $privatekey = static::getPrivateKey($instance);
            //teamテーブル
            $team_list = new Team();
            $team_list->group_name = $request->input('group_name');
            $team_list->user_id = Auth::user()->user_id;
            $team_list->publickey = $publicKey;
            //$password_list->regist_date = ;
            // データベースに保存
            $team_list->save();
            
            $group_id = DB::table('teams')->latest('group_id')->first();
            $g_user = new G_user();
            $g_user->group_id = $group_id->group_id;
            $g_user->user_id = Auth::user()->user_id;
            $g_user->authorizer_flag = 1;
            $g_user->withdrawal_flag = 0;
            $g_user->save();

            $group_key->group_id = $group_id->group_id;
            $group_key->privatekey = $privatekey;
            $group_key->hashpublickey = Hash::make($publicKey);
            $group_key->save();
                    return redirect('/groups')->with(['message', '登録が完了しました！']);
            } catch (\Exception $e) {
                return back()->with('message', '登録に失敗しました。' . $e->getMessage());
            }
    }

    public function group_management(): View
    {
        $teamInfo = Team::where('group_id','=',$this->request['get']['id'])->first();
        /*foreach($g_password_lists as $g_password_list)
        {
            $a = $g_password_list->team;
        }*/
        
        return view('g_user/management',['teamInfo'=>$teamInfo]);
    }

    public function group_delete(): RedirectResponse
    {
        try{
                $userInfo = G_user::where('group_id','=',$this->request['get']['id'])->delete();
                $teamInfo = Team::where('group_id','=',$this->request['get']['id'])->delete();
                

                /*foreach($g_password_lists as $g_password_list)
                {
                    $a = $g_password_list->team;
                }*/
                
                return redirect('/groups')->with(['message','削除しました！']);
            } catch (\Exception $e) {
                return back()->with('message','登録に失敗しました。'.$e->getMessage());
            }
    }
}

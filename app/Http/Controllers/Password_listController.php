<?php

namespace App\Http\Controllers;
use App\Models\Password_list;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use DateTime;
//use Illuminate\Contracts\View\View;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\OpenSSLAsymmetricKey;
//use Illuminate\Support\Facades\Crypt;

class Password_listController extends Controller
{
    //
    
    public function password_update()
    {

    }

    public function password_add(): View
    {
        
       return view('password_list/passcreate');
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

    public static function publicKeyEncrypt(string $text,$publicKey): string | false
{
    $encrypted = '';
    //$publicKeyString = ($publicKey instanceof OpenSSLAsymmetricKey) ? static::getPublicKey($publicKey) : $publicKey;
    //$publicKeyString = static::getPublicKey($publicKey);
    $publicKeyString = $publicKey;
    if ($publicKeyString === false) {
        return false;
    }
    if (openssl_public_encrypt($text, $encrypted, $publicKeyString)) {
        return base64_encode($encrypted);
    } else {
        return false;
    }
}

public static function publicKeySplitEncrypt(string $text,$publicKey, ?int $keyLength = 2048): string | false
{
    // 1回に暗号化可能なバイト数を算出
    $maxBytes = floor(($keyLength / 8) - 11);
    if ($maxBytes <= 0) {
        return false;
    }

    // 文字列をバイト単位で区切る
    $target = $text;
    $splitText = [];
    while(true) {
        // mb_strcut()は指定されたバイト数に入る分だけ、マルチバイト文字が壊れないように切り出してくれる
        $cutted = mb_strcut($target, 0, $maxBytes);
        $splitText[] = $cutted;
        if ($cutted == $target) {
            break;
        }
        $target = mb_substr($target, mb_strlen($cutted));
    }

    // それぞれ暗号化処理を行う
    $encryptArray = [];
    foreach ($splitText as $text) {
        $encrypted = static::publicKeyEncrypt($text, $publicKey);
        if ($encrypted === false) {
            return false;
        }
        $encryptArray[] = $encrypted;
    }

    return implode('', $encryptArray);
}











    public function store(Request $request)
    {
        
        
        try {
            // $userインスタンスを作成する
            $password_list = new Password_list();
     
            //$user = new User();

            $user = User::where('user_id','=',Auth::user()->user_id)->first();
            $publicKey = $user->publickey;


            //$instance = $this->createKey();
            //$publicKey = $this->getPublicKey($instance);
            //$privatekey = $this->getPrivateKey($instance);
            // 投稿フォームから送信されたデータを取得し、インスタンスの属性に代入する
            $password_list->user_id = Auth::user()->user_id;
            $password_list->site_name = $request->input('site_name');
            $password_list->url = $request->input('url');
            $password_list->management_account = $request->input('management_account');
            $password_list->management_account_password = $this->publicKeySplitEncrypt($request->input('management_account_password'),$publicKey);
            $password_list->comment = $request->input('comment');
            
            //$password_list->regist_date = ;

     
            // データベースに保存
            $password_list->save();
            
                     return redirect('/passlis')->with(['message', '登録が完了しました！']);
             } catch (\Exception $e) {
                 return back()->with('message', '登録に失敗しました。' . $e->getMessage());
             }
    }
}

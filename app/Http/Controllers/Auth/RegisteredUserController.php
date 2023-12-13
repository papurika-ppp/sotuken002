<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\User_key;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
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



    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'user_name' => ['required', 'string', 'max:255'],
            'user_id'=> ['required', 'string', 'max:30','unique:'.User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $google2fa = app('pragmarx.google2fa');
        $google2faSecret = "";
        if (!is_null($request->is_enable_google2fa)) {
            $google2faSecret = $google2fa->generateSecretKey();
        }

        $user_key = new User_key;
        $user_key->setConnection('mysql_second');
        $instance = static::createKey();
        $publicKey = static::getPublicKey($instance);
        $privatekey = static::getPrivateKey($instance);


        $user = User::create([
            'user_name' => $request->user_name,
            'user_id'=> $request->user_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'google2fa_secret' => $google2faSecret,
            'is_enable_google2fa' => $request->is_enable_google2fa,
            'publickey' => $publicKey
        ]);

        $user_key->user_id = $request->user_id;
        $user_key->privatekey = $privatekey;
        $user_key->hashpublickey = Hash::make($publicKey);
        $user_key->save();


        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}

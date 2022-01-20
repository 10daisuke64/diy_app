<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MultiAuthController extends Controller
{
    // メールアドレスやパスワードを入力するページ
    public function showLoginForm() {

        return view('multi_auth.login');

    }

    // その送信先
    public function login(Request $request) {

        $credentials = $request->only(['email', 'password']);
        $guard = $request->guard;

        if(\Auth::guard($guard)->attempt($credentials)) {

            return redirect($guard .'/dashboard'); // ログインしたらリダイレクト

        }

        return back()->withErrors([
            'auth' => ['認証に失敗しました']
        ]);
    }

    // 管理画面
    public function get_diyer_dashboard(){
      return view('diyer.dashboard');
    }
     public function get_mentor_dashboard(){
      return view('mentor.dashboard');
    }
}

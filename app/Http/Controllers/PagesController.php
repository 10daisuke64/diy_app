<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;

class PagesController extends Controller
{
    // askページ
    public function get_ask(){
      return view('diyer.ask');
    }
    // 質問の登録
    public function register_question(Request $request)
    {
        $posts = $request->all();

        Question::insert(['body' => $posts['body'], 'title' => $posts['title'], 'is_published' => 1, 'user_id' => \Auth::id()]);

        return redirect( route('ask') );
    }

    // answerページ
    public function get_answer(){
      return view('mentor.answer');
    }
    // 質問の登録
    public function register_answer(Request $request)
    {
        $posts = $request->all();

        Question::insert(['body' => $posts['body'], 'title' => $posts['title'], 'is_published' => 1, 'user_id' => \Auth::id()]);

        return redirect( route('ask') );
    }
}

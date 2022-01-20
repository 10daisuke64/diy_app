<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    // askページ
    public function get_ask(){
      return view('ask');
    }
}

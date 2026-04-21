<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Emails_content extends Controller
{
    public function index(){
        has_access(12);
        // dd(Auth::user()->email);
        return view('admin.emails_content',$this->data);

    }
}

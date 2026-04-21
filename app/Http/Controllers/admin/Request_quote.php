<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Request_Quote_model;

class Request_Quote extends Controller
{
    public function index(){

        has_access(5);
      
        $this->data['rows']=Request_Quote_model::orderBy('id', 'DESC')->get();
        return view('admin.request_quote',$this->data);
    }
    public function view($id){
        has_access(5);
        $request_quote=Request_Quote_model::find($id);
        $request_quote->status=1;
        $request_quote->update();
        $this->data['row']=$request_quote;
        return view('admin.request_quote',$this->data);
    }
    public function delete($id){
        has_access(5);
        $request_quote = Request_Quote_model::find($id);
        $request_quote->delete();
        return redirect('admin/request-quote/')
                ->with('error','Message deleted Successfully');
    }
}
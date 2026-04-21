<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter_model;

class Subscribers extends Controller
{
    public function index(){
        has_access(6);
        $rows=Newsletter_model::orderBy('id', 'DESC')->get();
        foreach($rows as $row){
            Newsletter_model::where('id',$row->id)->update(array('status'=>1));
        }
        $this->data['rows']=Newsletter_model::orderBy('id', 'DESC')->get();
        return view('admin.subscribers',$this->data);
    }
    public function delete($id){
        has_access(6);
        $faq = Newsletter_model::find($id);
        $faq->delete();
        return redirect('admin/subscribers/')
                ->with('error','Subscriber deleted Successfully');
    }

    function csv_export()
    {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=newsletterSubscribers-'.date('Y-m-d').'-'.toSlugUrl($this->data['site_settings']->site_name).'.csv');

        $output = fopen('php://output', 'w');

        fputcsv($output, array('Sr.', 'Email'));

        $rows=Newsletter_model::orderBy('id', 'DESC')->get();

        foreach ($rows as $key => $row) {
            $arr = array($key+1, $row->email);
            fputcsv($output, $arr);
        }
        fclose($output);
        exit;
    }
}

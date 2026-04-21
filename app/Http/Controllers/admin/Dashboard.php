<?php

namespace App\Http\Controllers\admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class Dashboard extends Controller
{

    public function index()
    {
        // $this->data['members']=table_count('members',array('mem_type' => 'client'),true);
        // $this->data['agents']=table_count('members',array('mem_type' => 'agent'),true);
        // $this->data['report_issues']=table_count('issue_reports',array(),true);


        // $this->data['new_report_issues']=table_count('issue_reports',array('view_status' => 0),false);
        // $this->data['new_contact']=table_count('contact',array('status' => 0),false);
        // $this->data['new_subscribers']=table_count('newsletter',array('status' => 0),false);

        // $this->data['listings']=table_count('listings',array(),true);
        // $this->data['bookings']=table_count('bookings',array(),true);
        // $this->data['conversations']=table_count('conversations',array(),true);
        $this->data['contact'] = table_count('contact', array(), true);
        $this->data['subscribers'] = table_count('newsletter', array(), true);
        // $this->data['withdraw_requests']=table_count('withdraw_requests',array(),true);
        // $this->data['tickets']=table_count('tickets',array(),true);
        // dd(Auth::user()->email);
        return view('admin.dashboard', $this->data);
    }
    public function settings()
    {
        has_access(1);
        return view('admin.site_settings', $this->data);
    }
    public function change_password(Request $request)
    {
        $admin = Admin::find(1);
        $input = $request->all();
        if ($input) {
            $this->validate($request, [
                'current_password'     => 'required',
                'new_password'     => 'required',
                'confirm_password' => 'required|same:new_password',
            ]);
            if (Hash::check($input['current_password'], $admin->site_password)) {
                $admin->site_password = Hash::make($input['new_password']);
                $admin->save();
                return redirect('admin/dashboard')
                    ->with('success', 'Updated Successfully');
            } else {
                return redirect('admin/change-password')
                    ->with('error', 'Current Password is not right!');
            }
        }
        return view('admin.change_password', $this->data);
    }

    public function settings_update(Request $request)
    {
        $admin = Admin::find(1);


        if ($request->hasFile('site_logo')) {
            $request->validate([
                'site_logo' => 'mimes:png,jpg,jpeg,svg,gif,ico,webp|max:2048'
            ]);
            $site_logo = $request->file('site_logo')->store('public/images/');
            if (!empty($site_logo)) {
                if (!empty($this->data['site_settings']->site_logo)) {


                    removeImage("images/" . $this->data['site_settings']->site_logo);
                }

                $admin->site_logo = basename($site_logo);
            }
        }

        if ($request->hasFile('site_logo2')) {
            $request->validate([
                'site_logo2' => 'mimes:png,jpg,jpeg,svg,gif,ico,webp|max:2048'
            ]);
            $site_logo2 = $request->file('site_logo2')->store('public/images/');
            if (!empty($site_logo2)) {
                if (!empty($this->data['site_settings']->site_logo2)) {
                    removeImage("images/" . $this->data['site_settings']->site_logo2);
                }
                $admin->site_logo2 = basename($site_logo2);
            }
        }


        if ($request->hasFile('site_icon')) {
            $request->validate([
                'site_icon' => 'mimes:png,jpg,jpeg,svg,gif,ico,webp|max:2048'
            ]);
            $site_icon = $request->file('site_icon')->store('public/images/');
            if (!empty($site_icon)) {
                if (!empty($this->data['site_settings']->site_icon)) {
                    removeImage("images/" . $this->data['site_settings']->site_icon);
                }
                $admin->site_icon = basename($site_icon);
            }
        }
        if ($request->hasFile('site_thumb')) {
            $request->validate([
                'site_thumb' => 'mimes:png,jpg,jpeg,svg,gif,ico,webp|max:2048'
            ]);
            $site_thumb = $request->file('site_thumb')->store('public/images/');
            if (!empty($site_thumb)) {
                if (!empty($this->data['site_settings']->site_thumb)) {
                    removeImage("images/" . $this->data['site_settings']->site_thumb);
                }
                $admin->site_thumb = basename($site_thumb);
            }
        }

        if ($request->hasFile('site_header_image1')) {
            $request->validate([
                'site_header_image1' => 'mimes:png,jpg,jpeg,svg,gif,ico,webp|max:2048'
            ]);
            $site_header_image1 = $request->file('site_header_image1')->store('public/images/');
            if (!empty($site_header_image1)) {
                if (!empty($this->data['site_settings']->site_header_image1)) {
                    removeImage("images/" . $this->data['site_settings']->site_header_image1);
                }
                $admin->site_header_image1 = basename($site_header_image1);
            }
        }


        if ($request->hasFile('site_header_image2')) {
            $request->validate([
                'site_header_image2' => 'mimes:png,jpg,jpeg,svg,gif,ico,webp|max:2048'
            ]);
            $site_header_image2 = $request->file('site_header_image2')->store('public/images/');
            if (!empty($site_header_image2)) {
                if (!empty($this->data['site_settings']->site_header_image2)) {
                    removeImage("images/" . $this->data['site_settings']->site_header_image2);
                }
                $admin->site_header_image2 = basename($site_header_image2);
            }
        }


        // if($request->hasFile('site_email_logo')){
        //     $request->validate([
        //         'site_email_logo' => 'mimes:png,jpg|max:2048'
        //     ]);
        //     $site_email_logo=$request->file('site_email_logo')->store('public/images/');
        //     if(!empty($site_email_logo)){
        //         if(!empty($this->data['site_settings']->site_email_logo)){
        //             removeImage("images/".$this->data['site_settings']->site_email_logo);
        //         }

        //         $admin->site_email_logo=basename($site_email_logo);
        //     }

        // }

        if (!empty($request->site_stripe_type) && $request->site_stripe_type == 'on') {
            $site_stripe_type = 1;
        } else {
            $site_stripe_type = 0;
        }

        if (!empty($request->site_sandbox) && $request->site_sandbox == 'on') {
            $site_sandbox = 1;
        } else {
            $site_sandbox = 0;
        }
        // pr($site_stripe_type);
        $admin->site_domain = $request->site_domain;
        $admin->site_name = $request->site_name;
        $admin->site_phone = $request->site_phone;
        $admin->site_email = $request->site_email;
        $admin->site_noreply_email = $request->site_noreply_email;
        $admin->site_address = $request->site_address;
        $admin->site_about = $request->site_about;
        $admin->site_copyright = $request->site_copyright;
        $admin->site_meta_desc = $request->site_meta_desc;
        $admin->site_meta_keyword = $request->site_meta_keyword;
        $admin->site_facebook = $request->site_facebook;
        $admin->site_twitter = $request->site_twitter;
        $admin->site_linkedin = $request->site_linkedin;
        $admin->site_instagram = $request->site_instagram;
        $admin->site_discord = $request->site_discord;
        $admin->site_stripe_type = $site_stripe_type;
        $admin->site_stripe_testing_api_key = $request->site_stripe_testing_api_key;
        $admin->site_stripe_testing_secret_key = $request->site_stripe_testing_secret_key;
        $admin->site_stripe_live_api_key = $request->site_stripe_live_api_key;
        $admin->site_stripe_live_secret_key = $request->site_stripe_live_secret_key;
        $admin->site_sandbox_paypal = $request->site_sandbox_paypal;
        $admin->site_live_paypal = $request->site_live_paypal;

        $admin->site_stripe_fee = $request->site_stripe_fee;
        $admin->site_stripe_flat_fee = $request->site_stripe_flat_fee;
        $admin->site_sandbox = $site_sandbox;
        $admin->site_media_inquery_email = $request->site_media_inquery_email;
        $admin->site_career_op_email = $request->site_career_op_email;
        $admin->site_license = $request->site_license;
        $admin->site_ft_heading1 = $request->site_ft_heading1;
        $admin->site_ft_heading2 = $request->site_ft_heading2;
        $admin->site_ft_heading3 = $request->site_ft_heading3;
        $admin->site_news_letter_text = $request->site_news_letter_text;

        $admin->site_smtp_host = $request->site_smtp_host;
        $admin->site_smtp_port = $request->site_smtp_port;
        $admin->site_smtp_user = $request->site_smtp_user;
        $admin->site_smtp_pswd = $request->site_smtp_pswd;

        $admin->site_shipping_fee = $request->site_shipping_fee;

        





        $admin->save();
        return redirect('admin/site_settings')
            ->with('success', 'Updated Successfully');
    }
}
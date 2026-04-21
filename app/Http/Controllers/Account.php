<?php

namespace App\Http\Controllers;

use App\Models\Agent_model;
use App\Models\Leads_model;
use App\Models\Member_model;
use App\Models\Reviews_model;
use App\Models\Team_member_model;
use App\Models\Teams_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;
use Illuminate\Support\Str;


class Account extends Controller
{

    public function resend_email(Request $request)
    {
        $res = array();
        $res['status'] = 0;
        $token = $request->input('token', null);
        $member = $this->authenticate_verify_token($token);
        if (!empty($member)) {
            $memberRow = Member_model::where(['id' => $member->id])->get()->first();
            $otp = random_int(100000, 999999);
            $memberRow->otp = $otp;
            $memberRow->otp_expire = date('Y-m-d H:i:s', strtotime('+3 minute'));
            $memberRow->update();
            $token = $memberRow->id . "-" . doEncode($memberRow->mem_email) . "-" . $memberRow->mem_type . "-" . rand(99, 999);
            $userToken = encrypt_string($token);
            $token_array = array(
                'mem_type' => $memberRow->mem_type,
                'token' => $userToken,
                'mem_id' => $memberRow->id,
                'expiry_date' => date("Y-m-d", strtotime("6 months")),
            );
            DB::table('tokens')->insert($token_array);
            $res['expire_time'] = $memberRow->otp_expire;
            // $email_data=array(
            //     'email_to'=>$memberRow->mem_email,
            //     'email_to_name'=>$memberRow->mem_fname,
            //     'email_from'=>'noreply@liveloftus.com',
            //     'email_from_name'=>$this->data['site_settings']->site_name,
            //     'subject'=>'Email Verification',
            //     'link'=>config('app.react_url')."/verification/".$userToken,
            //     // 'code'=>$data['otp'],
            // );
            // $email=send_email($email_data,'account');
            // if($email){
            $res['msg'] = "Verification email has been sent with verification link to your email.";
            $res['status'] = 1;
            // }
            // else{
            //     $res['msg']="Email could not be sent!";
            // }

        } else {
            $res['member'] = null;
        }

        exit(json_encode($res));
    }

    public function chk_old_email(Request $request){
        $res=array();
        $res['status']=0;
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        $input = $request->all();
        $request_data = [
            // 'old_email' => 'required|email',
            'new_email' => 'required|email|unique:members,mem_email',

        ];
        $validator = Validator::make($input, $request_data);

        if ($validator->fails()) {
            $res['status'] = 0;
            $res['msg'] = convertArrayMessageToString($validator->errors()->all());
        }else{
            if(!empty($member)){
                // pr($member);
                $memberRow=Member_model::where(['id' => $member->id])->get()->first();

                $otp=random_int(100000, 999999);
                $memberRow->otp=$otp;
                $memberRow->otp_expire=date('Y-m-d H:i:s', strtotime('+5 minute'));
                $memberRow->update();



                // $token=$memberRow->id."-".doEncode($memberRow->mem_email)."-".$memberRow->mem_type."-".rand(99,999);
                // $userToken=encrypt_string($token);
                // $token_array=array(
                //     'mem_type'=>$memberRow->mem_type,
                //     'token'=>$userToken,
                //     'mem_id'=>$memberRow->id,
                //     'expiry_date'=>date("Y-m-d", strtotime("6 months")),
                // );
                // $res['authToken']=$userToken;
                // DB::table('tokens')->insert($token_array);
                $res['expire_time']=$memberRow->otp_expire;
                $email_data=array(
                    'email_to'=>$memberRow->mem_email,
                    'email_to_name'=>$memberRow->mem_fullname,
                    'email_from' => $this->data['site_settings']->site_noreply_email,
                    'email_from_name' => $this->data['site_settings']->site_name,
                    'subject'=>'Change Email Request Verification',
                    // 'link'=>config('app.react_url')."/verification/".$userToken,
                    'code'=>$otp,
                );
                $email=send_email($email_data,'verify_old_email');

                $res['msg']="We have sent a verifcation code to your old email. Please verify its you.";
                $res['status']=1;


            }
            else{
                $res['member']=null;
                $res['status']=0;
                $res['msg']="Invlaid request";

            }
        }


        exit(json_encode($res));
    }

    public function verify_old_email_otp(Request $request){
        $res=array();
        $res['status']=0;
        $res['email_verify']=0;
        $input = $request->all();
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);

        $input = $request->all();
        $request_data = [
            // 'old_email' => 'required|email',
            'new_email' => 'required|email|unique:members,mem_email',
            'otp' => 'required',


        ];
        $validator = Validator::make($input, $request_data);

        if ($validator->fails()) {
            $res['status'] = 0;
            $res['msg'] = convertArrayMessageToString($validator->errors()->all());
        }else{
            if(!empty($member)){
                if($input){
                        if(strtotime(date('Y-m-d H:i:s')) > strtotime(date('Y-m-d H:i:s',strtotime($member->otp_expire)))){
                            $res['msg']="Your code has expired, please press “Resend Email” for a new code.";
                            $res['status']=0;
                            $res['expired']=1;
                            exit(json_encode($res));
                        }
                        if($member->otp==$input['otp']){
                            $member_row=Member_model::find($member->id);
                            $member_row->otp='';
                            $member_row->mem_verified=1;
                            $member_row->mem_email_verified=1;
                            // $member_row->mem_phone_verified=0;
                            $member_row->mem_status=1;

                            $otp=random_int(100000, 999999);
                            $member_row->otp=$otp;
                            $member_row->otp_expire=date('Y-m-d H:i:s', strtotime('+5 minute'));



                            $member_row->update();
                            $mem_id=$member->id;

                            $res['expire_time']=$member_row->otp_expire;
                            $email_data=array(
                                'email_to'=>$input['new_email'],
                                'email_to_name'=>$member_row->mem_fullname,
                                'email_from' => $this->data['site_settings']->site_noreply_email,
                                'email_from_name' => $this->data['site_settings']->site_name,
                                'subject'=>'Change Email Verification',
                                // 'link'=>config('app.react_url')."/verification/".$userToken,
                                'code'=>$otp,
                            );
                            $email=send_email($email_data,'verify_new_email');
                            // $token=$mem_id."-".doEncode($member->mem_email)."-".$member->mem_type."-".rand(99,999);
                            // $userToken=encrypt_string($token);
                            // $token_array=array(
                            //     'mem_type'=>$member->mem_type,
                            //     'token'=>$userToken,
                            //     'mem_id'=>$mem_id,
                            //     'expiry_date'=>date("Y-m-d", strtotime("6 months")),
                            // );
                            // DB::table('tokens')->insert($token_array);
                            $res['mem_type']=$member->mem_type;
                            // $res['authToken']=$userToken;
                            $res['status']=1;
                            $res['msg']='Your account has been verified!';
                        exit(json_encode($res));
                        }
                    else{
                        $res['status']=0;
                        $res['msg']='Verification code is invalid!';
                    }


                }
            }
            else{
                $res['status']=0;
                $res['msg']='Something went wrong!';
            }
        }
        // exit(json_encode($res));


        exit(json_encode($res));
    }

    public function resend_new_email(Request $request){
        $res=array();
        $res['status']=0;
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        $input = $request->all();
        $request_data = [
            // 'old_email' => 'required|email',
            'new_email' => 'required|email|unique:members,mem_email',

        ];
        $validator = Validator::make($input, $request_data);

        if ($validator->fails()) {
            $res['status'] = 0;
            $res['msg'] = convertArrayMessageToString($validator->errors()->all());
        }else{
            if(!empty($member)){
                $memberRow=Member_model::where(['id' => $member->id])->get()->first();
                $otp=random_int(100000, 999999);
                $memberRow->otp=$otp;
                $memberRow->otp_expire=date('Y-m-d H:i:s', strtotime('+5 minute'));
                $memberRow->update();
                // $token=$memberRow->id."-".doEncode($memberRow->mem_email)."-".$memberRow->mem_type."-".rand(99,999);
                // $userToken=encrypt_string($token);
                // $token_array=array(
                //     'mem_type'=>$memberRow->mem_type,
                //     'token'=>$userToken,
                //     'mem_id'=>$memberRow->id,
                //     'expiry_date'=>date("Y-m-d", strtotime("6 months")),
                // );
                // DB::table('tokens')->insert($token_array);
                $res['expire_time']=$memberRow->otp_expire;
                $email_data=array(
                    'email_to'=>$input['new_email'],
                    'email_to_name'=>$memberRow->mem_fullname,
                    'email_from' => $this->data['site_settings']->site_noreply_email,
                    'email_from_name' => $this->data['site_settings']->site_name,
                    'subject'=>'Email Verification',
                    // 'link'=>config('app.react_url')."/verification/".$userToken,
                    'code'=>$otp,
                );
                $email=send_email($email_data,'verify_new_email');
                // if($email){
                    $res['msg']="A new verification code has been sent to your new email address.";
                    $res['status']=1;
                // }
                // else{
                //     $res['msg']="Email could not be sent!";
                // }

            }
            else{
                $res['member']=null;
            }
        }


        exit(json_encode($res));
    }

    public function verify_new_email_otp(Request $request){
        $res=array();
        $res['status']=0;
        $res['email_verify']=0;
        $input = $request->all();
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);

        $input = $request->all();
        $request_data = [
            'new_email' => 'required|email|unique:members,mem_email',
            'otp' => 'required',
        ];
        $validator = Validator::make($input, $request_data);

        if ($validator->fails()) {
            $res['status'] = 0;
            $res['msg'] = convertArrayMessageToString($validator->errors()->all());
        }else{
            if(!empty($member)){
                if($input){
                        if(strtotime(date('Y-m-d H:i:s')) > strtotime(date('Y-m-d H:i:s',strtotime($member->otp_expire)))){
                            $res['msg']="Your code has expired, please press “Resend Email” for a new code.";
                            $res['status']=0;
                            $res['expired']=1;
                            exit(json_encode($res));
                        }
                        if($member->otp==$input['otp']){
                            $member_row=Member_model::find($member->id);
                            $member_row->otp='';
                            $member_row->mem_email = $input['new_email'];
                            $member_row->mem_verified=1;
                            $member_row->mem_email_verified=1;
                            // $member_row->mem_phone_verified=0;
                            $member_row->mem_status=1;

                            $member_row->update();
                            $mem_id=$member->id;

                            $token=$mem_id."-".doEncode($member_row->mem_email)."-".$member->mem_type."-".rand(99,999);
                            $userToken=encrypt_string($token);
                            $token_array=array(
                                'mem_type'=>$member->mem_type,
                                'token'=>$userToken,
                                'mem_id'=>$mem_id,
                                'expiry_date'=>date("Y-m-d", strtotime("6 months")),
                            );
                            DB::table('tokens')->insert($token_array);
                            $res['mem_type']=$member->mem_type;
                            $res['authToken']=$userToken;
                            $res['status']=1;
                            $res['msg']='Your account email address has been successfully changed!';
                        exit(json_encode($res));
                        }
                    else{
                        $res['status']=0;
                        $res['msg']='Verification code is invalid!';
                    }


                }
            }
            else{
                $res['status']=0;
                $res['msg']='Something went wrong!';
            }
        }
        // exit(json_encode($res));


        exit(json_encode($res));
    }

    public function change_email(Request $request){
        $res=array();
        $res['status']=0;
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        $input = $request->all();
        $request_data = [
            'email' => 'required|email|unique:members,mem_email',
        ];
        $validator = Validator::make($input, $request_data);

        if ($validator->fails()) {
            $res['status'] = 0;
            $res['msg'] = convertArrayMessageToString($validator->errors()->all());
        }else{
            if(!empty($member)){
                // pr($member);
                $memberRow=Member_model::where(['id' => $member->id])->get()->first();

                $memberRow->mem_email = $input['email'];
                $otp=random_int(100000, 999999);
                $memberRow->otp=$otp;
                $memberRow->otp_expire=date('Y-m-d H:i:s', strtotime('+5 minute'));
                $memberRow->update();



                $token=$memberRow->id."-".doEncode($memberRow->mem_email)."-".$memberRow->mem_type."-".rand(99,999);
                $userToken=encrypt_string($token);
                $token_array=array(
                    'mem_type'=>$memberRow->mem_type,
                    'token'=>$userToken,
                    'mem_id'=>$memberRow->id,
                    'expiry_date'=>date("Y-m-d", strtotime("6 months")),
                );
                $res['authToken']=$userToken;
                DB::table('tokens')->insert($token_array);
                $res['expire_time']=$memberRow->otp_expire;
                $email_data=array(
                    'email_to'=>$memberRow->mem_email,
                    'email_to_name'=>$memberRow->mem_fullname,
                    'email_from' => $this->data['site_settings']->site_noreply_email,
                    'email_from_name' => $this->data['site_settings']->site_name,
                    'subject'=>'Email Verification',
                    // 'link'=>config('app.react_url')."/verification/".$userToken,
                    'code'=>$otp,
                );
                $email=send_email($email_data,'account');

                $res['msg']="A new verification code has been sent to your email address.";
                $res['status']=1;


            }
            else{
                $res['member']=null;
                $res['status']=0;
                $res['msg']="Invlaid request";

            }
        }


        exit(json_encode($res));
    }

    public function change_phone(Request $request){
        $res=array();
        $res['status']=0;
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        $input = $request->all();
        $request_data = [
            'phone' => 'required',
        ];
        $validator = Validator::make($input, $request_data);

        if ($validator->fails()) {
            $res['status'] = 0;
            $res['msg'] = convertArrayMessageToString($validator->errors()->all());
        }else{
            $formattedPhone = '+1' . str_replace(' ', '', $input['phone']);

                $phoneExists = Member_model::where('mem_phone', $formattedPhone)->exists();
                if($phoneExists){
                        $res['status'] = 0;
                        $res['phone_exists'] = 1;
                        $res['msg'] = 'Phone already in use';
                        exit(json_encode($res));
                }
            if(!empty($member)){
                // pr($member);
                $memberRow=Member_model::where(['id' => $member->id])->get()->first();

                $memberRow->mem_phone = $formattedPhone;
                $otp=random_int(100000, 999999);
                sendOTP($memberRow->mem_phone, $otp);
                $memberRow->otp_phone=$otp;
                $memberRow->otp_expire=date('Y-m-d H:i:s', strtotime('+5 minute'));
                $memberRow->update();

                if($memberRow->mem_type == 'agent'){
                    $agent = Agent_model::where('mem_id', $memberRow->id)->get()->first();
                    if(!empty($agent)){
                        $agent->primary_phone = $formattedPhone;
                        $agent->update();
                    }

                }

                $res['expire_time']=$memberRow->otp_expire;
                $res['msg']="A verification code has been sent to your new phone number.";
                $res['status']=1;


            }
            else{
                $res['member']=null;
                $res['status']=0;
                $res['msg']="Invlaid request";

            }
        }


        exit(json_encode($res));
    }

    public function update_password(Request $request)
    {
        $res = array();
        $res['status'] = 0;
        $token = $request->input('token', null);
        $member = $this->authenticate_verify_token($token);
        if (!empty($member)) {
            $member = Member_model::where(['id' => $member->id])->get()->first();
            $input = $request->all();
            $request_data = [
                'old_password'     => 'required',
                'new_password'     => 'required',
                'confirm_password' => 'required|same:new_password',
            ];
            $validator = Validator::make($input, $request_data);
            // json is null
            if ($validator->fails()) {
                $res['status'] = 0;
                $res['msg'] = 'Error >>' . $validator->errors()->first();
            } else {
                $memberRow = Member_model::where(['mem_password' => md5($input['old_password']), 'id' => $member->id])->get()->first();
                if (!empty($memberRow)) {
                    $member->mem_password = md5($input['new_password']);
                    $member->update();

                    $email_data=array(
                        'email_to'=>$member->mem_email,
                        'email_to_name'=>$member->mem_fullname,
                        'email_from'=>$this->data['site_settings']->site_noreply_email  ,
                        'email_from_name'=>$this->data['site_settings']->site_name,
                        'subject'=>'Password Changed',

                        // 'code'=>$data['otp'],
                    );
                    send_email($email_data,'password_change_succes');

                    $res['msg'] = "Password updated successfully!";
                    $res['status'] = 1;
                } else {
                    $res['msg'] = 'Old password does not match';
                }
            }
        } else {
            $res['member'] = null;
        }

        exit(json_encode($res));
    }
    public function deactivate_account(Request $request)
    {
        $res = array();
        $res['status'] = 0;
        $token = $request->input('token', null);
        $member = $this->authenticate_verify_token($token);
        if (!empty($member)) {
            $member = Member_model::where(['id' => $member->id])->get()->first();
            $input = $request->all();
            $request_data = [
                'reason'     => 'required',
            ];
            $validator = Validator::make($input, $request_data);
            // json is null
            if ($validator->fails()) {
                $res['status'] = 0;
                $res['msg'] = 'Error >>' . $validator->errors()->first();
            } else {
                $member->is_deactivated = 1;
                $member->deactivated_reason = $input['reason'];
                $member->update();
                $res['msg'] = "Account Deactivated successfully!";
                $res['status'] = 1;
            }
        } else {
            $res['member'] = null;
        }

        exit(json_encode($res));
    }
    public function update_profile(Request $request)
    {

        $res = array();
        $res['status'] = 0;
        $token = $request->input('token');
        $member = $this->authenticate_verify_token($token);
        if (!empty($member)) {
            $input = $request->all();
        //    pr($input);
            $request_data = [
                'name'     => 'required',
                // 'phone'     => 'required|unique:members,mem_phone',
                'email'     => 'required|email',
                'potrait' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3096',

            ];
            $validator = Validator::make($input, $request_data);

            if ($validator->fails()) {
                $res['status'] = 0;
                $res['msg'] = convertArrayMessageToString($validator->errors()->all());
            } else {

                $formattedPhone = '+1' . str_replace(' ', '', $input['phone']);

                $phoneExists = Member_model::where('mem_phone', $formattedPhone)->exists();
                if($phoneExists){
                        $res['status'] = 0;
                        $res['phone_exists'] = 1;
                        // $res['msg'] = 'Phone already in use';
                        exit(json_encode($res));
                }
                $member = Member_model::where('id', $member->id)->get()->first();
                $input = $request->all();
                $member->mem_fullname = $input['name'];
                $member->mem_phone = $formattedPhone;
                $member->mem_email = $input['email'];


                if ($request->hasFile('potrait')) {

                    $potrait =$request->file('potrait')->store('public/members/');
                    if(!empty(basename($potrait))){
                        $member->mem_image=basename($potrait);
                    }

                }

                $member->update();

                $res['status'] = 1;
                $res['msg'] = "Profile updated successfully!";
                $res['member'] = $member;
            }
        } else {
            $res['member'] = null;
        }

        exit(json_encode($res));
    }

    public function lead_request(Request $request)
    {
        $token = $request->input('token', null);
        $mem_id = 0;

        $member = $this->authenticate_verify_token($token);
        $res = array();
        $res['status'] = 0;
        $input = $request->all();
        // pr($input);

        if(empty($member)){

            $emailExists = Member_model::where('mem_email', $input['email'])->first();
            // pr($emailExists);
            if(!empty($emailExists)){
                $mem_id = $emailExists->id;

            }else{
                $res['new_email'] = 1;
            }

            // $res['status'] = 0;
            // $res['msg'] = 'Not a valid user. or token is invalid';
            // exit(json_encode($res));

        }else{
            $mem_id = intval($member->id);
        }

        if (!empty($input)) {
            $request_data = [
                'agent_mem_id' => 'required',
                // 'agent_id' => 'required',
                'full_name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'property_type' => 'required',
                // 'msg' => 'required',
                'objective' => 'required',

            ];

            if($input['objective'] == 'sell' && $input['objective'] == 'sell_and_buy'){
                $request_data['address'] = 'required';
            }

            if($input['objective'] == 'buy' && $input['objective'] == 'sell_and_buy'){
                $request_data['city_zip'] = 'required';
                $request_data['min_price_range'] = 'required';
                $request_data['max_price_range'] = 'required';
            }


            $validator = Validator::make($input, $request_data);
            // json is null
            if ($validator->fails()) {
                $res['status'] = 0;
                $res['msg'] = 'Error >>' . $validator->errors()->first();
            } else {

                $primaryPhone = '+1' . str_replace(' ', '', $input['phone']);


                $filter_arr = convert_filters_obj_to_text($input['filters']);
                $data = array(
                    'lead_id_no' => generateLeadIDNumber(),
                    'sender_id' => $mem_id > 0 ? $mem_id : null,
                    'agent_mem_id' => intval($input['agent_mem_id']),
                    // 'agent_id' => intval($input['agent_id']),
                    'full_name' => $input['full_name'],
                    'phone' => $primaryPhone,
                    'email' => $input['email'],
                    'property_type' => intval(get_property_type_id_by_slug($input['property_type'])),
                    'city_zip' => $input['city_zip'],
                    // 'min_price_range' => $input['min_price_range'],
                    // 'max_price_range' => $input['max_price_range'],
                    // 'address' => $input['address'],
                    'objective' => $input['objective'],
                    'status' => 'lead',
                    'view_status' => 0,
                    'msg' => !empty($input['msg']) ? $input['msg'] : 'N/A',
                    'lead_owner' => !empty($input['lead_owner']) ? $input['lead_owner'] : null,
                    'selected_filters' => $filter_arr,
                );

                if($input['objective'] == 'sell' || $input['objective'] == 'sell_and_buy'){
                    $data['address'] = $input['address'];
                }

                if($input['objective'] == 'buy' || $input['objective'] == 'sell_and_buy'){
                    // $data['city_zip'] = $input['city_zip'];
                    $data['min_price_range'] = $input['min_price_range'];
                    $data['max_price_range'] = $input['max_price_range'];
                }
                // pr($data);
                // DB::table('leads_requests')->insert($data);
                $lead = Leads_model::create($data);
                $lead_id = $lead->id;

                if ($lead_id > 0) {

                    $mem_profile = Agent_model::where('mem_id', intval($input['agent_mem_id']))->get()->first();


                    $chk_email = DB::table('send_lead_emails')->where('email', $data['email'])->get()->first();
                    $chk_email_log = DB::table('lead_email_logs')->where('email', $data['email'])->get()->first();


                    if(empty($chk_email) && empty($chk_email_log)){
                        DB::table('send_lead_emails')->insert(['mem_id' => $mem_id, 'lead_id' => intval($lead_id), 'duration' => '1hour', 'email_time' => date('Y-m-d H:i:s', strtotime('+1 hour')), 'email' => $data['email'] ]);
                        DB::table('send_lead_emails')->insert(['mem_id' => $mem_id, 'lead_id' => intval($lead_id), 'duration' => '24hours', 'email_time' => date('Y-m-d H:i:s', strtotime('+24 hours')), 'email' => $data['email']]);
                        DB::table('send_lead_emails')->insert(['mem_id' => $mem_id, 'lead_id' => intval($lead_id), 'duration' => '72hours', 'email_time' => date('Y-m-d H:i:s', strtotime('+72 hours')), 'email' => $data['email']]);
                        DB::table('send_lead_emails')->insert(['mem_id' => $mem_id, 'lead_id' => intval($lead_id), 'duration' => '1week', 'email_time' => date('Y-m-d H:i:s', strtotime('+1 week')), 'email' => $data['email']]);
                    }





                    $email_data=array(
                        'email_to'=>$mem_profile->memberRow->mem_email,
                        'email_to_name'=>$mem_profile->agent_name,
                        'email_from'=>$this->data['site_settings']->site_noreply_email  ,
                        'email_from_name'=>$this->data['site_settings']->site_name,
                        'subject'=>'New Veerra Lead',

                        'full_name' => $lead->full_name,
                        'phone' => $lead->phone,
                        'objective' => $lead->objective,
                        'property_type' => get_property_type_name($lead->property_type),
                        'location' => get_area_seved_name($lead->city_zip),
                        'address' => $lead->address,
                        'min_price_range' => $lead->min_price_range,
                        'max_price_range' => $lead->max_price_range,
                        'msg' => $lead->msg,
                        'filters' => $filter_arr,

                    );
                    send_email($email_data,'agent_contact_lead');

                    if($mem_profile->agent_role == 'team_member'){
                        // pr('hi');
                        $team_mem = Team_member_model::where(['team_member_id' => $mem_profile->mem_id])->first();
                        // pr($team_mem);
                        if(!empty($team_mem)){
                            $team_data = Teams_model::where('team_code', $team_mem->team_code)->first();
                            // pr($team_data);
                           if(!empty($team_data->leader_row)){
                            $leader_row = $team_data->leader_row;
                            // pr($leader_row);
                            $leader_email_data=array(
                                'email_to'=>$leader_row->member_row->mem_email,
                                'email_to_name'=>$leader_row->member_row->agent_row->agent_name,
                                'email_from'=>$this->data['site_settings']->site_noreply_email  ,
                                'email_from_name'=>$this->data['site_settings']->site_name,
                                'subject'=>'New Veerra Lead for one of your Team Members',
                                'team_member_name' => $mem_profile->agent_name,
                                'full_name' => $lead->full_name,
                                'phone' => $lead->phone,
                                'objective' => $lead->objective,
                                'property_type' => get_property_type_name($lead->property_type),
                                'location' => get_area_seved_name($lead->city_zip),
                                'address' => $lead->address,
                                'min_price_range' => $lead->min_price_range,
                                'max_price_range' => $lead->max_price_range,
                                'msg' => $lead->msg,
                                'filters' => $filter_arr,

                            );
                            // pr($leader_email_data);

                            send_email($leader_email_data,'team_leader_contact_lead');
                           }

                        }
                    }

                    //Sms to contacted agent
                    $msg = "";
                    $msg .= 'Hello '.$mem_profile->agent_name.', new Veerra lead!';
                    $msg .= "\n\n";
                    $msg .= 'Name: '. $lead->full_name;
                    $msg .= "\n";
                    $msg .= 'Phone: '. formatPhoneNumberUSA($lead->phone);
                    $msg .= "\n";
                    $msg .= 'Objective: '. getEmailObjectiveKeyword($lead->objective, get_property_type_name($lead->property_type), get_area_seved_name($lead->city_zip));
                    $msg .= "\n\n";
                    $msg .= 'Check email for full details.';
                    $msg .= "\n\n";


                // pr($msg);

                        $smsData = [
                            'message' => $msg,
                            'receiver' => $mem_profile->memberRow->mem_phone,
                        ];

                        sendMsg($smsData);

                    $res['status'] = 1;
                    $res['msg'] = 'Request submitted successfully!';
                } else {
                    $res['msg'] = 'Technical problem!';
                }
            }
        }
        exit(json_encode($res));
    }

    public function saveReview(Request $request)
    {
        $token = $request->input('token', null);
        $member = $this->authenticate_verify_token($token);
        $res = array();
        $res['status'] = 0;
        $input = $request->all();
        $mem_id = intval($member->id);

        if(empty($member)){
            $res['status'] = 0;
            $res['msg'] = 'Not a valid user. or token is invalid';
            exit(json_encode($res));

        }

        if (!empty($member)) {
            $request_data = [
                'agent_mem_id' => 'required',
                // 'lead_id_no' => 'required',
                'city_zip' => 'required',
                'property_type' => 'required',
                'review' => 'required',
                'rating' => 'required',
                'review_type' => 'required',
                'objective' => 'required',

            ];
            if($input['profile_review'] == false || $input['profile_review'] == 'false'){
                $request_data['lead_id_no'] = 'required';
            }

            $validator = Validator::make($input, $request_data);
            // json is null
            if ($validator->fails()) {
                $res['status'] = 0;
                $res['msg'] = 'Error >>' . $validator->errors()->first();
            } else {
                // pr($input);
                if($input['profile_review'] == false || $input['profile_review'] == 'false'){
                    $lead_data = Leads_model::where(['lead_id_no' => $input['lead_id_no']])->get()->first();
                    if(empty($lead_data)){
                        $res['status'] = 0;
                        $res['msg'] = 'Invalid Lead ID';
                        exit(json_encode($res));

                    }
                }


                $data = array(
                    'lead_id_no' => $input['profile_review'] == false || $input['profile_review'] == 'false' ? $lead_data->lead_id_no : null ,
                    'sender_id' => intval($mem_id),
                    'agent_mem_id' => intval($input['agent_mem_id']),
                    'city_zip' => $input['city_zip'],
                    'property_type' => intval($input['property_type']),
                    'objective' => $input['objective'],
                    'review' => $input['review'],
                    'rating' => floatval($input['rating']),
                    'review_type' => $input['review_type'],
                    'status' => '1',
                    'complete_trxn' => intval($input['complete_trxn']) > 0 ? 1 : 0,
                    'sender_name' => $member->mem_fullname,
                );
                // pr($data);

                $review = Reviews_model::create($data);
                $review_id = $review->id;

                if ($review_id > 0) {

                    $res['status'] = 1;
                    $res['msg'] = 'Review submitted successfully!';
                } else {
                    $res['msg'] = 'Technical problem!';
                }
            }
        }
        exit(json_encode($res));
    }

    public function deleteReview(Request $request)
    {
        $token = $request->input('token', null);
        $member = $this->authenticate_verify_token($token);
        $res = array();
        $res['status'] = 0;
        $input = $request->all();
        $mem_id = intval($member->id);

        if(empty($member)){
            $res['status'] = 0;
            $res['msg'] = 'Not a valid user. or token is invalid';
            exit(json_encode($res));

        }
        $review_row = Reviews_model::where('id', intval($input['review_id']))->first();
        // pr($review_row);
        if(empty($review_row)){
            $res['status'] = 0;
            $res['msg'] = 'Invalid request';
            exit(json_encode($res));

        }

        if (!empty($member) && !empty($review_row)) {

            try {
                // Attempt to delete review
                $review_row->delete();
                $res['status'] = 1;
                $res['msg'] = 'Review Deleted';
            } catch (\Exception $e) {
                // Catch any error during deletion
                $res['status'] = 0;

                $res['msg'] = 'Failed to delete the review';
            }


        }
        exit(json_encode($res));
    }

}

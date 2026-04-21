<?php

namespace App\Http\Controllers;

use App\Models\Agent_model;
use App\Models\Member_model;
use Illuminate\Http\Request;
use App\Models\Contact_model;
use App\Models\Newsletter_model;
use App\Models\Mem_id_verifications_model;
use App\Models\Solo_model;
use App\Models\Team_leader_model;
use App\Models\Team_member_model;
use App\Models\Teams_model;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class User_auth extends Controller
{
    public function signup(Request $request)
    {
        $res = array();
        $res['status'] = 0;
        $input = $request->all();

        if ($input) {

            $request_data = [
                'email' => 'required|email|unique:members,mem_email',
                'name' => 'required',
                // 'phone' => 'required|unique:members,mem_phone',
                'password' => 'required',
                'confirm_password' => 'required|same:password',
            ];


            $validator = Validator::make($input, $request_data);
            // json is null
            if ($validator->fails()) {
                $res['status'] = 0;
                $res['msg'] = convertArrayMessageToString($validator->errors()->all());
            } else {
                $data = array(
                    'mem_type' => 'client',
                    'mem_fullname' => $input['name'],
                    'mem_email' => $input['email'],
                    // 'mem_phone'=>$input['phone'],
                    'mem_password' => md5($input['password']),
                    'otp' => random_int(100000, 999999),
                    // 'otp_phone'=>random_int(100000, 999999),
                    'otp_expire' => date('Y-m-d H:i:s', strtotime('+5 minute')),
                    'mem_status' => 1,
                    'mem_username' => convertEmailToUsername($input['email']),
                    'mem_image' => '',
                    // 'mem_agent_id' => generateUniqueUserId($input['name'])
                );

                // pr($data);
                $mem_data = Member_model::create($data);
                $mem_id = $mem_data->id;
                if ($mem_id > 0) {
                    $token = $mem_id . "-" . doEncode($input['email']) . "-" . $data['mem_type'] . "-" . rand(99, 999);
                    $userToken = encrypt_string($token);
                    $token_array = array(
                        'mem_type' => $data['mem_type'],
                        'token' => $userToken,
                        'mem_id' => $mem_id,
                        'expiry_date' => date("Y-m-d", strtotime("6 months")),
                    );
                    DB::table('tokens')->insert($token_array);
                    $email_data = array(
                        'email_to' => $data['mem_email'],
                        'email_to_name' => $data['mem_fullname'],
                        'email_from' => $this->data['site_settings']->site_noreply_email,
                        'email_from_name' => $this->data['site_settings']->site_name,
                        'subject' => 'Email Verification',
                        // 'link' => config('app.react_url') . "/verification/" . $userToken,
                        'code'=>$data['otp'],
                    );
                    $email = send_email($email_data, 'account');

                    updateLeadsMemId($data['mem_email'], $mem_id);
                    // pr($email);

                    // die('here');

                    $res['expire_time'] = $data['otp_expire'];

                    $res['mem_type'] = $data['mem_type'];
                    $res['authToken'] = $userToken;
                    $res['status'] = 1;
                    $res['msg'] = 'Thanks for signing up! We sent a verification code to your email. If you don’t see the email, check your spam folder.';
                } else {
                    $res['status'] = 0;
                    $res['msg'] = 'Technical problem!';
                }
            }
        }
        exit(json_encode($res));
    }

    public function checkAccountExsist(Request $request)
    {
        $res = array();
        $res['status'] = 0;
        $input = $request->all();

        if ($input) {

            $request_data = [
                'email' => 'required|email',
                'phone' => 'required',
                // 'potrait' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3096',

            ];
            // $messages = [
            //     'potrait.max' => 'The potrait must not be greater than 3 MB.',
            // ];


            $validator = Validator::make($input, $request_data);
            // json is null
            if ($validator->fails()) {
                $res['status'] = 0;
                $res['msg'] = convertArrayMessageToString($validator->errors()->all());
            } else {
                // pr($input);

                $formattedPhone = '+1' . str_replace(' ', '', $input['phone']);
                // pr($formattedPhone);
                $emailExists = Member_model::where('mem_email', $input['email'])->exists();
                $phoneExists = Member_model::where('mem_phone', $formattedPhone)->exists();

                if(empty($input['token'])){
                    if($emailExists){
                        $res['status'] = 0;
                        $res['email_exists'] = 1;
                        $res['invalid_invitation_code'] = 0;
                        $res['msg'] = 'Account already exists. If you are currently not an agent, sign in to your existing account and return to this page.';
                        exit(json_encode($res));
                    }

                    if($phoneExists){
                        $res['status'] = 0;
                        $res['phone_exists'] = 1;
                        $res['invalid_invitation_code'] = 0;
                        $res['msg'] = 'Primary phone number already in use. Please use a different phone number.';
                        exit(json_encode($res));
                    }
                }

                if (!empty($input['invitation_code']) ) {
                    $chkInvite = Agent_model::where('invitation_code', $input['invitation_code'])->get()->first();
                    // pr($chkInvite);
                    if(empty($chkInvite)){
                        $res['status'] = 0;
                        $res['invalid_invitation_code'] = 1;
                        $res['msg'] = 'Invalid invitation code. or Invitation code not exsist. Enter a valid invitation code. or leave it empty.';
                        exit(json_encode($res));
                    }
                }



//                 if (!isset($request->potrait)) {
//                     $res['status'] = 0;
//                     $res['msg'] = 'Please upload professional portrait.';
//                     $res['file_err'] = 1;
//                     exit(json_encode($res));
//                 }else{
//                     $potrait = $request->file('potrait');
// // pr($potrait);
//                     // Check if file is an image
//                     $allowedMimes = ['jpeg', 'png', 'jpg', 'gif', 'svg'];
//                     // pr($potrait->getClientOriginalExtension());
//                     if (!in_array($potrait->getClientOriginalExtension(), $allowedMimes)) {
//                         $res['status'] = 0;
//                         $res['msg'] = 'The professional portrait must be an image of type jpeg, png, jpg, gif, or svg.';
//                         $res['file_err'] = 1;
//                         exit(json_encode($res));
//                     }
//                     pr($potrait->getSize());

//                     // Check file size (3MB = 3 * 1024 * 1024 bytes)
//                     $maxFileSize = 3 * 1024 * 1024; // 3MB
//                     if ($potrait->getSize() > $maxFileSize) {
//                         $res['status'] = 0;
//                         $res['msg'] = 'Your professional portrait must be less than 3 MB.';
//                         $res['file_err'] = 1;
//                         exit(json_encode($res));
//                     }
//                 }





                    $res['status'] = 1;
                    $res['new'] = 1;

            }
        }
        exit(json_encode($res));
    }

    public function agentSignup(Request $request)
    {
        $res = array();
        $res['status'] = 0;
        $input = $request->all();
        // pr($input);

        if ($input) {
            $request_data = [
                'email' => 'required|email',
                'name' => 'required',
                'brokerage_name' => 'required',
                'brokerage_location' => 'required',
                'city' => 'required',
                'state' => 'required',
                'zip' => 'required',
                'agent_since_month' => 'required',
                'agent_since_year' => 'required',
                'about' => 'required',
                // 'primary_timezone' => 'required',
                'agent_role' => 'required',
                'brokerage_phone' => 'required',
                'primary_phone' => 'required',
                'agree' => 'required',

                 // Adding validation for arrays
                'license_no' => 'required|array|min:1',
                'license_no.*' => 'required|string', // Validates each license_no element

                'license_month' => 'required|array|min:1',
                'license_month.*' => 'required|string|between:1,12', // Validates each license_month element

                'license_day' => 'required|array|min:1',
                'license_day.*' => 'required|string|between:1,31', // Validates each license_day element

                'license_year' => 'required|array|min:1',
                'license_year.*' => 'required|string', // Validates each license_year element

                'license_state' => 'required|array|min:1',
                'license_state.*' => 'required|string', // Validates each license_state element

                're_specialties' => 'required|array|min:1',
                're_specialties.*' => 'required', // Validates each re_specialties element

                'areas_served' => 'required|array|min:1',
                'areas_served.*' => 'required', // Validates each areas_served element

                'languages' => 'required|array|min:1',
                'languages.*' => 'required', // Validates each languages element
                'potrait' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3096',
            ];

            if (isset($input['password'])) {
                $request_data['password'] = 'required';
            }

            if ($input['agent_role'] === 'solo_agent' || $input['agent_role'] == 'team_leader') {
                $request_data = array_merge($request_data, [
                    'base_commission_rate' => 'required|numeric',
                    'sell_service' => 'required|array',
                    'sell_service.*' => 'required|string',
                    'sell_cost_struct' => 'required|array',
                    'sell_cost_struct.*' => 'required|string',
                    'sell_amount' => 'required|array',
                    'sell_amount.*' => 'required|string',
                    'buy_service' => 'required|array',
                    'buy_service.*' => 'required|string',
                    'buy_cost_struct' => 'required|array',
                    'buy_cost_struct.*' => 'required|string',
                    'buy_amount' => 'required|array',
                    'buy_amount.*' => 'required|string',
                    'unique_value' => 'required|string',
                ]);
            }

            if ($input['agent_role'] === 'team_member') {
                $request_data = array_merge($request_data, [
                    'team_code' => 'required',

                ]);
            }


            $validator = Validator::make($input, $request_data);
            // json is null
            if ($validator->fails()) {
                $res['status'] = 0;
                $res['msg'] = convertArrayMessageToString($validator->errors()->all());
            } else {
                // pr($input);
                $primaryPhone = '+1' . str_replace(' ', '', $input['primary_phone']);
                $brokerPhone = '+1' . str_replace(' ', '', $input['brokerage_phone']);

                if ($input['agent_role'] === 'team_member' && !empty($input['team_code'])) {
                    $chkTeam = Teams_model::where('team_code', $input['team_code'])->get()->first();
                    // pr($chkTeam);
                    if(empty($chkTeam)){
                        $res['status'] = 0;
                        $res['team_not_exsist'] = true;
                        $res['msg'] = 'Invalid team code, please try again.';
                        exit(json_encode($res));
                    }
                }

                if (!empty($input['invitation_code']) ) {
                    $chkInvite = Agent_model::where('invitation_code', $input['invitation_code'])->get()->first();
                    // pr($chkInvite);
                    if(empty($chkInvite)){
                        $res['status'] = 0;
                        $res['invalid_invitation_code'] = true;
                        $res['msg'] = 'Invalid invitation code. or Invitation code not exsist. Enter a valid invitation code. or leave it empty.';
                        exit(json_encode($res));
                    }
                }
                // pr('gdfg');

                if(empty($input['token'])){
                    // pr('hi');
                    $emailExists = Member_model::where('mem_email', $input['email'])->exists();
                    if($emailExists){
                        $res['status'] = 0;
                        $res['email_exists'] = true;
                        $res['msg'] = 'Email already exists. please login to your account or use another email. If you are not an agent but have an account login to account and try to become agent again.';
                        exit(json_encode($res));
                    }else{
                        $data = array(
                            'mem_type' => 'client',
                            'mem_fullname' => $input['name'],
                            'mem_email' => $input['email'],
                            'mem_phone'=>$primaryPhone,
                            'mem_password' => md5($input['password']),
                            'otp' => random_int(100000, 999999),
                            // 'otp_phone'=>random_int(100000, 999999),
                            'otp_expire' => date('Y-m-d H:i:s', strtotime('+5 minute')),
                            'mem_status' => 1,
                            'mem_username' => convertEmailToUsername($input['email']),
                            'mem_image' => '',
                            // 'mem_agent_id' => generateUniqueUserId()
                        );

                        if ($request->hasFile('potrait')) {

                            $potrait =$request->file('potrait')->store('public/members/');
                            if(!empty(basename($potrait))){
                                $data['mem_image']=basename($potrait);
                            }

                        }

                        // pr($data);
                        $mem_data = Member_model::create($data);
                        $mem_id = $mem_data->id;
                        if($mem_id > 0){
                            $email_data = array(
                                'email_to' => $data['mem_email'],
                                'email_to_name' => $data['mem_fullname'],
                                'email_from' => $this->data['site_settings']->site_noreply_email,
                                'email_from_name' => $this->data['site_settings']->site_name,
                                'subject' => 'Email Verification',
                                // 'link' => config('app.react_url') . "/verification/" . $userToken,
                                'code'=>$data['otp'],
                            );
                            $email = send_email($email_data, 'account');
                            $token = $mem_id . "-" . doEncode($input['email']) . "-" . $data['mem_type'] . "-" . rand(99, 999);
                            $userToken = encrypt_string($token);
                            $token_array = array(
                                'mem_type' => $data['mem_type'],
                                'token' => $userToken,
                                'mem_id' => $mem_id,
                                'expiry_date' => date("Y-m-d", strtotime("6 months")),
                            );
                            DB::table('tokens')->insert($token_array);
                            updateLeadsMemId($data['mem_email'], $mem_id);
                            $res['signup'] = true;
                            $res['expire_time'] = $data['otp_expire'];
                            $res['mem_type'] = $data['mem_type'];
                            $res['authToken'] = $userToken;
                        }
                    }
                }else{
                    // pr($input['token']);
                    $mem_data = $this->authenticate_verify_token($input['token']);
                    // pr($mem_data);
                    $res['authToken'] = $input['token'];
                    $res['mem_type'] = $mem_data->mem_type;
                }

                $mem_id = $mem_data->id;
                if ($mem_id > 0) {
                    // pr($mem_data);
                    $agent_data = [
                        'mem_id' => $mem_id,
                        'agent_user_id' => generateUniqueUserId(),
                        'agent_name' => $input['name'],
                        'brokerage_name' => $input['brokerage_name'],
                        'brokerage_location' => $input['brokerage_location'],
                        'brokerage_city' => $input['city'],
                        'brokerage_state' => $input['state'],
                        'brokerage_zip' => $input['zip'],
                        'brokerage_phone' => $brokerPhone,
                        'primary_phone' => $primaryPhone,
                        'experience_month' => $input['agent_since_month'],
                        'experience_year' => $input['agent_since_year'],
                        'about_agent' => $input['about'],
                        // 'primary_timezone' => $input['primary_timezone'],
                        'invitation_code' => generateInvitationCode(),
                        'refferd_invite_code' => $input['invitation_code'] ? $input['invitation_code'] : null,
                        'agent_role' => $input['agent_role'],
                        'status' => 1,
                    ];

                    // pr($agent_data);



                    // pr($agent_data);
                    $agent = Agent_model::create($agent_data);
                    $agent_id = $agent->id;

                    if($agent_id > 0){

                        if ($request->hasFile('potrait')) {
                            $potrait =$request->file('potrait')->store('public/members/');
                            if(!empty(basename($potrait))){
                                $mems['mem_image']=basename($potrait);
                            Member_model::where('id', $mem_id)->update($mems);

                            }


                        }

                        if (!empty($agent_data['refferd_invite_code']) ) {
                            $chkInviteAgent = Agent_model::where('invitation_code', $agent_data['refferd_invite_code'])->first();
                            // pr($chkInviteAgent);
                            if(!empty($chkInviteAgent)){
                                // pr('hi');
                                $referralCount = Agent_model::where('refferd_invite_code', $chkInviteAgent->invitation_code)->count();
                                // pr($referralCount);
                                if ($referralCount >= 5) {
                                    // pr('ggg');
                                    Agent_model::where('invitation_code', $agent_data['refferd_invite_code'])->update(['veerra_fied' => 1]);

                                }

                            }
                        }



                        // Update mem_type to 'agent_profile'
                            // 'mem_agent_id' => generateUniqueUserId()
                    Member_model::where('id', $mem_id)->update(['mem_type' => 'agent']);


                if(isset($input['property_type']) && !empty($input['property_type'])){
                    $property_types = array_map(function($item) {
                        // Ensure $item is decoded correctly if it’s a JSON string
                        $item = is_string($item) ? json_decode($item, true) : $item;

                        return [
                            'typ_id' => $item['typ_id'] ?? null,
                            'Sell' => $item['Sell'] ? $item['Sell'] : 0,
                            'Buy' => $item['Buy'] ? $item['Buy'] : 0
                        ];
                    }, $input['property_type']);
                    // pr($property_types);
                    foreach($property_types as $typ){

                        $property_data = [
                            'property_type_id' => $typ['typ_id'],
                            'mem_id' => $mem_id,

                        ];
                        if($typ["Sell"] == 1 && $typ['Buy'] == 1){
                            $property_data['type'] = 'sell_and_buy';
                        }elseif($typ["Sell"] == 1 && $typ['Buy'] == 0){
                            $property_data['type'] = 'sell';
                        }elseif($typ["Sell"] == 0 && $typ['Buy'] == 1){
                            $property_data['type'] = 'buy';
                        }else{
                            $property_data['type'] = null;

                        }

                        DB::table('agent_property_types')->insert($property_data);
                    }


                }

                        $license_data = [
                            'license_no' => $input['license_no'],
                            'expiry_month' => $input['license_month'],
                            'expiry_day' => $input['license_day'],
                            'expiry_year' => $input['license_year'],
                            'state' =>  $input['license_state'],
                        ];
                        saveAgentLicenseData($license_data, $agent_id, $mem_id);

                        foreach ($input['re_specialties'] as $specialty) {
                            DB::table('agent_re_specialties')->insert([
                                'mem_id' => $mem_id,


                                'speciality' => intval($specialty),
                            ]);
                        }

                        foreach ($input['areas_served'] as $area) {
                            DB::table('agent_areas_served')->insert([
                                'mem_id' => $mem_id,

                                'area' => str_replace('"', '', $area),
                            ]);
                        }

                        foreach ($input['languages'] as $language) {
                            DB::table('agent_languages')->insert([
                                'mem_id' => $mem_id,

                                'language' => intval($language),
                            ]);
                        }


                    if ($input['agent_role'] === 'solo_agent') {
                        $solo_data = [
                            'mem_id' => $mem_id,

                            'base_commission_rate' => floatval($input['base_commission_rate']),
                            'unique_value' => $input['unique_value'],
                            'role' => $input['agent_role'],
                        ];

                        $solo_row = Solo_model::create($solo_data);

                        $solo_id = $solo_row->id;

                        if($solo_id > 0){
                            $sell_addons = [
                                'sell_service' => $input['sell_service'],
                                'sell_cost_struct' => $input['sell_cost_struct'],
                                'sell_amount' => $input['sell_amount'],
                            ];
                            saveSoloAgentSellAddonsData($sell_addons, $solo_id, 'solo_agent');

                            $buy_addons = [
                                'buy_service' => $input['buy_service'],
                                'buy_cost_struct' => $input['buy_cost_struct'],
                                'buy_amount' => $input['buy_amount'],
                            ];
                            saveSoloAgentBuyAddonsData($buy_addons, $solo_id, 'solo_agent');

                        }

                    }

                    if ($input['agent_role'] === 'team_leader') {

                        $team = Teams_model::create(['team_code' => generateTeamCode(), 'status' => 1, 'team_name' => $input['team_name']]);
                        $leader_data = [
                            'mem_id' => $mem_id,

                            'team_code' => $team->team_code,
                            'base_commission_rate' => floatval($input['base_commission_rate']),
                            'unique_value' => $input['unique_value'],
                            'role' => $input['agent_role'],
                        ];
                        // pr($team);

                        $leader_row = Team_leader_model::create($leader_data);

                        $leader_id = $leader_row->id;
                        // pr($solo_id);
                        if($leader_id > 0){
                            Teams_model::where('team_code', $team->team_code)->update(['team_leader_id' => $leader_id]);
                            $sell_addons = [
                                'sell_service' => $input['sell_service'],
                                'sell_cost_struct' => $input['sell_cost_struct'],
                                'sell_amount' => $input['sell_amount'],
                            ];
                            saveTeamLeaderSellAddonsData($sell_addons, $leader_id, 'team_leader');

                            $buy_addons = [
                                'buy_service' => $input['buy_service'],
                                'buy_cost_struct' => $input['buy_cost_struct'],
                                'buy_amount' => $input['buy_amount'],
                            ];
                            saveTeamLeaderBuyAddonsData($buy_addons, $leader_id, 'team_leader');

                        }

                    }

                    if ($input['agent_role'] === 'team_member') {

                        $teamMem = Team_member_model::create(['team_code' => $input['team_code'], 'team_member_id' => $mem_id, 'role' => 'member', 'status' => 1]);
                        $teamMemID = $teamMem->id;

                        if($teamMemID > 0){

                            $leader_row = $chkTeam->leader_row;
                            $email_data=array(
                                'email_to'=>$leader_row->member_row->mem_email,
                                'email_to_name'=>$leader_row->member_row->agent_row->agent_name,
                                'email_from'=>$this->data['site_settings']->site_noreply_email,
                                'email_from_name'=>$this->data['site_settings']->site_name,
                                'subject'=>'New Team Member',
                                'team_member_name' => $teamMem->member_row->mem_fullname
                            );
                            // pr($email_data);

                            send_email($email_data,'new_team_member_join');
                        }
                    }

                    // pr('die');
                            $res['status'] = 1;
                            $res['mem_type'] = 'agent';
                            $res['msg'] = 'You registered as a '.getAgentRole($input['agent_role']).'.';

                    }



                } else {
                    $res['status'] = 0;
                    $res['msg'] = 'Technical problem!';
                }
            }
        }
        exit(json_encode($res));
    }

    public function verify_otp(Request $request){
        $res=array();
        $res['status']=0;
        $res['email_verify']=0;
        $input = $request->all();
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        // exit(json_encode($res));
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
                        $member_row->mem_phone_verified=0;
                        $member_row->mem_status=1;



                        $member_row->update();
                        $mem_id=$member->id;
                        $token=$mem_id."-".doEncode($member->mem_email)."-".$member->mem_type."-".rand(99,999);
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
                        $res['msg']='Email has been verified!';

                        if($member_row->mem_type == 'agent'){
                            $tempOTP = random_int(100000, 999999);

                            sendOTP($member_row->mem_phone, $tempOTP);

                            $member_row->otp_phone = $tempOTP;
                            $member_row->otp_expire=date('Y-m-d H:i:s', strtotime('+5 minute'));
                            $member_row->update();

                            $res['verify_phone'] = 1;
                        }

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

        exit(json_encode($res));
    }

    public function verify_phone_otp(Request $request){
        $res=array();
        $res['status']=0;
        $res['email_verify']=0;
        $input = $request->all();
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        // exit(json_encode($res));
        if(!empty($member)){
            if($input){
                    if(strtotime(date('Y-m-d H:i:s')) > strtotime(date('Y-m-d H:i:s',strtotime($member->otp_expire)))){
                        $res['msg']="Your code has expired, please press “Resend Code” for a new code.";
                        $res['status']=0;
                        $res['expired']=1;
                        exit(json_encode($res));
                    }


                    if(!empty($input['otp'])){

                        $member_row=Member_model::find($member->id);

                        $verified = verifyOtp($input['otp'],  $member_row->mem_phone, $member_row->otp_phone);

                        if($verified == 1 || $verified == '1' || $verified){
                            $member_row->otp_phone='';
                        $member_row->mem_phone_verified=1;
                        $member_row->mem_status=1;
                        $member_row->update();
                        $mem_id=$member->id;
                        $token=$mem_id."-".doEncode($member->mem_email)."-".$member->mem_type."-".rand(99,999);
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
                        $res['msg']='Your phone has been verified successfully!';
                        }else{
                            $res['status']=0;
                            $res['msg']='Verification code is invalid.';
                        }

                    exit(json_encode($res));
                    }
                else{
                    $res['status']=0;
                    $res['msg']='Verification code is invalid.';
                }

            }
        }
        else{
            $res['status']=0;
            $res['msg']='Something went wrong!';
        }

        exit(json_encode($res));
    }


    public function resend_email(Request $request){
        $res=array();
        $res['status']=0;
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        if(!empty($member)){
            $memberRow=Member_model::where(['id' => $member->id])->get()->first();
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
            // if($email){
                $res['msg']="A new verification code has been sent to your email address.";
                $res['status']=1;
            // }
            // else{
            //     $res['msg']="Email could not be sent!";
            // }

        }
        else{
            $res['member']=null;
        }

        exit(json_encode($res));
    }

    public function resend_phone_code(Request $request){
        $res=array();
        $res['status']=0;
        $token=$request->input('token', null);
        $member=$this->authenticate_verify_token($token);
        if(!empty($member)){
            $memberRow=Member_model::where(['id' => $member->id])->get()->first();
            $otp=random_int(100000, 999999);
            $memberRow->otp_phone=$otp;
            sendOTP($memberRow->mem_phone, $otp);
            $memberRow->otp_expire=date('Y-m-d H:i:s', strtotime('+5 minute'));
            $memberRow->update();
            $res['expire_time']=$memberRow->otp_expire;

            $res['msg']="A new verification code has been sent to your phone number.";
            $res['status']=1;

        }
        else{
            $res['member']=null;
        }

        exit(json_encode($res));
    }

    public function login(Request $request){
        $res=array();
        $res['status']=0;
        $res['google_status']=0;
        $input = $request->all();

        if($input){
                $request_data = [
                    'email' => 'required|email',
                    'password' => 'required',
                ];
            $validator = Validator::make($input, $request_data);
            // json is null
            if ($validator->fails()) {
                $res['status']=0;
                $res['msg']='Error >>'.$validator->errors();
            }
            else{
                    $member=Member_model::where(['mem_email' => $input['email'],'mem_password'=>md5($input['password'])])->get()->first();
                    if(!empty($member)){
                        if($member->mem_status==1){

                            $mem_id=$member->id;

                            $token=$mem_id."-".doEncode($member->mem_email)."-".$member->mem_type."-".rand(99,999);
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


                            if($member->mem_verified==1){
                                $res['user_id']=$member->id;
                                $res['status']=1;
                                $res['msg']='Logged In successfully!';
                            }else{
                                $res['not_verified']=true;

                                $res['user_id']=$member->id;
                                $res['status']=1;
                                $res['msg']='Logged In successfully!';
                            }

                        }
                        else{
                            $res['msg']='Your account is not active right now. Ask website admit to activate your account!';
                        }
                    }
                    else{
                        $res['msg']='Email or password is not correct. Please try again!';
                    }


            }
        }
        exit(json_encode($res));
    }

    public function forget_password(Request $request){
        $res=array();
        $res['status']=0;
        $input = $request->all();
        if($input){
            $request_data = [
                'email' => 'required|email',
            ];
            $validator = Validator::make($input, $request_data);
            // json is null
            if ($validator->fails()) {
                $res['status']=0;
                $res['msg']=convertArrayMessageToString($validator->errors()->all());
            }
            else{
                $member=Member_model::where(['mem_email' => $input['email']])->get()->first();
                if(!empty($member)){
                    if($member->mem_status==1){

                        $mem_id=$member->id;
                        $token=$mem_id."-".doEncode($member->mem_email)."-".$member->mem_type."-".rand(99,999);
                        $userToken=encrypt_string($token);
                        $token_array=array(
                            'mem_type'=>$member->mem_type,
                            'token'=>$userToken,
                            'mem_id'=>$mem_id,
                            'expiry_date'=>date("Y-m-d", strtotime("6 months")),
                        );
                        DB::table('tokens')->insert($token_array);
                        $verify_link=config('app.react_url')."/reset-password/".$userToken;
                        $res['verify_link']=$verify_link;
                        $email_data=array(
                            'email_to'=>$member->mem_email,
                            'email_to_name'=>$member->mem_fullname,
                            'email_from'=>$this->data['site_settings']->site_noreply_email  ,
                            'email_from_name'=>$this->data['site_settings']->site_name,
                            'subject'=>'Password Reset Request',
                            'link'=>$verify_link,
                            // 'code'=>$data['otp'],
                        );
                        send_email($email_data,'forget');
                        $res['status']=1;
                        $res['msg']='Email has been sent to reset your password.';
                    }
                    else{
                        $res['msg']='Your account is not active right now. Ask website admit to activate your account!';
                    }
                }
                else{
                    $res['msg']='Email does not exist.';
                }
            }
        }
        exit(json_encode($res));
    }

    public function reset_password(Request $request,$token){
        $res=array();
        $res['status']=0;
        $member=$this->authenticate_verify_token($token);
        if($member){
            if($member=='expired'){
                $res['msg']="Link timeout. Send request again to reset your password.";
            }
            else{
                // pr($member);
                $input = $request->all();
                if($input){
                    $request_data = [
                        'password' => 'required',
                        'confirm_password' => 'required|same:password',
                    ];
                    $validator = Validator::make($input, $request_data);
                    // json is null
                    if ($validator->fails()) {
                        $res['status']=0;
                        $res['msg']=convertArrayMessageToString($validator->errors()->all());
                    }
                    else{
                        $member->mem_password=md5($input['password']);
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

                        $res['msg']="Password reset successfully!";
                        $res['status']=1;
                    }
                }
                else{
                    $res['msg']='Nothing to reset';
                }
            }

        }
        else{
            $res['msg']='Token is expired or this user does not exist.';
            $res['status']=0;
        }

        exit(json_encode($res));
    }

}

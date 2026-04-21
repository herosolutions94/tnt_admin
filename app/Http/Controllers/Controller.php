<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Leads_model;
use App\Models\Member_model;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct()
    {
        $this->data['site_settings'] = $this->getSiteSettings();
        $this->data['enable_editor'] = false;
        $this->data['enable_listing_script'] = false;
        $this->data['all_pages'] = get_pages();
        // $this->checkAchPaymentStatus();
        // $this->checkLeasePayments();
        // pr(phpinfo());


    }


    function checkIfItemsExist($array1, $array2)
    {
        $intersection = array_intersect($array1, $array2);
        return !empty($intersection);
    }


    public function getSiteSettings()
    {
        return Admin::where('id', '=', 1)->first();
    }
    public function getMember($mem_id, $mem_email)
    {
        return Member_model::where(['id' => $mem_id, 'mem_email' => $mem_email])->get()->first();
    }
    public function payment_methods_loop($payment_methods)
    {
        $member_payment_methods_arr = array();
        foreach ($payment_methods as $payment_method) {
            if ($payment_method->payment_method == 'credit-card') {
                $payment_method->encoded_id = doEncode($payment_method->id);
                $payment_method->payment_method_id = doDecode($payment_method->payment_method_id);
                $payment_method->customer_id = doDecode($payment_method->customer_id);
                $payment_method->card_number = doDecode($payment_method->card_number);
                $payment_method->card_brand = doDecode($payment_method->card_brand);
                $payment_method->card_exp_month = doDecode($payment_method->card_exp_month);
                $payment_method->card_exp_year = doDecode($payment_method->card_exp_year);
                $payment_method->setup_id = doDecode($payment_method->setup_id);
                $payment_method->card_holder_name = ucfirst($payment_method->card_holder_name);
            }

            $member_payment_methods_arr[] = $payment_method;
        }
        return $member_payment_methods_arr;
    }
    // public function authenticate_verify_token($token){
    //     // pr($userToken= DB::table('tokens')->where('token', $token)->first());
    //     if(!empty($token) && $userToken= DB::table('tokens')->where('token', $token)->first()){
    //         $toke_expiry = date('Y-m-d',strtotime($userToken->expiry_date));
    //         if(strtotime($toke_expiry)<=strtotime(date('Y-m-d'))){
    //         // pr('hi');

    //             $res['error']   = 1;
    //             $res['errorType'] = 'expired';
    //             $res['message'] = 'Token has been expired.';
    //             return $res;
    //             exit;
    //         }
    //         else{
    //         // pr('hi');

    //             $token_parts=decrypt_string($userToken->token);
    //             $token_array=explode("-",$token_parts);
    //             $member=$this->getMember($token_array[0],$token_array[1]);

    //             if(!empty($member)){
    //                 // $member->payment_methods=$this->payment_methods_loop($member->payment_methods);
    //                 // $mem_name=explode(" ",$member->mem_fullname);
    //                 // $member->mem_fname=$mem_name[0];
    //                 // $member->mem_lname=$mem_name[1];
    //                 return $member;
    //             }


    //             else{
    //                 $res['error'] = 1;
    //                 $res['errorType'] = 'invalid_token';
    //                 $res['message'] = 'Invalid token';
    //                 return $res;
    //                 exit;
    //             }
    //         }
    //     }
    //     else{
    //         $res['error'] = 1;
    //         $res['errorType'] = 'invalid_token';
    //         $res['message'] = 'Invalid token';
    //         return $res;
    //         exit;
    //     }
    // }
    public function authenticate_verify_token($token)
    {
        // pr($userToken= DB::table('tokens')->where('token', $token)->first());
        if (!empty($token) && $userToken = DB::table('tokens')->where('token', $token)->first()) {
            // pr($userToken);
            $toke_expiry = date('Y-m-d', strtotime($userToken->expiry_date));
            // pr($toke_expiry);
            if (strtotime($toke_expiry) <= strtotime(date('Y-m-d'))) {
                return false;
            } else {
                // pr('hi');
                $token_parts = decrypt_string($userToken->token);
                $token_array = explode("-", $token_parts);
                // pr($token_array);
                $token_array[1] = doDecode($token_array[1]);
                $member = $this->getMember($token_array[0], $token_array[1]);
                // pr($member);
                // die('here');
                if (!empty($member)) {
                    // $member->payment_methods=$this->payment_methods_loop($member->payment_methods);
                    // $mem_name=explode(" ",$member->mem_fullname);
                    // $member->mem_fname=$mem_name[0];
                    // $member->mem_lname=$mem_name[1];
                    return $member;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }
    public function authenticate_verify_email_token($token)
    {
        if (!empty($token) && $userToken = DB::table('tokens')->where('token', $token)->first()) {
            $toke_expiry = date('Y-m-d H:i:s', strtotime($userToken->expiry_date));
            if (strtotime($toke_expiry) <= strtotime(date('Y-m-d'))) {
                return false;
            } else {
                $token_parts = decrypt_string($userToken->token);
                $token_array = explode("-", $token_parts);
                $member = $this->getMember($token_array[0], $token_array[1]);
                if (!empty($member)) {
                    return $member;
                } else {
                    return false;
                }
            }
        }
    }

    public function unsbscribe_leads_emails(Request $request, $email)
    {

        try {
            $email = doDecode($email);

            // Remove the user from the `send_lead_emails` table
            $deleted = DB::table('send_lead_emails')->where('email', $email)->delete();
            $deleted_log = DB::table('lead_email_logs')->where('email', $email)->delete();


            if ($deleted && $deleted_log) {
                return 'You have successfully unsubscribed.';
            } else {
                return 'Email not found or already unsubscribed.';
            }
        } catch (\Exception $e) {
            // Log the exception
            $logFile = public_path('email_logs/unsubscribe_email_log.txt');
            file_put_contents(
                $logFile,
                '[' . now() . "] Unsubscribe Error for Email:". doDecode($email) ." - {$e->getMessage()}\n",
                FILE_APPEND
            );

            return 'An error occurred while processing your request.';
        }
    }

    public function process_leads_emails()
    {
        $now = now();

        try {
            $emailsToSend = DB::table('send_lead_emails')->where('email_time', '<=', $now)->get();

            if ($emailsToSend->isNotEmpty()) {
                foreach ($emailsToSend as $val) {
                    try {
                        $lead = Leads_model::find($val->lead_id);

                        if (!empty($lead)) {

                            $emailData = [
                                'email_to' => $lead->email,
                                'email_to_name' => $lead->full_name,
                                'email_from' => $this->data['site_settings']->site_noreply_email,
                                'email_from_name' => $this->data['site_settings']->site_name,
                                'agent_name' => $lead->agentRow->agent_name,
                            ];

                            switch ($val->duration){
                                case '1hour';
                                    $logFile = public_path('email_logs/1hour_email_error_log.txt');
                                    $content = get_email_content('email_1hour');
                                    $emailData['subject'] =  $content['email_subject'] ? $content['email_subject'] : 'Thanks for reaching out to an agent on Veerra!';
                                    $emailData['email_body'] =  $content['email_body'] ? $content['email_body'] : 'Email Body Deprecated';
                                    $emailData['greeting'] =  $content['email_greeting'] ? $content['email_greeting'] : 'Hello';
                                    $template = 'lead_email_1hour';
                                    break;
                                case '24hours';
                                    $logFile = public_path('email_logs/24hours_email_error_log.txt');
                                    $content = get_email_content('email_24hours');
                                    $emailData['subject'] =  $content['email_subject'] ? $content['email_subject'] : 'Discover More Agents on Veerra';
                                    $emailData['email_body'] =  $content['email_body'] ? $content['email_body'] : 'Email Body Deprecated';
                                    $emailData['greeting'] =  $content['email_greeting'] ? $content['email_greeting'] : 'Hello';
                                    $template = 'lead_email_24hours';
                                    break;
                                case '72hours';
                                    $logFile = public_path('email_logs/72hours_email_error_log.txt');
                                    $content = get_email_content('email_72hours');
                                    $emailData['subject'] =  $content['email_subject'] ? $content['email_subject'] : 'Did Any Agents Contact You?';
                                    $emailData['email_body'] =  $content['email_body'] ? $content['email_body'] : 'Email Body Deprecated';
                                    $emailData['greeting'] =  $content['email_greeting'] ? $content['email_greeting'] : 'Hello';
                                    $template = 'lead_email_72hours';
                                    break;
                                case '1week';
                                    $logFile = public_path('email_logs/1week_email_error_log.txt');
                                    $content = get_email_content('email_1week');
                                    $emailData['subject'] =  $content['email_subject'] ? $content['email_subject'] : 'Still Looking to Find the Perfect Agent?';
                                    $emailData['email_body'] =  $content['email_body'] ? $content['email_body'] : 'Email Body Deprecated';
                                    $emailData['greeting'] =  $content['email_greeting'] ? $content['email_greeting'] : 'Hello';
                                    $template = 'lead_email_1week';
                                    break;

                                default:
                                echo 'false';
                            }

                            $e = send_email($emailData, $template);
                            if ($e === true || $e == 1) {
                                DB::table('lead_email_logs')->insert([
                                    'mem_id' => $val->mem_id,
                                    'lead_id' => $val->lead_id,
                                    'duration' => $val->duration,
                                    'email_time' => $val->email_time,
                                    'email' => $val->email,
                                ]);

                                DB::table('send_lead_emails')->where('id', $val->id)->delete();
                            }
                        }
                    } catch (\Exception $e) {
                        // Log exception for this email
                        file_put_contents(
                            $logFile,
                            '[' . now() . "] Email : {$val->email}, Lead ID: {$val->lead_id}, Email Time: {$val->email_time}, Error: {$e->getMessage()}\n",
                            FILE_APPEND
                        );
                    }
                }
            }
        } catch (\Exception $e) {
            // Log exception for the overall process
            file_put_contents(
                $logFile,
                '[' . now() . "] Duration: 1hour, General Error: {$e->getMessage()}\n",
                FILE_APPEND
            );
        }
    }

    public function process_leads_Emails_1hour()
    {
        $now = now();
        $logFile = public_path('email_logs/1hour_email_error_log.txt'); // Path to log file

        // pr($logFile);

        try {
            $emailsToSend = DB::table('send_lead_emails')
                ->where('email_time', '<=', $now)
                ->where('duration', '1hour')
                ->get();

            if ($emailsToSend->isNotEmpty()) {
                foreach ($emailsToSend as $val) {
                    try {
                        $lead = Leads_model::find($val->lead_id);

                        if (!empty($lead)) {
                            $content = get_email_content('email_1hour');

                            $emailData = [
                                'email_to' => $lead->email,
                                'email_to_name' => $lead->full_name,
                                'email_from' => $this->data['site_settings']->site_noreply_email,
                                'email_from_name' => $this->data['site_settings']->site_name,
                                'subject' => $content['email_subject'] ?: 'Thanks for reaching out to an agent on Veerra!',
                                'agent_name' => $lead->agentRow->agent_name,
                                'email_body' => $content['email_body'] ?: 'Email Body Deprecated',
                                'greeting' => $content['email_greeting'] ?: 'Hello',
                            ];

                            $template = 'lead_email_1hour';

                            $e = send_email($emailData, $template);
                            if ($e === true || $e == 1) {
                                DB::table('lead_email_logs')->insert([
                                    'mem_id' => $val->mem_id,
                                    'lead_id' => $val->lead_id,
                                    'duration' => $val->duration,
                                    'email_time' => $val->email_time,
                                    'email' => $val->email,
                                ]);

                                DB::table('send_lead_emails')->where('id', $val->id)->delete();
                            }
                        }
                    } catch (\Exception $e) {
                        // Log exception for this email
                        file_put_contents(
                            $logFile,
                            '[' . now() . "] Email : {$val->email}, Lead ID: {$val->lead_id}, Email Time: {$val->email_time}, Error: {$e->getMessage()}\n",
                            FILE_APPEND
                        );
                    }
                }
            }
        } catch (\Exception $e) {
            // Log exception for the overall process
            file_put_contents(
                $logFile,
                '[' . now() . "] Duration: 1hour, General Error: {$e->getMessage()}\n",
                FILE_APPEND
            );
        }
    }


    public function process_leads_Emails_24hours()
    {
        $now = now();
        $logFile = public_path('email_logs/24hours_email_error_log.txt'); // Path to log file

        // pr($logFile);

        try {
            $emailsToSend = DB::table('send_lead_emails')
                ->where('email_time', '<=', $now)
                ->where('duration', '24hours')
                ->get();

            if ($emailsToSend->isNotEmpty()) {
                foreach ($emailsToSend as $val) {
                    try {
                        $lead = Leads_model::find($val->lead_id);

                        if (!empty($lead)) {
                            $content = get_email_content('email_24hours');

                            $emailData = [
                                'email_to' => $lead->email,
                                'email_to_name' => $lead->full_name,
                                'email_from' => $this->data['site_settings']->site_noreply_email,
                                'email_from_name' => $this->data['site_settings']->site_name,
                                'subject' => $content['email_subject'] ?: 'Thanks for reaching out to an agent on Veerra!',
                                'agent_name' => $lead->agentRow->agent_name,
                                'email_body' => $content['email_body'] ?: 'Email Body Deprecated',
                                'greeting' => $content['email_greeting'] ?: 'Hello',
                            ];

                            $template = 'lead_email_24hours';

                            $e = send_email($emailData, $template);
                            if ($e === true || $e == 1) {
                                DB::table('lead_email_logs')->insert([
                                    'mem_id' => $val->mem_id,
                                    'lead_id' => $val->lead_id,
                                    'duration' => $val->duration,
                                    'email_time' => $val->email_time,
                                    'email' => $val->email,
                                ]);

                                DB::table('send_lead_emails')->where('id', $val->id)->delete();
                            }
                        }
                    } catch (\Exception $e) {
                        // Log exception for this email
                        file_put_contents(
                            $logFile,
                            '[' . now() . "] Email : {$val->email}, Lead ID: {$val->lead_id}, Email Time: {$val->email_time}, Error: {$e->getMessage()}\n",
                            FILE_APPEND
                        );
                    }
                }
            }
        } catch (\Exception $e) {
            // Log exception for the overall process
            file_put_contents(
                $logFile,
                '[' . now() . "] Duration: 1hour, General Error: {$e->getMessage()}\n",
                FILE_APPEND
            );
        }
    }

    public function process_leads_Emails_72hours()
    {
        $now = now();
        $logFile = public_path('email_logs/72hours_email_error_log.txt'); // Path to log file

        // pr($logFile);

        try {
            $emailsToSend = DB::table('send_lead_emails')
                ->where('email_time', '<=', $now)
                ->where('duration', '72hours')
                ->get();

            if ($emailsToSend->isNotEmpty()) {
                foreach ($emailsToSend as $val) {
                    try {
                        $lead = Leads_model::find($val->lead_id);

                        if (!empty($lead)) {
                            $content = get_email_content('email_72hours');

                            $emailData = [
                                'email_to' => $lead->email,
                                'email_to_name' => $lead->full_name,
                                'email_from' => $this->data['site_settings']->site_noreply_email,
                                'email_from_name' => $this->data['site_settings']->site_name,
                                'subject' => $content['email_subject'] ?: 'Thanks for reaching out to an agent on Veerra!',
                                'agent_name' => $lead->agentRow->agent_name,
                                'email_body' => $content['email_body'] ?: 'Email Body Deprecated',
                                'greeting' => $content['email_greeting'] ?: 'Hello',
                            ];

                            $template = 'lead_email_72hours';

                            $e = send_email($emailData, $template);
                            if ($e === true || $e == 1) {
                                DB::table('lead_email_logs')->insert([
                                    'mem_id' => $val->mem_id,
                                    'lead_id' => $val->lead_id,
                                    'duration' => $val->duration,
                                    'email_time' => $val->email_time,
                                    'email' => $val->email,
                                ]);

                                DB::table('send_lead_emails')->where('id', $val->id)->delete();
                            }
                        }
                    } catch (\Exception $e) {
                        // Log exception for this email
                        file_put_contents(
                            $logFile,
                            '[' . now() . "] Email : {$val->email}, Lead ID: {$val->lead_id}, Email Time: {$val->email_time}, Error: {$e->getMessage()}\n",
                            FILE_APPEND
                        );
                    }
                }
            }
        } catch (\Exception $e) {
            // Log exception for the overall process
            file_put_contents(
                $logFile,
                '[' . now() . "] Duration: 1hour, General Error: {$e->getMessage()}\n",
                FILE_APPEND
            );
        }
    }

    public function process_leads_Emails_1week()
    {
        $now = now();
        $logFile = public_path('email_logs/1week_email_error_log.txt'); // Path to log file

        // pr($logFile);

        try {
            $emailsToSend = DB::table('send_lead_emails')
                ->where('email_time', '<=', $now)
                ->where('duration', '1week')
                ->get();

            if ($emailsToSend->isNotEmpty()) {
                foreach ($emailsToSend as $val) {
                    try {
                        $lead = Leads_model::find($val->lead_id);

                        if (!empty($lead)) {
                            $content = get_email_content('email_1week');

                            $emailData = [
                                'email_to' => $lead->email,
                                'email_to_name' => $lead->full_name,
                                'email_from' => $this->data['site_settings']->site_noreply_email,
                                'email_from_name' => $this->data['site_settings']->site_name,
                                'subject' => $content['email_subject'] ?: 'Thanks for reaching out to an agent on Veerra!',
                                'agent_name' => $lead->agentRow->agent_name,
                                'email_body' => $content['email_body'] ?: 'Email Body Deprecated',
                                'greeting' => $content['email_greeting'] ?: 'Hello',
                            ];

                            $template = 'lead_email_1week';

                            $e = send_email($emailData, $template);
                            if ($e === true || $e == 1) {
                                DB::table('lead_email_logs')->insert([
                                    'mem_id' => $val->mem_id,
                                    'lead_id' => $val->lead_id,
                                    'duration' => $val->duration,
                                    'email_time' => $val->email_time,
                                    'email' => $val->email,
                                ]);

                                DB::table('send_lead_emails')->where('id', $val->id)->delete();
                            }
                        }
                    } catch (\Exception $e) {
                        // Log exception for this email
                        file_put_contents(
                            $logFile,
                            '[' . now() . "] Email : {$val->email}, Lead ID: {$val->lead_id}, Email Time: {$val->email_time}, Error: {$e->getMessage()}\n",
                            FILE_APPEND
                        );
                    }
                }
            }
        } catch (\Exception $e) {
            // Log exception for the overall process
            file_put_contents(
                $logFile,
                '[' . now() . "] Duration: 1hour, General Error: {$e->getMessage()}\n",
                FILE_APPEND
            );
        }
    }
}

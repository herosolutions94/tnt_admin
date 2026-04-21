<?php

namespace App\Http\Controllers;


use App\Models\Member_model;
use Illuminate\Http\Request;
use App\Models\Contact_model;
use App\Models\Request_Quote_model;
use App\Models\Newsletter_model;
use App\Models\Report_model;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Ajax extends Controller
{
    public function upload_editor_image(Request $request)
    {
        // Validate the request
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Get the uploaded file
        $file = $request->file('upload');

        // Generate a unique filename
        $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();

        // Store the file in the public directory (adjust the path as needed)
        $path = $file->storeAs('public/uploads', $filename);

        // Get the public URL of the stored file
        $url = asset('storage/uploads/' . $filename);

        // Return a JSON response with the URL
        return response()->json(['url' => $url]);
    }

    public function get_states($country_id)
    {
        $output = array();
        if ($country_id > 0 && $country_row = DB::table('countries')->where('id', $country_id)->first()) {
            $output = get_country_states($country_row->id);
        }

        exit(json_encode($output));
    }


    public function save_image(Request $request)
    {
        $token = $request->input('token', null);
        $member = $this->authenticate_verify_token($token);
        $res = array();
        $res['status'] = 0;
        if (!empty($member)) {
            $input = $request->all();
            if ($request->hasFile('image')) {

                $request_data = [
                    'image' => 'mimes:png,jpg,jpeg,svg,gif,webp|max:400000'
                ];
                $validator = Validator::make($input, $request_data);
                // json is null
                if ($validator->fails()) {
                    $res['status'] = 0;
                    $res['msg'] = 'Error >>' . $validator->errors()->first();
                } else {
                    $image = $request->file('image')->store('public/members/');
                    if (!empty(basename($image))) {
                        generateThumbnail('members', basename($image), 'avatar', 'large');
                        $member_row = Member_model::find($member->id);
                        $member_row->mem_image = basename($image);
                        $member_row->update();
                        $res['status'] = 1;
                        $res['mem_image'] = basename($image);
                    } else {
                        $res['msg'] = "Something went wrong while uploading image. Please try again!";
                    }
                }
            } else {
                $res['image'] = "Only images are allowed to upload!";
            }
        } else {
            $res['status'] = 0;
            $res['msg'] = 'Something went wrong!';
        }
        exit(json_encode($res));
    }

    public function upload_image(Request $request)
    {
        $res = array();
        $res['status'] = 0;
        $input = $request->all();
        $res['input'] = $input;
        if ($request->hasFile('image')) {
            $type = $input['type'];
            $file_type = $request->input('file_type', null);
            $res['type'] = 'public/' . $type . '/';
            if ($file_type == 'files'):
                $request_data = [
                    'image' => 'max:40000'
                ];
            else:
                $request_data = [
                    'image' => 'mimes:png,jpg,jpeg,svg,gif,webp|max:400000'
                ];

            endif;
            $validator = Validator::make($input, $request_data);
            // json is null
            if ($validator->fails()) {
                $res['status'] = 0;
                $res['msg'] = 'Error >>' . $validator->errors()->first();
            } else {
                $uploadedFile = $request->file('image');
                $image = $request->file('image')->store('public/' . $type . '/');
                $filename = $uploadedFile->getClientOriginalName();
                $res['image'] = $image;
                if (!empty(basename($image))) {
                    generateThumbnail($type, basename($image), 'square', 'large');
                    $res['status'] = 1;
                    $res['image_name'] = basename($image);
                    $res['file_name'] = $filename;
                    // $res['image_path']=storage_path('app/public/'.basename($image));
                } else {
                    $res['msg'] = "Something went wrong while uploading image. Please try again!";
                }
            }
        } else {
            $res['msg'] = "Only images are allowed to upload!";
        }

        exit(json_encode($res));
    }
    public function upload_file(Request $request)
    {
        $res = array();
        $res['status'] = 0;
        $input = $request->all();
        if ($request->hasFile('file')) {

            $request_data = [
                'file' => 'max:40000'
            ];
            $validator = Validator::make($input, $request_data);
            // json is null
            if ($validator->fails()) {
                $res['status'] = 0;
                $res['msg'] = 'Error >>' . $validator->errors()->first();
            } else {
                $image = $request->file('file')->store('public/attachments/');
                $res['file_name'] = $_FILES['file']['name'];
                $res['file'] = $image;
                if (!empty(basename($image))) {
                    $uploadedFile = $request->file('file');
                    $filename = $uploadedFile->getClientOriginalName();
                    $res['status'] = 1;
                    $res['file_name'] = basename($image);
                    $res['file_name_text'] = $filename;
                } else {
                    $res['msg'] = "Something went wrong while uploading file. Please try again!";
                }
            }
        } else {
            $res['msg'] = "Only images are allowed to upload!";
        }

        exit(json_encode($res));
    }
    public function newsletter(Request $request)
    {
        $res = array();
        $res['status'] = 0;
        $input = $request->all();
        if ($input) {
            $request_data = [
                'email' => 'required|email|unique:newsletter,email',
            ];
            $validator = Validator::make($input, $request_data);
          
            if ($validator->fails()) {
                $res['status'] = 0;
                // $res['msg'] = 'Error >>' . $validator->errors()->first();
                $res['msg'] = convertArrayMessageToString($validator->errors()->all());
            } else {
                $data = array(
                    'email' => $input['email'],
                    'status' => 0
                );
                Newsletter_model::create($data);
                $res['status'] = 1;
                $res['msg'] = 'Subscribed successfully!';
            }
        }
        exit(json_encode($res));
    }
    public function contact_us(Request $request)
    {

        $res = array();
        $res['status'] = 0;
        $input = $request->all();
        // pr($input);
        if ($input) {
            $request_data = [
                'email' => 'required|email',
                'fname' => 'required',
                'lname' => 'required',
                'phone' => 'required',               
                'message' => 'required',
                'hear_about_us' => 'required',
                // 'feedback_type' => 'required',

            ];
            $validator = Validator::make($input, $request_data);
          
            if ($validator->fails()) {
                $res['status'] = 0;
                // $res['msg'] = 'Error >>' . $validator->errors();
                $res['msg'] = convertArrayMessageToString($validator->errors()->all());
            } else {
                $data = array(
                    'fname' => $input['fname'],
                    'lname' => $input['lname'],
                    'email' => $input['email'],
                    'phone' => $input['phone'],
                     'message' => $input['message'],
                    'hear_about_us' => $input['hear_about_us'],                   
                    'status' => 0
                );
                // pr($data);
                Contact_model::create($data);

                // $email_data = array(
                //     'email_to' => $this->data['site_settings']->site_email,
                //     'email_to_name' => 'Admin',
                //     'email_from' => $this->data['site_settings']->site_noreply_email,
                //     'email_from_name' => $this->data['site_settings']->site_name,
                //     'sender_name' => $input['name'],
                //     'subject' => 'New Contact Query',
                //     'mem_data' => $data,
                //     // 'link' => $verify_link,

                // );
                // pr($email_data);
                // send_email($email_data, 'contact-email');

                $res['status'] = 1;
                $res['msg'] = 'Message sent successfully!';
            }
        }
        exit(json_encode($res));
    }

    public function request_quote(Request $request)
    {

        $res = array();
        $res['status'] = 0;
        $input = $request->all();
        // pr($input);
        if ($input) {
            $request_data = [
                'email' => 'required|email',
                'fname' => 'required',
                'lname' => 'required',
                'phone' => 'required',
                'anything_else' => 'required',
                'budget' => 'required',
                'timeline' => 'required',
                'stage' => 'required',
                'address' => 'required',
                'pool_type' => 'required',
                

            ];
            $validator = Validator::make($input, $request_data);
          
            if ($validator->fails()) {
                $res['status'] = 0;
                // $res['msg'] = 'Error >>' . $validator->errors();
                $res['msg'] = convertArrayMessageToString($validator->errors()->all());
            } else {
                $data = array(
                     'fname' => $input['fname'],
                    'lname' => $input['lname'],
                    'email' => $input['email'],
                    'phone' => $input['phone'],
                     'anything_else' => $input['anything_else'],
                    'budget' => $input['budget'],
                    'timeline' => $input['timeline'],
                    'stage' => $input['stage'],
                    'address' => $input['address'],
                    'pool_type' => $input['pool_type'],
                    'status' => 0
                );
                // pr($data);
                Request_Quote_model::create($data);

                // $email_data = array(
                //     'email_to' => $this->data['site_settings']->site_email,
                //     'email_to_name' => 'Admin',
                //     'email_from' => $this->data['site_settings']->site_noreply_email,
                //     'email_from_name' => $this->data['site_settings']->site_name,
                //     'sender_name' => $input['name'],
                //     'subject' => 'New Contact Query',
                //     'mem_data' => $data,
                //     // 'link' => $verify_link,

                // );
                // pr($email_data);
                // send_email($email_data, 'contact-email');

                $res['status'] = 1;
                $res['msg'] = 'Request Quote submitted successfully!';
            }
        }
        exit(json_encode($res));
    }

    
}
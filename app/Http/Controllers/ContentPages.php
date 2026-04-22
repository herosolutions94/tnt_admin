<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;




use App\Models\Blog_model;
// use App\Models\Blog_categories_model;

use App\Models\Faq_model;
use App\Models\Cart_model;
use App\Models\Coaches_model;
use App\Models\Work_videos_model;
use App\Models\Testimonial_model;
use App\Models\Interns_model;
use Illuminate\Http\Request;
use App\Models\Cooky_tools_model;
// use App\Models\Products_categories_model;


class ContentPages extends Controller
{
    public function website_settings(Request $request)
    {
        // $token = $request->input('token', null);
        // $member = $this->authenticate_verify_token($token);
        // $session_id = $request->input('session_id', null);
        // if (empty($header) || $header == null || $header == 'null') {
        //     $output['not_logged'] = true;
        // }
        // if (!empty($member) && $member != false) {
        //     $this->data['site_settings']->member = $member;
        // } else {
        //     $this->data['site_settings']->member = null;
        // }
        $output['site_settings'] = $this->data['site_settings'];
    
        exit(json_encode($output));
    }
    public function getCookies()
    {
        // $cooky=Cooky_tools_model::orderBy('order_no', 'ASC')->get();
        $cookyTools = Cooky_tools_model::with('features')
            ->where('status', 1)
            ->orderBy('id', 'ASC')
            ->get();
        return $cookyTools;
    }



    public function member_settings(Request $request)
    {
        $member_obj = (object)[];
        $token = $request->input('token', null);
        // pr($request->all());
        $member = $this->authenticate_verify_token($token);
        $output = [];
        $output['member'] = null;

        // pr($member);
        if (!empty($member)) {
            // pr('hi');
            // $member->id_verification = $member->id_verification($member->mem_id_verification_id);
            $output['expire_time'] = format_date($member->otp_expire, 'Y-m-d H:i:s');
            // $output['mem_image'] = $member->mem_image;
            $output['mem_fname'] = $member->mem_fname;
            $output['mem_lname'] = $member->mem_lname;
            $output['mem_salutation'] = $member->mem_salutation;
            $output['mem_street'] = $member->mem_street;
            $output['mem_house'] = $member->mem_house;
            $output['mem_postal'] = $member->mem_postal;
            $output['mem_city'] = $member->mem_city;





            $output['mem_email'] = $member->mem_email;
            // $output['unread_msgs']=Msgs_model::where(['status'=>'sent','receiver'=>$member->id])->where('message_by','!=',$member->id)->orderBy('created_at', 'desc')->get()->count();
            if (empty($member->mem_phone) || empty($member->mem_address1) || empty($member->mem_display_name) || empty($member->mem_phone) || empty($member->mem_fullname)) {
                $member->complete_required = 1;
            }
            $output['member'] = $member;
        }

        exit(json_encode($output));
    }

    public function home_page(Request $request)
    {

        // $token = $request->input('token', null);
        // $member = $this->authenticate_verify_token($token);
        $lang = request()->header('lang');
        $lang = "eng";
        // return $lang;

        $this->data['content'] = get_page('home', $lang);


        $this->data['page_title'] = $this->data['content']['page_title'] . ' - ' . $this->data['site_settings']->site_name;
        $this->data['meta_desc'] = (object)[
            'meta_title' => $this->data['content']['meta_title'],
            'meta_description' => $this->data['content']['meta_description'],
            'meta_keywords' => $this->data['content']['meta_keywords'],
            'meta_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_title' => $this->data['content']['meta_title'],
            'og_description' => $this->data['content']['meta_description'],
            'meta_keywords' => $this->data['content']['meta_keywords'],
            'twitter_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),

        ];
        $this->data['banner_slider'] = getMultiText('banner-section', $lang);
        // pr($this->data['banner_slider']);
        $this->data['product_categories'] = Products_categories_model::orderBy('id', 'ASC')->where('status', '1')->get();
        $this->data['cta_section'] = get_page('cta_section',  $lang);

        exit(json_encode($this->data));
    }



    public function become_creator(Request $request)
    {

        // $token = $request->input('token', null);
        // $member = $this->authenticate_verify_token($token);
        $lang = request()->header('lang');
        $lang = "eng";
        // return $lang;

        $this->data['content'] = get_page('become_creator', $lang);


        $this->data['page_title'] = $this->data['content']['page_title'] . ' - ' . $this->data['site_settings']->site_name;
        $this->data['meta_desc'] = (object)[
            'meta_title' => $this->data['content']['meta_title'],
            'meta_description' => $this->data['content']['meta_description'],
            'meta_keywords' => $this->data['content']['meta_keywords'],
            'meta_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_title' => $this->data['content']['meta_title'],
            'og_description' => $this->data['content']['meta_description'],
            'meta_keywords' => $this->data['content']['meta_keywords'],
            'twitter_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),

        ];
        $this->data['home_jobs'] = getMultiText('home-jobs', $lang); 
        $this->data['why_choose_us'] = getMultiText('why-choose-us', $lang); 
        $this->data['our_products'] = getMultiText('our-products', $lang); 
        $this->data['work_videos'] = Work_videos_model::orderBy('id', 'ASC')->where('status', '1')->get();
        $this->data['interns'] = Interns_model::orderBy('id', 'ASC')->where('status', '1')->get();
        $this->data['coaches'] = Coaches_model::orderBy('id', 'ASC')->where('status', '1')->get();
        $this->data['testimonials'] = Testimonial_model::orderBy('id', 'ASC')->where('status', '1')->get();

        exit(json_encode($this->data));
    }


   







    public function request_quote(Request $request)
    {

        $this->data['content'] = get_page('request_quote');
        $this->data['page_title'] = $this->data['content']['page_title'] . ' - ' . $this->data['site_settings']->site_name;

        $this->data['meta_desc'] = (object)[
            'meta_title' => $this->data['content']['meta_title'],
            'meta_description' => $this->data['content']['meta_description'],
            'meta_keywords' => $this->data['content']['meta_keywords'],
            'meta_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_title' => $this->data['content']['meta_title'],
            'og_description' => $this->data['content']['meta_description'],
            'meta_keywords' => $this->data['content']['meta_keywords'],
            'twitter_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),

        ];
       

        exit(json_encode($this->data));
    }
    public function privacy_policy_page(Request $request)
    {

        // $token = $request->input('token', null);
        // $member = $this->authenticate_verify_token($token);
        $lang = request()->header('lang');

        $this->data['content'] = get_page('privacy-policy', $lang);

        $this->data['page_title'] = $this->data['content']['page_title'] . ' - ' . $this->data['site_settings']->site_name;
        $this->data['meta_desc'] = (object)[
            'meta_title' => $this->data['content']['meta_title'],
            'meta_description' => $this->data['content']['meta_description'],
            'meta_keywords' => $this->data['content']['meta_keywords'],
            'meta_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_title' => $this->data['content']['meta_title'],
            'og_description' => $this->data['content']['meta_description'],
            'meta_keywords' => $this->data['content']['meta_keywords'],
            'twitter_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),

        ];
        // $this->data['cta_section'] = get_page('cta_section',$lang);





        exit(json_encode($this->data));
    }

    public function terms_page(Request $request)
    {

        $this->data['content'] = get_page('terms-conditions');
        $this->data['page_title'] = $this->data['content']['page_title'] . ' - ' . $this->data['site_settings']->site_name;
        $this->data['cta_section'] = get_page('cta_section');

        $this->data['meta_desc'] = (object)[
            'meta_title' => $this->data['content']['meta_title'],
            'meta_description' => $this->data['content']['meta_description'],
            'meta_keywords' => $this->data['content']['meta_keywords'],
            'meta_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_title' => $this->data['content']['meta_title'],
            'og_description' => $this->data['content']['meta_description'],
            'meta_keywords' => $this->data['content']['meta_keywords'],
            'twitter_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),

        ];

        exit(json_encode($this->data));
    }



}

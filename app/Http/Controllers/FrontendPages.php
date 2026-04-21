<?php

namespace App\Http\Controllers;

use App\Models\Agent_model;
use Illuminate\Support\Facades\DB;
use App\Models\Blog_model;
use App\Models\Blog_categories_model;
use App\Models\Leads_model;
use App\Models\Focus_model;
use App\Models\Job_opportunities_model;
use App\Models\Job_type_model;
use App\Models\Jobs_model;
use App\Models\Locations_model;
use App\Models\Member_model;
use App\Models\Reviews_model;
use App\Models\Service_model;
use App\Models\Specialization_model;
use App\Models\Team_model;
use App\Models\Testimonial_model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use PHPUnit\Util\Log\TeamCity;
use App\Models\Colors_model;
use App\Models\Hardscapes_model;
use App\Models\Stick_Built_model;
use App\Models\Renaissance_model;
use App\Models\Aviva_model;
use App\Models\Faq_model;


class FrontendPages extends Controller
{

    public function home_page(Request $request)
    {
        $this->data['content'] = get_page('home');
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
        $this->data['cta_section'] = get_page('cta_section');
        return view('frontend/pages/home', $this->data);
    }

    public function about_page(Request $request)
    {
        $this->data['content'] = get_page('about_us');
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
        $this->data['cta_section'] = get_page('cta_section');
        $this->data['industries'] = getMultiText('industries-section1');
        $this->data['testimonials'] = Testimonial_model::orderBy('id', 'ASC')->where('status', '1')->get();
        return view('frontend/pages/about', $this->data);
    }

    public function aviva_pools_page(Request $request)
    {
        $this->data['content'] = get_page('aviva_pools');
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
        $this->data['avivas'] = Aviva_model::orderBy('id', 'DESC')->where('status', '1')->where('featured', 1)->get();
        $this->data['cta_section'] = get_page('cta_section');


        return view('frontend/pages/aviva-pools', $this->data);
    }

    public function pool_details_page($slug)
    {
        $aviva = Aviva_model::where('slug', $slug)->where('status', 1)->firstOrFail();
        $this->data['page_title'] = $aviva->meta_title . ' - ' . $this->data['site_settings']->site_name;
        $this->data['meta_desc'] = (object)[
            'meta_title' => $aviva->meta_title,
            'meta_description' => $aviva->meta_description,
            'meta_keywords' => $aviva->meta_keywords,
            'meta_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_title' => $aviva->meta_title,
            'og_description' => $aviva->meta_description,
            'meta_keywords' => $aviva->meta_keywords,
            'twitter_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),

        ];

        $this->data['aviva'] = $aviva;
        $this->data['content_data'] = json_decode($this->data['aviva']->content, true);
        $this->data['specification'] = getSpecify($aviva->id);
        $this->data['colors'] = getColours($aviva->id);
        $this->data['designs'] = getDesign($aviva->id);
        $this->data['content'] = get_page('pool_details');






        $this->data['cta_section'] = get_page('cta_section');

        return view('frontend/pages/pool-details', $this->data);
    }



    public function patio_details_page($slug)
    {
        $aviva = Renaissance_model::where('slug', $slug)->where('status', 1)->firstOrFail();
        $this->data['page_title'] = $aviva->meta_title . ' - ' . $this->data['site_settings']->site_name;
        $this->data['meta_desc'] = (object)[
            'meta_title' => $aviva->meta_title,
            'meta_description' => $aviva->meta_description,
            'meta_keywords' => $aviva->meta_keywords,
            'meta_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_title' => $aviva->meta_title,
            'og_description' => $aviva->meta_description,
            'meta_keywords' => $aviva->meta_keywords,
            'twitter_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),

        ];

        $this->data['renaissance'] = $aviva;
        $this->data['content_data'] = json_decode($this->data['renaissance']->content, true);
        $this->data['gallerys'] = getGallery($aviva->id);
        $this->data['features'] = getFeatures($aviva->id);
        $this->data['designs'] = getDesignList($aviva->id);
        $this->data['faqs'] = getFaqsResi($aviva->id);
        $this->data['content'] = get_page('pool_details');








        $this->data['cta_section'] = get_page('cta_section');

        return view('frontend/pages/patio-details', $this->data);
    }

    public function stick_details_page($slug)
    {
        $aviva = Stick_Built_model::where('slug', $slug)->where('status', 1)->firstOrFail();
        $this->data['page_title'] = $aviva->meta_title . ' - ' . $this->data['site_settings']->site_name;
        $this->data['meta_desc'] = (object)[
            'meta_title' => $aviva->meta_title,
            'meta_description' => $aviva->meta_description,
            'meta_keywords' => $aviva->meta_keywords,
            'meta_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_title' => $aviva->meta_title,
            'og_description' => $aviva->meta_description,
            'meta_keywords' => $aviva->meta_keywords,
            'twitter_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),

        ];

        $this->data['renaissance'] = $aviva;
        $this->data['content_data'] = json_decode($this->data['renaissance']->content, true);
        $this->data['gallerys'] = getGalleryStick($aviva->id);
        $this->data['features'] = getFeaturesStick($aviva->id);
        $this->data['designs'] = getDesignListStick($aviva->id);
        $this->data['faqs'] = getFaqsStick($aviva->id);
        $this->data['content'] = get_page('pool_details');

        $this->data['cta_section'] = get_page('cta_section');

        return view('frontend/pages/stick-details', $this->data);
    }

    public function hardscapes_details_page($slug)
    {
  $this->data['content'] = get_page('patio_details');
        $aviva = Hardscapes_model::where('slug', $slug)->where('status', 1)->firstOrFail();
        $this->data['page_title'] = $aviva->meta_title . ' - ' . $this->data['site_settings']->site_name;
        $this->data['meta_desc'] = (object)[
            'meta_title' => $aviva->meta_title,
            'meta_description' => $aviva->meta_description,
            'meta_keywords' => $aviva->meta_keywords,
            'meta_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_title' => $aviva->meta_title,
            'og_description' => $aviva->meta_description,
            'meta_keywords' => $aviva->meta_keywords,
            'twitter_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),
            'og_image' => get_site_image_src('images', $this->data['site_settings']->site_thumb),

        ];

        $this->data['hardscape'] = $aviva;
        $this->data['content_data'] = json_decode($this->data['hardscape']->content, true);
        $this->data['specifies'] = getSpecifyHardscapes($aviva->id);
        $this->data['gallerys'] = getHardGallery($aviva->id);
        $this->data['cta_section'] = get_page('cta_section');

        return view('frontend/pages/hardscapes-details', $this->data);
    }

    public function renaissance_patio_page(Request $request)
    {
        $this->data['content'] = get_page('renaissance_patio');
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
        $this->data['cta_section'] = get_page('cta_section');
        $this->data['renaissances'] = Renaissance_model::orderBy('id', 'DESC')->where('status', '1')->where('featured', 1)->get();


        return view('frontend/pages/renaissance-patio', $this->data);
    }

    public function stick_built_page(Request $request)
    {
        $this->data['content'] = get_page('stick_built');
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
        $this->data['cta_section'] = get_page('cta_section');
        $this->data['sticks_built'] = Stick_Built_model::orderBy('id', 'DESC')->where('status', '1')->where('featured', 1)->get();



        return view('frontend/pages/stick-built', $this->data);
    }

    public function request_quote_page(Request $request)
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

        $this->data['cta_section'] = get_page('cta_section');
        $this->data['job_opportunities'] = Job_opportunities_model::orderBy('id', 'ASC')->where('status', '1')->get();
        $this->data['testimonials'] = Testimonial_model::orderBy('id', 'ASC')->where('status', '1')->get();
        $this->data['cta_section'] = get_page('cta_section');
        return view('frontend/pages/request-quote', $this->data);
    }


    public function faqs_page(Request $request)
    {
        $this->data['content'] = get_page('faqs');
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

        $this->data['cta_section'] = get_page('cta_section');
         $this->data['faqs'] = Faq_model::orderBy('id', 'DESC')->where('status', '1')->get();


        return view('frontend/pages/faqs', $this->data);
    }



    public function hardscapes_page(Request $request)
    {
        $this->data['content'] = get_page('hardscapes');
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
        $this->data['cta_section'] = get_page('cta_section');
        $this->data['hardscapes'] = Hardscapes_model::orderBy('id', 'DESC')->where('status', '1')->where('featured', 1)->get();


        return view('frontend/pages/hardscapes', $this->data);
    }



    public function colors_page(Request $request)
    {
        $this->data['content'] = get_page('colors');
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

        $this->data['cta_section'] = get_page('cta_section');
        $colors = Colors_model::orderBy('id', 'DESC')->where('status', '1')->where('featured', 1)->get();
        foreach ($colors as $color) {
            $color->images = DB::table('colors_gallery')
                ->where('product_id', $color->id)
                ->get();
        }

        $this->data['colors'] = $colors;

        return view('frontend/pages/colors', $this->data);
    }


    public function contact_page(Request $request)
    {
        $this->data['content'] = get_page('contact_us');
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

        $this->data['cta_section'] = get_page('cta_section');
        $this->data['job_specializations'] = Specialization_model::orderBy('id', 'ASC')->where('status', '1')->get();
        $this->data['job_opportunities'] = Job_opportunities_model::orderBy('id', 'ASC')->where('status', '1')->get();
        $this->data['services'] = Service_model::orderBy('id', 'ASC')->where('status', '1')->get();

        return view('frontend/pages/contact-us', $this->data);
    }


    public function terms_conditions_page(Request $request)
    {
        $this->data['content'] = get_page('terms_conditions');
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
        $this->data['cta_section'] = get_page('cta_section');

        exit(json_encode($this->data));
    }

    public function blog_page(Request $request)
    {
        $token = $request->input('token', null);
        $member = $this->authenticate_verify_token($token);
        $this->data['content'] = get_page('blog');
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

        $this->data['featured_blog_posts'] = Blog_model::orderBy('id', 'DESC')
            ->where('status', 1)->where('featured', 1)->get();
        foreach ($this->data['featured_blog_posts'] as $featured_blog_post) {
            $featured_blog_post->cat_name = $featured_blog_post->category_row->name ?? '';
            $featured_blog_post->created_date = format_date($featured_blog_post->created_at, 'd M, Y');
        }

        $this->data['blog_categories'] = Blog_categories_model::orderBy('id', 'DESC')
            ->where('status', 1)->has('blog_posts')->get();

        foreach ($this->data['blog_categories'] as $blog_category) {
            foreach ($blog_category->blog_posts as $blog_post) {
                $blog_post->cat_name = $blog_post->category_row->name ?? '';
                $blog_post->created_date = format_date($blog_post->created_at, 'd M, Y');
            }
        }

        $this->data['cta_section'] = get_page('cta_section');

        return view('frontend/pages/blog', $this->data);
    }

    public function blog_details_page(Request $request, $slug)
    {
        if (!empty($slug) && $this->data['blog_post'] = Blog_model::orderBy('id', 'DESC')->where('status', 1)->where('slug', $slug)->get()->first()) {
            $this->data['content'] = get_page('blog');
            $this->data['page_title'] = $this->data['blog_post']->title. ' - ' . $this->data['site_settings']->site_name;
            $this->data['blog_post']->cat_name = !empty($this->data['blog_post']->category_row) ? $this->data['blog_post']->category_row->name : '';
            $this->data['blog_post']->created_date = format_date($this->data['blog_post']->created_at, 'd M, Y');
            $this->data['meta_desc'] = (object)[
            'meta_title' => $this->data['blog_post']->meta_title ?? $this->data['blog_post']->title,
            'meta_description' => $this->data['blog_post']->meta_description ?? \Str::limit(strip_tags($this->data['blog_post']->description), 150),
            'meta_keywords' => $this->data['blog_post']->meta_keywords ?? '',
            'og_title' => $this->data['blog_post']->meta_title ?? $this->data['blog_post']->title,
            'og_description' => $this->data['blog_post']->meta_description ?? \Str::limit(strip_tags($this->data['blog_post']->description), 150),
            'og_image' => get_site_image_src('blogs', $this->data['blog_post']->image),
            'twitter_image' => get_site_image_src('blogs', $this->data['blog_post']->image),
        ];
        }
        $this->data['cta_section'] = get_page('cta_section');

        return view('frontend/pages/blog-details', $this->data);
    }
}

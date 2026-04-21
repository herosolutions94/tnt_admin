<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Job_opportunities_model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Job_opportunities extends Controller
{
    public function index()
    {
        has_access(15);
        $this->data['rows'] = Job_opportunities_model::orderBy('id', 'DESC')->get();
        return view('admin.job_opportunities.index', $this->data);
    }
    public function add(Request $request)
    {
        has_access(15);
        $input = $request->all();
        if ($input) {
            $data = array();
            if ($request->hasFile('image')) {

                $request->validate([
                    'image' => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000'
                ]);
                $image = $request->file('image')->store('public/job_opportunities/');
                if (!empty(basename($image))) {
                    $data['image'] = basename($image);
                }
            }
            if (!empty($input['status'])) {
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }
            $data['industry_title'] = $input['industry_title'];
            $data['slug'] = checkSlug(Str::slug($data['industry_title'], '-'), 'job_opportunities');
            $data['details'] = $input['details'];
            $data['meta_title'] = $input['meta_title'];
            $data['meta_description'] = $input['meta_description'];
            $data['meta_keywords'] = $input['meta_keywords'];
            // pr($data);
            $area_of_expertise = Job_opportunities_model::create($data);
            $exp_id = $area_of_expertise->id;


            if ($exp_id > 0) {
                $content_array = [

                    'banner_heading' => $input['banner_heading'],
                    'banner_text' => $input['banner_text'],
                    'banner_btn1_txt' => $input['banner_btn1_txt'],
                    'banner_btn1_link' => $input['banner_btn1_link'],
                    'banner_btn2_txt' => $input['banner_btn2_txt'],
                    'banner_btn2_link' => $input['banner_btn2_link'],


                    //tab1
                    'section1_tab1_heading' => $input['section1_tab1_heading'],
                    'section1_tab1_text' => $input['section1_tab1_text'],
                    'sec1_tab1_heading1' => $input['sec1_tab1_heading1'],
                    'sec1_tab1_heading2' => $input['sec1_tab1_heading2'],
                    'sec1_tab1_heading3' => $input['sec1_tab1_heading3'],
                    'sec1_tab1_text1' => $input['sec1_tab1_text1'],
                    'sec1_tab1_text2' => $input['sec1_tab1_text2'],
                    'sec1_tab1_text3' => $input['sec1_tab1_text3'],


                    'section2_tab1_heading' => $input['section2_tab1_heading'],
                    'section2_tab1_text1' => $input['section2_tab1_text1'],
                    'section2_tab1_text2' => $input['section2_tab1_text2'],
                    'section2_tab1_btn_txt' => $input['section2_tab1_btn_txt'],
                    'section2_tab1_btn_link' => $input['section2_tab1_btn_link'],


                    ///tab2

                    'section1_tab2_heading' => $input['section1_tab2_heading'],
                    'section1_tab2_text' => $input['section1_tab2_text'],
                    'sec1_tab2_heading1' => $input['sec1_tab2_heading1'],
                    'sec1_tab2_heading2' => $input['sec1_tab2_heading2'],
                    'sec1_tab2_heading3' => $input['sec1_tab2_heading3'],
                    'sec1_tab2_text1' => $input['sec1_tab2_text1'],
                    'sec1_tab2_text2' => $input['sec1_tab2_text2'],
                    'sec1_tab2_text3' => $input['sec1_tab2_text3'],

                    'section2_tab2_heading' => $input['section2_tab2_heading'],
                    'section2_tab2_text1' => $input['section2_tab2_text1'],
                    'section2_tab2_text2' => $input['section2_tab2_text2'],
                    'section2_tab2_btn_txt' => $input['section2_tab2_btn_txt'],
                    'section2_tab2_btn_link' => $input['section2_tab2_btn_link'],



                    'section3_heading' => $input['section3_heading'],
                    'section3_text' => $input['section3_text'],
                    'section3_btn_txt' => $input['section3_btn_txt'],
                    'section3_btn_link' => $input['section3_btn_link'],


                    // 'banner_text1' => $input['banner_text1'],
                    // 'banner_text2' => $input['banner_text2'],
                    // 'section1_text1' => $input['section1_text1'],
                    // 'section1_text2' => $input['section1_text2'],
                    // 'section2_text' => $input['section2_text'],
                    // 'sec2_text3' => $input['sec2_text3'],
                    // 'sec2_text4' => $input['sec2_text4'],
                    // 'sec2_text5' => $input['sec2_text5'],
                    // 'section3_text' => $input['section3_text'],
                    // 'sec3_text6' => $input['sec3_text6'],
                    // 'sec3_text7' => $input['sec3_text7'],
                    // 'section4_heading' => $input['section4_heading'],
                    // 'section4_text' => $input['section4_text'],
                    // 'section4_btn_txt' => $input['section4_btn_txt'],
                    // 'section4_btn_link' => $input['section4_btn_link'],

                ];

                for ($i = 1; $i <= 13; $i++) {
                    if ($request->hasFile('image' . $i)) {

                        $request->validate([
                            'image' . $i => 'mimes:png,jpg,jpeg,svg,gif,webp|max:800000'
                        ]);
                        $image = $request->file('image' . $i)->store('public/job_opportunities/');
                        if (!empty($image)) {
                            $content_array['image' . $i] = basename($image);
                        }
                    }
                }
                // pr($content_array);
                $area_of_expertise->update(['content' => serialize($content_array)]);
            }

            return redirect('admin/job_opportunities/')
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['enable_editor'] = true;
        return view('admin.job_opportunities.index', $this->data);
    }
    public function edit(Request $request, $id)
    {
        has_access(15);
        $job_opportunity = Job_opportunities_model::find($id);
        $input = $request->all();
        if ($input) {
            $data = array();
            if ($request->hasFile('image')) {

                $request->validate([
                    'image' => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000'
                ]);
                $image = $request->file('image')->store('public/job_opportunities/');
                if (!empty($image)) {
                    $job_opportunity->image = basename($image);
                }
            }
            if (!empty($input['status'])) {
                $job_opportunity->status = 1;
            } else {
                $job_opportunity->status = 0;
            }
            $job_opportunity->industry_title = $input['industry_title'];
            $job_opportunity->slug = checkSlug(Str::slug($job_opportunity->industry_title, '-'), 'jobs', $job_opportunity->id);
            $job_opportunity->details = $input['details'];
            $job_opportunity->meta_title = $input['meta_title'];
            $job_opportunity->meta_description = $input['meta_description'];
            $job_opportunity->meta_keywords = $input['meta_keywords'];
            // pr($data);
            $job_opportunity->update();

            $content = unserialize($job_opportunity->content);

            if (!empty($job_opportunity->content)) {
                $content = unserialize($job_opportunity->content);
            } else {
                $content = array();
            }
            $content_array = [

                'banner_heading' => $input['banner_heading'],
                'banner_text' => $input['banner_text'],
                'banner_btn1_txt' => $input['banner_btn1_txt'],
                'banner_btn1_link' => $input['banner_btn1_link'],
                'banner_btn2_txt' => $input['banner_btn2_txt'],
                'banner_btn2_link' => $input['banner_btn2_link'],


                //tab1
                'section1_tab1_heading' => $input['section1_tab1_heading'],
                'section1_tab1_text' => $input['section1_tab1_text'],
                'sec1_tab1_heading1' => $input['sec1_tab1_heading1'],
                'sec1_tab1_heading2' => $input['sec1_tab1_heading2'],
                'sec1_tab1_heading3' => $input['sec1_tab1_heading3'],
                'sec1_tab1_text1' => $input['sec1_tab1_text1'],
                'sec1_tab1_text2' => $input['sec1_tab1_text2'],
                'sec1_tab1_text3' => $input['sec1_tab1_text3'],


                'section2_tab1_heading' => $input['section2_tab1_heading'],
                'section2_tab1_text1' => $input['section2_tab1_text1'],
                'section2_tab1_text2' => $input['section2_tab1_text2'],
                'section2_tab1_btn_txt' => $input['section2_tab1_btn_txt'],
                'section2_tab1_btn_link' => $input['section2_tab1_btn_link'],


                ///tab2

                'section1_tab2_heading' => $input['section1_tab2_heading'],
                'section1_tab2_text' => $input['section1_tab2_text'],
                'sec1_tab2_heading1' => $input['sec1_tab2_heading1'],
                'sec1_tab2_heading2' => $input['sec1_tab2_heading2'],
                'sec1_tab2_heading3' => $input['sec1_tab2_heading3'],
                'sec1_tab2_text1' => $input['sec1_tab2_text1'],
                'sec1_tab2_text2' => $input['sec1_tab2_text2'],
                'sec1_tab2_text3' => $input['sec1_tab2_text3'],

                'section2_tab2_heading' => $input['section2_tab2_heading'],
                'section2_tab2_text1' => $input['section2_tab2_text1'],
                'section2_tab2_text2' => $input['section2_tab2_text2'],
                'section2_tab2_btn_txt' => $input['section2_tab2_btn_txt'],
                'section2_tab2_btn_link' => $input['section2_tab2_btn_link'],


                'section3_heading' => $input['section3_heading'],
                'section3_text' => $input['section3_text'],
                'section3_btn_txt' => $input['section3_btn_txt'],
                'section3_btn_link' => $input['section3_btn_link'],


                // 'banner_heading' => $input['banner_heading'],
                // 'banner_text1' => $input['banner_text1'],
                // 'banner_text2' => $input['banner_text2'],
                // 'section1_text1' => $input['section1_text1'],
                // 'section1_text2' => $input['section1_text2'],
                // 'section2_text' => $input['section2_text'],
                // 'sec2_text3' => $input['sec2_text3'],
                // 'sec2_text4' => $input['sec2_text4'],
                // 'sec2_text5' => $input['sec2_text5'],
                // 'section3_text' => $input['section3_text'],
                // 'sec3_text6' => $input['sec3_text6'],
                // 'sec3_text7' => $input['sec3_text7'],
                // 'section4_heading' => $input['section4_heading'],
                // 'section4_text' => $input['section4_text'],
                // 'section4_btn_txt' => $input['section4_btn_txt'],
                // 'section4_btn_link' => $input['section4_btn_link'],
            ];

            for ($i = 1; $i <= 13; $i++) {
                if ($request->hasFile('image' . $i)) {

                    $request->validate([
                        'image' . $i => 'mimes:png,jpg,jpeg,svg,gif,webp|max:800000'
                    ]);
                    $image = $request->file('image' . $i)->store('public/job_opportunities/');
                    if (!empty($image)) {
                        if (!empty($content['image' . $i])) {
                            removeImage("job_opportunities/" . $content['image' . $i]);
                        }

                        $content_array['image' . $i] = basename($image);
                    }
                }
            }

            $data = serialize(array_merge($content, $content_array));
            $job_opportunity->update(['content' => $data]);


            return redirect('admin/job_opportunities/')
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Job_opportunities_model::find($id);
        $this->data['content'] = unserialize($this->data['row']->content);

        $this->data['enable_editor'] = true;
        return view('admin.job_opportunities.index', $this->data);
    }
    public function delete($id)
    {
        has_access(15);
        $job_opportunity = Job_opportunities_model::find($id);
        if (!empty($job_opportunity->image)) {
            removeImage("job_opportunities/" . $job_opportunity->image);
        }
        if (!empty($job_opportunity->content)) {
            $content = unserialize($job_opportunity->content);

            for ($i = 1; $i <= 13; $i++) {
                if (!empty($content['image' . $i])) {
                    removeImage("job_opportunities/" . $content['image' . $i]);
                }
            }
        }
        $job_opportunity->delete();
        return redirect('admin/job_opportunities/')
            ->with('error', 'Content deleted Successfully');
    }
}

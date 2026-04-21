<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Service_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Services extends Controller
{
    public function index()
    {
        has_access(17);
        $this->data['rows'] = Service_model::orderBy('id', 'DESC')->get();
        return view('admin.services.index', $this->data);
    }
    public function add(Request $request)
    {
        has_access(17);
        $input = $request->all();
        if ($input) {
            // pr($input);
            $data = array();
            if ($request->hasFile('image')) {

                $request->validate([
                    'image' => 'mimes:png,jpg,jpeg,svg,gif,webp|max:800000'
                ]);
                $image = $request->file('image')->store('public/services/');
                if (!empty(basename($image))) {
                    // generateThumbnail('company', basename($image), 'square', 'large');
                    $data['image'] = basename($image);
                }
            }

            if (!empty($input['status'])) {
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }
            if (!empty($input['featured'])) {
                $data['featured'] = 1;
            } else {
                $data['featured'] = 0;
            }

            $data['title'] = $input['title'];
            $data['slug'] = checkSlug(Str::slug($data['title'], '-'), 'services');
            $data['meta_title'] = $input['meta_title'];
            $data['meta_description'] = $input['meta_description'];
            $data['meta_keywords'] = $input['meta_keywords'];
            $data['tagline'] = $input['tagline'];
            $data['short_desc'] = $input['short_desc'];
            // pr($data);
            $service = Service_model::create($data);
            $ser_id = $service->id;

            if ($ser_id > 0) {
                $content_array = [
                    'banner_heading' => $input['banner_heading'],
                    'banner_heading2' => $input['banner_heading2'],
                    'banner_text' => $input['banner_text'],
                    'section1_heading' => $input['section1_heading'],
                    'section1_text' => $input['section1_text'],
                    'section1_btn_txt' => $input['section1_btn_txt'],
                    'section1_btn_link' => $input['section1_btn_link'],
                    'section2_heading' => $input['section2_heading'],
                    'sec2_heading3' => $input['sec2_heading3'],
                    'sec2_text3' => $input['sec2_text3'],
                    'sec2_heading4' => $input['sec2_heading4'],
                    'sec2_text4' => $input['sec2_text4'],
                    'sec2_heading5' => $input['sec2_heading5'],
                    'sec2_text5' => $input['sec2_text5'],
                    'section3_heading' => $input['section3_heading'],
                    'section3_text' => $input['section3_text'],
                    'section3_btn_txt' => $input['section3_btn_txt'],
                    'section3_btn_link' => $input['section3_btn_link'],
                    'section4_heading' => $input['section4_heading'],
                    'sec4_heading7' => $input['sec4_heading7'],
                    'sec4_count7' => $input['sec4_count7'],
                    'sec4_heading8' => $input['sec4_heading8'],
                    'sec4_count8' => $input['sec4_count8'],
                    'sec4_heading9' => $input['sec4_heading9'],
                    'sec4_count9' => $input['sec4_count9'],
                    'section5_heading' => $input['section5_heading'],
                    'section5_text' => $input['section5_text'],
                    'section6_heading' => $input['section6_heading'],
                    'section6_text' => $input['section6_text'],
                    'section6_btn_txt' => $input['section6_btn_txt'],
                    'section6_btn_link' => $input['section6_btn_link'],
                    'section7_heading' => $input['section7_heading'],
                    'section7_text' => $input['section7_text'],
                    'section7_btn_txt' => $input['section7_btn_txt'],
                    'section7_btn_link' => $input['section7_btn_link'],
                ];

                for ($i = 1; $i <= 13; $i++) {
                    if ($request->hasFile('image' . $i)) {

                        $request->validate([
                            'image' . $i => 'mimes:png,jpg,jpeg,svg,gif,webp|max:800000'
                        ]);
                        $image = $request->file('image' . $i)->store('public/services/');
                        if (!empty($image)) {
                            $content_array['image' . $i] = basename($image);
                        }
                    }
                }
                // pr($content_array);
                $service->update(['content' => serialize($content_array)]);
            }


            return redirect('admin/services/')
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['enable_editor'] = true;


        return view('admin.services.index', $this->data);
    }
    public function edit(Request $request, $id)
    {
        has_access(17);
        $service = Service_model::find($id);

        $input = $request->all();
        if ($input) {
            $data = array();
            if ($request->hasFile('image')) {

                $request->validate([
                    'image' => 'mimes:png,jpg,jpeg,svg,gif,webp|max:800000'
                ]);
                $image = $request->file('image')->store('public/services/');
                if (!empty($image)) {
                    removeImage("services/" . $service->image);
                    // generateThumbnail('company', basename($image), 'square', 'large');
                    $service->image = basename($image);
                }
            }
            if (!empty($input['status'])) {
                $service->status = 1;
            } else {
                $service->status = 0;
            }
            if (!empty($input['featured'])) {
                $service->featured = 1;
            } else {
                $service->featured = 0;
            }

            $service->title = $input['title'];
            $service->slug = checkSlug(Str::slug($service->title, '-'), 'jobs', $service->id);
            $service->meta_title = $input['meta_title'];
            $service->meta_description = $input['meta_description'];
            $service->meta_keywords = $input['meta_keywords'];
            $service->tagline = $input['tagline'];
            $service->short_desc = $input['short_desc'];

            $service->update();

            $content = unserialize($service->content);

            if (!empty($service->content)) {
                $content = unserialize($service->content);
            } else {
                $content = array();
            }


            $content_array = [
                'banner_heading' => $input['banner_heading'],
                'banner_heading2' => $input['banner_heading2'],
                'banner_text' => $input['banner_text'],
                'section1_heading' => $input['section1_heading'],
                'section1_text' => $input['section1_text'],
                'section1_btn_txt' => $input['section1_btn_txt'],
                'section1_btn_link' => $input['section1_btn_link'],
                'section2_heading' => $input['section2_heading'],
                'sec2_heading3' => $input['sec2_heading3'],
                'sec2_text3' => $input['sec2_text3'],
                'sec2_heading4' => $input['sec2_heading4'],
                'sec2_text4' => $input['sec2_text4'],
                'sec2_heading5' => $input['sec2_heading5'],
                'sec2_text5' => $input['sec2_text5'],
                'section3_heading' => $input['section3_heading'],
                'section3_text' => $input['section3_text'],
                'section3_btn_txt' => $input['section3_btn_txt'],
                'section3_btn_link' => $input['section3_btn_link'],
                'section4_heading' => $input['section4_heading'],
                'sec4_heading7' => $input['sec4_heading7'],
                'sec4_count7' => $input['sec4_count7'],
                'sec4_heading8' => $input['sec4_heading8'],
                'sec4_count8' => $input['sec4_count8'],
                'sec4_heading9' => $input['sec4_heading9'],
                'sec4_count9' => $input['sec4_count9'],
                'section5_heading' => $input['section5_heading'],
                'section5_text' => $input['section5_text'],
                'section6_heading' => $input['section6_heading'],
                'section6_text' => $input['section6_text'],
                'section6_btn_txt' => $input['section6_btn_txt'],
                'section6_btn_link' => $input['section6_btn_link'],
                'section7_heading' => $input['section7_heading'],
                'section7_text' => $input['section7_text'],
                'section7_btn_txt' => $input['section7_btn_txt'],
                'section7_btn_link' => $input['section7_btn_link'],
            ];

            for ($i = 1; $i <= 13; $i++) {
                if ($request->hasFile('image' . $i)) {

                    $request->validate([
                        'image' . $i => 'mimes:png,jpg,jpeg,svg,gif,webp|max:800000'
                    ]);
                    $image = $request->file('image' . $i)->store('public/services/');
                    if (!empty($image)) {
                        if (!empty($content['image' . $i])) {
                            removeImage("services/" . $content['image' . $i]);
                        }

                        $content_array['image' . $i] = basename($image);
                    }
                }
            }

            $data = serialize(array_merge($content, $content_array));

            $service->update(['content' => $data]);

            return redirect('admin/services/')
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Service_model::find($id);
        $this->data['content'] = unserialize($this->data['row']->content);

        $this->data['enable_editor'] = true;

        return view('admin.services.index', $this->data);
    }

    public function delete($id)
    {
        has_access(17);
        $service = Service_model::find($id);
        removeImage("services/" . $service->image);

        if (!empty($service->content)) {
            $content = unserialize($service->content);

            for ($i = 1; $i <= 13; $i++) {
                if (!empty($content['image' . $i])) {
                    removeImage("services/" . $content['image' . $i]);
                }
            }
        }

        $service->delete();
        return redirect('admin/services/')
            ->with('error', 'Content deleted Successfully');
    }
}

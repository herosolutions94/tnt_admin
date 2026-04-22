<?php

namespace App\Http\Controllers\admin;

use App\Models\Sitecontent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Pages extends Controller
{

    public function home(Request $request)
    {
        has_access(12);
        $page = Sitecontent::where('ckey', $request->segment(3))->first();
        if (empty($page)) {
            $page = new Sitecontent;
            $page->ckey = $request->segment(3);
            $page->code = '';
            $page->save();
        }
        $input = $request->all();
        if ($input) {
            if (!empty($page->code)) {
                $content_row = unserialize($page->code);
            } else {
                $content_row = array();
            }
            if (!is_array($content_row))
                $content_row = array();

            // Handle numbered images (banner, growth section, etc.)
            for ($i = 1; $i <= 10; $i++) {
                if ($request->hasFile('image' . $i)) {
                    $request->validate([
                        'image' . $i => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000'
                    ]);
                    $image = $request->file('image' . $i)->store('public/images/');
                    if (!empty($image)) {
                        $input['image' . $i] = basename($image);
                    }
                }
            }

            // Section 1 - Telegram features (icon + title + text repeater)
            $sec1['title']    = $input['sec1_title'] ?? '';
            $sec1['txt1']     = $input['sec1_txt1'] ?? '';
            $sec1['order_no'] = $input['sec1_order_no'] ?? '';
            $sec1Pics['pics'] = $input['sec1_pics'] ?? '';
            unset($input['sec1_pics'], $input['sec1_order_no'], $input['sec1_title'], $input['sec1_txt1']);
            DB::table('multi_text')->where('section', 'creator-telegram')->delete();
            $sec1s = ['order_no' => $sec1['order_no'], 'title' => $sec1['title'], 'txt1' => $sec1['txt1']];
            if (!empty($request->file('sec1_image')) || !empty($sec1Pics['pics'])) {
                saveMultiMediaFieldsImgs('public/images/', $request->file('sec1_image'), 'sec1_image', 'creator-telegram', $sec1Pics['pics'], $sec1s);
            }
            unset($input['sec1_image']);

            // Section 3 - Crazy Stories repeater (image + title + text + amount)
            $sec3['title']    = $input['sec3_title'] ?? '';
            $sec3['txt1']     = $input['sec3_txt1'] ?? '';
            $sec3['txt2']     = $input['sec3_txt2'] ?? '';
            $sec3['order_no'] = $input['sec3_order_no'] ?? '';
            $sec3Pics['pics'] = $input['sec3_pics'] ?? '';
            unset($input['sec3_pics'], $input['sec3_order_no'], $input['sec3_title'], $input['sec3_txt1'], $input['sec3_txt2']);
            DB::table('multi_text')->where('section', 'creator-stories')->delete();
            $sec3s = ['order_no' => $sec3['order_no'], 'title' => $sec3['title'], 'txt1' => $sec3['txt1'], 'txt2' => $sec3['txt2']];
            if (!empty($request->file('sec3_image')) || !empty($sec3Pics['pics'])) {
                saveMultiMediaFieldsImgs('public/images/', $request->file('sec3_image'), 'sec3_image', 'creator-stories', $sec3Pics['pics'], $sec3s);
            }
            unset($input['sec3_image']);

            // Section 4 - Testimonials repeater (image + name + text + platform)
            $sec4['title']    = $input['sec4_title'] ?? '';
            $sec4['txt1']     = $input['sec4_txt1'] ?? '';
            $sec4['txt2']     = $input['sec4_txt2'] ?? '';
            $sec4['order_no'] = $input['sec4_order_no'] ?? '';
            $sec4Pics['pics'] = $input['sec4_pics'] ?? '';
            unset($input['sec4_pics'], $input['sec4_order_no'], $input['sec4_title'], $input['sec4_txt1'], $input['sec4_txt2']);
            DB::table('multi_text')->where('section', 'creator-testimonials')->delete();
            $sec4s = ['order_no' => $sec4['order_no'], 'title' => $sec4['title'], 'txt1' => $sec4['txt1'], 'txt2' => $sec4['txt2']];
            if (!empty($request->file('sec4_image')) || !empty($sec4Pics['pics'])) {
                saveMultiMediaFieldsImgs('public/images/', $request->file('sec4_image'), 'sec4_image', 'creator-testimonials', $sec4Pics['pics'], $sec4s);
            }
            unset($input['sec4_image']);

            $data = serialize(array_merge($content_row, $input));
            $page->ckey = $request->segment(3);
            $page->code = $data;
            $page->save();
            return redirect('admin/pages/' . $request->segment(3))
                ->with('success', 'Content Updated Successfully');
        }

        $this->data['row'] = Sitecontent::where('ckey', $request->segment(3))->first();
        if (!empty($this->data['row']->code)) {
            $this->data['sitecontent'] = unserialize($this->data['row']->code);
        } else {
            $this->data['sitecontent'] = [];
        }
        return view('admin.website_pages.site_home', $this->data);
    }


    public function become_creator(Request $request)
    {


      has_access(12);
        $page = Sitecontent::where('ckey', $request->segment(3))->first();
        if (empty($page)) {
            $page = new Sitecontent;
            $page->ckey = $request->segment(3);
            $page->code = '';
            $page->save();
        }
        $input = $request->all();
        if ($input) {
            if (!empty($page->code)) {
                $content_row = unserialize($page->code);
            } else {
                $content_row = array();
            }
            if (!is_array($content_row))
                $content_row = array();
            for ($i = 1; $i <= 10; $i++) {
                if ($request->hasFile('image' . $i)) {

                    $request->validate([
                        'image' . $i => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000'
                    ]);
                    $image = $request->file('image' . $i)->store('public/images/');
                    if (!empty($image)) {
                        $input['image' . $i] = basename($image);
                    }
                }
            }

            $sec1['title'] = $input['sec1_title'] ?? '';
            $sec1['txt1'] = $input['sec1_txt1'] ?? '';
            $sec1['order_no'] = $input['sec1_order_no'] ?? '';
            $sec1Phto['pics'] = $input['sec1_pics'] ?? '';
            unset($input['sec1_pics'], $input['sec1_order_no'], $input['sec1_title'], $input['sec1_txt1']);
            DB::table('multi_text')->where('section', 'home-jobs')->delete();
            $sec1s = array('order_no' => $sec1['order_no'], 'title' => $sec1['title'], 'txt1' => $sec1['txt1']);
            // pr($sec1Phto);
            if (!empty($request->file('sec1_image')) || !empty($sec1Phto['pics'])) {
                saveMultiMediaFieldsImgs('public/images/', $request->file('sec1_image'), 'sec1_image', 'home-jobs', $sec1Phto['pics'], $sec1s);
            }
            unset($input['sec1_image']);



            $sec2['title'] = $input['sec2_title'] ?? '';
            $sec2['txt1'] = $input['sec2_txt1'] ?? '';
            $sec2['order_no'] = $input['sec2_order_no'] ?? '';
            $sec2Phto['pics'] = $input['sec2_pics'] ?? '';
            unset($input['sec2_pics'], $input['sec2_order_no'], $input['sec2_title'], $input['sec2_txt1']);
            DB::table('multi_text')->where('section', 'why-choose-us')->delete();
            $sec2s = array('order_no' => $sec2['order_no'], 'title' => $sec2['title'], 'txt1' => $sec2['txt1']);
            // pr($sec2Phto);
            if (!empty($request->file('sec2_image')) || !empty($sec2Phto['pics'])) {
                saveMultiMediaFieldsImgs('public/images/', $request->file('sec2_image'), 'sec2_image', 'why-choose-us', $sec2Phto['pics'], $sec2s);
            }
            unset($input['sec2_image']);


            $sec3['title'] = $input['sec3_title'] ?? '';
            $sec3['txt1'] = $input['sec3_txt1'] ?? '';
            $sec3['order_no'] = $input['sec3_order_no'] ?? '';
            unset($input['sec3_order_no'], $input['sec3_title'], $input['sec3_txt1']);
            DB::table('multi_text')->where('section', 'our-products')->delete();
            $sec3s = array('order_no' => $sec3['order_no'], 'title' => $sec3['title'], 'txt1' => $sec3['txt1']);
            saveMultiText($sec3s, 'our-products');



            // pr($input);
            $data = serialize(array_merge($content_row, $input));
            // pr($input);
            $page->ckey = $request->segment(3);
            $page->code = $data;
            $page->save();
            return redirect('admin/pages/' . $request->segment(3))
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Sitecontent::where('ckey', $request->segment(3))->first();
        if (!empty($this->data['row']->code)) {
            $this->data['sitecontent'] = unserialize($this->data['row']->code);
        } else {
            $this->data['sitecontent'] = array();
        }
        return view('admin.website_pages.site_become_creator', $this->data);
      
    }

   



    public function contact_us(Request $request)
    {
        // has_access(12);
        $page = Sitecontent::where('ckey', $request->segment(3))->first();
        if (empty($page)) {
            $page = new Sitecontent;
            $page->ckey = $request->segment(3);
            $page->code = '';
            $page->save();
        }
        $input = $request->all();
        if ($input) {
            if (!empty($page->code)) {
                $content_row = unserialize($page->code);
            } else {
                $content_row = array();
            }
            if (!is_array($content_row))
                $content_row = array();

            if (!is_array($content_row))
                $content_row = array();
            for ($i = 1; $i <= 1; $i++) {
                if ($request->hasFile('image' . $i)) {

                    $request->validate([
                        'image' . $i => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000'
                    ]);
                    $image = $request->file('image' . $i)->store('public/images/');
                    if (!empty($image)) {
                        $input['image' . $i] = basename($image);
                    }
                } else {
                    // $input['image'.$i]='';
                }
            }
            // pr($input);

            $data = serialize(array_merge($content_row, $input));
            $page->ckey = $request->segment(3);
            $page->code = $data;
            $page->save();
            return redirect('admin/pages/' . $request->segment(3))
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Sitecontent::where('ckey', $request->segment(3))->first();
        if (!empty($this->data['row']->code)) {
            $this->data['sitecontent'] = unserialize($this->data['row']->code);
        } else {
            $this->data['sitecontent'] = array();
        }
        return view('admin.website_pages.site_contact_us', $this->data);
    }


    public function faqs(Request $request)
    {
        has_access(12);
        $page = Sitecontent::where('ckey', $request->segment(3))->first();
        if (empty($page)) {
            $page = new Sitecontent;
            $page->ckey = $request->segment(3);
            $page->code = '';
            $page->save();
        }
        $input = $request->all();
        if ($input) {
            if (!empty($page->code)) {
                $content_row = unserialize($page->code);
            } else {
                $content_row = array();
            }
            if (!is_array($content_row))
                $content_row = array();
            for ($i = 1; $i <= 5; $i++) {
                if ($request->hasFile('image' . $i)) {

                    $request->validate([
                        'image' . $i => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000'
                    ]);
                    $image = $request->file('image' . $i)->store('public/images/');
                    if (!empty($image)) {
                        $input['image' . $i] = basename($image);
                    }
                }
            }


            $data = serialize(array_merge($content_row, $input));
            // pr($input);
            $page->ckey = $request->segment(3);
            $page->code = $data;
            $page->save();
            return redirect('admin/pages/' . $request->segment(3))
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Sitecontent::where('ckey', $request->segment(3))->first();
        if (!empty($this->data['row']->code)) {
            $this->data['sitecontent'] = unserialize($this->data['row']->code);
        } else {
            $this->data['sitecontent'] = array();
        }
        return view('admin.website_pages.site_faqs', $this->data);
    }



   

    public function about_us(Request $request)
    {
        has_access(12);
        $page = Sitecontent::where('ckey', $request->segment(3))->first();
        if (empty($page)) {
            $page = new Sitecontent;
            $page->ckey = $request->segment(3);
            $page->code = '';
            $page->save();
        }
        $input = $request->all();
        if ($input) {
            if (!empty($page->code)) {
                $content_row = unserialize($page->code);
            } else {
                $content_row = array();
            }
            if (!is_array($content_row))
                $content_row = array();
            for ($i = 1; $i <= 10; $i++) {
                if ($request->hasFile('image' . $i)) {

                    $request->validate([
                        'image' . $i => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000'
                    ]);
                    $image = $request->file('image' . $i)->store('public/images/');
                    if (!empty($image)) {
                        $input['image' . $i] = basename($image);
                    }
                }
            }


            $data = serialize(array_merge($content_row, $input));
            // pr($input);
            $page->ckey = $request->segment(3);
            $page->code = $data;
            $page->save();
            return redirect('admin/pages/' . $request->segment(3))
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Sitecontent::where('ckey', $request->segment(3))->first();
        // pr($this->data['row']->code);
        if (!empty($this->data['row']->code)) {
            $this->data['sitecontent'] = unserialize($this->data['row']->code);
        } else {
            $this->data['sitecontent'] = array();
        }
        return view('admin.website_pages.site_about_us', $this->data);
    }

    public function blog(Request $request)
    {
        has_access(12);
        $page = Sitecontent::where('ckey', $request->segment(3))->first();
        if (empty($page)) {
            $page = new Sitecontent;
            $page->ckey = $request->segment(3);
            $page->code = '';
            $page->save();
        }
        $input = $request->all();
        if ($input) {
            if (!empty($page->code)) {
                $content_row = unserialize($page->code);
            } else {
                $content_row = array();
            }
            if (!is_array($content_row))
                $content_row = array();
            for ($i = 1; $i <= 7; $i++) {
                if ($request->hasFile('image' . $i)) {

                    $request->validate([
                        'image' . $i => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000'
                    ]);
                    $image = $request->file('image' . $i)->store('public/images/');
                    if (!empty($image)) {
                        $input['image' . $i] = basename($image);
                    }
                }
            }


            $data = serialize(array_merge($content_row, $input));
            // pr($input);
            $page->ckey = $request->segment(3);
            $page->code = $data;
            $page->save();
            return redirect('admin/pages/' . $request->segment(3))
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Sitecontent::where('ckey', $request->segment(3))->first();
        if (!empty($this->data['row']->code)) {
            $this->data['sitecontent'] = unserialize($this->data['row']->code);
        } else {
            $this->data['sitecontent'] = array();
        }
        return view('admin.website_pages.site_blog', $this->data);
    }



 






    public function request_quote(Request $request)
    {
        has_access(12);
        $page = Sitecontent::where('ckey', $request->segment(3))->first();
        if (empty($page)) {
            $page = new Sitecontent;
            $page->ckey = $request->segment(3);
            $page->code = '';
            $page->save();
        }
        $input = $request->all();
        if ($input) {
            if (!empty($page->code)) {
                $content_row = unserialize($page->code);
            } else {
                $content_row = array();
            }

            if (!is_array($content_row))
                $content_row = array();
            for ($i = 1; $i <= 1; $i++) {
                if ($request->hasFile('image' . $i)) {

                    $request->validate([
                        'image' . $i => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000'
                    ]);
                    $image = $request->file('image' . $i)->store('public/images/');
                    if (!empty($image)) {
                        $input['image' . $i] = basename($image);
                    }
                } else {
                    // $input['image'.$i]='';
                }
            }
            // pr($input);
            $data = serialize(array_merge($content_row, $input));
            $page->ckey = $request->segment(3);
            $page->code = $data;
            $page->save();
            return redirect('admin/pages/' . $request->segment(3))
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Sitecontent::where('ckey', $request->segment(3))->first();;
        if (!empty($this->data['row']->code)) {
            $this->data['sitecontent'] = unserialize($this->data['row']->code);
        } else {
            $this->data['sitecontent'] = array();
        }
        $this->data['enable_editor'] = true;
        return view('admin.website_pages.site_request_quote', $this->data);
    }




    public function cta_section(Request $request)
    {
        has_access(12);
        $page = Sitecontent::where('ckey', $request->segment(3))->first();
        if (empty($page)) {
            $page = new Sitecontent;
            $page->ckey = $request->segment(3);
            $page->code = '';
            $page->save();
        }
        $input = $request->all();
        if ($input) {
            if (!empty($page->code)) {
                $content_row = unserialize($page->code);
            } else {
                $content_row = array();
            }
            if (!is_array($content_row))
                $content_row = array();
            for ($i = 1; $i <= 10; $i++) {
                if ($request->hasFile('image' . $i)) {

                    $request->validate([
                        'image' . $i => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000'
                    ]);
                    $image = $request->file('image' . $i)->store('public/images/');
                    if (!empty($image)) {
                        $input['image' . $i] = basename($image);
                    }
                }
            }

            // pr($input);
            $data = serialize(array_merge($content_row, $input));
            // pr($input);
            $page->ckey = $request->segment(3);
            $page->code = $data;
            $page->save();
            return redirect('admin/pages/' . $request->segment(3))
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Sitecontent::where('ckey', $request->segment(3))->first();
        if (!empty($this->data['row']->code)) {
            $this->data['sitecontent'] = unserialize($this->data['row']->code);
        } else {
            $this->data['sitecontent'] = array();
        }
        return view('admin.website_pages.cta_section', $this->data);
    }

    
}

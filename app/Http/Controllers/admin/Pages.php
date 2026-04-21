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
        return view('admin.website_pages.site_home', $this->data);
    }

    public function aviva_pools(Request $request)
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

            for ($i = 1; $i <= 20; $i++) {
                if ($request->hasFile('image' . $i)) {

                    $request->validate([
                        'image' . $i => 'mimes:png,jpg,jpeg,svg,gif,webp|max:70000'
                    ]);
                    $image = $request->file('image' . $i)->store('public/images/');
                    if (!empty($image)) {
                        $input['image' . $i] = basename($image);
                    }
                }
            }


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
        return view('admin.website_pages.site_aviva_pools', $this->data);
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



    public function hardscapes(Request $request)
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
            for ($i = 1; $i <= 20; $i++) {
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
        return view('admin.website_pages.site_hardscapes', $this->data);
    }




    public function colors(Request $request)
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
            for ($i = 1; $i <= 13; $i++) {
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
        return view('admin.website_pages.site_colors', $this->data);
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



    public function renaissance_patio(Request $request)
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
        return view('admin.website_pages.site_renaissance_patio', $this->data);
    }





    public function stick_built(Request $request)
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
        return view('admin.website_pages.site_stick_built', $this->data);
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

    public function pool_details(Request $request)
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
        return view('admin.website_pages.site_pool_details', $this->data);
    }

    public function patio_details(Request $request)
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
        return view('admin.website_pages.site_patio_details', $this->data);
    }

    public function hardscapes_details(Request $request)
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
        return view('admin.website_pages.site_hardscapes_details', $this->data);
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

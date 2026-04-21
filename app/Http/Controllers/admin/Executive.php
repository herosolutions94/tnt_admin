<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Team_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;

class Executive extends Controller
{
    public function index()
    {
        has_access(17);
        $this->data['rows'] = Team_model::where('ex_members', 1)->orderBy('id', 'DESC')->get();
        return view('admin.team.executive', $this->data);
    }
    public function add(Request $request)
    {
        has_access(17);
        $input = $request->all();
        // pr($input);
        if ($input) {
            $data = array();


            if ($request->hasFile('image')) {
                $request->validate([
                    'image' => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000'
                ]);
                $image = $request->file('image')->store('public/team/');
                if (!empty(basename($image))) {
                    $data['image'] = basename($image);
                }
            }

            if (!empty($input['status'])) {
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }

            $data['name'] = $input['name'];
            $data['designation'] = $input['designation'];
            $data['ex_members'] = 1;
            // $data['email'] = $input['email'];
            // $data['phone'] = $input['phone'];
            // $data['fb_link'] = $input['fb_link'];
            // $data['inst_link'] = $input['inst_link'];
            // $data['lin_link'] = $input['lin_link'];
            // $data['x_link'] = $input['x_link'];
            // $data['detail'] = $input['detail'];
            $id = Team_model::create($data);
            return redirect('admin/executive/')
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['enable_editor'] = true;
        return view('admin.team.executive', $this->data);
    }
    public function edit(Request $request, $id)
    {
        has_access(17);
        $executive = Team_model::find($id);
        $input = $request->all();
        if ($input) {
            $data = array();

            if ($request->hasFile('image')) {

                $request->validate([
                    'image' => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000'
                ]);
                $image = $request->file('image')->store('public/team/');
                if (!empty($image)) {
                    if (!empty($executive->image)) {
                        removeImage("team/" . $executive->image);
                    }

                    $executive->image = basename($image);
                }
            }

            if (!empty($input['status'])) {
                $executive->status = 1;
            } else {
                $executive->status = 0;
            }

            $executive->name = $input['name'];
            $executive->designation = $input['designation'];
            $executive->ex_members = 1;
            // $executive->email = $input['email'];
            // $executive->phone = $input['phone'];
            // $executive->fb_link = $input['fb_link'];
            // $executive->inst_link = $input['inst_link'];
            // $executive->lin_link = $input['lin_link'];
            // $executive->x_link = $input['x_link'];
            // $executive->detail = $input['detail'];

            $executive->update();
            return redirect('admin/executive/')
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Team_model::find($id);
        $this->data['enable_editor'] = true;
        return view('admin.team.executive', $this->data);
    }
    public function delete($id)
    {
        has_access(17);
        $executive = Team_model::find($id);
        if (!empty($executive->image)) {
            removeImage("team/" . $executive->image);
        }
        $executive->delete();
        return redirect('admin/executive/')
            ->with('error', 'Content deleted Successfully');
    }
}

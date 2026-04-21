<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Team_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Directors extends Controller
{
    public function index()
    {
        has_access(17);
        $this->data['rows'] = Team_model::where('bod_members', 1)->orderBy('id', 'DESC')->get();
        return view('admin.team.directors', $this->data);
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
            $data['bod_members'] = 1;
            // $data['email'] = $input['email'];
            // $data['phone'] = $input['phone'];
            // $data['fb_link'] = $input['fb_link'];
            // $data['inst_link'] = $input['inst_link'];
            // $data['lin_link'] = $input['lin_link'];
            // $data['x_link'] = $input['x_link'];
            // $data['detail'] = $input['detail'];
            $id = Team_model::create($data);
            return redirect('admin/directors/')
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['enable_editor'] = true;
        return view('admin.team.directors', $this->data);
    }
    public function edit(Request $request, $id)
    {
        has_access(17);
        $bod_member = Team_model::find($id);
        $input = $request->all();
        if ($input) {
            $data = array();

            if ($request->hasFile('image')) {

                $request->validate([
                    'image' => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000'
                ]);
                $image = $request->file('image')->store('public/team/');
                if (!empty($image)) {
                    if (!empty($bod_member->image)) {
                        removeImage("team/" . $bod_member->image);
                    }

                    $bod_member->image = basename($image);
                }
            }


            if (!empty($input['status'])) {
                $bod_member->status = 1;
            } else {
                $bod_member->status = 0;
            }


            $bod_member->name = $input['name'];
            $bod_member->designation = $input['designation'];
            $bod_member->bod_members = 1;
            // $bod_member->email = $input['email'];
            // $bod_member->phone = $input['phone'];
            // $bod_member->fb_link = $input['fb_link'];
            // $bod_member->inst_link = $input['inst_link'];
            // $bod_member->lin_link = $input['lin_link'];
            // $bod_member->x_link = $input['x_link'];
            // $bod_member->detail = $input['detail'];

            $bod_member->update();
            return redirect('admin/directors/')
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Team_model::find($id);
        $this->data['enable_editor'] = true;
        return view('admin.team.directors', $this->data);
    }
    public function delete($id)
    {
        has_access(17);
        $bod_member = Team_model::find($id);
        if (!empty($bod_member->image)) {
            removeImage("team/" . $bod_member->image);
        }
        // $this->remove_file($id);
        $bod_member->delete();
        return redirect('admin/directors/')
            ->with('error', 'Content deleted Successfully');
    }
}

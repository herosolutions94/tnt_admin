<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Team_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;

class Team extends Controller
{
    public function index()
    {
        has_access(17);
        $this->data['rows'] = Team_model::where('team', 1)->orderBy('id', 'DESC')->get();
        return view('admin.team.index', $this->data);
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
            $data['team'] = 1;
            // $data['email'] = $input['email'];
            // $data['phone'] = $input['phone'];
            // $data['fb_link'] = $input['fb_link'];
            // $data['inst_link'] = $input['inst_link'];
            // $data['lin_link'] = $input['lin_link'];
            // $data['x_link'] = $input['x_link'];
            // $data['detail'] = $input['detail'];
            $id = Team_model::create($data);
            return redirect('admin/team/')
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['enable_editor'] = true;
        return view('admin.team.index', $this->data);
    }
    public function edit(Request $request, $id)
    {
        has_access(17);
        $team = Team_model::find($id);
        $input = $request->all();
        if ($input) {
            $data = array();

            if ($request->hasFile('image')) {

                $request->validate([
                    'image' => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000'
                ]);
                $image = $request->file('image')->store('public/team/');
                if (!empty($image)) {
                    if (!empty($team->image)) {
                        removeImage("team/" . $team->image);
                    }

                    $team->image = basename($image);
                }
            }

            if (!empty($input['status'])) {
                $team->status = 1;
            } else {
                $team->status = 0;
            }

            $team->name = $input['name'];
            $team->designation = $input['designation'];
            $team->team = 1;
            // $team->email = $input['email'];
            // $team->phone = $input['phone'];
            // $team->fb_link = $input['fb_link'];
            // $team->inst_link = $input['inst_link'];
            // $team->lin_link = $input['lin_link'];
            // $team->x_link = $input['x_link'];
            // $team->detail = $input['detail'];

            $team->update();
            return redirect('admin/team/')
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Team_model::find($id);
        $this->data['enable_editor'] = true;
        return view('admin.team.index', $this->data);
    }
    public function delete($id)
    {
        has_access(17);
        $team = Team_model::find($id);
        if (!empty($team->image)) {
            removeImage("team/" . $team->image);
        }
        $team->delete();
        return redirect('admin/team/')
            ->with('error', 'Content deleted Successfully');
    }
}

<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\Coaches_model;
use App\Http\Controllers\Controller;

class Coaches extends Controller
{
    public function index()
    {
        $this->data['rows'] = Coaches_model::orderBy('id', 'DESC')->get();
        return view('admin.coaches.index', $this->data);
    }

    public function add(Request $request)
    {
        $input = $request->all();
        if ($input) {
            $data = [];
            if ($request->hasFile('image')) {
                $request->validate([
                    'image' => 'mimes:png,jpg,jpeg,svg,gif,webp|max:400000'
                ]);
                $image = $request->file('image')->store('public/coaches/');
                if (!empty(basename($image))) {
                    $data['image'] = basename($image);
                }
            }
            $data['status']      = !empty($input['status']) ? 1 : 0;
            $data['name']        = $input['name'];
            $data['description'] = $input['description'];
            $data['followers']   = $input['followers'];
            $data['platform']    = $input['platform'];

            Coaches_model::create($data);
            return redirect('admin/coaches')->with('success', 'Coach added successfully');
        }
        return view('admin.coaches.index', $this->data);
    }

    public function edit(Request $request, $id)
    {
        $coach = Coaches_model::find($id);
        $input = $request->all();
        if ($input) {
            if ($request->hasFile('image')) {
                $request->validate([
                    'image' => 'mimes:png,jpg,jpeg,svg,gif,webp|max:400000'
                ]);
                $image = $request->file('image')->store('public/coaches/');
                if (!empty($image)) {
                    removeImage('coaches/' . $coach->image);
                    $coach->image = basename($image);
                }
            }
            $coach->status      = !empty($input['status']) ? 1 : 0;
            $coach->name        = $input['name'];
            $coach->description = $input['description'];
            $coach->followers   = $input['followers'];
            $coach->platform    = $input['platform'];
            $coach->update();
            return redirect('admin/coaches')->with('success', 'Coach updated successfully');
        }
        $this->data['row'] = Coaches_model::find($id);
        return view('admin.coaches.index', $this->data);
    }

    public function delete($id)
    {
        $coach = Coaches_model::find($id);
        if (!empty($coach->image)) {
            removeImage('coaches/' . $coach->image);
        }
        $coach->delete();
        return redirect('admin/coaches')->with('error', 'Coach deleted successfully');
    }
}

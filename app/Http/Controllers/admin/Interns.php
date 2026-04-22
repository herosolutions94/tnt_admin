<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\Interns_model;
use App\Http\Controllers\Controller;

class Interns extends Controller
{
    public function index()
    {
        $this->data['rows'] = Interns_model::orderBy('id', 'DESC')->get();
        return view('admin.interns.index', $this->data);
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
                $image = $request->file('image')->store('public/interns/');
                if (!empty(basename($image))) {
                    $data['image'] = basename($image);
                }
            }
            $data['status']      = !empty($input['status']) ? 1 : 0;
            $data['name']        = $input['name'];
            $data['description'] = $input['description'];
            $data['time_period'] = $input['time_period'];

            Interns_model::create($data);
            return redirect('admin/interns')->with('success', 'Intern added successfully');
        }
        return view('admin.interns.index', $this->data);
    }

    public function edit(Request $request, $id)
    {
        $intern = Interns_model::find($id);
        $input  = $request->all();
        if ($input) {
            if ($request->hasFile('image')) {
                $request->validate([
                    'image' => 'mimes:png,jpg,jpeg,svg,gif,webp|max:400000'
                ]);
                $image = $request->file('image')->store('public/interns/');
                if (!empty($image)) {
                    removeImage('interns/' . $intern->image);
                    $intern->image = basename($image);
                }
            }
            $intern->status      = !empty($input['status']) ? 1 : 0;
            $intern->name        = $input['name'];
            $intern->description = $input['description'];
            $intern->time_period = $input['time_period'];
            $intern->update();
            return redirect('admin/interns')->with('success', 'Intern updated successfully');
        }
        $this->data['row'] = Interns_model::find($id);
        return view('admin.interns.index', $this->data);
    }

    public function delete($id)
    {
        $intern = Interns_model::find($id);
        if (!empty($intern->image)) {
            removeImage('interns/' . $intern->image);
        }
        $intern->delete();
        return redirect('admin/interns')->with('error', 'Intern deleted successfully');
    }
}

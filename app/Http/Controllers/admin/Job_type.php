<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Job_type_model;
use App\Http\Controllers\Controller;

class Job_type extends Controller
{

    public function index()
    {
        has_access(18);
        $this->data['rows'] = Job_type_model::orderBy('id', 'DESC')->get();
        return view('admin.jobs.job_type', $this->data);
    }
    public function add(Request $request)
    {
        has_access(18);
        $input = $request->all();
        if ($input) {
            $data = array();
            if (!empty($input['status'])) {
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }
            $data['name'] = $input['name'];
            $data['slug'] = checkSlug(Str::slug($data['name'], '-'), 'job_type');
            // pr($data);
            $id = Job_type_model::create($data);
            return redirect('admin/job_type/')
                ->with('success', 'Content Updated Successfully');
        }

        return view('admin.jobs.job_type', $this->data);
    }
    public function edit(Request $request, $id)
    {
        has_access(18);
        $category = Job_type_model::find($id);
        $input = $request->all();
        if ($input) {
            $data = array();
            // pr($input['status']);
            if (!empty($input['status'])) {
                $category->status = 1;
            } else {
                $category->status = 0;
            }
            $category->name = $input['name'];
            $category->slug = checkSlug(Str::slug($category->name, '-'), 'job_type', $category->id);

            // pr($category);
            $category->update();
            return redirect('admin/job_type/')
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Job_type_model::find($id);
        return view('admin.jobs.job_type', $this->data);
    }
    public function delete($id)
    {
        has_access(18);
        $category = Job_type_model::find($id);
        $category->delete();
        return redirect('admin/job_type/')
            ->with('error', 'Content deleted Successfully');
    }
}

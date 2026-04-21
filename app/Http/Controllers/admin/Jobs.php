<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Countries_model;
use App\Models\Jobs_model;
use App\Models\Specialization_model;
use App\Models\Job_type_model;
use App\Models\Locations_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Jobs extends Controller
{
    public function index()
    {
        has_access(17);
        $this->data['rows'] = Jobs_model::orderBy('id', 'DESC')->get();
        foreach ($this->data['rows'] as $row) {
            $row->specialization_name = $row->specialization_row->name;
        }
        return view('admin.jobs.index', $this->data);
    }
    public function add(Request $request)
    {
        has_access(17);
        $input = $request->all();
        if ($input) {
            $data = array();
            if ($request->hasFile('image')) {

                $request->validate([
                    'image' => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000'
                ]);
                $image = $request->file('image')->store('public/company/');
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

            $data['spec_id'] = $input['spec_id'];
            $data['type_id'] = $input['type_id'];
            $data['meta_title'] = $input['meta_title'];
            $data['meta_description'] = $input['meta_description'];
            $data['meta_keywords'] = $input['meta_keywords'];
            $data['title'] = $input['title'];
            $data['slug'] = checkSlug(Str::slug($data['title'], '-'), 'jobs');
            $data['company_name'] = $input['company_name'];
            $data['min_salary'] = $input['min_salary'];
            $data['max_salary'] = $input['max_salary'];
            $data['detail'] = $input['detail'];
            $data['application_process'] = $input['application_process'];
            // $data['country_id'] = $input['country_id'];
            // $data['state_id'] = $input['state_id'];
            // $data['city'] = $input['city'];
            $data['city_id'] = $input['city_id'];
            $data['location'] = $input['location'];
            $data['zip_code'] = $input['zip_code'];

            // $data['short_detail'] = $input['short_detail'];

            // pr($data);
            $id = Jobs_model::create($data);
            return redirect('admin/jobs/')
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['enable_editor'] = true;
        $this->data['specializations'] = Specialization_model::where('status', 1)->get();
        $this->data['job_types'] = Job_type_model::where('status', 1)->get();
        $this->data['city_locations'] = Locations_model::where('status', 1)->get();
        // $this->data['countries'] = Countries_model::get();
        return view('admin.jobs.index', $this->data);
    }
    public function edit(Request $request, $id)
    {
        has_access(17);
        $job = Jobs_model::find($id);
        $input = $request->all();
        if ($input) {
            $data = array();
            if ($request->hasFile('image')) {

                $request->validate([
                    'image' => 'mimes:png,jpg,jpeg,svg,gif,webp|max:40000'
                ]);
                $image = $request->file('image')->store('public/company/');
                if (!empty($image)) {
                    if (!empty($job->image)) {
                        removeImage("company/" . $job->image);
                    }
                    // generateThumbnail('company', basename($image), 'square', 'large');
                    $job->image = basename($image);
                }
            }
            if (!empty($input['status'])) {
                $job->status = 1;
            } else {
                $job->status = 0;
            }
            if (!empty($input['featured'])) {
                $job->featured = 1;
            } else {
                $job->featured = 0;
            }
            $job->spec_id = $input['spec_id'];
            $job->type_id = $input['type_id'];
            $job->meta_title = $input['meta_title'];
            $job->meta_description = $input['meta_description'];
            $job->meta_keywords = $input['meta_keywords'];
            $job->title = $input['title'];
            $job->slug = checkSlug(Str::slug($job->title, '-'), 'jobs', $job->id);
            $job->company_name = $input['company_name'];
            $job->min_salary = $input['min_salary'];
            $job->max_salary = $input['max_salary'];
            $job->application_process = $input['application_process'];
            $job->detail = $input['detail'];
            // $job->country_id = $input['country_id'];
            // $job->state_id = $input['state_id'];
            // $job->city = $input['city'];zip_code
            $job->city_id = $input['city_id'];
            $job->location = $input['location'];
            $job->zip_code = $input['zip_code'];


            // pr($data);
            $job->update();
            return redirect('admin/jobs/')
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Jobs_model::find($id);
        $this->data['enable_editor'] = true;
        $this->data['specializations'] = Specialization_model::where('status', 1)->get();
        $this->data['job_types'] = Job_type_model::where('status', 1)->get();
        // $this->data['countries'] = Countries_model::get();
        $this->data['city_locations'] = Locations_model::where('status', 1)->get();

        return view('admin.jobs.index', $this->data);
    }

    public function delete($id)
    {
        has_access(17);
        $job = Jobs_model::find($id);
        if (!empty($job->image)) {
            removeImage("company/" . $job->image);
        }
        $job->delete();
        return redirect('admin/jobs/')
            ->with('error', 'Content deleted Successfully');
    }

    // public function get_states(Request $request)
    // {
    //     $country_id = $request->country_id;
    //     $output = '<option value="">Select State</option>';

    //     if ($country_id) {
    //         $states = DB::table('states')->where('country_id', $country_id)->get();

    //         if ($states->count() > 0) {
    //             foreach ($states as $state) {
    //                 $output .= '<option value="' . $state->id . '">' . ucfirst($state->name) . '</option>';
    //             }
    //         } else {
    //             $output .= '<option value="">No States Available!</option>';
    //         }
    //     } else {
    //         $output .= '<option value="">No States Available!</option>';
    //     }

    //     return (json_encode($output));
    // }
}

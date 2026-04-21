<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Locations_model;
use App\Http\Controllers\Controller;
use App\Models\Countries_model;
use Illuminate\Support\Facades\DB;

class Locations extends Controller
{

    public function index()
    {
        has_access(18);
        $this->data['rows'] = Locations_model::orderBy('id', 'DESC')->get();
        return view('admin.jobs.locations', $this->data);
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
            $data['country_id'] = $input['country_id'];
            $data['state_id'] = $input['state_id'];
            $data['city'] = $input['city'];
            $data['slug'] = checkSlug(Str::slug($data['city'], '-'), 'locations');
            // pr($data);
            $id = Locations_model::create($data);
            return redirect('admin/locations/')
                ->with('success', 'Content Updated Successfully');
        }

        $this->data['countries'] = Countries_model::get();
        return view('admin.jobs.locations', $this->data);
    }
    public function edit(Request $request, $id)
    {
        has_access(18);
        $category = Locations_model::find($id);
        $input = $request->all();
        if ($input) {
            $data = array();
            // pr($input['status']);
            if (!empty($input['status'])) {
                $category->status = 1;
            } else {
                $category->status = 0;
            }
            $category->country_id = $input['country_id'];
            $category->state_id = $input['state_id'];
            $category->city = $input['city'];
            $category->slug = checkSlug(Str::slug($category->city, '-'), 'locations', $category->id);

            // pr($category);
            $category->update();
            return redirect('admin/locations/')
                ->with('success', 'Content Updated Successfully');
        }
        $this->data['row'] = Locations_model::find($id);
        $this->data['countries'] = Countries_model::get();
        return view('admin.jobs.locations', $this->data);
    }

    public function get_states(Request $request)
    {
        $country_id = $request->country_id;
        $output = '<option value="">Select State</option>';

        if ($country_id) {
            $states = DB::table('states')->where('country_id', $country_id)->get();

            if ($states->count() > 0) {
                foreach ($states as $state) {
                    $output .= '<option value="' . $state->id . '">' . ucfirst($state->name) . '</option>';
                }
            } else {
                $output .= '<option value="">No States Available!</option>';
            }
        } else {
            $output .= '<option value="">No States Available!</option>';
        }

        return (json_encode($output));
    }

    public function delete($id)
    {
        has_access(18);
        $category = Locations_model::find($id);
        $category->delete();
        return redirect('admin/locations/')
            ->with('error', 'Content deleted Successfully');
    }
}

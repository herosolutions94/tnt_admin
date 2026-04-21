@extends('layouts.adminlayout')
@section('page_meta')
    <meta name="description" content={{ !empty($site_settings) ? $site_settings->site_meta_desc : '' }}">
    <meta name="keywords" content="{{ !empty($site_settings) ? $site_settings->site_meta_keyword : '' }}">
    <meta name="author" content="{{ !empty($site_settings->site_name) ? $site_settings->site_name : 'Login' }}">
    <title>Admin - {{ $site_settings->site_name }}</title>
@endsection
@section('page_content')
    @if (request()->segment(3) == 'edit' || request()->segment(3) == 'add')
        {!! breadcrumb('Add/Update Jobs') !!}
        <form class="form theme-form" method="post" action="" enctype="multipart/form-data" id="saveForm">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <div class="col-lg-12 d-flex align-items-stretch">
                            <div class="card w-100 border position-relative overflow-hidden">
                                <div class="card-body p-4">
                                    <h4 class="card-title">Meta Information Block</h4>
                                    <div class="mb-3">
                                        <label for="detail" class="form-label">Meta Title</label>
                                        <input class="form-control" id="meta_title" type="text" name="meta_title"
                                            placeholder="" value="{{ !empty($row->meta_title) ? $row->meta_title : '' }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="detail" class="form-label">Meta Description</label>
                                        <textarea class="form-control" id="meta_description" rows="3" name="meta_description">{{ !empty($row->meta_description) ? $row->meta_description : '' }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="detail" class="form-label">Meta Keywords</label>
                                        <textarea class="form-control" id="meta_keywords" rows="3" name="meta_keywords">{{ !empty($row->meta_keywords) ? $row->meta_keywords : '' }}</textarea>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 d-flex align-items-stretch">
                            <div class="card w-100 border position-relative overflow-hidden">
                                <div class="card-body p-4">
                                    <h4 class="card-title">Job Block</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Title</label>
                                                <input type="text" class="form-control" name="title"
                                                    value="{{ !empty($row->title) ? $row->title : '' }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="company_name" class="form-label">Company Name</label>
                                                <input type="text" class="form-control" name="company_name"
                                                    value="{{ !empty($row->company_name) ? $row->company_name : '' }}"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="spec_id" class="form-label">Job Specialization</label>
                                                <select name="spec_id" class="form-control" required>
                                                    <option value="">Select Specialization</option>
                                                    @foreach ($specializations as $special)
                                                        <option value="{{ $special->id }}"
                                                            {{ !empty($row) ? ($row->spec_id == $special->id ? 'selected' : '') : '' }}>
                                                            {{ !empty($special->name) ? $special->name : '' }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="type_id" class="form-label">Job Types</label>
                                                <select name="type_id" class="form-control" required>
                                                    <option value="">Select Job Type</option>
                                                    @foreach ($job_types as $type)
                                                        <option value="{{ $type->id }}"
                                                            {{ !empty($row) ? ($row->type_id == $type->id ? 'selected' : '') : '' }}>
                                                            {{ !empty($type->name) ? $type->name : '' }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="location" class="form-label">Job Location</label>
                                                <select name="location" class="form-control" required>
                                                    <option value="onsite"
                                                        {{ isset($row->location) && 'onsite' == $row->location ? ' selected' : '' }}>
                                                        Onsite</option>
                                                    <option value="remote"
                                                        {{ isset($row->location) && 'remote' == $row->location ? ' selected' : '' }}>
                                                        Remote</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="city_id" class="form-label">Locations</label>
                                                <select name="city_id" id="city_id" class="form-control">
                                                    <option value="">Select Locations</option>
                                                    @foreach ($city_locations as $city_loc)
                                                        <option value="{{ $city_loc->id }}"
                                                            {{ !empty($row) ? ($row->city_id == $city_loc->id ? 'selected' : '') : '' }}>
                                                            {{ !empty($city_loc->city) ? $city_loc->city : '' }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="country_id" class="form-label">Countries</label>
                                                <select name="country_id" id="country_id" class="form-control">
                                                    <option value="">Select Country</option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}"
                                                            {{ !empty($row) ? ($row->country_id == $country->id ? 'selected' : '') : '' }}>
                                                            {{ !empty($country->name) ? $country->name : '' }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> --}}

                                        {{-- <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="state_id" class="form-label">States</label>
                                                <select name="state_id" id="state_id" class="form-control">
                                                    <option value="">Select State</option>
                                                    @if (!empty($row->country_id))
                                                        @php
                                                            $states = DB::table('states')
                                                                ->where('country_id', $row->country_id)
                                                                ->get();
                                                        @endphp
                                                        @foreach ($states as $state)
                                                            <option value="{{ $state->id }}"
                                                                {{ !empty($row->state_id) && $row->state_id == $state->id ? 'selected' : '' }}>
                                                                {{ $state->name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div> --}}

                                        {{-- <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="city" class="form-label">City</label>
                                                <input type="text" class="form-control" name="city"
                                                    value="{{ !empty($row->city) ? $row->city : '' }}" required>
                                            </div>
                                        </div> --}}

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="min_salary" class="form-label">Minimum Salary</label>
                                                <input type="number" min="0" class="form-control"
                                                    name="min_salary"
                                                    value="{{ !empty($row->min_salary) ? $row->min_salary : '' }}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="max_salary" class="form-label">Maximum Salary</label>
                                                <input type="number" min="0" class="form-control"
                                                    name="max_salary"
                                                    value="{{ !empty($row->max_salary) ? $row->max_salary : '' }}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="zip_code" class="form-label">Zip Code</label>
                                                <input type="text" class="form-control" name="zip_code"
                                                    value="{{ !empty($row->zip_code) ? $row->zip_code : '' }}">
                                            </div>
                                        </div>


                                    </div>


                                    <div class="mb-3">
                                        <div class="form-check form-switch py-2">
                                            <input class="form-check-input success" type="checkbox" id="color-success"
                                                {{ !empty($row) ? ($row->status == 1 ? 'checked' : '') : '' }}
                                                name="status" />
                                            <label class="form-check-label" for="color-success">
                                                {{ !empty($row) ? ($row->status == 0 ? 'InActive' : 'Active') : 'Status' }}</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check form-switch py-2">
                                            <input class="form-check-input success" type="checkbox" id="color-success"
                                                {{ !empty($row) ? ($row->featured == 1 ? 'checked' : '') : '' }}
                                                name="featured" />
                                            <label class="form-check-label" for="color-success">
                                                {{ !empty($row) ? ($row->featured == 0 ? 'Not Featured' : 'Featured') : 'Featured' }}</label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 d-flex align-items-stretch">
                            <div class="card w-100 border position-relative overflow-hidden">
                                <div class="card-body p-4">
                                    <h4 class="card-title">Details Block</h4>
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="application_process" class="form-label">Application
                                                    Process</label>
                                                <textarea class="form-control editor" name="application_process">{{ !empty($row) ? $row->application_process : '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="detail" class="form-label">Details</label>
                                                <textarea class="editor" name="detail">{{ !empty($row) ? $row->detail : '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 d-flex align-items-stretch">
                            <div class="card w-100 border position-relative overflow-hidden">
                                <div class="card-body p-4">
                                    <h4 class="card-title">Change Company Logo</h4>
                                    <div class="text-center">
                                        <div class="file_choose_icon">
                                            <img src="{{ get_site_image_src('company', !empty($row) ? $row->image : '') }}"
                                                alt="matdash-img" class="img-fluid" width="120" height="120">
                                        </div>
                                        <input class="form-control uploadFile" name="image" type="file"
                                            data-bs-original-title="" title="">
                                        <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-end mt-4 gap-6">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    @else
        {!! breadcrumb('Jobs', url('admin/jobs/add/')) !!}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered text-nowrap align-middle">
                            <thead>
                                <!-- start row -->
                                <tr>
                                    <th>Sr#</th>
                                    <th>Company</th>
                                    <th>Job Title</th>
                                    <th>Location</th>
                                    <th>Salary</th>
                                    <th>Status</th>
                                    <th>Featured</th>
                                    <th>Action</th>
                                </tr>
                                <!-- end row -->
                            </thead>
                            <tbody>
                                @if (!empty($rows))
                                    @foreach ($rows as $key => $row)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-6 crud_thumbnail_icon">
                                                    <img src="{{ get_site_image_src('company', !empty($row->image) ? $row->image : '') }}"
                                                        width="45" />
                                                    <h6 class="mb-0"> {{ ucfirst($row->company_name) }}</h6>
                                                </div>

                                            </td>
                                            <td>{!! $row->title !!}</td>
                                            <td>{!! $row->location !!}</td>
                                            <td>{!! format_amount_with_symbols($row->min_salary) . '-' . format_amount_with_symbols($row->max_salary) !!}</td>
                                            <td>{!! getStatus($row->status) !!}</td>
                                            <td>{!! getFeatured($row->featured) !!}</td>
                                            <td>
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0)" class="text-muted"
                                                        id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="ti ti-dots-vertical fs-6"></i>
                                                    </a>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <li>
                                                            <a class="dropdown-item d-flex align-items-center gap-3"
                                                                href="{{ url('admin/jobs/edit/' . $row->id) }}">
                                                                <i class="fs-4 ti ti-edit"></i>Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item d-flex align-items-center gap-3"
                                                                href="{{ url('admin/jobs/delete/' . $row->id) }}"
                                                                onclick="return confirm('Are you sure?');">
                                                                <i class="fs-4 ti ti-trash"></i>Delete
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="odd">
                                        <td colspan="4">No record(s) found!</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

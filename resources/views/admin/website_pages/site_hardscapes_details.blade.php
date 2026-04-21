@extends('layouts.adminlayout')
@section('page_meta')
<meta name="description" content={{ !empty($site_settings) ? $site_settings->site_meta_desc : '' }}">
<meta name="keywords" content="{{ !empty($site_settings) ? $site_settings->site_meta_keyword : '' }}">
<meta name="author" content="{{ !empty($site_settings->site_name) ? $site_settings->site_name : 'Login' }}">
<title>Admin - {{ $site_settings->site_name }}</title>
@endsection
@section('page_content')
{!! breadcrumb('Hardscapes Details Page') !!}

<form class="form theme-form" method="post" action="" enctype="multipart/form-data" id="saveForm">
    @csrf
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ url('admin/sitecontent') }}" class="btn btn-lg btn-danger">
            Cancel
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>CTA Section</h5>
        </div>
        <div class="card-body">
            <div class="row">

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="cta_heading">Heading</label>
                            <input class="form-control" id="cta_heading" type="text" name="cta_heading" placeholder=""
                                value="{{ $sitecontent['cta_heading'] ?? '' }}">
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="cta_text">Text</label>
                            <textarea id="cta_text" name="cta_text" rows="4"
                                class=" form-control">{{ !empty($sitecontent['cta_text']) ? $sitecontent['cta_text'] : '' }}</textarea>
                        </div>
                    </div>
                </div>


            </div>

            <div class="col">
                <div class="mb-3">
                    <label class="form-label" for="cta_btn1_txt">Button Text</label>
                    <input class="form-control" id="cta_btn1_txt" type="text" name="cta_btn1_txt" placeholder=""
                        value="{{ $sitecontent['cta_btn1_txt'] ?? '' }}">
                </div>
            </div>

            <div class="col">
                <div class="mb-3">
                    <label class="form-label" for="cta_btn1_link">Button Link</label>
                    <select name="cta_btn1_link" class="form-control" required>
                        <option value="">Set URL</option>

                        @foreach ($all_pages as $key => $page)
                        <option value="{{ $key }}"
                            {{ !empty($sitecontent['cta_btn1_link']) && $sitecontent['cta_btn1_link'] == $key ? 'selected' : '' }}>
                            {{ $page }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>




    </div>





    <div class="col-12">
        <div class="d-flex align-items-center justify-content-end mt-4 gap-6">
            <button class="btn btn-primary" type="submit">Update Page</button>
        </div>
    </div>
    @endsection
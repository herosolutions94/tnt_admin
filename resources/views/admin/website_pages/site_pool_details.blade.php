@extends('layouts.adminlayout')
@section('page_meta')
<meta name="description" content={{ !empty($site_settings) ? $site_settings->site_meta_desc : '' }}">
<meta name="keywords" content="{{ !empty($site_settings) ? $site_settings->site_meta_keyword : '' }}">
<meta name="author" content="{{ !empty($site_settings->site_name) ? $site_settings->site_name : 'Login' }}">
<title>Admin - {{ $site_settings->site_name }}</title>
@endsection
@section('page_content')
{!! breadcrumb('Pool Details Page') !!}

<form class="form theme-form" method="post" action="" enctype="multipart/form-data" id="saveForm">
    @csrf
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ url('admin/sitecontent') }}" class="btn btn-lg btn-danger">
            Cancel
        </a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="row">
                    <div class="col">
                        <div>
                            <label class="form-label" for="page_title">Page Title</label>
                            <input class="form-control" id="page_title" type="text" name="page_title" placeholder=""
                                value="{{ $sitecontent['page_title'] ?? '' }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div>
                            <label class="form-label" for="meta_title">Meta Title</label>
                            <input class="form-control" id="meta_title" type="text" name="meta_title" placeholder=""
                                value="{{ $sitecontent['meta_title'] ?? '' }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div>
                            <label class="form-label" for="site_meta_desc">Meta Description</label>
                            <textarea class="form-control" id="meta_description" rows="3"
                                name="meta_description">{{ $sitecontent['meta_description'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div>
                            <label class="form-label" for="meta_keywords">Meta Keywords</label>
                            <textarea class="form-control" id="meta_keywords" rows="3"
                                name="meta_keywords">{{ $sitecontent['meta_keywords'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="card">

        <div class="card-header">
            <h5>Banner</h5>
        </div>

        <div class="card-body">

            <div class="row">
                <div class="col-md-12">


                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="banner_heading">Banner Heading</label>
                                <input class="form-control" id="banner_heading" type="text" name="banner_heading"
                                    placeholder="" value="{{ $sitecontent['banner_heading'] ?? '' }}">
                            </div>
                        </div>
                    </div>







                </div>

            </div>
        </div>


    </div>

    <div class="card">

        <div class="card-header">
            <h5>Section 1</h5>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-12">



                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section1_heading">Heading</label>
                                <input class="form-control" id="section1_heading" type="text" name="section1_heading"
                                    placeholder="" value="{{ $sitecontent['section1_heading'] ?? '' }}">
                            </div>
                        </div>
                    </div>



                </div>

            </div>

        </div>


    </div>

    <div class="card">

        <div class="card-header">
            <h5>Section 2</h5>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-12">



                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section2_heading">Heading</label>
                                <input class="form-control" id="section2_heading" type="text" name="section2_heading"
                                    placeholder="" value="{{ $sitecontent['section2_heading'] ?? '' }}">
                            </div>
                        </div>
                    </div>






                </div>

            </div>

        </div>


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
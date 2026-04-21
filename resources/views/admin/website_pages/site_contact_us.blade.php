@extends('layouts.adminlayout')
@section('page_meta')
<meta name="description" content={{ !empty($site_settings) ? $site_settings->site_meta_desc : '' }}">
<meta name="keywords" content="{{ !empty($site_settings) ? $site_settings->site_meta_keyword : '' }}">
<meta name="author" content="{{ !empty($site_settings->site_name) ? $site_settings->site_name : 'Login' }}">
<title>Admin - {{ $site_settings->site_name }}</title>
@endsection
@section('page_content')
{!! breadcrumb('Contact Us') !!}

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
            <h5>Banner Section</h5>
        </div>

        <div class="card-body">

            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label" for="image1">Banner Image</label>
                            <div class="card w-100 border position-relative overflow-hidden">
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <div class="file_choose_icon">
                                            <img src="{{ get_site_image_src('images', !empty($sitecontent['image1']) ? $sitecontent['image1'] : ' ') }}"
                                                alt="matdash-img" class="img-fluid ">
                                        </div>
                                        <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                        <input class="form-control uploadFile" name="image1" type="file"
                                            data-bs-original-title="" title="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label" for="banner_heading"> Heading</label>
                                <input class="form-control" id="banner_heading" type="text" name="banner_heading"
                                    placeholder="" value="{{ $sitecontent['banner_heading'] ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="banner_text">Text</label>
                                <textarea id="banner_text" name="banner_text" rows="4"
                                    class="form-control">{{ $sitecontent['banner_text'] ?? '' }}</textarea>
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


                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label" for="section1_heading"> Heading</label>
                                <input class="form-control" id="section1_heading" type="text" name="section1_heading"
                                    placeholder="" value="{{ $sitecontent['section1_heading'] ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="section1_text">Text</label>
                                <textarea id="section1_text" name="section1_text" rows="4"
                                    class="editor">{{ $sitecontent['section1_text'] ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
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
@extends('layouts.adminlayout')
@section('page_meta')
    <meta name="description" content={{ !empty($site_settings) ? $site_settings->site_meta_desc : '' }}">
    <meta name="keywords" content="{{ !empty($site_settings) ? $site_settings->site_meta_keyword : '' }}">
    <meta name="author" content="{{ !empty($site_settings->site_name) ? $site_settings->site_name : 'Login' }}">
    <title>Admin - {{ $site_settings->site_name }}</title>
@endsection
@section('page_content')
    @if (request()->segment(3) == 'edit' || request()->segment(3) == 'add')
        {!! breadcrumb('Add/Update Areas Of Expertise') !!}
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
                    </div>
                    <div class="row">

                        <div class="col-lg-12 d-flex align-items-stretch">
                            <div class="card w-100 border position-relative overflow-hidden">
                                <div class="card-body p-4">
                                    <h4 class="card-title">Industry Detail</h4>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="industry_title" class="form-label">Industry Title</label>
                                            <input type="text" class="form-control" name="industry_title"
                                                value="{{ !empty($row->industry_title) ? $row->industry_title : '' }}"
                                                required>
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

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 d-flex align-items-stretch">
                            <div class="card w-100 border position-relative overflow-hidden">
                                <div class="card-body p-4">
                                    <h4 class="card-title">Text Block</h4>

                                    <div class="mb-3">
                                        <label for="details" class="form-label">Text</label>
                                        <textarea class="editor" name="details">{{ !empty($row) ? $row->details : '' }}</textarea>
                                    </div>


                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-center" style="font-weight: bold">Details Blocks</h5>
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
                                        <div class="col-md-4">
                                            <label class="form-label" for="image1">Banner Image</label>
                                            <div class="card w-100 border position-relative overflow-hidden">
                                                <div class="card-body p-4">
                                                    <div class="text-center">
                                                        <div class="file_choose_icon">
                                                            <img src="{{ get_site_image_src('job_opportunities', !empty($content['image1']) ? $content['image1'] : ' ') }}"
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
                                                <label class="form-label" for="banner_heading">Banner Heading</label>
                                                <input class="form-control" id="banner_heading" type="text"
                                                    name="banner_heading" placeholder=""
                                                    value="{{ $content['banner_heading'] ?? '' }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="banner_text">Text</label>
                                                <textarea id="banner_text" name="banner_text" rows="4" class="editor">{{ $content['banner_text'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label" for="banner_btn1_txt">Button 1 Text</label>
                                                <input class="form-control" id="banner_btn1_txt" type="text"
                                                    name="banner_btn1_txt" placeholder=""
                                                    value="{{ $content['banner_btn1_txt'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label" for="banner_btn1_link">Button 1 Link URL</label>
                                                <select name="banner_btn1_link" class="form-control" required>
                                                    <option value="">Set URL</option>

                                                    @foreach ($all_pages as $key => $page)
                                                        <option value="{{ $key }}"
                                                            {{ !empty($content['banner_btn1_link']) && $content['banner_btn1_link'] == $key ? 'selected' : '' }}>
                                                            {{ $page }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label" for="banner_btn2_txt">Button 2 Text</label>
                                                <input class="form-control" id="banner_btn2_txt" type="text"
                                                    name="banner_btn2_txt" placeholder=""
                                                    value="{{ $content['banner_btn2_txt'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label" for="banner_btn2_link">Button 2 Link URL</label>
                                                <select name="banner_btn2_link" class="form-control" required>
                                                    <option value="">Set URL</option>

                                                    @foreach ($all_pages as $key => $page)
                                                        <option value="{{ $key }}"
                                                            {{ !empty($content['banner_btn2_link']) && $content['banner_btn2_link'] == $key ? 'selected' : '' }}>
                                                            {{ $page }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>


                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-center" style="font-weight: bold">Details For Tab1</h5>
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
                                                <label class="form-label" for="section1_tab1_heading">Heading</label>
                                                <input class="form-control" id="section1_tab1_heading" type="text"
                                                    name="section1_tab1_heading" placeholder=""
                                                    value="{{ $content['section1_tab1_heading'] ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label" for="section1_tab1_text">Text</label>
                                                <textarea id="section1_tab1_text" name="section1_tab1_text" rows="4" class=" editor">{{ !empty($content['section1_tab1_text']) ? $content['section1_tab1_text'] : '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <?php $section1 = 0; ?>
                                        @for ($i = 1; $i <= 3; $i++)
                                            <?php $section1 = $section1 + 1; ?>
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Block {{ $section1 }}</h5>
                                                    </div>
                                                    <div class="card-body">

                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="mb-4">
                                                                    <label class="form-label"
                                                                        for="sec1_tab1_heading{{ $i }}">Heading
                                                                        {{ $section1 }}</label>
                                                                    <input class="form-control"
                                                                        id="sec1_tab1_heading{{ $i }}"
                                                                        type="text"
                                                                        name="sec1_tab1_heading{{ $i }}"
                                                                        placeholder=""
                                                                        value="{{ !empty($content['sec1_tab1_heading' . $i]) ? $content['sec1_tab1_heading' . $i] : '' }}">
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="mb-4">
                                                                    <label class="form-label"
                                                                        for="sec1_tab1_text{{ $i }}">Text
                                                                        {{ $section1 }}</label>
                                                                    <textarea id="sec1_tab1_text{{ $i }}" name="sec1_tab1_text{{ $i }}" rows="8"
                                                                        class="form-control">{{ !empty($content['sec1_tab1_text' . $i]) ? $content['sec1_tab1_text' . $i] : '' }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
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
                                        <div class="col-md-4">
                                            <label class="form-label" for="image2"> Image</label>
                                            <div class="card w-100 border position-relative overflow-hidden">
                                                <div class="card-body p-4">
                                                    <div class="text-center">
                                                        <div class="file_choose_icon">
                                                            <img src="{{ get_site_image_src('job_opportunities', !empty($content['image2']) ? $content['image2'] : ' ') }}"
                                                                alt="matdash-img" class="img-fluid ">
                                                        </div>
                                                        <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                                        <input class="form-control uploadFile" name="image2"
                                                            type="file" data-bs-original-title="" title="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label class="form-label" for="section2_tab1_heading"> Heading</label>
                                                <input class="form-control" id="section2_tab1_heading" type="text"
                                                    name="section2_tab1_heading" placeholder=""
                                                    value="{{ $content['section2_tab1_heading'] ?? '' }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="section2_tab1_text1">Text 1</label>
                                                <textarea id="section2_tab1_text1" name="section2_tab1_text1" rows="4" class="editor">{{ $content['section2_tab1_text1'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label" for="section2_tab1_text2">Text 2</label>
                                                <textarea id="section2_tab1_text2" name="section2_tab1_text2" rows="4" class=" editor">{{ $content['section2_tab1_text2'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label" for="section2_tab1_btn_txt">Button Text</label>
                                                <input class="form-control" id="section2_tab1_btn_txt" type="text"
                                                    name="section2_tab1_btn_txt" placeholder=""
                                                    value="{{ $content['section2_tab1_btn_txt'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label" for="section2_tab1_btn_link">Button Link
                                                    URL</label>
                                                <select name="section2_tab1_btn_link" class="form-control" required>
                                                    <option value="">Set URL</option>

                                                    @foreach ($all_pages as $key => $page)
                                                        <option value="{{ $key }}"
                                                            {{ !empty($content['section2_tab1_btn_link']) && $content['section2_tab1_btn_link'] == $key ? 'selected' : '' }}>
                                                            {{ $page }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>


                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-center" style="font-weight: bold">Details For Tab2</h5>
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
                                                <label class="form-label" for="section1_tab2_heading">Heading</label>
                                                <input class="form-control" id="section1_tab2_heading" type="text"
                                                    name="section1_tab2_heading" placeholder=""
                                                    value="{{ $content['section1_tab2_heading'] ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label" for="section1_tab2_text">Text</label>
                                                <textarea id="section1_tab2_text" name="section1_tab2_text" rows="4" class=" editor">{{ !empty($content['section1_tab2_text']) ? $content['section1_tab2_text'] : '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <?php $section1 = 0; ?>
                                        @for ($i = 1; $i <= 3; $i++)
                                            <?php $section1 = $section1 + 1; ?>
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Block {{ $section1 }}</h5>
                                                    </div>
                                                    <div class="card-body">

                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="mb-4">
                                                                    <label class="form-label"
                                                                        for="sec1_tab2_heading{{ $i }}">Heading
                                                                        {{ $section1 }}</label>
                                                                    <input class="form-control"
                                                                        id="sec1_tab2_heading{{ $i }}"
                                                                        type="text"
                                                                        name="sec1_tab2_heading{{ $i }}"
                                                                        placeholder=""
                                                                        value="{{ !empty($content['sec1_tab2_heading' . $i]) ? $content['sec1_tab2_heading' . $i] : '' }}">
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="mb-4">
                                                                    <label class="form-label"
                                                                        for="sec1_tab2_text{{ $i }}">Text
                                                                        {{ $section1 }}</label>
                                                                    <textarea id="sec1_tab2_text{{ $i }}" name="sec1_tab2_text{{ $i }}" rows="8"
                                                                        class="form-control">{{ !empty($content['sec1_tab2_text' . $i]) ? $content['sec1_tab2_text' . $i] : '' }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
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
                                        <div class="col-md-4">
                                            <label class="form-label" for="image4"> Image</label>
                                            <div class="card w-100 border position-relative overflow-hidden">
                                                <div class="card-body p-4">
                                                    <div class="text-center">
                                                        <div class="file_choose_icon">
                                                            <img src="{{ get_site_image_src('job_opportunities', !empty($content['image4']) ? $content['image4'] : ' ') }}"
                                                                alt="matdash-img" class="img-fluid ">
                                                        </div>
                                                        <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                                        <input class="form-control uploadFile" name="image4"
                                                            type="file" data-bs-original-title="" title="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label class="form-label" for="section2_tab2_heading"> Heading</label>
                                                <input class="form-control" id="section2_tab2_heading" type="text"
                                                    name="section2_tab2_heading" placeholder=""
                                                    value="{{ $content['section2_tab2_heading'] ?? '' }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="section2_tab2_text1">Text 1</label>
                                                <textarea id="section2_tab2_text1" name="section2_tab2_text1" rows="4" class="editor">{{ $content['section2_tab2_text1'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label" for="section2_tab2_text2">Text 2</label>
                                                <textarea id="section2_tab2_text2" name="section2_tab2_text2" rows="4" class=" editor">{{ $content['section2_tab2_text2'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label" for="section2_tab2_btn_txt">Button Text</label>
                                                <input class="form-control" id="section2_tab2_btn_txt" type="text"
                                                    name="section2_tab2_btn_txt" placeholder=""
                                                    value="{{ $content['section2_tab2_btn_txt'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label" for="section2_tab2_btn_link">Button Link
                                                    URL</label>
                                                <select name="section2_tab2_btn_link" class="form-control" required>
                                                    <option value="">Set URL</option>

                                                    @foreach ($all_pages as $key => $page)
                                                        <option value="{{ $key }}"
                                                            {{ !empty($content['section2_tab2_btn_link']) && $content['section2_tab2_btn_link'] == $key ? 'selected' : '' }}>
                                                            {{ $page }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>


                    </div>

                    <div class="card">

                        <div class="card-header">
                            <h5>Section 3 For Main Content</h5>
                        </div>

                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" for="image3"> Image</label>
                                            <div class="card w-100 border position-relative overflow-hidden">
                                                <div class="card-body p-4">
                                                    <div class="text-center">
                                                        <div class="file_choose_icon">
                                                            <img src="{{ get_site_image_src('job_opportunities', !empty($content['image3']) ? $content['image3'] : ' ') }}"
                                                                alt="matdash-img" class="img-fluid ">
                                                        </div>
                                                        <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                                        <input class="form-control uploadFile" name="image3"
                                                            type="file" data-bs-original-title="" title="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label class="form-label" for="section3_heading"> Heading</label>
                                                <input class="form-control" id="section3_heading" type="text"
                                                    name="section3_heading" placeholder=""
                                                    value="{{ $content['section3_heading'] ?? '' }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="section3_text">Text</label>
                                                <textarea id="section3_text" name="section3_text" rows="4" class="editor">{{ $content['section3_text'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label" for="section3_btn_txt">Button Text</label>
                                                <input class="form-control" id="section3_btn_txt" type="text"
                                                    name="section3_btn_txt" placeholder=""
                                                    value="{{ $content['section3_btn_txt'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label" for="section3_btn_link">Button Link URL</label>
                                                <select name="section3_btn_link" class="form-control" required>
                                                    <option value="">Set URL</option>

                                                    @foreach ($all_pages as $key => $page)
                                                        <option value="{{ $key }}"
                                                            {{ !empty($content['section3_btn_link']) && $content['section3_btn_link'] == $key ? 'selected' : '' }}>
                                                            {{ $page }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>


                    </div>

                    {{-- <div class="card">

                        <div class="card-header">
                            <h5>Section 3</h5>
                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-12">

                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label" for="section3_heading">Heading</label>
                                                <input class="form-control" id="section3_heading" type="text"
                                                    name="section3_heading" placeholder=""
                                                    value="{{ $content['section3_heading'] ?? '' }}">
                                            </div>

                                            <div class="mb-3">
                                                <a href="{{ url('admin/job_opportunities') }}" target="_blank"
                                                    class="btn btn-sm btn-dark"> + Add Job Opportunites</a>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <h5>Highlights</h5>

                                        <?php $section3 = 0; ?>
                                        @for ($i = 8; $i <= 10; $i++)
                                            <?php $section3 = $section3 + 1; ?>
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Block {{ $section3 }}</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="mb-4">
                                                                    <label class="form-label"
                                                                        for="sec3_heading{{ $i }}">Heading
                                                                        {{ $section3 }}</label>
                                                                    <input class="form-control"
                                                                        id="sec3_heading{{ $i }}"
                                                                        type="text"
                                                                        name="sec3_heading{{ $i }}"
                                                                        placeholder=""
                                                                        value="{{ !empty($content['sec3_heading' . $i]) ? $content['sec3_heading' . $i] : '' }}">
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="mb-4">
                                                                    <label class="form-label"
                                                                        for="sec3_count{{ $i }}">Count
                                                                        {{ $section3 }}</label>
                                                                    <input class="form-control"
                                                                        id="sec3_count{{ $i }}" type="number"
                                                                        name="sec3_count{{ $i }}"
                                                                        placeholder=""
                                                                        value="{{ !empty($content['sec3_count' . $i]) ? $content['sec3_count' . $i] : '' }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>

                            </div>

                        </div>


                    </div> --}}

                    {{-- <div class="card">

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
                                                            <img src="{{ get_site_image_src('job_opportunities', !empty($content['image1']) ? $content['image1'] : ' ') }}"
                                                                alt="matdash-img" class="img-fluid ">
                                                        </div>
                                                        <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                                        <input class="form-control uploadFile" name="image1"
                                                            type="file" data-bs-original-title="" title="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label class="form-label" for="banner_heading"> Heading</label>
                                                <input class="form-control" id="banner_heading" type="text"
                                                    name="banner_heading" placeholder=""
                                                    value="{{ $content['banner_heading'] ?? '' }}">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="banner_text1">Text 1</label>
                                                <textarea id="banner_text1" name="banner_text1" rows="4" class="editor">{{ $content['banner_text1'] ?? '' }}</textarea>
                                            </div>

                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="banner_text2">Text 2</label>
                                                <textarea id="banner_text2" name="banner_text2" rows="4" class="editor">{{ $content['banner_text2'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div> --}}

                    {{-- <div class="card">

                        <div class="card-header">
                            <h5>Section 1</h5>
                        </div>

                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="section1_text1">Heading & Text 1</label>
                                                <textarea id="section1_text1" name="section1_text1" rows="4" class="editor">{{ $content['section1_text1'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="section1_text2">Text 2</label>
                                                <textarea id="section1_text2" name="section1_text2" rows="4" class="editor">{{ $content['section1_text2'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    {{-- <div class="card">

                        <div class="card-header">
                            <h5>Section 2</h5>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="section2_text">Heading & Text 1</label>
                                                <textarea id="section2_text" name="section2_text" rows="4" class="editor">{{ $content['section2_text'] ?? '' }}</textarea>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <?php $section2 = 0; ?>
                                        @for ($i = 3; $i <= 5; $i++)
                                            <?php $section2 = $section2 + 1; ?>
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Block {{ $section2 }}</h5>
                                                    </div>
                                                    <div class="card-body">
                                                       

                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="mb-4">
                                                                    <label class="form-label"
                                                                        for="sec2_text{{ $i }}">Text
                                                                        {{ $section2 }}</label>
                                                                    <textarea id="sec2_text{{ $i }}" name="sec2_text{{ $i }}" rows="5"
                                                                        class="form-control editor">{{ !empty($content['sec2_text' . $i]) ? $content['sec2_text' . $i] : '' }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div> --}}

                    {{-- <div class="card">
                        <div class="card-header">
                            <h5>Section 3</h5>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label" for="section3_text">Heading & Text 1</label>
                                                <textarea id="section3_text" name="section3_text" rows="4" class="editor">{{ $content['section3_text'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <?php $section3 = 0; ?>
                                        @for ($i = 6; $i <= 7; $i++)
                                            <?php $section3 = $section3 + 1; ?>
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Block {{ $section3 }}</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div
                                                                    class="card w-100 border position-relative overflow-hidden">
                                                                    <div class="card-body p-4">
                                                                        <div class="text-center">
                                                                            <div class="file_choose_icon"
                                                                                style="background-color: rgb(179, 179, 179)">
                                                                                <img src="{{ get_site_image_src('job_opportunities', !empty($content['image' . $i]) ? $content['image' . $i] : '') }}"
                                                                                    alt="matdash-img" class="img-fluid ">
                                                                            </div>
                                                                            <p class="mb-0">Allowed JPG,
                                                                                GIF or PNG. Max size
                                                                                of 800K
                                                                            </p>
                                                                            <input class="form-control uploadFile"
                                                                                name="image{{ $i }}"
                                                                                type="file" data-bs-original-title=""
                                                                                title="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        

                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="mb-4">
                                                                    <label class="form-label"
                                                                        for="sec3_text{{ $i }}">Text
                                                                        {{ $section3 }}</label>
                                                                    <textarea id="sec3_text{{ $i }}" name="sec3_text{{ $i }}" rows="5"
                                                                        class="form-control editor">{{ !empty($content['sec3_text' . $i]) ? $content['sec3_text' . $i] : '' }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div> --}}

                    {{-- <div class="card">

                        <div class="card-header">
                            <h5>Section 4</h5>
                        </div>

                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label" for="image8">Image</label>
                                            <div class="card w-100 border position-relative overflow-hidden">
                                                <div class="card-body p-4">
                                                    <div class="text-center">
                                                        <div class="file_choose_icon">
                                                            <img src="{{ get_site_image_src('job_opportunities', !empty($content['image8']) ? $content['image8'] : ' ') }}"
                                                                alt="matdash-img" class="img-fluid ">
                                                        </div>
                                                        <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                                        <input class="form-control uploadFile" name="image8"
                                                            type="file" data-bs-original-title="" title="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label class="form-label" for="section4_heading"> Heading</label>
                                                <input class="form-control" id="section4_heading" type="text"
                                                    name="section4_heading" placeholder=""
                                                    value="{{ $content['section4_heading'] ?? '' }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="section4_text">Text</label>
                                                <textarea id="section4_text" name="section4_text" rows="4" class="editor">{{ $content['section4_text'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label" for="section4_btn_txt">Button Text</label>
                                                <input class="form-control" id="section4_btn_txt" type="text"
                                                    name="section4_btn_txt" placeholder=""
                                                    value="{{ $content['section4_btn_txt'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label" for="section4_btn_link">Button Link URL</label>
                                                <select name="section4_btn_link" class="form-control" required>
                                                    <option value="">Set URL</option>

                                                    @foreach ($all_pages as $key => $page)
                                                        <option value="{{ $key }}"
                                                            {{ !empty($content['section4_btn_link']) && $content['section4_btn_link'] == $key ? 'selected' : '' }}>
                                                            {{ $page }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-end mt-4 gap-6">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </div>


                </div>
            </div>
        </form>
    @else
        {!! breadcrumb('Areas Of Expertise', url('admin/job_opportunities/add/')) !!}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered text-nowrap align-middle">
                            <thead>
                                <!-- start row -->
                                <tr>
                                    <th>Sr#</th>
                                    {{-- <th>Image</th> --}}
                                    <th>Industry Title</th>
                                    {{-- <th>Designation</th> --}}
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                <!-- end row -->
                            </thead>
                            <tbody>
                                @if (!empty($rows))
                                    @foreach ($rows as $key => $row)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            {{-- <td>
                                                <div class="d-flex align-items-center gap-6 crud_thumbnail_icon">
                                                    <img src="{{ get_site_image_src('job_opportunities', !empty($row->image) ? $row->image : '') }}"
                                                        width="120" height="120" />

                                                </div>



                                            </td> --}}
                                            <td>
                                                <div class="d-flex align-items-center gap-6 crud_thumbnail_icon">
                                                    <h6 class="mb-0"> {{ $row->industry_title }}</h6>
                                                </div>
                                                {{-- {!! $row->designation !!} --}}
                                            </td>
                                            <td>{!! getStatus($row->status) !!}</td>
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
                                                                href="{{ url('admin/job_opportunities/edit/' . $row->id) }}">
                                                                <i class="fs-4 ti ti-edit"></i>Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item d-flex align-items-center gap-3"
                                                                href="{{ url('admin/job_opportunities/delete/' . $row->id) }}"
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

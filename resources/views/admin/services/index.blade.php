@extends('layouts.adminlayout')
@section('page_meta')
    <meta name="description" content={{ !empty($site_settings) ? $site_settings->site_meta_desc : '' }}">
    <meta name="keywords" content="{{ !empty($site_settings) ? $site_settings->site_meta_keyword : '' }}">
    <meta name="author" content="{{ !empty($site_settings->site_name) ? $site_settings->site_name : 'Login' }}">
    <title>Admin - {{ $site_settings->site_name }}</title>
@endsection
@section('page_content')
    @if (request()->segment(3) == 'edit' || request()->segment(3) == 'add')
        {!! breadcrumb('Add/Update Service') !!}
        <form class="form theme-form" method="post" action="" enctype="multipart/form-data" id="saveForm">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <div class="col-lg-3 d-flex align-items-stretch">
                            <div class="card w-100 border position-relative overflow-hidden">
                                <div class="card-body p-4">
                                    <h4 class="card-title">Main Image</h4>
                                    <div class="text-center">
                                        <div class="file_choose_icon">
                                            <img src="{{ get_site_image_src('services', !empty($row) ? $row->image : '') }}"
                                                alt="matdash-img" class="img-fluid" width="120" height="120">
                                        </div>
                                        <input class="form-control uploadFile" name="image" type="file"
                                            data-bs-original-title="" title="">
                                        <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 d-flex align-items-stretch">
                            <div class="card w-100 border position-relative overflow-hidden">
                                <div class="card-body p-4">
                                    <h4 class="card-title">Service Info</h4>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Title</label>
                                                <input type="text" class="form-control" name="title"
                                                    value="{{ !empty($row->title) ? $row->title : '' }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="tagline" class="form-label">tagline</label>
                                                <input type="text" class="form-control" name="tagline"
                                                    value="{{ !empty($row->tagline) ? $row->tagline : '' }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check form-switch py-2">
                                            <input class="form-check-input success" type="checkbox" id="status"
                                                {{ !empty($row) ? ($row->status == 1 ? 'checked' : '') : '' }}
                                                name="status" />
                                            <label class="form-check-label" for="status">
                                                {{ !empty($row) ? ($row->status == 0 ? 'InActive' : 'Active') : 'Status' }}</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check form-switch py-2">
                                            <input class="form-check-input success" type="checkbox" id="featured"
                                                {{ !empty($row) ? ($row->featured == 1 ? 'checked' : '') : '' }}
                                                name="featured" />
                                            <label class="form-check-label" for="featured">
                                                {{ !empty($row) ? ($row->featured == 0 ? 'Not Featured' : 'Featured') : 'Featured' }}</label>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>

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
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="short_desc" class="form-label">Short Descriptions</label>
                                                <textarea class="editor" name="short_desc">{{ !empty($row) ? $row->short_desc : '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="text-center" style="font-weight: bold">Service Details Blocks</h5>
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
                                                    <img src="{{ get_site_image_src('services', !empty($content['image1']) ? $content['image1'] : ' ') }}"
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
                                        <label class="form-label" for="banner_heading"> Title</label>
                                        <input class="form-control" id="banner_heading" type="text"
                                            name="banner_heading" placeholder=""
                                            value="{{ $content['banner_heading'] ?? '' }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="banner_heading2"> Heading</label>
                                        <input class="form-control" id="banner_heading2" type="text"
                                            name="banner_heading2" placeholder=""
                                            value="{{ $content['banner_heading2'] ?? '' }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="banner_text">Text</label>
                                        <textarea id="banner_text" name="banner_text" rows="4" class="editor">{{ $content['banner_text'] ?? '' }}</textarea>
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
                                <div class="col-md-4">
                                    <label class="form-label" for="image2">Image</label>
                                    <div class="card w-100 border position-relative overflow-hidden">
                                        <div class="card-body p-4">
                                            <div class="text-center">
                                                <div class="file_choose_icon">
                                                    <img src="{{ get_site_image_src('services', !empty($content['image2']) ? $content['image2'] : ' ') }}"
                                                        alt="matdash-img" class="img-fluid ">
                                                </div>
                                                <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                                <input class="form-control uploadFile" name="image2" type="file"
                                                    data-bs-original-title="" title="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label class="form-label" for="section1_heading"> Heading</label>
                                        <input class="form-control" id="section1_heading" type="text"
                                            name="section1_heading" placeholder=""
                                            value="{{ $content['section1_heading'] ?? '' }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="section1_text">Text</label>
                                        <textarea id="section1_text" name="section1_text" rows="4" class="editor">{{ $content['section1_text'] ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="section1_btn_txt">Button Text</label>
                                        <input class="form-control" id="section1_btn_txt" type="text"
                                            name="section1_btn_txt" placeholder=""
                                            value="{{ $content['section1_btn_txt'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="section1_btn_link">Button Link URL</label>
                                        <select name="section1_btn_link" class="form-control" required>
                                            <option value="">Set URL</option>

                                            @foreach ($all_pages as $key => $page)
                                                <option value="{{ $key }}"
                                                    {{ !empty($content['section1_btn_link']) && $content['section1_btn_link'] == $key ? 'selected' : '' }}>
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
                    <h5>Section 2</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="section2_heading">Heading</label>
                                        <input class="form-control" id="section2_heading" type="text"
                                            name="section2_heading" placeholder=""
                                            value="{{ $content['section2_heading'] ?? '' }}">
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
                                                        <div class="card w-100 border position-relative overflow-hidden">
                                                            <div class="card-body p-4">
                                                                <div class="text-center">
                                                                    <div class="file_choose_icon"
                                                                        style="background-color: rgb(179, 179, 179)">
                                                                        <img src="{{ get_site_image_src('services', !empty($content['image' . $i]) ? $content['image' . $i] : '') }}"
                                                                            alt="matdash-img" class="img-fluid ">
                                                                    </div>
                                                                    <p class="mb-0">Allowed JPG, GIF or PNG. Max size
                                                                        of 800K
                                                                    </p>
                                                                    <input class="form-control uploadFile"
                                                                        name="image{{ $i }}" type="file"
                                                                        data-bs-original-title="" title="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-4">
                                                            <label class="form-label"
                                                                for="sec2_heading{{ $i }}">Heading
                                                                {{ $section2 }}</label>
                                                            <input class="form-control"
                                                                id="sec2_heading{{ $i }}" type="text"
                                                                name="sec2_heading{{ $i }}" placeholder=""
                                                                value="{{ !empty($content['sec2_heading' . $i]) ? $content['sec2_heading' . $i] : '' }}">
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-4">
                                                            <label class="form-label"
                                                                for="sec2_text{{ $i }}">Text
                                                                {{ $section2 }}</label>
                                                            <textarea id="sec2_text{{ $i }}" name="sec2_text{{ $i }}" rows="5"
                                                                class="form-control">{{ !empty($content['sec2_text' . $i]) ? $content['sec2_text' . $i] : '' }}</textarea>
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
                    <h5>Section 3</h5>
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label" for="image6">Image</label>
                                    <div class="card w-100 border position-relative overflow-hidden">
                                        <div class="card-body p-4">
                                            <div class="text-center">
                                                <div class="file_choose_icon">
                                                    <img src="{{ get_site_image_src('services', !empty($content['image6']) ? $content['image6'] : ' ') }}"
                                                        alt="matdash-img" class="img-fluid ">
                                                </div>
                                                <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                                <input class="form-control uploadFile" name="image6" type="file"
                                                    data-bs-original-title="" title="">
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

            <div class="card">

                <div class="card-header">
                    <h5>Section 4</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="section4_heading">Heading</label>
                                        <input class="form-control" id="section4_heading" type="text"
                                            name="section4_heading" placeholder=""
                                            value="{{ $content['section4_heading'] ?? '' }}">
                                    </div>
                                    <div class="mb-3">
                                        <a href="{{ url('admin/job_opportunities') }}" target="_blank"
                                            class="btn btn-sm btn-dark"> + Add Job Opportunites</a>

                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <h5>Highlights</h5>

                                <?php $section4 = 0; ?>
                                @for ($i = 7; $i <= 9; $i++)
                                    <?php $section4 = $section4 + 1; ?>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Block {{ $section4 }}</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-4">
                                                            <label class="form-label"
                                                                for="sec4_heading{{ $i }}">Heading
                                                                {{ $section4 }}</label>
                                                            <input class="form-control"
                                                                id="sec4_heading{{ $i }}" type="text"
                                                                name="sec4_heading{{ $i }}" placeholder=""
                                                                value="{{ !empty($content['sec4_heading' . $i]) ? $content['sec4_heading' . $i] : '' }}">
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-4">
                                                            <label class="form-label"
                                                                for="sec4_count{{ $i }}">Count
                                                                {{ $section4 }}</label>
                                                            <input class="form-control"
                                                                id="sec4_count{{ $i }}" type="number"
                                                                name="sec4_count{{ $i }}" placeholder=""
                                                                value="{{ !empty($content['sec4_count' . $i]) ? $content['sec4_count' . $i] : '' }}">
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
                    <h5>Section 5</h5>
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label" for="image10">Image</label>
                                    <div class="card w-100 border position-relative overflow-hidden">
                                        <div class="card-body p-4">
                                            <div class="text-center">
                                                <div class="file_choose_icon">
                                                    <img src="{{ get_site_image_src('services', !empty($content['image10']) ? $content['image10'] : ' ') }}"
                                                        alt="matdash-img" class="img-fluid ">
                                                </div>
                                                <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                                <input class="form-control uploadFile" name="image10" type="file"
                                                    data-bs-original-title="" title="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label class="form-label" for="section5_heading"> Heading</label>
                                        <input class="form-control" id="section5_heading" type="text"
                                            name="section5_heading" placeholder=""
                                            value="{{ $content['section5_heading'] ?? '' }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="section5_text">Text</label>
                                        <textarea id="section5_text" name="section5_text" rows="4" class="editor">{{ $content['section5_text'] ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">

                <div class="card-header">
                    <h5>Section 6</h5>
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label" for="image11">Image</label>
                                    <div class="card w-100 border position-relative overflow-hidden">
                                        <div class="card-body p-4">
                                            <div class="text-center">
                                                <div class="file_choose_icon">
                                                    <img src="{{ get_site_image_src('services', !empty($content['image11']) ? $content['image11'] : ' ') }}"
                                                        alt="matdash-img" class="img-fluid ">
                                                </div>
                                                <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                                <input class="form-control uploadFile" name="image11" type="file"
                                                    data-bs-original-title="" title="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label class="form-label" for="section6_heading"> Heading</label>
                                        <input class="form-control" id="section6_heading" type="text"
                                            name="section6_heading" placeholder=""
                                            value="{{ $content['section6_heading'] ?? '' }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="section6_text">Text</label>
                                        <textarea id="section6_text" name="section6_text" rows="4" class="editor">{{ $content['section6_text'] ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="section6_btn_txt">Button Text</label>
                                        <input class="form-control" id="section6_btn_txt" type="text"
                                            name="section6_btn_txt" placeholder=""
                                            value="{{ $content['section6_btn_txt'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="section6_btn_link">Button Link URL</label>
                                        <select name="section6_btn_link" class="form-control" required>
                                            <option value="">Set URL</option>

                                            @foreach ($all_pages as $key => $page)
                                                <option value="{{ $key }}"
                                                    {{ !empty($content['section6_btn_link']) && $content['section6_btn_link'] == $key ? 'selected' : '' }}>
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
                    <h5>Section 7</h5>
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label" for="image12">Image</label>
                                    <div class="card w-100 border position-relative overflow-hidden">
                                        <div class="card-body p-4">
                                            <div class="text-center">
                                                <div class="file_choose_icon">
                                                    <img src="{{ get_site_image_src('services', !empty($content['image12']) ? $content['image12'] : ' ') }}"
                                                        alt="matdash-img" class="img-fluid ">
                                                </div>
                                                <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                                <input class="form-control uploadFile" name="image12" type="file"
                                                    data-bs-original-title="" title="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label class="form-label" for="section7_heading"> Heading</label>
                                        <input class="form-control" id="section7_heading" type="text"
                                            name="section7_heading" placeholder=""
                                            value="{{ $content['section7_heading'] ?? '' }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="section7_text">Text</label>
                                        <textarea id="section7_text" name="section7_text" rows="4" class="editor">{{ $content['section7_text'] ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="section7_btn_txt">Button Text</label>
                                        <input class="form-control" id="section7_btn_txt" type="text"
                                            name="section7_btn_txt" placeholder=""
                                            value="{{ $content['section7_btn_txt'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="section7_btn_link">Button Link URL</label>
                                        <select name="section7_btn_link" class="form-control" required>
                                            <option value="">Set URL</option>

                                            @foreach ($all_pages as $key => $page)
                                                <option value="{{ $key }}"
                                                    {{ !empty($content['section7_btn_link']) && $content['section7_btn_link'] == $key ? 'selected' : '' }}>
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

            <div class="col-12">
                <div class="d-flex align-items-center justify-content-end mt-4 gap-6">
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </div>

        </form>
    @else
        {!! breadcrumb('Services', url('admin/services/add/')) !!}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered text-nowrap align-middle">
                            <thead>
                                <!-- start row -->
                                <tr>
                                    <th>Sr#</th>
                                    <th>Title</th>
                                    <th>Tagline</th>
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
                                                    <img src="{{ get_site_image_src('services', !empty($row->image) ? $row->image : '') }}"
                                                        width="45" />
                                                    <h6 class="mb-0"> {{ ucfirst($row->title) }}</h6>
                                                </div>

                                            </td>
                                            <td>{!! $row->tagline !!}</td>
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
                                                                href="{{ url('admin/services/edit/' . $row->id) }}">
                                                                <i class="fs-4 ti ti-edit"></i>Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item d-flex align-items-center gap-3"
                                                                href="{{ url('admin/services/delete/' . $row->id) }}"
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

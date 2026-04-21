@extends('layouts.adminlayout')
@section('page_meta')
<meta name="description" content={{ !empty($site_settings) ? $site_settings->site_meta_desc : '' }}">
<meta name="keywords" content="{{ !empty($site_settings) ? $site_settings->site_meta_keyword : '' }}">
<meta name="author" content="{{ !empty($site_settings->site_name) ? $site_settings->site_name : 'Login' }}">
<title>Admin - {{ $site_settings->site_name }}</title>
@endsection
@section('page_content')
{!! breadcrumb('About us Page') !!}

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
                        <div class="col-md-4">
                            <label class="form-label" for="image2"> Image</label>
                            <div class="card w-100 border position-relative overflow-hidden">
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <div class="file_choose_icon">
                                            <img src="{{ get_site_image_src('images', !empty($sitecontent['image2']) ? $sitecontent['image2'] : ' ') }}"
                                                alt="matdash-img" class="img-fluid ">
                                        </div>
                                        <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                        <input class="form-control uploadFile" name="image2" type="file"
                                            data-bs-original-title="" title="">
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section1_text">Text</label>
                                <textarea id="section1_text" name="section1_text" rows="4"
                                    class=" form-control">{{ !empty($sitecontent['section1_text']) ? $sitecontent['section1_text'] : '' }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="section1_heading"> Heading</label>
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
                        <div class="col-md-12">
                            <!-- <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="section4_heading">Heading</label>
                                        <input class="form-control" id="section4_heading" type="text"
                                            name="section4_heading" placeholder=""
                                            value="{{ $sitecontent['section4_heading'] ?? '' }}">
                                    </div>
                                </div>
                            </div> -->

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="section2_heading"> Heading</label>
                                        <input class="form-control" id="section2_heading" type="text"
                                            name="section2_heading" placeholder=""
                                            value="{{ $sitecontent['section2_heading'] ?? '' }}">
                                    </div>

                                </div>
                            </div>

                            <!-- <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label" for="image3">Image</label>
                                    <div class="card w-100 border position-relative overflow-hidden">
                                        <div class="card-body p-4">
                                            <div class="text-center">
                                                <div class="file_choose_icon">
                                                    <img src="{{ get_site_image_src('images', !empty($sitecontent['image3']) ? $sitecontent['image3'] : '') }}"
                                                        alt="matdash-img" class="img-fluid ">
                                                </div>
                                                <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                                <input class="form-control uploadFile" name="image3" type="file"
                                                    data-bs-original-title="" title="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->


                            <div class="row">
                                <?php $section2 = 0; ?>
                                @for ($i = 3; $i <= 5; $i++) <?php $section2 = $section2 + 1; ?> <div class="col-md-4">
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
                                                                    <img src="{{ get_site_image_src('images', !empty($sitecontent['image' . $i]) ? $sitecontent['image' . $i] : '') }}"
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
                                                        <label class="form-label" for="sec2_heading{{ $i }}">Heading
                                                            {{ $section2 }}</label>
                                                        <input class="form-control" id="sec2_heading{{ $i }}"
                                                            type="text" name="sec2_heading{{ $i }}" placeholder=""
                                                            value="{{ !empty($sitecontent['sec2_heading' . $i]) ? $sitecontent['sec2_heading' . $i] : '' }}">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label"
                                                            for="section1_text{{ $i }}">Text</label>
                                                        <textarea id="section2_text{{ $i }}"
                                                            name="section2_text{{ $i }}" rows="4"
                                                            class=" form-control">{{ !empty($sitecontent['section2_text' . $i]) ? $sitecontent['section2_text' . $i] : '' }}</textarea>

                                                    </div>
                                                </div>

                                            </div>



                                        </div>
                                    </div>
                            </div>
                            @endfor
                        </div>

                        <div class="row">
                            <?php $section4_counter = 0; ?>
                            @for ($i = 7; $i <= 10; $i++) <?php $section4_counter = $section4_counter + 1; ?> <div
                                class="col-md-3">
                                <!-- <div class="card">
                                    <div class="card-header">
                                        <h5>Counter {{ $section4_counter }}</h5>
                                    </div>
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-4">
                                                    <label class="form-label" for="sec4_counter{{ $i }}">Count
                                                        {{ $section4_counter }}</label>
                                                    <input class="form-control" id="sec4_counter{{ $i }}" type="text"
                                                        name="sec4_counter{{ $i }}" placeholder=""
                                                        value="{{ !empty($sitecontent['sec4_counter' . $i]) ? $sitecontent['sec4_counter' . $i] : '' }}">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-4">
                                                    <label class="form-label" for="sec4_counter_txt{{ $i }}">Heading
                                                        {{ $section4_counter }}</label>
                                                    <input class="form-control" id="sec4_counter_txt{{ $i }}"
                                                        type="text" name="sec4_counter_txt{{ $i }}" placeholder=""
                                                        value="{{ !empty($sitecontent['sec4_counter_txt' . $i]) ? $sitecontent['sec4_counter_txt' . $i] : '' }}">
                                                </div>
                                            </div>

                                        </div>



                                    </div>
                                </div> -->
                        </div>
                        @endfor
                    </div>

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

                    <!-- <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section2_heading">Heading</label>
                                <input class="form-control" id="section2_heading" type="text" name="section2_heading"
                                    placeholder="" value="{{ $sitecontent['section2_heading'] ?? '' }}">
                            </div>
                        </div>
                    </div> -->


                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section3_text">Text</label>
                                <textarea id="section3_text" name="section3_text" rows="4"
                                    class=" editor">{{ !empty($sitecontent['section3_text']) ? $sitecontent['section3_text'] : '' }}</textarea>
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
                        <div class="col-md-4">
                            <label class="form-label" for="image3">Image</label>
                            <div class="card w-100 border position-relative overflow-hidden">
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <div class="file_choose_icon">
                                            <img src="{{ get_site_image_src('images', !empty($sitecontent['image6']) ? $sitecontent['image6'] : '') }}"
                                                alt="matdash-img" class="img-fluid ">
                                        </div>
                                        <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                        <input class="form-control uploadFile" name="image6" type="file"
                                            data-bs-original-title="" title="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section2_heading">Heading</label>
                                <input class="form-control" id="section2_heading" type="text" name="section2_heading"
                                    placeholder="" value="{{ $sitecontent['section2_heading'] ?? '' }}">
                            </div>
                        </div>
                    </div> -->


                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section4_text">Text</label>
                                <textarea id="section4_text" name="section4_text" rows="4"
                                    class=" editor">{{ !empty($sitecontent['section4_text']) ? $sitecontent['section4_text'] : '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section4_btn_txt">Button Text</label>
                                <input class="form-control" id="section4_btn_txt" type="text" name="section4_btn_txt"
                                    placeholder="" value="{{ $sitecontent['section4_btn_txt'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section4_btn_link">Button Link URL</label>
                                <select name="section4_btn_link" class="form-control" required>
                                    <option value="">Set URL</option>

                                    @foreach ($all_pages as $key => $page)
                                    <option value="{{ $key }}"
                                        {{ !empty($sitecontent['section4_btn_link']) && $sitecontent['section4_btn_link'] == $key ? 'selected' : '' }}>
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
                            <label class="form-label" for="image2"> Image</label>
                            <div class="card w-100 border position-relative overflow-hidden">
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <div class="file_choose_icon">
                                            <img src="{{ get_site_image_src('images', !empty($sitecontent['image7']) ? $sitecontent['image7'] : ' ') }}"
                                                alt="matdash-img" class="img-fluid ">
                                        </div>
                                        <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                        <input class="form-control uploadFile" name="image7" type="file"
                                            data-bs-original-title="" title="">
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section5_text">Text</label>
                                <textarea id="section5_text" name="section5_text" rows="4"
                                    class=" form-control">{{ !empty($sitecontent['section5_text']) ? $sitecontent['section5_text'] : '' }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="section5_heading"> Heading</label>
                                <input class="form-control" id="section5_heading" type="text" name="section5_heading"
                                    placeholder="" value="{{ $sitecontent['section5_heading'] ?? '' }}">
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
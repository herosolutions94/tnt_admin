@extends('layouts.adminlayout')
@section('page_meta')
<meta name="description" content={{ !empty($site_settings) ? $site_settings->site_meta_desc : '' }}">
<meta name="keywords" content="{{ !empty($site_settings) ? $site_settings->site_meta_keyword : '' }}">
<meta name="author" content="{{ !empty($site_settings->site_name) ? $site_settings->site_name : 'Login' }}">
<title>Admin - {{ $site_settings->site_name }}</title>
@endsection
@section('page_content')
{!! breadcrumb('Home Page') !!}

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
                    <!-- <div class="row">
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
                    </div> -->

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="banner_badage_heading">Banner Badage Heading</label>
                                <input class="form-control" id="banner_badage_heading" type="text" name="banner_badage_heading"
                                    placeholder="" value="{{ $sitecontent['banner_badage_heading'] ?? '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="banner_heading">Banner Heading</label>
                                <input class="form-control" id="banner_heading" type="text" name="banner_heading"
                                    placeholder="" value="{{ $sitecontent['banner_heading'] ?? '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="banner_b_heading">Blue Heading</label>
                                <input class="form-control" id="banner_b_heading" type="text" name="banner_b_heading"
                                    placeholder="" value="{{ $sitecontent['banner_b_heading'] ?? '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="banner_text">Text</label>
                                <textarea id="banner_text" name="banner_text" rows="4"
                                    class="form-control">{{ $sitecontent['banner_text'] ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="banner_b_text">Blue Text</label>
                                <textarea id="banner_b_text" name="banner_b_text" rows="4"
                                    class="form-control">{{ $sitecontent['banner_b_text'] ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="banner_text2">Text</label>
                                <textarea id="banner_text2" name="banner_text2" rows="4"
                                    class="form-control">{{ $sitecontent['banner_text2'] ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="banner_btn1_txt">Button 1 Text</label>
                                <input class="form-control" id="banner_btn1_txt" type="text" name="banner_btn1_txt"
                                    placeholder="" value="{{ $sitecontent['banner_btn1_txt'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="banner_btn1_link">Button 1 Link URL</label>
                                <select name="banner_btn1_link" class="form-control" required>
                                    <option value="">Set URL</option>

                                    @foreach ($all_pages as $key => $page)
                                    <option value="{{ $key }}"
                                        {{ !empty($sitecontent['banner_btn1_link']) && $sitecontent['banner_btn1_link'] == $key ? 'selected' : '' }}>
                                        {{ $page }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="banner_btn2_txt">Button 2 Text</label>
                                <input class="form-control" id="banner_btn2_txt" type="text" name="banner_btn2_txt"
                                    placeholder="" value="{{ $sitecontent['banner_btn2_txt'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="banner_btn2_link">Button 2 Link URL</label>
                                <input class="form-control" id="banner_btn2_link" type="text" name="banner_btn2_link" placeholder=""
                                    value="{{ $sitecontent['banner_btn2_link'] ?? '' }}">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <?php $section4_counter = 0; ?>
                        @for ($i = 1; $i <= 3; $i++) <?php $section4_counter = $section4_counter + 1; ?> <div
                            class="col-md-4">
                            <div class="card">
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
            <h5>Section 1</h5>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-12">

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section1_top_heading">Top Heading</label>
                                <input class="form-control" id="section1_top_heading" type="text" name="section1_top_heading"
                                    placeholder="" value="{{ $sitecontent['section1_top_heading'] ?? '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section1_heading">Heading</label>
                                <input class="form-control" id="section1_heading" type="text" name="section1_heading"
                                    placeholder="" value="{{ $sitecontent['section1_heading'] ?? '' }}">
                            </div>
                        </div>
                    </div>


                    <div class="row ">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Jobs</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table text-nowrap mb-0 newTable" id="newTable">
                                            <thead class="header-item">
                                                <tr>
                                                    <th width="10%">Image/ Icon</th>
                                                    <th width="20%">heading</th>

                                                    <th width="30%">Text</th>
                                                    <th width="18%">Order No.</th>
                                                    <th width="5%">

                                                        <div class="action-btn">

                                                            <a href="javascript:void(0)"
                                                                class="text-primary edit addNewRowTbl"
                                                                id="addNewRowTbl">
                                                                <i class="ti ti-plus fs-6 fw-bold"></i>
                                                            </a>

                                                        </div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- start row -->
                                                @php
                                                $sec1s = getMultiText('home-jobs');
                                                @endphp
                                                @if (countlength($sec1s) > 0)
                                                @php
                                                $sec1s_count = 1;
                                                @endphp
                                                @foreach ($sec1s as $sec1)
                                                <tr class="search-items">

                                                    <td>
                                                        <div class="d-flex align-items-center" id="imgDiv">
                                                            <input type="file" name="sec1_image[]"
                                                                accept="image/*" id="newImgInput"
                                                                style="display: none;" />
                                                            <img src="{{ get_site_image_src('images', !empty($sec1->image) ? $sec1->image : '') }}"
                                                                alt="avatar" class=""
                                                                style="width: 100%; cursor: pointer;background:#ddd"
                                                                id="newImg">
                                                            <input type="hidden" name="sec1_pics[]"
                                                                value="<?= $sec1->image ?>">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="sec1_title[]"
                                                            id="sec1_title" value="<?= $sec1->title ?>"
                                                            class="form-control" placeholder="Topic">
                                                    </td>


                                                    <td>
                                                        <textarea name="sec1_txt1[]" id="sec_txt1" class="form-control" rows="3"><?= $sec1->txt1 ?></textarea>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="sec1_order_no[]"
                                                            id="sec1_order_no" value="<?= $sec1->order_no ?>"
                                                            class="form-control" placeholder="Order#"
                                                            required>
                                                    </td>
                                                    <td>
                                                        <div class="action-btn">
                                                            @if ($sec1s_count >= 1)
                                                            <a href="javascript:void(0)"
                                                                class="text-primary edit delNewRowTbl"
                                                                id="delNewRowTbl">
                                                                <i class="ti ti-minus fs-5"></i>
                                                            </a>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                                @php
                                                $sec1s_count++;
                                                @endphp
                                                @endforeach
                                                @else
                                                <tr class="search-items">

                                                    <td>
                                                        <div class="d-flex align-items-center" id="imgDiv">
                                                            <input type="file" name="sec1_image[]"
                                                                accept="image/*" id="newImgInput"
                                                                style="display: none;" />
                                                            <img src="{{ asset('/images/no-image.svg') }}"
                                                                alt="avatar"
                                                                style="width: 100%; cursor: pointer;background:#ddd"
                                                                id="newImg">

                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="sec1_title[]" id="sec1_title"
                                                            value="" class="form-control"
                                                            placeholder="Topic">
                                                    </td>

                                                    <td>
                                                        <textarea name="sec1_txt1[]" id="sec_txt1" class="form-control" rows="3"></textarea>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="sec1_order_no[]"
                                                            id="sec1_order_no" value=""
                                                            class="form-control" placeholder="Order#" required>
                                                    </td>
                                                    <td>
                                                        <div class="action-btn">

                                                        </div>
                                                    </td>
                                                </tr>
                                                @endif
                                                <!-- end row -->


                                            </tbody>
                                        </table>
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
            <h5>Section 2</h5>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-12">

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section2_top_heading">Top Heading</label>
                                <input class="form-control" id="section2_top_heading" type="text" name="section2_top_heading"
                                    placeholder="" value="{{ $sitecontent['section2_top_heading'] ?? '' }}">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section2_heading">Heading</label>
                                <input class="form-control" id="section2_heading" type="text" name="section2_heading"
                                    placeholder="" value="{{ $sitecontent['section2_heading'] ?? '' }}">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section2_text">Text</label>
                                <textarea id="section2_text" name="section2_text" rows="4"
                                    class="form-control">{{ !empty($sitecontent['section2_text']) ? $sitecontent['section2_text'] : '' }}</textarea>
                            </div>
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

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section3_top_heading">TOP Heading</label>
                                <input class="form-control" id="section3_top_heading" type="text" name="section3_top_heading"
                                    placeholder="" value="{{ $sitecontent['section3_top_heading'] ?? '' }}">
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section3_heading">Heading</label>
                                <input class="form-control" id="section3_heading" type="text" name="section3_heading"
                                    placeholder="" value="{{ $sitecontent['section3_heading'] ?? '' }}">
                            </div>
                        </div>
                    </div>



                    <div class="row ">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Why choose us?</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table text-nowrap mb-0 newTable" id="newTable">
                                            <thead class="header-item">
                                                <tr>
                                                    <th width="10%">Image/ Icon</th>
                                                    <th width="20%">heading</th>

                                                    <th width="30%">Text</th>
                                                    <th width="18%">Order No.</th>
                                                    <th width="5%">

                                                        <div class="action-btn">

                                                            <a href="javascript:void(0)"
                                                                class="text-primary edit addNewRowTbl"
                                                                id="addNewRowTbl">
                                                                <i class="ti ti-plus fs-6 fw-bold"></i>
                                                            </a>

                                                        </div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- start row -->
                                                @php
                                                $sec2s = getMultiText('why-choose-us');
                                                @endphp
                                                @if (countlength($sec2s) > 0)
                                                @php
                                                $sec2s_count = 1;
                                                @endphp
                                                @foreach ($sec2s as $sec2)
                                                <tr class="search-items">

                                                    <td>
                                                        <div class="d-flex align-items-center" id="imgDiv">
                                                            <input type="file" name="sec2_image[]"
                                                                accept="image/*" id="newImgInput"
                                                                style="display: none;" />
                                                            <img src="{{ get_site_image_src('images', !empty($sec2->image) ? $sec2->image : '') }}"
                                                                alt="avatar" class=""
                                                                style="width: 100%; cursor: pointer;background:#ddd"
                                                                id="newImg">
                                                            <input type="hidden" name="sec2_pics[]"
                                                                value="<?= $sec2->image ?>">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="sec2_title[]"
                                                            id="sec2_title" value="<?= $sec2->title ?>"
                                                            class="form-control" placeholder="Topic">
                                                    </td>


                                                    <td>
                                                        <textarea name="sec2_txt1[]" id="sec2_txt1" class="form-control" rows="3"><?= $sec2->txt1 ?></textarea>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="sec2_order_no[]"
                                                            id="sec2_order_no" value="<?= $sec2->order_no ?>"
                                                            class="form-control" placeholder="Order#"
                                                            required>
                                                    </td>
                                                    <td>
                                                        <div class="action-btn">
                                                            @if ($sec2s_count >= 1)
                                                            <a href="javascript:void(0)"
                                                                class="text-primary edit delNewRowTbl"
                                                                id="delNewRowTbl">
                                                                <i class="ti ti-minus fs-5"></i>
                                                            </a>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                                @php
                                                $sec2s_count++;
                                                @endphp
                                                @endforeach
                                                @else
                                                <tr class="search-items">

                                                    <td>
                                                        <div class="d-flex align-items-center" id="imgDiv">
                                                            <input type="file" name="sec2_image[]"
                                                                accept="image/*" id="newImgInput"
                                                                style="display: none;" />
                                                            <img src="{{ asset('/images/no-image.svg') }}"
                                                                alt="avatar"
                                                                style="width: 100%; cursor: pointer;background:#ddd"
                                                                id="newImg">

                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="sec2_title[]" id="sec2_title"
                                                            value="" class="form-control"
                                                            placeholder="Topic">
                                                    </td>

                                                    <td>
                                                        <textarea name="sec2_txt1[]" id="sec2_txt1" class="form-control" rows="3"></textarea>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="sec2_order_no[]"
                                                            id="sec2_order_no" value=""
                                                            class="form-control" placeholder="Order#" required>
                                                    </td>
                                                    <td>
                                                        <div class="action-btn">

                                                        </div>
                                                    </td>
                                                </tr>
                                                @endif
                                                <!-- end row -->


                                            </tbody>
                                        </table>
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
            <h5>Section 4</h5>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-12">



                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section4_top_heading">Top Heading</label>
                                <input class="form-control" id="section4_top_heading" type="text" name="section4_top_heading"
                                    placeholder="" value="{{ $sitecontent['section4_top_heading'] ?? '' }}">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section4_heading">Heading</label>
                                <input class="form-control" id="section4_heading" type="text" name="section4_heading"
                                    placeholder="" value="{{ $sitecontent['section4_heading'] ?? '' }}">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section4_text">Text</label>
                                <textarea id="section4_text" name="section4_text" rows="4"
                                    class="form-control">{{ !empty($sitecontent['section4_text']) ? $sitecontent['section4_text'] : '' }}</textarea>
                            </div>
                        </div>
                    </div>





                </div>

                <div class="row ">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Why choose us?</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-nowrap mb-0 newTable" id="newTable">
                                        <thead class="header-item">
                                            <tr>
                                                <th width="20%">Heading</th>

                                                <th width="30%">Text</th>
                                                <th width="18%">Order No.</th>
                                                <th width="5%">

                                                    <div class="action-btn">

                                                        <a href="javascript:void(0)"
                                                            class="text-primary edit addNewRowTbl"
                                                            id="addNewRowTbl">
                                                            <i class="ti ti-plus fs-6 fw-bold"></i>
                                                        </a>

                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- start row -->
                                            @php
                                            $sec3s = getMultiText('our-products');
                                            @endphp
                                            @if (countlength($sec3s) > 0)
                                            @php
                                            $sec3s_count = 1;
                                            @endphp
                                            @foreach ($sec3s as $sec3)
                                            <tr class="search-items">


                                                <td>
                                                    <input type="text" name="sec3_title[]"
                                                        id="sec3_title" value="<?= $sec3->title ?>"
                                                        class="form-control" placeholder="Topic">
                                                </td>


                                                <td>
                                                    <textarea name="sec3_txt1[]" id="sec3_txt1" class="form-control" rows="3"><?= $sec3->txt1 ?></textarea>
                                                </td>
                                                <td>
                                                    <input type="number" name="sec3_order_no[]"
                                                        id="sec3_order_no" value="<?= $sec3->order_no ?>"
                                                        class="form-control" placeholder="Order#"
                                                        required>
                                                </td>
                                                <td>
                                                    <div class="action-btn">
                                                        @if ($sec3s_count >= 1)
                                                        <a href="javascript:void(0)"
                                                            class="text-primary edit delNewRowTbl"
                                                            id="delNewRowTbl">
                                                            <i class="ti ti-minus fs-5"></i>
                                                        </a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @php
                                            $sec3s_count++;
                                            @endphp
                                            @endforeach
                                            @else
                                            <tr class="search-items">


                                                <td>
                                                    <input type="text" name="sec3_title[]" id="sec3_title"
                                                        value="" class="form-control"
                                                        placeholder="Topic">
                                                </td>

                                                <td>
                                                    <textarea name="sec3_txt1[]" id="sec3_txt1" class="form-control" rows="3"></textarea>
                                                </td>
                                                <td>
                                                    <input type="number" name="sec3_order_no[]"
                                                        id="sec3_order_no" value=""
                                                        class="form-control" placeholder="Order#" required>
                                                </td>
                                                <td>
                                                    <div class="action-btn">

                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
                                            <!-- end row -->


                                        </tbody>
                                    </table>
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
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section5_top_heading">Top Heading</label>
                                <input class="form-control" id="section5_top_heading" type="text" name="section5_top_heading"
                                    placeholder="" value="{{ $sitecontent['section5_top_heading'] ?? '' }}">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section5_heading">Heading</label>
                                <input class="form-control" id="section5_heading" type="text" name="section5_heading"
                                    placeholder="" value="{{ $sitecontent['section5_heading'] ?? '' }}">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section5_text">Text</label>
                                <textarea id="section5_text" name="section5_text" rows="4"
                                    class="form-control">{{ !empty($sitecontent['section5_text']) ? $sitecontent['section5_text'] : '' }}</textarea>
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
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section6_top_heading">Top Heading</label>
                                <input class="form-control" id="section6_top_heading" type="text" name="section6_top_heading"
                                    placeholder="" value="{{ $sitecontent['section6_top_heading'] ?? '' }}">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section6_heading">Heading</label>
                                <input class="form-control" id="section6_heading" type="text" name="section6_heading"
                                    placeholder="" value="{{ $sitecontent['section6_heading'] ?? '' }}">
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
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section7_top_heading">Top Heading</label>
                                <input class="form-control" id="section7_top_heading" type="text" name="section7_top_heading"
                                    placeholder="" value="{{ $sitecontent['section7_top_heading'] ?? '' }}">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section7_heading">Heading</label>
                                <input class="form-control" id="section7_heading" type="text" name="section7_heading"
                                    placeholder="" value="{{ $sitecontent['section7_heading'] ?? '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section7_btn1_txt">Button 1 Text</label>
                                <input class="form-control" id="section7_btn1_txt" type="text" name="section7_btn1_txt"
                                    placeholder="" value="{{ $sitecontent['section7_btn1_txt'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section7_btn1_link">Button 1 Link URL</label>
                                <select name="section7_btn1_link" class="form-control" required>
                                    <option value="">Set URL</option>

                                    @foreach ($all_pages as $key => $page)
                                    <option value="{{ $key }}"
                                        {{ !empty($sitecontent['section7_btn1_link']) && $sitecontent['section7_btn1_link'] == $key ? 'selected' : '' }}>
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
            <h5>Cta</h5>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-12">



                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section8_top_heading">Top Heading</label>
                                <input class="form-control" id="section8_top_heading" type="text" name="section8_top_heading"
                                    placeholder="" value="{{ $sitecontent['section8_top_heading'] ?? '' }}">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section8_text">Text</label>
                                 <textarea class="form-control" id="section8_text" rows="3"
                                name="section8_text">{{ $sitecontent['section8_text'] ?? '' }}</textarea>
                               
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section8_btn1_txt">Button 1 Text</label>
                                <input class="form-control" id="section8_btn1_txt" type="text" name="section8_btn1_txt"
                                    placeholder="" value="{{ $sitecontent['section8_btn1_txt'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="section8_btn1_link">Button 1 Link URL</label>
                                <select name="section8_btn1_link" class="form-control" required>
                                    <option value="">Set URL</option>

                                    @foreach ($all_pages as $key => $page)
                                    <option value="{{ $key }}"
                                        {{ !empty($sitecontent['section8_btn1_link']) && $sitecontent['section8_btn1_link'] == $key ? 'selected' : '' }}>
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


    {{-- <div class="card">

            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">

                        <h6>You can edit CTA section from edit CTA section on mange pages</h6>

                    </div>
                </div>
            </div>


        </div> --}}


    <div class="col-12">
        <div class="d-flex align-items-center justify-content-end mt-4 gap-6">
            <button class="btn btn-primary" type="submit">Update Page</button>
        </div>
    </div>
    @endsection
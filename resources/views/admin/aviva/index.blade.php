@extends('layouts.adminlayout')
@section('page_meta')
<meta name="description" content={{ !empty($site_settings) ? $site_settings->site_meta_desc : '' }}">
<meta name="keywords" content="{{ !empty($site_settings) ? $site_settings->site_meta_keyword : '' }}">
<meta name="author" content="{{ !empty($site_settings->site_name) ? $site_settings->site_name : 'Login' }}">
<title>Admin - {{ $site_settings->site_name }}</title>
@endsection
@section('page_content')
@if (request()->segment(3) == 'edit' || request()->segment(3) == 'add')
{!! breadcrumb('Add/Update Aviva Pools') !!}
<form class="form theme-form" method="post" action="" enctype="multipart/form-data" id="saveForm">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100 border position-relative overflow-hidden">
                        <div class="card-body p-4">
                            <h4 class="card-title">Meta Information Block </h4>
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
                            <h4 class="card-title"> Block</h4>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ !empty($row->name) ? $row->name : '' }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="title" class="form-label">Available</label>
                                    <input type="text" class="form-control" name="title"
                                        value="{{ !empty($row->title) ? $row->title : '' }}" required>
                                </div>
                                <!-- <div class="col-md-6">
                                    <label for="heading" class="form-label">Intro Heading</label>
                                    <input type="text" class="form-control" name="heading"
                                        value="{{ !empty($row->heading) ? $row->heading : '' }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="delivery_time" class="form-label">Delivery Time</label>
                                    <input type="text" class="form-control" name="delivery_time"
                                        value="{{ !empty($row->delivery_time) ? $row->delivery_time : '' }}" required>
                                </div> -->




                                <!-- <div class="col-md-6">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" class="form-control" name="slug"
                                        value="{{ !empty($row->slug) ? $row->slug : '' }}">
                                </div> -->


                            </div>

                            <!-- <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" min="0" step="any" class="form-control"
                                        name="price" value="{{ !empty($row->price) ? $row->price : '0' }}"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label for="qty" class="form-label">Stock Quantity</label>
                                    <input type="number" min="0" class="form-control" name="qty"
                                        value="{{ !empty($row->qty) ? $row->qty : '0' }}" required>
                                </div>
                            </div> -->



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
                                    <input class="form-check-input success" type="checkbox" id="color-success2"
                                        {{ !empty($row) ? ($row->featured == 1 ? 'checked' : '') : '' }}
                                        name="featured" />
                                    <label class="form-check-label" for="color-success2">
                                        {{ !empty($row) ? ($row->featured == 0 ? 'Not Featured' : 'Featured') : 'Featured' }}</label>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>



                <div class="col-lg-6 d-flex align-items-stretch">
                    <div class="card w-100 border position-relative overflow-hidden">
                        <div class="card-body p-4">
                            <h4 class="card-title">Main Image</h4>
                            <div class="text-center">
                                <div class="file_choose_icon">
                                    <img src="{{ get_site_image_src('aviva', !empty($row) ? $row->image1 : '') }}"
                                        alt="matdash-img" class="img-fluid" width="120" height="120">
                                </div>
                                <input class="form-control uploadFile" name="image1" type="file"
                                    data-bs-original-title="" title="">
                                <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 d-flex align-items-stretch">
                    <div class="card w-100 border position-relative overflow-hidden">
                        <div class="card-body p-4">
                            <h4 class="card-title">Overlay Image</h4>
                            <div class="text-center">
                                <div class="file_choose_icon">
                                    <img src="{{ get_site_image_src('aviva', !empty($row) ? $row->image2 : '') }}"
                                        alt="matdash-img" class="img-fluid" width="120" height="120">
                                </div>
                                <input class="form-control uploadFile" name="image2" type="file"
                                    data-bs-original-title="" title="">
                                <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100 border position-relative overflow-hidden">
                        <div class="card-body p-4">
                            <h4 class="card-title">Details Block </h4>
                            <div class="mb-3">
                                <label for="description" class="form-label">Text</label>
                                <textarea class="editor" name="description" required>{{ !empty($row) ? $row->description : '' }}</textarea>
                            </div>


                        </div>
                    </div>
                </div>


                <div class="row">

                    <div class="col-md-12">

                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label" for="image2">Image</label>
                                <div class="card w-100 border position-relative overflow-hidden">
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <div class="file_choose_icon">
                                                <img src="{{ get_site_image_src('aviva', !empty($content['image3']) ? $content['image3'] : '') }}"
                                                    alt="matdash-img" class="img-fluid ">
                                            </div>
                                            <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                            <input class="form-control uploadFile" name="image3" type="file"
                                                data-bs-original-title="" title="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">

                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="section1_heading"> Heading</label>
                                            <input class="form-control" id="section1_heading" type="text" name="section1_heading"
                                                placeholder="" value="{{ $content['section1_heading'] ?? '' }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="section1_text">Text</label>
                                            <textarea id="section1_text" name="section1_text" rows="4"
                                                class=" editor">{{ !empty($content['section1_text']) ? $content['section1_text'] : '' }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="section1_btn_txt">Button 1 Text</label>
                                            <input class="form-control" id="section1_btn_txt" type="text" name="section1_btn_txt"
                                                placeholder="" value="{{ $content['section1_btn_txt'] ?? '' }}">
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

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="section2_btn_txt">Button 1 Text</label>
                                            <input class="form-control" id="section2_btn_txt" type="text" name="section2_btn_txt"
                                                placeholder="" value="{{ $content['section2_btn_txt'] ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="section2_btn_link">Button Link URL</label>
                                            <select name="section2_btn_link" class="form-control" required>
                                                <option value="">Set URL</option>

                                                @foreach ($all_pages as $key => $page)
                                                <option value="{{ $key }}"
                                                    {{ !empty($content['section2_btn_link']) && $content['section2_btn_link'] == $key ? 'selected' : '' }}>
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








                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5> Specifications List</h5>
                                </div>

                                <div class="card-body">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="section2_heading">Small Heading</label>
                                            <input class="form-control" id="section2_heading" type="text" name="section2_heading"
                                                placeholder="" value="{{ $content['section2_heading'] ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table text-nowrap mb-0 newTable" id="newTable" isCkeditor="true">
                                            <thead class="header-item">
                                                <tr>
                                                    <th width="15%"> Image</th>

                                                    <th width="25%"> Title</th>
                                                    <th width="30%"> Detail</th>
                                                    <th width="10%">Order No.</th>
                                                    <th width="5%">
                                                        <div class="action-btn">
                                                            <a href="javascript:void(0)" class="text-primary edit addNewRowTbl" id="addNewRowTbl">
                                                                <i class="ti ti-plus fs-6 fw-bold"></i>
                                                            </a>
                                                        </div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="toolRepeater">
                                                @php
                                                $cover_material = isset($row) ? getSpecify($row->id) : [];
                                                $count = 1;
                                                @endphp

                                                @if (countlength($cover_material) > 0)
                                                @php
                                                $sec1s_count = 1;
                                                @endphp
                                                @foreach ($cover_material as $cover)

                                                <tr class="tool-row">

                                                    <td>
                                                        <div class="d-flex align-items-center" id="imgDiv">
                                                            <input type="file" name="cover_image[]"
                                                                accept="image/*" id="newImgInput"
                                                                style="display: none;" />
                                                            <img src="{{ get_site_image_src('aviva', !empty($cover->cover_image) ? $cover->cover_image : '') }}"
                                                                alt="avatar" class=""
                                                                style="width: 60%; cursor: pointer;background:#ddd"
                                                                id="newImg">

                                                        </div>
                                                    </td>
                                                    <input type="hidden" name="cover_id[]" value="{{ $cover->id }}">
                                                    <td>
                                                        <input type="text" name="cover_name[]" class="form-control" value="{{ $cover->title }}" placeholder=" Title" required>
                                                    </td>
                                                    <td>
                                                        <textarea class="editor" name="detail[]" id="sec1_txt" required>{{ $cover->detail }}</textarea>


                                                    </td>


                                                    <td>
                                                        <input type="number" name="co_order_no[]" class="form-control" value="{{ $cover->order_no }}" min="0" placeholder="Order No." required>
                                                    </td>
                                                    <td>
                                                        <div class="action-btn">
                                                            @if ($count >= 1)
                                                            <a href="javascript:void(0)" class="text-primary edit delNewRowTbl">
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
                                                <tr class="tool-row">
                                                    <td>
                                                        <div class="d-flex align-items-center" id="imgDiv">
                                                            <input type="file" name="cover_image[]"
                                                                accept="image/*" id="newImgInput"
                                                                style="display: none;" />
                                                            <img height="100px" width="100px" src="{{ asset('/images/no-image.svg') }}"
                                                                alt="avatar"
                                                                style="width: 100%; cursor: pointer;background:#ddd"
                                                                id="newImg">
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <input type="text" name="cover_name[]" class="form-control" placeholder="Cover Title" required>
                                                    </td>
                                                    <td>
                                                        <textarea class="editor" name="detail[]" id="sec1_txt" required></textarea>

                                                    </td>


                                                    <td>
                                                        <input type="number" name="co_order_no[]" class="form-control" placeholder="Order No." min="0" required>
                                                    </td>
                                                    <td>
                                                        <div class="action-btn"></div>
                                                    </td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>



                <div class="row">

                    <div class="col-md-12">

                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label" for="image2">Image</label>
                                <div class="card w-100 border position-relative overflow-hidden">
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <div class="file_choose_icon">
                                                <img src="{{ get_site_image_src('aviva', !empty($content['image4']) ? $content['image4'] : '') }}"
                                                    alt="matdash-img" class="img-fluid ">
                                            </div>
                                            <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                            <input class="form-control uploadFile" name="image4" type="file"
                                                data-bs-original-title="" title="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="section3_text">Text</label>
                                            <textarea id="section3_text" name="section3_text" rows="4"
                                                class=" editor">{{ !empty($content['section3_text']) ? $content['section3_text'] : '' }}</textarea>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>






                    </div>

                </div>







                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Available Colours List</h5>
                                </div>
                                <div class="card-body">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="section3_heading">Small Heading</label>
                                            <input class="form-control" id="section3_heading" type="text" name="section3_heading"
                                                placeholder="" value="{{ $content['section3_heading'] ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table text-nowrap mb-0 newTable" id="newTable">
                                            <thead class="header-item">
                                                <tr>
                                                    <th width="25%">Color Image</th>
                                                    <th width="25%">Color Title</th>
                                                    <th width="10%">Order No.</th>
                                                    <th width="5%">
                                                        <div class="action-btn">
                                                            <a href="javascript:void(0)" class="text-primary edit addNewRowTbl" id="addNewRowTbl">
                                                                <i class="ti ti-plus fs-6 fw-bold"></i>
                                                            </a>
                                                        </div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="toolRepeater">
                                                @php
                                                $colours = isset($row) ? getColours($row->id) : [];
                                                $count = 1;
                                                @endphp

                                                @if (countlength($colours) > 0)
                                                @foreach ($colours as $colour)
                                                <tr class="tool-row">

                                                    <td>
                                                        <div class="d-flex align-items-center" id="imgDiv">
                                                            <input type="file" name="colour_image[]"
                                                                accept="image/*" id="newImgInput"
                                                                style="display: none;" />
                                                            <img src="{{ get_site_image_src('aviva', !empty($colour->colour_image) ? $colour->colour_image : '') }}"
                                                                alt="avatar" class=""
                                                                style="width: 60%; cursor: pointer;background:#ddd"
                                                                id="newImg">

                                                        </div>
                                                    </td>
                                                    <input type="hidden" name="colour_id[]" value="{{ $colour->id }}">
                                                    <td>
                                                        <input type="text" name="colour_name[]" class="form-control" value="{{ $colour->title }}" placeholder="Colour Title" required>
                                                    </td>


                                                    <td>
                                                        <input type="number" name="c_order_no[]" class="form-control" value="{{ $colour->order_no }}" min="0" placeholder="Order No." required>
                                                    </td>
                                                    <td>
                                                        <div class="action-btn">
                                                            @if ($count >= 1)
                                                            <a href="javascript:void(0)" class="text-primary edit delNewRowTbl">
                                                                <i class="ti ti-minus fs-5"></i>
                                                            </a>
                                                            @endif
                                                        </div>
                                                    </td>


                                                </tr>
                                                @endforeach
                                                @else
                                                <tr class="tool-row">
                                                    <td>
                                                        <div class="d-flex align-items-center" id="imgDiv">
                                                            <input type="file" name="colour_image[]"
                                                                accept="image/*" id="newImgInput"
                                                                style="display: none;" />
                                                            <img height="100px" width="100px" src="{{ asset('/images/no-image.svg') }}"
                                                                alt="avatar"
                                                                style="width: 100%; cursor: pointer;background:#ddd"
                                                                id="newImg">
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <input type="text" name="colour_name[]" class="form-control" placeholder="Colour Title" required>
                                                    </td>


                                                    <td>
                                                        <input type="number" name="c_order_no[]" class="form-control" placeholder="Order No." min="0" required>
                                                    </td>
                                                    <td>
                                                        <div class="action-btn"></div>
                                                    </td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>


                <div class="row">

                    <div class="col-md-12">

                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label" for="image5">Image</label>
                                <div class="card w-100 border position-relative overflow-hidden">
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <div class="file_choose_icon">
                                                <img src="{{ get_site_image_src('aviva', !empty($content['image5']) ? $content['image5'] : '') }}"
                                                    alt="matdash-img" class="img-fluid ">
                                            </div>
                                            <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                            <input class="form-control uploadFile" name="image5" type="file"
                                                data-bs-original-title="" title="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="section4_text">Text</label>
                                            <textarea id="section4_text" name="section4_text" rows="4"
                                                class=" editor">{{ !empty($content['section4_text']) ? $content['section4_text'] : '' }}</textarea>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>






                    </div>

                </div>






                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Product Designs</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table text-nowrap mb-0 newTable" id="newTable">
                                            <thead class="header-item">
                                                <tr>
                                                    <th width="25%"> Image</th>
                                                    <th width="25%"> Title</th>
                                                    <th width="10%">Order No.</th>
                                                    <th width="5%">
                                                        <div class="action-btn">
                                                            <a href="javascript:void(0)" class="text-primary edit addNewRowTbl" id="addNewRowTbl">
                                                                <i class="ti ti-plus fs-6 fw-bold"></i>
                                                            </a>
                                                        </div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="toolRepeater">
                                                @php
                                                $product_sizes = isset($row) ? getDesign($row->id) : [];
                                                $count = 1;
                                                @endphp

                                                @if (countlength($product_sizes) > 0)
                                                @foreach ($product_sizes as $size)
                                                <tr class="tool-row">

                                                    <td>
                                                        <div class="d-flex align-items-center" id="imgDiv">
                                                            <input type="file" name="size_image[]"
                                                                accept="image/*" id="newImgInput"
                                                                style="display: none;" />
                                                            <img src="{{ get_site_image_src('aviva', !empty($size->size_image) ? $size->size_image : '') }}"
                                                                alt="avatar" class=""
                                                                style="width: 60%; cursor: pointer;background:#ddd"
                                                                id="newImg">

                                                        </div>
                                                    </td>
                                                    <input type="hidden" name="size_id[]" value="{{ $size->id }}">
                                                    <td>
                                                        <input type="text" name="size_name[]" class="form-control" value="{{ $size->title }}" placeholder="Size Title" required>
                                                    </td>


                                                    <td>
                                                        <input type="number" name="s_order_no[]" class="form-control" value="{{ $size->order_no }}" min="0" placeholder="Order No." required>
                                                    </td>
                                                    <td>
                                                        <div class="action-btn">
                                                            @if ($count >= 1)
                                                            <a href="javascript:void(0)" class="text-primary edit delNewRowTbl">
                                                                <i class="ti ti-minus fs-5"></i>
                                                            </a>
                                                            @endif
                                                        </div>
                                                    </td>


                                                </tr>
                                                @endforeach
                                                @else
                                                <tr class="tool-row">
                                                    <td>
                                                        <div class="d-flex align-items-center" id="imgDiv">
                                                            <input type="file" name="size_image[]"
                                                                accept="image/*" id="newImgInput"
                                                                style="display: none;" />
                                                            <img height="100px" width="100px" src="{{ asset('/images/no-image.svg') }}"
                                                                alt="avatar"
                                                                style="width: 100%; cursor: pointer;background:#ddd"
                                                                id="newImg">
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <input type="text" name="size_name[]" class="form-control" placeholder="Size Title" required>
                                                    </td>


                                                    <td>
                                                        <input type="number" name="s_order_no[]" class="form-control" placeholder="Order No." min="0" required>
                                                    </td>
                                                    <td>
                                                        <div class="action-btn"></div>
                                                    </td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
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

            </div>
        </div>
    </div>
</form>
@else
{!! breadcrumb('Aviva Pools', url('admin/aviva/add/')) !!}
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered text-nowrap align-middle">
                    <thead>
                        <!-- start row -->
                        <tr>
                            <th>Sr#</th>
                            <th>Main Image</th>
                            <th>Name</th>
                            <th>Available</th>

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
                                    <img src="{{ get_site_image_src('aviva', !empty($row->image1) ? $row->image1 : '') }}"
                                        width="45" class="rounded-circle" />
                                    {{-- <h6 class="mb-0"> {{ $row->title }}</h6> --}}
                                </div>

                            </td>
                            <td>

                                <div class="d-flex align-items-center gap-6 crud_thumbnail_icon">
                                    <h6 class="mb-0"> {{ $row->name }}</h6>
                                </div>

                            </td>
                            <td>{!! $row->title !!}</td>

                            {{-- <td>{!! short_text($row->detail) !!}</td> --}}
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
                                                href="{{ url('admin/aviva/edit/' . $row->id) }}">
                                                <i class="fs-4 ti ti-edit"></i>Edit
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center gap-3"
                                                href="{{ url('admin/aviva/delete/' . $row->id) }}"
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
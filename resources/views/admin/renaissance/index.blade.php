@extends('layouts.adminlayout')
@section('page_meta')
<meta name="description" content={{ !empty($site_settings) ? $site_settings->site_meta_desc : '' }}">
<meta name="keywords" content="{{ !empty($site_settings) ? $site_settings->site_meta_keyword : '' }}">
<meta name="author" content="{{ !empty($site_settings->site_name) ? $site_settings->site_name : 'Login' }}">
<title>Admin - {{ $site_settings->site_name }}</title>
@endsection
@section('page_content')
@if (request()->segment(3) == 'edit' || request()->segment(3) == 'add')
{!! breadcrumb('Add/Update Renaissance Patio') !!}
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
                                <!-- <div class="col-md-6">
                                    <label for="title" class="form-label">Available</label>
                                    <input type="text" class="form-control" name="title"
                                        value="{{ !empty($row->title) ? $row->title : '' }}" required>
                                </div> -->
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
                                    <img src="{{ get_site_image_src('renaissance', !empty($row) ? $row->image1 : '') }}"
                                        alt="matdash-img" class="img-fluid" width="120" height="120">
                                </div>
                                <input class="form-control uploadFile" name="image1" type="file"
                                    data-bs-original-title="" title="">
                                <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label" for="short_text">Text</label>
                        <textarea id="short_text" name="short_text" rows="4"
                            class=" editor">{{ !empty($content['short_text']) ? $content['short_text'] : '' }}</textarea>
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

                        </div>
                    </div>
                </div>








                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5> Gallery List</h5>
                                </div>
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table text-nowrap mb-0 newTable" id="newTable">
                                            <thead class="header-item">
                                                <tr>
                                                    <th width="15%"> Image</th>

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
                                                $gallery_material = isset($row) ? getGallery($row->id) : [];
                                                $count = 1;
                                                @endphp

                                                @if (countlength($gallery_material) > 0)
                                                @foreach ($gallery_material as $gallery)
                                                <tr class="tool-row">

                                                    <td>
                                                        <div class="d-flex align-items-center" id="imgDiv">
                                                            <input type="file" name="gallery_image[]"
                                                                accept="image/*" id="newImgInput"
                                                                style="display: none;" />
                                                            <img src="{{ get_site_image_src('renaissance', !empty($gallery->cover_image) ? $gallery->cover_image : '') }}"
                                                                alt="avatar" class=""
                                                                style="width: 60%; cursor: pointer;background:#ddd"
                                                                id="newImg">

                                                        </div>
                                                    </td>
                                                    <input type="hidden" name="gallery_id[]" value="{{ $gallery->id }}">
                                                    <td>
                                                        <input type="text" name="gallery_name[]" class="form-control" value="{{ $gallery->title }}" placeholder=" Title" required>
                                                    </td>



                                                    <td>
                                                        <input type="number" name="g_order_no[]" class="form-control" value="{{ $gallery->order_no }}" min="0" placeholder="Order No." required>
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
                                                            <input type="file" name="gallery_image[]"
                                                                accept="image/*" id="newImgInput"
                                                                style="display: none;" />
                                                            <img height="100px" width="100px" src="{{ asset('/images/no-image.svg') }}"
                                                                alt="avatar"
                                                                style="width: 100%; cursor: pointer;background:#ddd"
                                                                id="newImg">
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <input type="text" name="gallery_name[]" class="form-control" placeholder="gallery Title" required>
                                                    </td>



                                                    <td>
                                                        <input type="number" name="g_order_no[]" class="form-control" placeholder="Order No." min="0" required>
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







                <div class="card-body">
                    <div class="row">
                        <div class="mb-3">
                            <label for="sec1_heading" class="form-label">Section Heading</label>
                            <textarea class="editor" name="sec1_heading" required>{{ !empty($row) ? $row->sec1_heading : '' }}</textarea>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Key Features List</h5>
                                </div>
                                <div class="card-body">



                                    <div class="table-responsive">
                                        <table class="table text-nowrap mb-0 newTable" id="newTable">
                                            <thead class="header-item">
                                                <tr>
                                                    <th width="25%"> Title</th>
                                                    <th width="25%"> Detail</th>
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
                                                $colours = isset($row) ? getFeatures($row->id) : [];
                                                $count = 1;
                                                @endphp

                                                @if (countlength($colours) > 0)
                                                @foreach ($colours as $colour)
                                                <tr class="tool-row">


                                                    <input type="hidden" name="colour_id[]" value="{{ $colour->id }}">
                                                    <td>
                                                        <input type="text" name="colour_name[]" class="form-control" value="{{ $colour->title }}" placeholder=" Title" required>
                                                    </td>

                                                    <td>
                                                        <textarea class="form-control" name="detail[]" required>{{ $colour->detail }}</textarea>
                                                    </td>


                                                    <td>
                                                        <input type="number" name="f_order_no[]" class="form-control" value="{{ $colour->order_no }}" min="0" placeholder="Order No." required>
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
                                                        <input type="text" name="colour_name[]" class="form-control" placeholder=" Title" required>
                                                    </td>

                                                    <td>
                                                        <textarea class="form-control" name="detail[]" required></textarea>
                                                    </td>

                                                    <td>
                                                        <input type="number" name="f_order_no[]" class="form-control" placeholder="Order No." min="0" required>
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






                <div class="card-body">
                    <div class="row">
                        <div class="mb-3">
                            <label for="sec2_heading" class="form-label">Section Heading</label>
                            <textarea class="editor" name="sec2_heading" required>{{ !empty($row) ? $row->sec2_heading : '' }}</textarea>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5> Designs List</h5>
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
                                                $product_sizes = isset($row) ? getDesignList($row->id) : [];
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
                                                            <img src="{{ get_site_image_src('renaissance', !empty($size->size_image) ? $size->size_image : '') }}"
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
                                                        <input type="number" name="d_order_no[]" class="form-control" value="{{ $size->order_no }}" min="0" placeholder="Order No." required>
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
                                                        <input type="number" name="d_order_no[]" class="form-control" placeholder="Order No." min="0" required>
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



                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="mb-3">
                                    <label class="form-label" for="section1_text">Text</label>
                                    <textarea id="section1_text" name="section1_text" rows="4"
                                        class=" editor">{{ !empty($content['section1_text']) ? $content['section1_text'] : '' }}</textarea>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>





                <div class="card-body">
                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label" for="section2_heading"> Heading</label>
                            <input class="form-control" id="section2_heading" type="text" name="section2_heading"
                                placeholder="" value="{{ $content['section2_heading'] ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label for="sec3_text" class="form-label"> Text</label>
                            <textarea class="editor" name="sec3_text" required>{{ !empty($content['sec3_text']) ? $content['sec3_text'] : '' }}</textarea>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Faqs List</h5>
                                </div>
                                <div class="card-body">



                                    <div class="table-responsive">
                                        <table class="table text-nowrap mb-0 newTable" id="newTable">
                                            <thead class="header-item">
                                                <tr>
                                                    <th width="25%"> Title</th>
                                                    <th width="25%"> Detail</th>
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
                                                $faqs = isset($row) ? getFaqsResi($row->id) : [];
                                                $count = 1;
                                                @endphp

                                                @if (countlength($faqs) > 0)
                                                @foreach ($faqs as $colour)
                                                <tr class="tool-row">


                                                    <input type="hidden" name="faq_id[]" value="{{ $colour->id }}">
                                                    <td>
                                                        <input type="text" name="answer[]" class="form-control" value="{{ $colour->answer }}" placeholder=" Title" required>
                                                    </td>

                                                    <td>
                                                        <textarea class="form-control" name="question[]" required>{{ $colour->question }}</textarea>
                                                    </td>


                                                    <td>
                                                        <input type="number" name="q_order_no[]" class="form-control" value="{{ $colour->order_no }}" min="0" placeholder="Order No." required>
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
                                                    <input type="hidden" name="faq_id[]" value="">
                                                    <td>
                                                        <input type="text" name="answer[]" class="form-control" placeholder=" Title" required>
                                                    </td>
                                                    <td>
                                                        <textarea class="form-control" name="question[]" required></textarea>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="q_order_no[]" class="form-control" placeholder="Order No." min="0" required>
                                                    </td>
                                                    <td>
                                                        <div class="action-btn">
                                                            <a href="javascript:void(0)" class="text-primary edit delNewRowTbl">
                                                                <i class="ti ti-minus fs-5"></i>
                                                            </a>
                                                        </div>
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
{!! breadcrumb('Renaissance Patio', url('admin/renaissance/add/')) !!}
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
                                    <img src="{{ get_site_image_src('renaissance', !empty($row->image1) ? $row->image1 : '') }}"
                                        width="45" class="rounded-circle" />
                                    {{-- <h6 class="mb-0"> {{ $row->title }}</h6> --}}
                                </div>

                            </td>
                            <td>

                                <div class="d-flex align-items-center gap-6 crud_thumbnail_icon">
                                    <h6 class="mb-0"> {{ $row->name }}</h6>
                                </div>

                            </td>

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
                                                href="{{ url('admin/renaissance/edit/' . $row->id) }}">
                                                <i class="fs-4 ti ti-edit"></i>Edit
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center gap-3"
                                                href="{{ url('admin/renaissance/delete/' . $row->id) }}"
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
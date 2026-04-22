@extends('layouts.adminlayout')
@section('page_meta')
<meta name="description" content="{{ !empty($site_settings) ? $site_settings->site_meta_desc : '' }}">
<meta name="keywords" content="{{ !empty($site_settings) ? $site_settings->site_meta_keyword : '' }}">
<meta name="author" content="{{ !empty($site_settings->site_name) ? $site_settings->site_name : 'Admin' }}">
<title>Admin - {{ $site_settings->site_name }}</title>
@endsection
@section('page_content')
{!! breadcrumb('Home Page') !!}

<form class="form theme-form" method="post" action="" enctype="multipart/form-data" id="saveForm">
    @csrf
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ url('admin/sitecontent') }}" class="btn btn-lg btn-danger">Cancel</a>
    </div>

    {{-- ===================== META ===================== --}}
    <div class="card">
        <div class="card-header">
            <h5>SEO / Meta</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Page Title</label>
                    <input class="form-control" type="text" name="page_title" value="{{ $sitecontent['page_title'] ?? '' }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Meta Title</label>
                    <input class="form-control" type="text" name="meta_title" value="{{ $sitecontent['meta_title'] ?? '' }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Meta Description</label>
                    <textarea class="form-control" rows="3" name="meta_description">{{ $sitecontent['meta_description'] ?? '' }}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Meta Keywords</label>
                    <textarea class="form-control" rows="3" name="meta_keywords">{{ $sitecontent['meta_keywords'] ?? '' }}</textarea>
                </div>
            </div>
        </div>
    </div>

    {{-- ===================== BANNER ===================== --}}
    <div class="card">
        <div class="card-header">
            <h5>Banner Section</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Badge / Top Label</label>
                    <input class="form-control" type="text" name="banner_badge" value="{{ $sitecontent['banner_badge'] ?? '' }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Main Heading</label>
                    <input class="form-control" type="text" name="banner_heading" value="{{ $sitecontent['banner_heading'] ?? '' }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Colored / Highlighted Heading</label>
                    <input class="form-control" type="text" name="banner_colored_heading" value="{{ $sitecontent['banner_colored_heading'] ?? '' }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Main Heading Black</label>
                    <input class="form-control" type="text" name="banner_colored_heading_black" value="{{ $sitecontent['banner_colored_heading_black'] ?? '' }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Description Text</label>
                    <textarea class="form-control" rows="3" name="banner_text">{{ $sitecontent['banner_text'] ?? '' }}</textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Description Text Bold</label>
                    <textarea class="form-control" rows="3" name="banner_text_bold">{{ $sitecontent['banner_text_bold'] ?? '' }}</textarea>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Description Text</label>
                    <textarea class="form-control" rows="3" name="banner_text_2">{{ $sitecontent['banner_text_2'] ?? '' }}</textarea>
                </div>


                <div class="col-md-3 mb-3">
                    <label class="form-label">Button 1 Text</label>
                    <input class="form-control" type="text" name="banner_btn1_txt" value="{{ $sitecontent['banner_btn1_txt'] ?? '' }}">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Button 1 Link</label>
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
                <div class="col-md-3 mb-3">
                    <label class="form-label">Button 2 Text</label>
                    <input class="form-control" type="text" name="banner_btn2_txt" value="{{ $sitecontent['banner_btn2_txt'] ?? '' }}">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Button 2 Link</label>
                    <input class="form-control" type="text" name="banner_btn2_link" value="{{ $sitecontent['banner_btn2_link'] ?? '' }}">
                </div>
            </div>

            {{-- Banner Counters --}}
            <hr>
            <h6 class="mb-3">Banner Counters (e.g. 47,284 / $2.8M+)</h6>
            <div class="row">
                @for ($i = 1; $i <= 4; $i++)
                    <div class="col-md-3 mb-3">
                    <div class="card border">
                        <div class="card-body">
                            <h6>Counter {{ $i }}</h6>


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
                            <div class="mb-2">
                                <label class="form-label">Number / Value</label>
                                <input class="form-control" type="text" name="banner_counter{{ $i }}_val"
                                    value="{{ $sitecontent['banner_counter' . $i . '_val'] ?? '' }}"
                                    placeholder="e.g. 47,284">
                            </div>
                            <div>
                                <label class="form-label">Label</label>
                                <input class="form-control" type="text" name="banner_counter{{ $i }}_label"
                                    value="{{ $sitecontent['banner_counter' . $i . '_label'] ?? '' }}"
                                    placeholder="e.g. Creators">
                            </div>
                        </div>
                    </div>
            </div>
            @endfor
        </div>
    </div>
    </div>

    {{-- ===================== SECTION 1 - TELEGRAM ===================== --}}
    <div class="card">
        <div class="card-header">
            <h5>Section 1 — Telegram / Features</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Top Label</label>
                    <input class="form-control" type="text" name="section1_top_label" value="{{ $sitecontent['section1_top_label'] ?? '' }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Heading</label>
                    <input class="form-control" type="text" name="section1_heading" value="{{ $sitecontent['section1_heading'] ?? '' }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" rows="3" name="section1_text">{{ $sitecontent['section1_text'] ?? '' }}</textarea>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Button Text</label>
                    <input class="form-control" type="text" name="section1_btn_txt" value="{{ $sitecontent['section1_btn_txt'] ?? '' }}">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Button Link</label>
                    <input class="form-control" type="text" name="section1_btn_link" value="{{ $sitecontent['section1_btn_link'] ?? '' }}">
                </div>
            </div>

            {{-- Row Repeater --}}
            <div class="card border mt-3">
                <div class="card-header">
                    <h6>Feature Items (Icon + Title + Text)</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 newTable" id="newTable">
                            <thead class="header-item">
                                <tr>
                                    <th width="12%">Icon / Image</th>
                                    <th width="22%">Title</th>
                                    <th width="35%">Text</th>
                                    <th width="15%">Order No.</th>
                                    <th width="5%">
                                        <a href="javascript:void(0)" class="text-primary addNewRowTbl" id="addNewRowTbl">
                                            <i class="ti ti-plus fs-6 fw-bold"></i>
                                        </a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sec1s = getMultiText('creator-telegram'); @endphp
                                @if (countlength($sec1s) > 0)
                                @php $sec1s_count = 1; @endphp
                                @foreach ($sec1s as $sec1)
                                <tr class="search-items">
                                    <td>
                                        <div class="d-flex align-items-center" id="imgDiv">
                                            <input type="file" name="sec1_image[]" accept="image/*" id="newImgInput" style="display:none;" />
                                            <img src="{{ get_site_image_src('images', !empty($sec1->image) ? $sec1->image : '') }}"
                                                alt="" style="width:100%;cursor:pointer;background:#ddd" id="newImg">
                                            <input type="hidden" name="sec1_pics[]" value="{{ $sec1->image }}">
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" name="sec1_title[]" value="{{ $sec1->title }}" class="form-control" placeholder="Title">
                                    </td>
                                    <td>
                                        <textarea name="sec1_txt1[]" class="form-control" rows="3">{{ $sec1->txt1 }}</textarea>
                                    </td>
                                    <td>
                                        <input type="number" name="sec1_order_no[]" value="{{ $sec1->order_no }}" class="form-control" placeholder="Order#" required>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="text-danger delNewRowTbl"><i class="ti ti-minus fs-5"></i></a>
                                    </td>
                                </tr>
                                @php $sec1s_count++; @endphp
                                @endforeach
                                @else
                                <tr class="search-items">
                                    <td>
                                        <div class="d-flex align-items-center" id="imgDiv">
                                            <input type="file" name="sec1_image[]" accept="image/*" id="newImgInput" style="display:none;" />
                                            <img src="{{ asset('/images/no-image.svg') }}" alt="" style="width:100%;cursor:pointer;background:#ddd" id="newImg">
                                        </div>
                                    </td>
                                    <td><input type="text" name="sec1_title[]" value="" class="form-control" placeholder="Title"></td>
                                    <td><textarea name="sec1_txt1[]" class="form-control" rows="3"></textarea></td>
                                    <td><input type="number" name="sec1_order_no[]" value="" class="form-control" placeholder="Order#" required></td>
                                    <td></td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="col-md-12 mb-3">
                <label class="form-label">Last Text</label>
                <input class="form-control" type="text" name="section1_last_txt" value="{{ $sitecontent['section1_last_txt'] ?? '' }}">
            </div>
        </div>
    </div>

    {{-- ===================== SECTION 2 - GROWTH ===================== --}}
    <div class="card">
        <div class="card-header">
            <h5>Section 2 — Growth That Speaks for Itself</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Top Label</label>
                    <input class="form-control" type="text" name="section2_top_label" value="{{ $sitecontent['section2_top_label'] ?? '' }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Heading</label>
                    <input class="form-control" type="text" name="section2_heading" value="{{ $sitecontent['section2_heading'] ?? '' }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" rows="3" name="section2_text">{{ $sitecontent['section2_text'] ?? '' }}</textarea>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Chart / Graph Image</label>
                    <div class="card border">
                        <div class="card-body text-center">
                            <img src="{{ get_site_image_src('images', !empty($sitecontent['image1']) ? $sitecontent['image1'] : '') }}"
                                class="img-fluid mb-2" style="max-height:120px;">
                            <input class="form-control uploadFile" name="image1" type="file">
                            <p class="mb-0 small">Allowed JPG, PNG, SVG</p>
                        </div>
                    </div>
                </div>

                {{-- Row Repeater --}}
                <div class="card border mt-2">
                    <div class="card-header">
                        <h6>Perfoming Groups</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 newTable" id="newTable">
                                <thead class="header-item">
                                    <tr>
                                        <th width="12%">Avatar</th>
                                        <th width="18%">Name</th>
                                        <th width="18%">Earnings / Amount</th>
                                        <th width="30%">Description</th>
                                        <th width="12%">Order No.</th>
                                        <th width="5%">
                                            <a href="javascript:void(0)" class="text-primary addNewRowTbl" id="addNewRowTbl">
                                                <i class="ti ti-plus fs-6 fw-bold"></i>
                                            </a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $sec3s = getMultiText('creator-stories'); @endphp
                                    @if (countlength($sec3s) > 0)
                                    @php $sec3s_count = 1; @endphp
                                    @foreach ($sec3s as $sec3)
                                    <tr class="search-items">
                                        <td>
                                            <div class="d-flex align-items-center" id="imgDiv">
                                                <input type="file" name="sec3_image[]" accept="image/*" id="newImgInput" style="display:none;" />
                                                <img src="{{ get_site_image_src('images', !empty($sec3->image) ? $sec3->image : '') }}"
                                                    alt="" style="width:100%;cursor:pointer;background:#ddd" id="newImg">
                                                <input type="hidden" name="sec3_pics[]" value="{{ $sec3->image }}">
                                            </div>
                                        </td>
                                        <td><input type="text" name="sec3_title[]" value="{{ $sec3->title }}" class="form-control" placeholder="Name"></td>
                                        <td><input type="text" name="sec3_txt2[]" value="{{ $sec3->txt2 }}" class="form-control" placeholder="e.g. $1,200"></td>
                                        <td><textarea name="sec3_txt1[]" class="form-control" rows="3">{{ $sec3->txt1 }}</textarea></td>
                                        <td><input type="number" name="sec3_order_no[]" value="{{ $sec3->order_no }}" class="form-control" placeholder="Order#" required></td>
                                        <td>
                                            <a href="javascript:void(0)" class="text-danger delNewRowTbl"><i class="ti ti-minus fs-5"></i></a>
                                        </td>
                                    </tr>
                                    @php $sec3s_count++; @endphp
                                    @endforeach
                                    @else
                                    <tr class="search-items">
                                        <td>
                                            <div class="d-flex align-items-center" id="imgDiv">
                                                <input type="file" name="sec3_image[]" accept="image/*" id="newImgInput" style="display:none;" />
                                                <img src="{{ asset('/images/no-image.svg') }}" alt="" style="width:100%;cursor:pointer;background:#ddd" id="newImg">
                                            </div>
                                        </td>
                                        <td><input type="text" name="sec3_title[]" value="" class="form-control" placeholder="Name"></td>
                                        <td><input type="text" name="sec3_txt2[]" value="" class="form-control" placeholder="e.g. $1,200"></td>
                                        <td><textarea name="sec3_txt1[]" class="form-control" rows="3"></textarea></td>
                                        <td><input type="number" name="sec3_order_no[]" value="" class="form-control" placeholder="Order#" required></td>
                                        <td></td>
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

    {{-- ===================== SECTION 3 - CRAZY STORIES ===================== --}}
    <div class="card">
        <div class="card-header">
            <h5>Section 3 — Crazy Stories. Real People.</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Top Label</label>
                    <input class="form-control" type="text" name="section3_top_label" value="{{ $sitecontent['section3_top_label'] ?? '' }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Heading</label>
                    <input class="form-control" type="text" name="section3_heading" value="{{ $sitecontent['section3_heading'] ?? '' }}">
                </div>
            </div>


        </div>
    </div>

    {{-- ===================== SECTION 4 - TESTIMONIALS ===================== --}}
    <div class="card">
        <div class="card-header">
            <h5>Section 4 — Testimonials &amp; Live Reviews</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Top Label</label>
                    <input class="form-control" type="text" name="section4_top_label" value="{{ $sitecontent['section4_top_label'] ?? '' }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Heading</label>
                    <input class="form-control" type="text" name="section4_heading" value="{{ $sitecontent['section4_heading'] ?? '' }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Colored / Highlighted Heading</label>
                    <input class="form-control" type="text" name="section4_colored_heading" value="{{ $sitecontent['section4_colored_heading'] ?? '' }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" rows="3" name="section4_text">{{ $sitecontent['section4_text'] ?? '' }}</textarea>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Button Text</label>
                    <input class="form-control" type="text" name="section4_btn_txt" value="{{ $sitecontent['section4_btn_txt'] ?? '' }}">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Button Link</label>
                    <input class="form-control" type="text" name="section4_btn_link" value="{{ $sitecontent['section4_btn_link'] ?? '' }}">
                </div>
            </div>

            {{-- Row Repeater --}}
            <div class="card border mt-2">
                <div class="card-header">
                    <h6>Review Cards (Avatar + Name + Platform + Review Text)</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 newTable" id="newTable">
                            <thead class="header-item">
                                <tr>
                                    <th width="12%">Avatar</th>
                                    <th width="18%">Name</th>
                                    <th width="18%">Platform / Handle</th>
                                    <th width="30%">Review Text</th>
                                    <th width="12%">Order No.</th>
                                    <th width="5%">
                                        <a href="javascript:void(0)" class="text-primary addNewRowTbl" id="addNewRowTbl">
                                            <i class="ti ti-plus fs-6 fw-bold"></i>
                                        </a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sec4s = getMultiText('creator-testimonials'); @endphp
                                @if (countlength($sec4s) > 0)
                                @php $sec4s_count = 1; @endphp
                                @foreach ($sec4s as $sec4)
                                <tr class="search-items">
                                    <td>
                                        <div class="d-flex align-items-center" id="imgDiv">
                                            <input type="file" name="sec4_image[]" accept="image/*" id="newImgInput" style="display:none;" />
                                            <img src="{{ get_site_image_src('images', !empty($sec4->image) ? $sec4->image : '') }}"
                                                alt="" style="width:100%;cursor:pointer;background:#ddd" id="newImg">
                                            <input type="hidden" name="sec4_pics[]" value="{{ $sec4->image }}">
                                        </div>
                                    </td>
                                    <td><input type="text" name="sec4_title[]" value="{{ $sec4->title }}" class="form-control" placeholder="Name"></td>
                                    <td><input type="text" name="sec4_txt2[]" value="{{ $sec4->txt2 }}" class="form-control" placeholder="@handle"></td>
                                    <td><textarea name="sec4_txt1[]" class="form-control" rows="3">{{ $sec4->txt1 }}</textarea></td>
                                    <td><input type="number" name="sec4_order_no[]" value="{{ $sec4->order_no }}" class="form-control" placeholder="Order#" required></td>
                                    <td>
                                        <a href="javascript:void(0)" class="text-danger delNewRowTbl"><i class="ti ti-minus fs-5"></i></a>
                                    </td>
                                </tr>
                                @php $sec4s_count++; @endphp
                                @endforeach
                                @else
                                <tr class="search-items">
                                    <td>
                                        <div class="d-flex align-items-center" id="imgDiv">
                                            <input type="file" name="sec4_image[]" accept="image/*" id="newImgInput" style="display:none;" />
                                            <img src="{{ asset('/images/no-image.svg') }}" alt="" style="width:100%;cursor:pointer;background:#ddd" id="newImg">
                                        </div>
                                    </td>
                                    <td><input type="text" name="sec4_title[]" value="" class="form-control" placeholder="Name"></td>
                                    <td><input type="text" name="sec4_txt2[]" value="" class="form-control" placeholder="@handle"></td>
                                    <td><textarea name="sec4_txt1[]" class="form-control" rows="3"></textarea></td>
                                    <td><input type="number" name="sec4_order_no[]" value="" class="form-control" placeholder="Order#" required></td>
                                    <td></td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===================== SECTION 5 - NUMBERS ===================== --}}
    <div class="card">
        <div class="card-header">
            <h5>Section 5 — The Numbers Don't Lie</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Top Label</label>
                    <input class="form-control" type="text" name="section5_top_label" value="{{ $sitecontent['section5_top_label'] ?? '' }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Heading</label>
                    <input class="form-control" type="text" name="section5_heading" value="{{ $sitecontent['section5_heading'] ?? '' }}">
                </div>
            </div>
            <hr>
            <h6 class="mb-3">Stats / Counters</h6>
            <div class="row">
                @for ($i = 1; $i <= 4; $i++)
                    <div class="col-md-3 mb-3">
                    <div class="card border">
                        <div class="card-body">
                            <h6>Stat {{ $i }}</h6>
                            <div class="mb-2">
                                <label class="form-label">Value</label>
                                <input class="form-control" type="text" name="section5_stat{{ $i }}_val"
                                    value="{{ $sitecontent['section5_stat' . $i . '_val'] ?? '' }}"
                                    placeholder="e.g. 47,284">
                            </div>
                            <div>
                                <label class="form-label">Label</label>
                                <input class="form-control" type="text" name="section5_stat{{ $i }}_label"
                                    value="{{ $sitecontent['section5_stat' . $i . '_label'] ?? '' }}"
                                    placeholder="e.g. Active Creators">
                            </div>
                        </div>
                    </div>
            </div>
            @endfor
        </div>
    </div>
    </div>

    {{-- ===================== CTA SECTION ===================== --}}
    <div class="card">
        <div class="card-header">
            <h5>CTA Section — Ready to Get Paid?</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Heading</label>
                    <input class="form-control" type="text" name="cta_heading" value="{{ $sitecontent['cta_heading'] ?? '' }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Colored / Highlighted Heading</label>
                    <input class="form-control" type="text" name="cta_colored_heading" value="{{ $sitecontent['cta_colored_heading'] ?? '' }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" rows="3" name="cta_text">{{ $sitecontent['cta_text'] ?? '' }}</textarea>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Button Text</label>
                    <input class="form-control" type="text" name="cta_btn_txt" value="{{ $sitecontent['cta_btn_txt'] ?? '' }}">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Button Link</label>
                    <input class="form-control" type="text" name="cta_btn_link" value="{{ $sitecontent['cta_btn_link'] ?? '' }}">
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 mb-4">
        <div class="d-flex align-items-center justify-content-end gap-6">
            <button class="btn btn-primary btn-lg" type="submit">Update Page</button>
        </div>
    </div>

</form>
@endsection
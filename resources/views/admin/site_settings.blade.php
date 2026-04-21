@extends('layouts.adminlayout')
@section('page_meta')
<meta name="description" content={{ !empty($site_settings) ? $site_settings->site_meta_desc : '' }}">
<meta name="keywords" content="{{ !empty($site_settings) ? $site_settings->site_meta_keyword : '' }}">
<meta name="author" content="{{ !empty($site_settings->site_name) ? $site_settings->site_name : 'Login' }}">
<title>Admin - {{ $site_settings->site_name }}</title>
@endsection
@section('page_content')
{!! breadcrumb('Site Settings') !!}
<form class="form theme-form" method="post" action="{{ url('admin/settings') }}" enctype="multipart/form-data"
    id="saveForm">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4 d-flex align-items-stretch">
                    <div class="card w-100 border position-relative overflow-hidden">
                        <div class="card-body p-4">
                            <h4 class="card-title">Change Logo</h4>
                            <p class="card-subtitle mb-4">Change your Site Logo 1</p>
                            <div class="text-center">
                                <div class="file_choose_icon">
                                    <img src="{{ get_site_image_src('images', $site_settings->site_logo) }}"
                                        alt="matdash-img" class="img-fluid ">
                                </div>
                                <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                <input class="form-control uploadFile" name="site_logo" type="file"
                                    data-bs-original-title="" title="">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-lg-3 d-flex align-items-stretch">
                        <div class="card w-100 border position-relative overflow-hidden">
                            <div class="card-body p-4">
                                <h4 class="card-title">Change Footer</h4>
                                <p class="card-subtitle mb-4">Change your Site Footer Logo</p>
                                <div class="text-center">
                                    <div class="file_choose_icon">
                                        <img src="{{ get_site_image_src('images', $site_settings->site_logo2) }}"
                                            alt="matdash-img" class="img-fluid ">
                                    </div>
                                    <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                    <input class="form-control uploadFile" name="site_logo2" type="file"
                                        data-bs-original-title="" title="">
                                </div>
                            </div>
                        </div>
                    </div> -->
                <div class="col-lg-4 d-flex align-items-stretch">
                    <div class="card w-100 border position-relative overflow-hidden">
                        <div class="card-body p-4">
                            <h4 class="card-title">Change Fav Icon</h4>
                            <p class="card-subtitle mb-4">Change your Site FavIcon</p>
                            <div class="text-center">
                                <div class="file_choose_icon">
                                    <img src="{{ get_site_image_src('images', $site_settings->site_icon) }}"
                                        alt="matdash-img" class="img-fluid ">
                                </div>
                                <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                <input class="form-control uploadFile" name="site_icon" type="file"
                                    data-bs-original-title="" title="">
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-4 d-flex align-items-stretch">
                <div class="card w-100 border position-relative overflow-hidden">
                  <div class="card-body p-4">
                    <h4 class="card-title">Change Email Logo</h4>
                    <p class="card-subtitle mb-4">Change your Email Logo</p>
                    <div class="text-center">
                     <div class="file_choose_icon">
                        <img src="{{ get_site_image_src('images', $site_settings->site_email_logo) }}"
                alt="matdash-img" class="img-fluid " >
            </div>
            <p class="mb-0">Allowed JPG or PNG. Max size of 800K</p>
            <input class="form-control uploadFile" name="site_email_logo" type="file" data-bs-original-title=""
                title="">
        </div>
    </div>
    </div>
    </div> --}}
    <div class="col-lg-3 d-flex align-items-stretch">
        <div class="card w-100 border position-relative overflow-hidden">
            <div class="card-body p-4">
                <h4 class="card-title">Change Thumb</h4>
                <p class="card-subtitle mb-4">Change your Site Thumb</p>
                <div class="text-center">
                    <div class="file_choose_icon">
                        <img src="{{ get_site_image_src('images', $site_settings->site_thumb) }}" alt="matdash-img"
                            class="img-fluid ">
                    </div>
                    <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                    <input class="form-control uploadFile" name="site_thumb" type="file" data-bs-original-title=""
                        title="">
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card w-100 border position-relative overflow-hidden">
            <div class="card-body p-4">
                <h4 class="card-title">Website Details</h4>
                <p class="card-subtitle mb-4">To change your Website detail , edit and save from here</p>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="site_domain" class="form-label">Site Domain</label>
                            <input class="form-control" id="site_domain" type="text" name="site_domain"
                                placeholder="www.example.come" value="{{ $site_settings->site_domain }}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="site_name" class="form-label">Site Name</label>
                            <input class="form-control" id="site_name" type="text" name="site_name" placeholder=""
                                value="{{ $site_settings->site_name }}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="site_phone" class="form-label">Site Phone</label>
                            <input class="form-control" id="site_phone" type="text" name="site_phone" placeholder=""
                                value="{{ $site_settings->site_phone }}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="site_email" class="form-label">Site Email</label>
                            <input class="form-control" id="site_email" type="text" name="site_email" placeholder=""
                                value="{{ $site_settings->site_email }}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="site_noreply_email" class="form-label">Site No-Reply Email</label>
                            <input class="form-control" id="site_noreply_email" type="text" name="site_noreply_email"
                                placeholder="" value="{{ $site_settings->site_noreply_email }}">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="site_address" class="form-label">Site Address</label>
                            <textarea class="form-control" id="site_address" rows="3"
                                name="site_address">{{ $site_settings->site_address }}</textarea>
                        </div>
                    </div>
                    <!-- <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="site_about" class="form-label">Site About</label>
                            <textarea class="form-control" id="site_about" rows="3"
                                name="site_about">{{ $site_settings->site_about }}</textarea>
                        </div>
                    </div> -->


                    <!-- <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="site_ft_heading1" class="form-label">Footer Heading 1</label>
                            <input class="form-control" id="site_ft_heading1" type="text" name="site_ft_heading1"
                                placeholder="" value="{{ $site_settings->site_ft_heading1 }}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="site_ft_heading2" class="form-label">Footer Heading 2</label>
                            <input class="form-control" id="site_ft_heading2" type="text" name="site_ft_heading2"
                                placeholder="" value="{{ $site_settings->site_ft_heading2 }}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="site_ft_heading3" class="form-label">Footer Heading 3</label>
                            <input class="form-control" id="site_ft_heading3" type="text" name="site_ft_heading3"
                                placeholder="" value="{{ $site_settings->site_ft_heading3 }}">
                        </div>
                    </div> -->



                    {{-- <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="site_news_letter_text" class="form-label">Newsletter Text</label>
                                            <textarea class="form-control" id="site_news_letter_text" rows="3" name="site_news_letter_text">{{ $site_settings->site_news_letter_text }}</textarea>
                </div>
            </div> --}}

            <div class="col-lg-12">
                <div class="mb-3">
                    <label for="site_copyright" class="form-label">Site Copyright</label>
                    <textarea class="form-control" id="site_copyright" rows="3"
                        name="site_copyright">{{ $site_settings->site_copyright }}</textarea>
                </div>
            </div>

            {{-- <div class="col-lg-12">
                            <div class="mb-3">
                              <label for="site_license" class="form-label">Site License link</label>
                              <input class="form-control" id="site_license" type="text" name="site_license"
                                                  placeholder="" value="{{ $site_settings->site_license }}">
        </div>
    </div> --}}
    </div>

    </div>
    </div>
    </div>

    {{-- <div class="col-12">
                <div class="card w-100 border position-relative overflow-hidden">
                  <div class="card-body p-4">


                      <div class="row">

                        <div class="col-lg-4">
                          <div class="mb-3">
                            <label for="site_media_inquery_email" class="form-label">Media Inquiries Email</label>
                            <input class="form-control" id="site_media_inquery_email" type="text" name="site_media_inquery_email"
                                                placeholder="" value="{{ $site_settings->site_media_inquery_email }}">
    </div>
    </div>
    <div class="col-lg-4">
        <div class="mb-3">
            <label for="site_career_op_email" class="form-label">Career Opportunities Email</label>
            <input class="form-control" id="site_career_op_email" type="text" name="site_career_op_email" placeholder=""
                value="{{ $site_settings->site_career_op_email }}">
        </div>
    </div>

    </div>

    </div>
    </div>
    </div> --}}

    <div class="col-12">
        <div class="card w-100 border position-relative overflow-hidden">
            <div class="card-body p-4">
                <h4 class="card-title">Meta Details</h4>
                <p class="card-subtitle mb-4">To change your meta detail , edit and save from here</p>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="site_domain" class="form-label">Site Meta Description</label>
                            <textarea class="form-control" id="site_meta_desc" rows="3"
                                name="site_meta_desc">{{ $site_settings->site_meta_desc }}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="site_copyright" class="form-label">Site Meta Keywords</label>
                            <textarea class="form-control" id="site_meta_keyword" rows="3"
                                name="site_meta_keyword">{{ $site_settings->site_meta_keyword }}</textarea>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- <div class="col-12">
                <div class="card w-100 border position-relative overflow-hidden">
                  <div class="card-body p-4">
                    <h4 class="card-title">Site Processing Fee(%)</h4>
                    <p class="card-subtitle mb-4">Site processing fee or services charges</p>
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="mb-3">
                            <div class="">
                               <input type="number" name="site_processing_fee" class="form-control" value="{{$site_settings->site_processing_fee}}"
    />
    </div>
    </div>
    </div>

    </div>

    </div>
    </div>
    </div> --}}
    {{-- <div class="col-12">
                <div class="card w-100 border position-relative overflow-hidden">
                  <div class="card-body p-4">
                    <h4 class="card-title">Site Profit Percentage(%)</h4>
                    <p class="card-subtitle mb-4">Site profit percentage that will be deducted from each booking</p>
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="mb-3">
                            <div class="">
                               <input type="number" name="site_percentage" class="form-control" value="{{$site_settings->site_percentage}}"
    />
    </div>
    </div>
    </div>

    </div>

    </div>
    </div>
    </div> --}}
    <div class="col-12">
        <div class="card w-100 border position-relative overflow-hidden">
            <div class="card-body p-4">
                <h4 class="card-title">Site Social Links</h4>
                <p class="card-subtitle mb-4">To change your Social Media detail , edit and save from here
                </p>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <div class="">
                                <label class="form-check-label" for="color-success"> Instagram</label>
                                <input class="form-control" id="site_instagram" type="text" name="site_instagram"
                                    placeholder="" value="{{ $site_settings->site_instagram }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <div class="">
                                <label class="form-check-label" for="color-success"> Facebook</label>
                                <input class="form-control" id="site_facebook" type="text" name="site_facebook"
                                    placeholder="" value="{{ $site_settings->site_facebook }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <div class="">
                                <label class="form-check-label" for="color-success">X / Twitter</label>
                                <input class="form-control" id="site_twitter" type="text" name="site_twitter"
                                    placeholder="" value="{{ $site_settings->site_twitter }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <div class="">
                                <label class="form-check-label" for="color-success"> Linkedin</label>
                                <input class="form-control" id="site_linkedin" type="text" name="site_linkedin"
                                    placeholder="" value="{{ $site_settings->site_linkedin }}">
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    {{-- <div class="col-12">
                        <div class="card w-100 border position-relative overflow-hidden">
                            <div class="card-body p-4">
                                <h4 class="card-title">Site Stripe Payment Testing/Live</h4>
                                <p class="card-subtitle mb-4">To change your Stripe Details , edit and save from here</p>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <div class="form-check form-switch py-2">
                                                <input class="form-check-input success" type="checkbox"
                                                    id="color-success"
                                                    {{ !empty($site_settings) ? ($site_settings->site_stripe_type == 1 ? 'checked' : '') : '' }}
    name="site_stripe_type" />
    <label class="form-check-label" for="color-success">
        {{ !empty($site_settings) ? ($site_settings->site_stripe_type == 0 ? 'Testing' : 'Live') : '' }}
        Mode</label>
    </div>
    </div>
    </div>

    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <div class="">
                    <label class="form-check-label" for="color-success">Testing Stripe API
                        Public Key</label>
                    <input class="form-control" id="site_stripe_testing_api_key" type="text"
                        name="site_stripe_testing_api_key" placeholder=""
                        value="{{ $site_settings->site_stripe_testing_api_key }}">
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <div class="">
                    <label class="form-check-label" for="color-success"> Testing Stripe API
                        Secret Key</label>
                    <input class="form-control" id="site_stripe_testing_secret_key" type="text"
                        name="site_stripe_testing_secret_key" placeholder=""
                        value="{{ $site_settings->site_stripe_testing_secret_key }}">
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="mb-3">
                <div class="">
                    <label class="form-check-label" for="color-success"> Live Stripe API
                        Public Key </label>
                    <input class="form-control" id="site_stripe_live_api_key" type="text"
                        name="site_stripe_live_api_key" placeholder=""
                        value="{{ $site_settings->site_stripe_live_api_key }}">
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <div class="">
                    <label class="form-check-label" for="color-success"> Live Stripe API
                        Secret Key</label>
                    <input class="form-control" id="site_stripe_live_secret_key" type="text"
                        name="site_stripe_live_secret_key" placeholder=""
                        value="{{ $site_settings->site_stripe_live_secret_key }}">
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="mb-3">
                <div class="">
                    <label class="form-check-label" for="color-success"> Site Shipping
                        Fee</label>
                    <input class="form-control" id="site_shipping_fee" type="number" min="0" name="site_shipping_fee"
                        placeholder="" value="{{ $site_settings->site_shipping_fee }}">
                </div>
            </div>
        </div>

    </div>

    </div>
    </div>
    </div> --}}

    {{-- <div class="col-12">
                        <div class="card w-100 border position-relative overflow-hidden">
                            <div class="card-body p-4">
                                <h4 class="card-title">Site Paypal Payment Testing/Live</h4>
                                <p class="card-subtitle mb-4">To change your Paypal Details , edit and save from here</p>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <div class="form-check form-switch py-2">
                                                <input class="form-check-input success" type="checkbox"
                                                    id="color-success"
                                                    {{ !empty($site_settings) ? ($site_settings->site_sandbox == 1 ? 'checked' : '') : '' }}
    name="site_sandbox" />
    <label class="form-check-label" for="color-success">
        {{ !empty($site_settings) ? ($site_settings->site_sandbox == 0 ? 'Sandbox' : 'Live') : '' }}
        Mode</label>
    </div>
    </div>
    </div>

    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <div class="">
                    <label class="form-check-label" for="color-success">Paypal Sandbox API
                        Key</label>
                    <input class="form-control" id="site_sandbox_paypal" type="text" name="site_sandbox_paypal"
                        placeholder="" value="{{ $site_settings->site_sandbox_paypal }}">
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <div class="">
                    <label class="form-check-label" for="color-success"> Live Paypal API Key
                    </label>
                    <input class="form-control" id="site_live_paypal" type="text" name="site_live_paypal" placeholder=""
                        value="{{ $site_settings->site_live_paypal }}">
                </div>
            </div>
        </div>

    </div>

    </div>
    </div>
    </div> --}}

    <div class="col-12">
        <div class="card w-100 border position-relative overflow-hidden">
            <div class="card-body p-4">
                <h4 class="card-title">Site SMTP Details</h4>
                <p class="card-subtitle mb-4">To change your SMTP detail , edit and save from here
                </p>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <div class="">
                                <label class="form-check-label" for="color-success"> SMTP Host</label>
                                <input class="form-control" id="site_smtp_host" type="text" name="site_smtp_host"
                                    placeholder="" value="{{ $site_settings->site_smtp_host }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <div class="">
                                <label class="form-check-label" for="color-success"> SMTP Port</label>
                                <input class="form-control" id="site_smtp_port" type="text" name="site_smtp_port"
                                    placeholder="" value="{{ $site_settings->site_smtp_port }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <div class="">
                                <label class="form-check-label" for="color-success">SMTP User</label>
                                <input class="form-control" id="site_smtp_user" type="text" name="site_smtp_user"
                                    placeholder="" value="{{ $site_settings->site_smtp_user }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <div class="">
                                <label class="form-check-label" for="color-success"> SMTP Password</label>
                                <input class="form-control" id="site_smtp_pswd" type="text" name="site_smtp_pswd"
                                    placeholder="" value="{{ $site_settings->site_smtp_pswd }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-end mt-4 gap-6">
                            <button class="btn btn-primary" type="submit">Update Site Settings</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- <div class="col-12">
        <div class="card w-100 border position-relative overflow-hidden">
            <div class="card-body p-4">
                <h4 class="card-title">Site Header</h4>
                <p class="card-subtitle mb-4">To change your header detail , edit and save from here
                </p>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Find Jobs</h5>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col">
                                        <div class="card w-100 border position-relative overflow-hidden">
                                            <div class="card-body p-4">
                                                <div class="text-center">
                                                    <div class="file_choose_icon"
                                                        style="background-color: rgb(179, 179, 179)">
                                                        <img src="{{ get_site_image_src('images', $site_settings->site_header_image1) }}"
                                                            alt="matdash-img" class="img-fluid ">
                                                    </div>
                                                    <p class="mb-0">Allowed JPG, GIF or PNG. Max size
                                                        of 800K
                                                    </p>
                                                    <input class="form-control uploadFile" name="site_header_image1"
                                                        type="file" data-bs-original-title="" title="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-4">
                                            <label class="form-label" for="site_header_heading1">Heading</label>
                                            <input class="form-control" id="site_header_heading1" type="text"
                                                name="site_header_heading1" placeholder=""
                                                value="{{ $site_settings->site_header_heading1 }}">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-4">
                                            <label class="form-label" for="site_header_btn1_text">Button
                                                Text</label>
                                            <input class="form-control" id="site_header_btn1_text" type="text"
                                                name="site_header_btn1_text" placeholder=""
                                                value="{{ $site_settings->site_header_btn1_text }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="site_header_btn1_link">Button
                                                Link
                                                URL</label>
                                            <select name="site_header_btn1_link" class="form-control">
                                                <option value="">Set URL</option>

                                                @foreach ($all_pages as $key => $page)
                                                <option value="{{ $key }}"
                                                    {{ !empty($site_settings->site_header_btn1_link) && $site_settings->site_header_btn1_link == $key ? 'selected' : '' }}>
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


                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Hire Talent</h5>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col">
                                        <div class="card w-100 border position-relative overflow-hidden">
                                            <div class="card-body p-4">
                                                <div class="text-center">
                                                    <div class="file_choose_icon"
                                                        style="background-color: rgb(179, 179, 179)">
                                                        <img src="{{ get_site_image_src('images', $site_settings->site_header_image2) }}"
                                                            alt="matdash-img" class="img-fluid ">
                                                    </div>
                                                    <p class="mb-0">Allowed JPG, GIF or PNG. Max size
                                                        of 800K
                                                    </p>
                                                    <input class="form-control uploadFile" name="site_header_image2"
                                                        type="file" data-bs-original-title="" title="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-4">
                                            <label class="form-label" for="site_header_heading2">Heading</label>
                                            <input class="form-control" id="site_header_heading2" type="text"
                                                name="site_header_heading2" placeholder=""
                                                value="{{ $site_settings->site_header_heading2 }}">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-4">
                                            <label class="form-label" for="site_header_btn2_text">Button
                                                Text</label>
                                            <input class="form-control" id="site_header_btn2_text" type="text"
                                                name="site_header_btn2_text" placeholder=""
                                                value="{{ $site_settings->site_header_btn2_text }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="site_header_btn2_link">Button
                                                Link
                                                URL</label>
                                            <select name="site_header_btn2_link" class="form-control">
                                                <option value="">Set URL</option>

                                                @foreach ($all_pages as $key => $page)
                                                <option value="{{ $key }}"
                                                    {{ !empty($site_settings->site_header_btn2_link) && $site_settings->site_header_btn2_link == $key ? 'selected' : '' }}>
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
        </div>
    </div> -->



    </div>
    </div>
    </div>
</form>
@endsection
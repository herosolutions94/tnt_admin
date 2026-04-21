@extends('layouts.frontend')

@section('title', 'Welcome to Our Website')

@section('content')

<section class="sm_banner" style="background-image: url('{{ get_site_image_src('images', !empty($content['image1']) ? $content['image1'] : 'default.jpg') }}')">
    <div class="contain">
        <div class="cntnt" data-aos="fade-up">
              <h1>{!! $content['banner_heading'] ?? '' !!}</h1>
            <p>{!! $content['banner_text'] ?? '' !!}</p>
        </div>
    </div>
</section>
<section class="contact_info">
    <div class="contain">
        <div class="flex">
            <div class="colL" data-aos="fade-right">
              <h3>{!! $content['section1_heading'] ?? '' !!}</h3>
                <p>{!! $content['section1_text'] ?? '' !!}</p>
            </div>
            <div class="colR" data-aos="fade-left">
                <div class="flex_contact">
                    <div class="col">
                        <div class="inner">
                            <div class="img_icon">
                                <img src="assets/images/map.svg" alt="">
                            </div>
                            <p>{{$site_settings->site_address}}</p>
                        </div>
                    </div>

                    <div class="col">
                        <div class="inner">
                            <div class="img_icon">
                                <img src="assets/images/call.svg" alt="">
                            </div>
                            <a href="tel:{{$site_settings->site_phone}}">{{$site_settings->site_phone}}</a>
                        </div>
                    </div>

                    <div class="col">
                        <div class="inner">
                            <div class="img_icon">
                                <img src="assets/images/email.svg" alt="">
                            </div>
                            <a href="mailto:{{$site_settings->site_email}}">{{$site_settings->site_email}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form id="contactForm" action="{{url('/api/save-contact-message')}}" data-aos="fade-up" class="frmAjax">
            @csrf
            <h3>Have a Quick Question?</h3>
            <div class="row form_row">
                <div class="col-md-6">
                    <input type="text" class="input" name="fname" placeholder="First Name" required>
                </div>
                <div class="col-md-6">
                    <input type="text" class="input" name="lname" placeholder="Last Name" required>
                </div>
                <div class="col-md-6">
                    <input type="text" class="input" name="phone" placeholder="Phone Number" required>
                </div>
                <div class="col-md-6">
                    <input type="text" class="input" name="email" placeholder="Email Address" required>
                </div>
                <div class="col-md-12">
                    <textarea name="message" id="" placeholder="Enter Your Message Here" class="input"></textarea>
                </div>
                <div class="col-md-12">
                    <input type="text" class="input" name="hear_about_us" placeholder="How did you hear about us?">
                </div>
            </div>
            <div class="btn_blk">
                <button type="submit" class="site_btn" >Send Message<i class="spinner hidden"></i></button>
            </div>
        </form>
    </div>
</section>






@endsection
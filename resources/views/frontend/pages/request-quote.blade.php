@extends('layouts.frontend')

@section('title', 'Welcome to Our Website')

@section('content')

<section class="sm_banner"
    style="background-image: url('{{ get_site_image_src('images', !empty($content['image1']) ? $content['image1'] : 'default.jpg') }}');">
    <div class="contain">
        <div class="cntnt" data-aos="fade-up">
            {!! $content['banner_text'] ?? '' !!}
        </div>
    </div>
</section>
<section class="quote_sec">
    <div class="contain">
        <div class="cntnt" data-aos="fade-up">
            <form id="requestQuoteForm" action="{{url('/api/save-request-quote')}}" class="frmAjax">
                <div class="row form_row">
                    <div class="col-md-6">
                        <label for="">First Name</label>
                        <input type="text" class="input" name="fname" placeholder="First Name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="">Last Name</label>
                        <input type="text" class="input" name="lname" placeholder="Last Name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="">Phone Number</label>
                        <input type="text" class="input" name="phone" placeholder="Phone Number" required>
                    </div>
                    <div class="col-md-6">
                        <label for="">Email Address</label>
                        <input type="text" class="input" name="email" placeholder="Email Address" required>
                    </div>
                    <div class="col-md-12">
                        <label for="">Address</label>
                        <input type="text" class="input" name="address" placeholder="Address" required>
                    </div>
                    <div class="col-md-12">
                        <label for="">What type of pool are you interested in?</label>
                        <select name="pool_type" id="" class="input" required>
                            <option value="Plunge Pool">Plunge Pool</option>
                            <option value="Liner Pool">Liner Pool</option>
                            <option value="Not Sure Yet">Not Sure Yet</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="">What stage are you at in the process?</label>
                        <select name="stage" id="" class="input" required>
                            <option value="Just Exploring Options">Just Exploring Options</option>
                            <option value="Ready to Start">Ready to Start</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="">Project Timeline</label>
                        <select name="timeline" id="" class="input" required>
                            <option value="ASAP">ASAP</option>
                            <option value="3-6 Months">3-6 Months</option>
                            <option value="Next Year">Next Year</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="">What is your estimated budget for this project?</label>
                        <select name="budget" id="" class="input" required>
                            <option value="$30,000 - $50,000">$30,000 - $50,000</option>
                            <option value="$50,000 - $75,000">$50,000 - $75,000</option>
                            <option value="$75,000 - $100,000">$75,000 - $100,000</option>
                            <option value="I'm not sure yet">I'm not sure yet</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="">Anything else we should know?</label>
                        <textarea name="anything_else" id="" placeholder="Type here.." class="input"></textarea>
                    </div>
                </div>
                <div class="btn_blk">
                    <button type="submit" class="site_btn">Submit<i class="spinner hidden"></i></button>
                </div>
            </form>
            <p><small>{!! $content['section1_text'] ?? '' !!}</small></p>
        </div>
    </div>
</section>

@endsection
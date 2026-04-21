@extends('layouts.frontend')

@section('title', 'Welcome to Our Website')

@section('content')

<section class="sm_banner blog_details" style="background:url({{ get_site_image_src('blog', !empty($blog_post) ? $blog_post->image : '') }})">
</section>

<section class="blog_cntnt_sec">
    <div class="contain">
        <div class="detail_blog_cntnt" data-aos="fade-up">
            <div class="cntnt text-center">
                <div class="category">{{ $blog_post->cat_name ?? '' }}</div>
                <h2>{{ $blog_post->title }}</h2>
                <div class="date">{{ $blog_post->created_date }}</div>
            </div>
            <div class="image">
                <img src="{{ get_site_image_src('blog', !empty($blog_post) ? $blog_post->image : '') }}" alt="{{ $blog_post->title }}">
            </div>
            <div class="ck_editor">
                {!! $blog_post->detail !!}
            </div>

            <div class="share_blk">
                <p>Share On</p>
                <ul class="social_lnks">
                    <li><a href="https://www.facebook.com"><img src="{{ asset('assets/images/facebook.svg') }}" alt=""></a></li>
                    <li><a href="#"><img src="{{ asset('assets/images/instagram.svg') }}" alt=""></a></li>
                    <li><a href="https://twitter.com"><img src="{{ asset('assets/images/twitter.svg') }}" alt=""></a></li>
                    <li><a href="#"><img src="{{ asset('assets/images/linkedin.svg') }}" alt=""></a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="cta_sec">
    <div class="contain">
        <div class="flex">
            <div class="sec_heading" data-aos="fade-up">
                <h2>{!! $cta_section['cta_heading'] ?? '' !!}</h2>
                <p>{!! $cta_section['cta_text'] ?? '' !!}</p>
            </div>
            <div class="btn_blk text-center" data-aos="fade-up">
                <a href="{{ url($cta_section['cta_btn1_link']) }}" class="site_btn light">{!!
                    $cta_section['cta_btn1_txt'] ?? '' !!}</a>
            </div>
        </div>
    </div>
</section>



@endsection
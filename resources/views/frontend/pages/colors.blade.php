@extends('layouts.frontend')

@section('title', 'Welcome to Our Website')

@section('content')


<section class="bg_banner">
    <div class="contain">
        <div class="cntnt" data-aos="fade-up">
            {!! $content['banner_text'] ?? '' !!}
        </div>
    </div>
</section>
<section class="color_color_sec">
    <div class="outer_main_color">
        @foreach($colors as $color)
        <div class="inner_main_color" data-aos="fade-up">
            <div class="image">
                <img src="{{ get_site_image_src('colors', $color['image1'] ?? 'default.jpg') }}" alt="">
            </div>
            <div class="contain">
                <div class="flex main_flex">
                    <div class="col">
                        <div class="flex">
                            @foreach($color->images as $img)
                            <div class="col">
                                <div class="image">
                                    <img src="{{ get_site_image_src('colors', $img->cover_image ?? 'default.jpg') }}" alt="">
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col">
                        <div class="inner">
                            {!! $color['description'] ?? '' !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach




    </div>
</section>
<section class="cta_sec">
    <div class="contain">
        <div class="flex">
            <div class="sec_heading" data-aos="fade-up">
                <h2>{!! $content['cta_heading'] ?? '' !!}</h2>
                <p>{!! $content['cta_text'] ?? '' !!}</p>
            </div>
            <div class="btn_blk text-center" data-aos="fade-up">
                <a href="{{ url($content['cta_btn1_link']) }}" class="site_btn light">{!!
                    $content['cta_btn1_txt'] ?? '' !!}</a>
            </div>
        </div>
    </div>
</section>

@endsection
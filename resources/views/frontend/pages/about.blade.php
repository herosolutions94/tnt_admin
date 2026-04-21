@extends('layouts.frontend')


@section('content')
<section class="sm_banner"
    style="background-image: url('{{ get_site_image_src('images', !empty($content['image1']) ? $content['image1'] : 'default.jpg') }}');">
    <div class="contain">
        <div class="cntnt" data-aos="fade-up">
            <h1>{!! $content['banner_heading'] ?? '' !!}</h1>
            <p>{!! $content['banner_text'] ?? '' !!}</p>
        </div>
    </div>
</section>
<section class="story_sec">
    <div class="contain">
        <div class="cntnt"
            style="background-image: url('{{ get_site_image_src('images', !empty($content['image2']) ? $content['image2'] : 'default.jpg') }}');">
            <div class="inner_cntnt" data-aos="fade-up">
                <h2>{!! $content['section1_heading'] ?? '' !!}</h2>
                <p>{!! $content['section1_text'] ?? '' !!}</p>
            </div>
        </div>
    </div>
</section>
<section class="values_sec">
    <div class="contain">
        <div class="sec_heading text-center" data-aos="fade-up">
            <h2>{!! $content['section2_heading'] ?? '' !!}</h2>
        </div>
        <div class="flex">
            @for ($i = 3; $i <= 5; $i++) @php $image=$content['image' . $i] ?? null; $heading=$content['sec2_heading' .
                $i] ?? null; $text=$content['section2_text' . $i] ?? null; @endphp @if (!empty($image) ||
                !empty($heading)) <div class="col" data-aos="fade-up">
                <div class="inner">
                    <div class="image">
                        <img src="{{ get_site_image_src('images', $image) }}" alt="">
                    </div>
                    <h4>{{ $heading }}</h4>
                    <p>{{ $text }}</p>
                </div>
        </div>
        @endif
        @endfor

    </div>
    </div>
</section>
<section class="who_we_sec">
    <div class="contain">
        <div class="sec_heading" data-aos="fade-up">
            {!! $content['section3_text'] ?? '' !!}
        </div>
    </div>
</section>
<section class="about_sec">
    <div class="contain">
        <div class="flex">
            <div class="colL" data-aos="fade-right">
                <div class="image">
                    <img src="{{ get_site_image_src('images', $content['image6'] ?? 'default.jpg') }}" alt="">
                </div>
            </div>
            <div class="colR" data-aos="fade-left">
                {!! $content['section4_text'] ?? '' !!}
                <div class="btn_blk">
                    <a href="{{ url($content['section4_btn_link']) }}"
                        class="site_btn">{{ $content['section4_btn_txt'] }}</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="who_we_sec mission_sec"
    style="background-image: url('{{ get_site_image_src('images', !empty($content['image7']) ? $content['image7'] : 'default.jpg') }}');">
    <div class="contain">
        <div class="sec_heading text-center" data-aos="fade-up">
            <h2>{!! $content['section5_heading'] ?? '' !!}</h2>
            <p>{!! $content['section5_text'] ?? '' !!}</p>
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
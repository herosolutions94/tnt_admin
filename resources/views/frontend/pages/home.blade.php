@extends('layouts.frontend')


@section('content')
<section class="banner"
    style="background-image: url('{{ get_site_image_src('images', !empty($content['image1']) ? $content['image1'] : 'default.jpg') }}');">

    <div class="contain">
        <div class="cntnt" data-aos="fade-up">
            {!! $content['banner_text'] ?? '' !!}
        </div>
    </div>

</section>
<section class="about_sec">
    <div class="contain">
        <div class="flex">
            <div class="colL" data-aos="fade-right">
                <div class="image">
                    <img src="{{ get_site_image_src('images', $content['image2'] ?? 'default.jpg') }}" alt="">
                </div>
            </div>
            <div class="colR" data-aos="fade-left">
                {!! $content['section1_text'] ?? '' !!}
                @if (!empty($content['section1_btn_txt']) && !empty($content['section1_btn_link']))
                <div class="btn_blk">
                    <a href="{{ url($content['section1_btn_link']) }}" class="site_btn">
                        {{ $content['section1_btn_txt'] }}
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
<section class="services_sec">
    <div class="contain">
        <div class="cntnt text-center" data-aos="fade-up">
            {!! $content['section2_text'] ?? '' !!}
        </div>
        <div class="outer_flex">
            <div class="flex" data-aos="fade-up">
                <div class="col">
                    <div class="inner">
                        {!! $content['section3_text'] ?? '' !!}
                        <div class="btn_blk">
                            <a href="{{ url($content['section3_btn_link']) }}"
                                class="site_btn">{{ $content['section3_btn_txt'] }}</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="image">
                        <img src="{{ get_site_image_src('images', $content['image3'] ?? 'default.jpg') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="flex" data-aos="fade-left">
                <div class="col">
                    <div class="inner">
                        {!! $content['section4_text'] ?? '' !!}
                        <div class="btn_blk">
                            <a href="{{ url($content['section4_btn_link']) }}"
                                class="site_btn">{{ $content['section4_btn_txt'] }}</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="image">
                        <img src="{{ get_site_image_src('images', $content['image4'] ?? 'default.jpg') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="flex" data-aos="fade-right">
                <div class="col">
                    <div class="inner">
                        {!! $content['section5_text'] ?? '' !!}
                        <div class="btn_blk">
                            <a href="{{ url($content['section5_btn_link']) }}" class="site_btn">{!!
                                $content['section5_btn_txt'] ?? '' !!}</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="image">
                        <img src="{{ get_site_image_src('images', $content['image5'] ?? 'default.jpg') }}" alt="">
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="how_work_sec">
    <div class="contain">
        <div class="sec_heading text-center" data-aos="fade-up">
            <h2>{!! $content['section6_heading'] ?? '' !!}</h2>
        </div>
        <div class="flex">
            @for ($i = 6; $i <= 10; $i++) @php $image=$content['image' . $i] ?? null; $heading=$content['sec6_heading' .
                $i] ?? null; @endphp @if (!empty($image) || !empty($heading)) <div class="col" data-aos="fade-up">
                <div class="inner">
                    <div class="image">
                        <img src="{{ get_site_image_src('images', $image) }}" alt="">
                    </div>
                    <h4>{{ $heading }}</h4>
                </div>
        </div>
        @endif
        @endfor
    </div>
    </div>
</section>
<section class="choose_sec">
    <div class="contain">
        <div class="cntnt">
            <div class="txt" data-aos="fade-up">
                {!! $content['section7_text1'] ?? '' !!}
            </div>

            <ul data-aos="fade-up">
                {!! $content['section7_text2'] ?? '' !!}
            </ul>
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
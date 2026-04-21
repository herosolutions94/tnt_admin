@extends('layouts.frontend')

@section('title', 'Welcome to Our Website')

@section('content')


<section class="sm_banner" style="background: url('{{ get_site_image_src('hardscapes', $hardscape['image1'] ?? 'default.jpg') }}'); background-size: cover; background-position: center;">
    <div class="contain">
        <div class="cntnt" data-aos="fade-up">
            <h1>Montreal Transformation</h1>
        </div>
    </div>
</section>
<section class="about_sec">
    <div class="contain">
        <div class="flex">
            <div class="colL" data-aos="fade-right">
                <div class="image">
                    <img src="{{ get_site_image_src('hardscapes', $content_data['image3'] ?? 'default.jpg') }}" alt="">
                </div>
            </div>
            <div class="colR" data-aos="fade-left">
                <h2> {{ $content_data['section1_heading']}} </h2>
                {!! $content_data['section1_text'] ?? '' !!}

            </div>
        </div>
    </div>
</section>
<section class="values_sec">
    <div class="contain">
        <div class="flex">
             @foreach($specifies as $speci)
              <div class="col" data-aos="fade-up">
                <div class="inner">
                    <div class="image">
                        <img src="{{ get_site_image_src('hardscapes', $speci->size_image ?? 'default.jpg') }}" alt="">
                    </div>
                    <h4>{{$speci->title}}</h4>
                </div>
            </div>

            



            @endforeach
           
            
        </div>
    </div>
</section>
<section class="story_behind_sec">
    <div class="contain">
        <div class="flex">
            <div class="colL" data-aos="fade-right">
                {!! $content_data['section3_text'] ?? '' !!}
            </div>
            <div class="colR" data-aos="fade-left">
                <div class="image">
                    <img src="{{ get_site_image_src('hardscapes', $content_data['image4'] ?? 'default.jpg') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="inner_pool sm_banner" style="background: url('{{ get_site_image_src('hardscapes', $content_data['image5'] ?? 'default.jpg') }}'); ">
    <div class="contain">
        <div class="cntnt" data-aos="fade-up">
             {!! $content_data['section4_text'] ?? '' !!}
        </div>
    </div>
</section>
<section class="gallery_sec">
    <div class="contain">
        <div class="sec_heading" data-aos="fade-up">
            <h2>Products Used in This Space </h2>
        </div>
        <div class="grid_view" data-aos="fade-up">
              @foreach($gallerys as $design)
             <div class="card_view">
                <img src="{{ get_site_image_src('hardscapes', $design->cover_image ?? 'default.jpg') }}" alt="">
            </div>


                @endforeach
           
        </div>
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
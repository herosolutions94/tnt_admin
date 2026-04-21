@extends('layouts.frontend')

@section('title', 'Welcome to Our Website')

@section('content')


<section class="banner_pool sm_banner" style="background: url('{{ get_site_image_src('aviva', $aviva['image1'] ?? 'default.jpg') }}'); background-size: cover; background-position: center;"></section>
<section class="detail_pool_sec">
    <div class="contain">
        <div class="cntnt text-center" data-aos="fade-up">
            <h1>{{ $content_data['section1_heading']}}</h1>
        </div>
        <div class="flex">
            <div class="colL" data-aos="fade-right">
                <div class="image">
                    <img src="{{ get_site_image_src('aviva', $content_data['image3'] ?? 'default.jpg') }}" alt="">
                </div>
            </div>
            <div class="colR" data-aos="fade-left">
                <div class="inner">
                    {!! $content_data['section1_text'] ?? '' !!}
                    <div class="btn_blk">
                        <a href="{{ $content_data['section1_btn_link']}}" class="site_btn">{{ $content_data['section1_btn_txt']}}</a>
                        <a href="{{ $content_data['section2_btn_link']}}" class="site_btn color">{{ $content_data['section2_btn_txt']}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="size_sec">
    <div class="contain">
        <div class="sec_heading" data-aos="fade-up">
            <h2>{!! $content['banner_heading'] ?? '' !!}</h2>
            <h4>{{ $content_data['section2_heading']}}</h4>
        </div>
        <div class="flex">

            @foreach($specification as $speci)

            <div class="col" data-aos="fade-up">
                <div class="image">
                    <img src="{{ get_site_image_src('aviva', $speci->cover_image ?? 'default.jpg') }}" alt="">
                </div>
                <div class="txt">
                    <h3>{{$speci->title}}</h3>
                    {!! $speci->detail ?? '' !!}
                </div>
            </div>



            @endforeach


        </div>
    </div>
</section>
<section class="inner_pool sm_banner" style="background: url('{{ get_site_image_src('aviva', $content_data['image4'] ?? 'default.jpg') }}'); ">
    <div class="contain">
        <div class="cntnt" data-aos="fade-up">
            {!! $content_data['section3_text'] ?? '' !!}
        </div>
    </div>
</section>
<section class="colors_collection_sec">
    <div class="contain">
        <div class="sec_heading text-center" data-aos="fade-up">
            <h2>{!! $content['section1_heading'] ?? '' !!}</h2>
            <p>{{ $content_data['section3_heading']}}</p>
        </div>
        <div class="slider-container" data-aos="fade-up">
            <div class="color-slider">

                @foreach($colors as $col)



                <div>
                    <img src="{{ get_site_image_src('aviva', $col->colour_image ?? 'default.jpg') }}" alt="Crystal Blue" />
                    <p>{{$col->title}}</p>
                </div>



                @endforeach

                
            </div>
        </div>
    </div>
</section>
<section class="inner_pool sm_banner" style="background: url('{{ get_site_image_src('aviva', $content_data['image5'] ?? 'default.jpg') }}'); ">
    <div class="contain">
        <div class="cntnt" data-aos="fade-up">
           {!! $content_data['section4_text'] ?? '' !!}
        </div>
    </div>
</section>
<section class="gallery_sec">
    <div class="contain">
        <div class="sec_heading" data-aos="fade-up">
            <h2>{!! $content['section2_heading'] ?? '' !!}</h2>
        </div>
        <div class="grid_view" data-aos="fade-up">
             @foreach($designs as $design)
             <div class="card_view">
                <img src="{{ get_site_image_src('aviva', $design->size_image ?? 'default.jpg') }}" alt="">
                <h4>{{$design->title}}</h4>
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
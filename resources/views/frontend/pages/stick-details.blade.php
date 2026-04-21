@extends('layouts.frontend')

@section('title', 'Welcome to Our Website')

@section('content')


<section class="detail_banner">
    <div class="contain">
        <div class="flex">
            <div class="colL" data-aos="fade-right">
                <div class="slider_outer">

                    <div class="slider-for">
                        @foreach($gallerys as $gall)



                        <div><img src="{{ get_site_image_src('stick', $gall->cover_image ?? 'default.jpg') }}" /></div>

                        @endforeach


                    </div>
                    <div class="slider-nav">
                        @foreach($gallerys as $gall)



                        <div><img src="{{ get_site_image_src('stick', $gall->cover_image ?? 'default.jpg') }}" /></div>

                        @endforeach

                    </div>

                </div>
            </div>
            <div class="colR" data-aos="fade-left">
                <div class="inner">
                    <h1>{{ $renaissance['name']}}</h1>
                    {!! $renaissance['description'] ?? '' !!}
                    <div class="btn_blk">
                        <a href="{{ $content_data['section1_btn_link']}}" class="site_btn">{{ $content_data['section1_btn_txt']}}</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="feature_sec">
    <div class="contain">
        <div class="sec_heading" data-aos="fade-up">
            {!! $renaissance['sec1_heading'] ?? '' !!}
        </div>
        <div class="flex" data-aos="fade-up">
            @foreach($features as $feature)
            <div class="col">
                <div class="inner">
                    <h4>{{$feature->title}}</h4>
                    {!! $feature->detail ?? '' !!}

                </div>
            </div>



            @endforeach

        </div>
    </div>
</section>
<section class="gallery_sec">
    <div class="contain">
        <div class="sec_heading" data-aos="fade-up">
            {!! $renaissance['sec2_heading'] ?? '' !!}

        </div>
        <div class="grid_view" data-aos="fade-up">

            @foreach($designs as $design)
            <div class="card_view">
                <img src="{{ get_site_image_src('stick', $design->size_image ?? 'default.jpg') }}" alt="">
                <h4>{{$design->title}}</h4>
            </div>
          @endforeach

           
        </div>
        <div class="flex" data-aos="fade-up">
           {!! $content_data['section1_text'] ?? '' !!}
        </div>
    </div>
</section>
<section class="opt_choose_sec">
    <div class="contain">
        <div class="sec_heading" data-aos="fade-up">

            <h2>{{ $content_data['section2_heading']}}</h2>
              {!! $content_data['sec3_text'] ?? '' !!}
        </div>
        <div class="faqLst" data-aos="fade-up">
                @foreach($faqs as $faq)
            

             <div class="faqBlk">
                <h5>{{$faq->question}}</h5>
                <div class="txt" style="display: none;">
                    {!! $faq->answer ?? '' !!}
                </div>
            </div>



            @endforeach
           
            
        </div>
    </div>
</section>
<section class="cta_sec bg">
    <div class="contain">
        <div class="flex">
            <div class="sec_heading" data-aos="fade-up">
                <h2>Ready to Elevate Your Backyard?</h2>
                <p>Let us help you build a patio cover that brings style, comfort, and value to your home. Our team will
                    guide you through every step—from design to final installation.</p>
            </div>
            <div class="btn_blk text-center" data-aos="fade-up">
                <a href="request-quote.php" class="site_btn light">Schedule a Free Consultation</a>
            </div>
        </div>
    </div>
</section>


@endsection
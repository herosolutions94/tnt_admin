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
<section class="opt_choose_sec top_p">
    <div class="contain">
        <div class="faqLst" data-aos="fade-up">
           
             @foreach($faqs as $faq)

          <div class="faqBlk">
                <h5>{{ $faq->question}}</h5>
                <div class="txt" style="display: none;">
                      {!! $faq->answer ?? '' !!}

                </div>
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
@extends('layouts.frontend')

@section('title', 'Welcome to Our Website')

@section('content')

<section class="all_sub">
    <div class="contain">
        <div class="cntnt" data-aos="fade-up">
            <h1>{{ $content['banner_heading'] }}</h1>
            {!! $content['banner_text'] ?? '' !!}
        </div>
    </div>
</section>
<section class="blog_blog_pg">
    <div class="contain">
        <div class="featured_blog">
            <div class="flex" data-aos="fade-up">
                @foreach($featured_blog_posts as $post)
                <div class="_col">
                    <div class="inner">
                        <a href="{{ url('blog-detail/'.$post->slug) }}">
                            <div class="image">
                                <img src="{{ get_site_image_src('blog', !empty($post) ? $post->image : '') }}" alt="{{ $post->title }}" />
                            </div>
                            <div class="cntnt">
                                <div class="category">{{ $post->cat_name }}</div>
                                <h4>{{ $post->title }}</h4>
                                <div class="date">{{ $post->created_date }}</div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
        <div class="all_blog" data-aos="fade-up">
            <div class="tabs_account">
                <ul class="nav nav-tabs">
                    @foreach($blog_categories as $index => $category)
                    <li class="{{ $index == 0 ? 'active' : '' }}">
                        <a data-toggle="tab" href="#tab-{{ $category->slug }}">{{ $category->name }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="tab-content">
                @foreach($blog_categories as $index => $category)
                <div id="tab-{{ $category->slug }}" class="tab-pane fade {{ $index == 0 ? 'in active' : '' }}">
                    <div class="flex_all_blog">
                        @foreach($category->blog_posts as $post)
                        <div class="col">
                            <a href="{{ url('blog-detail/'.$post->slug) }}">
                                <div class="image">
                                    <img src="{{ get_site_image_src('blog', !empty($post) ? $post->image : '') }}" alt="{{ $post->title }}" />
                                </div>
                                <h5>{{ $post->title }}</h5>
                                <div class="date">{{ $post->created_date }}</div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    {{-- Optional Pagination per tab if implemented --}}
                </div>
                @endforeach
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
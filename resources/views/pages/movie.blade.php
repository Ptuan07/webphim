@extends('layout')
@section('content')
    <div class="row container" id="wrapper">
        <div class="halim-panel-filter">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="yoast_breadcrumb hidden-xs"><span><span><a
                                        href="{{ route('category', [$movie->category->slug]) }}">{{ $movie->category->title }}</a>»
                                    <span>

                                        <a
                                            href="{{ route('country', [$movie->country->slug]) }}">{{ $movie->country->title }}</a>»
                                        @foreach ($movie->movie_genre as $gen)
                                            <a href="{{ route('genre', [$gen->slug]) }}">{{ $gen->title }}</a>»
                                        @endforeach


                                        <span class="breadcrumb_last" aria-current="page">{{ $movie->title }}</span>
                                    </span></span></span></div>
                    </div>
                </div>
            </div>
            <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                <div class="ajax"></div>
            </div>
        </div>
        <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
            <section id="content" class="test">
                <div class="clearfix wrap-content">

                    <div class="halim-movie-wrapper">
                        <div class="title-block">
                            <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="38424">
                                <div class="halim-pulse-ring"></div>
                            </div>
                            <div class="title-wrapper" style="font-weight: bold;">
                                Bookmark
                            </div>
                        </div>
                        <div class="movie_info col-xs-12">
                            <div class="movie-poster col-md-3">
                                <img class="movie-thumb"
                                    src="{{ starts_with($movie->image, 'http://') || starts_with($movie->image, 'https://') ? $movie->image : asset('uploads/movie/' . $movie->image) }}"
                                    alt="{{ $movie->title }}">
                                @if ($movie->resolution != 5)
                                    @if ($episode_current_list_count > 0)
                                        <div class="bwa-content">
                                            <div class="loader"></div>
                                            <a href="{{ url('xem-phim/' . $movie->slug . '/tap-' . $episode_tapdau->episode . '/server-' . $episode_tapdau->server) }}"
                                                class="bwac-btn">
                                                <i class="fa fa-play"></i>
                                            </a>
                                        </div>
                                    @endif
                                @else
                                    <a href="#watch_trailer" style="display: block;"
                                        class="btn btn-primary watch_trailer">Xem Trailer</a>
                                @endif
                            </div>
                            <div class="film-poster col-md-9">
                                <h1 class="movie-title title-1"
                                    style="display:block;line-height:35px;margin-bottom: -14px;color: #ffed4d;text-transform: uppercase;font-size: 18px;">
                                    {{ $movie->title }}</h1>
                                <h2 class="movie-title title-2" style="font-size: 12px;">{{ $movie->name_eng }}</h2>
                                <ul class="list-info-group">
                                    <li class="list-info-group-item"><span>Độ phân giải</span> : <span class="quality">
                                            @if ($movie->resolution == 0)
                                                HD
                                            @elseif($movie->resolution == 1)
                                                SD
                                            @elseif($movie->resolution == 2)
                                                HDCAM
                                            @elseif($movie->resolution == 3)
                                                CAM
                                            @elseif($movie->resolution == 4)
                                                FULLHD
                                            @else
                                                Trailer
                                            @endif
                                        </span>

                                        @if ($movie->resolution != 5)
                                            <span class="episode">
                                                @if ($movie->vietsub == 0)
                                                    Phụ Đề
                                                @else
                                                    Thuyết Minh
                                                @endif
                                            </span>
                                        @endif
                                    </li>
                                    <li class="list-info-group-item"><span>Thời lượng</span> :{{ $movie->time }}</li>
                                    <li class="list-info-group-item"><span>Số Tập Phim</span>
                                        {{-- :{{ $episode_current_list_count }}/{{ $movie->sotap }} - --}}
                                        @if ($movie->thuocphim == 'phimbo')
                                            {{ $episode_current_list_count }}/{{ $movie->sotap }} -
                                            @if ($episode_current_list_count == $movie->sotap)
                                                Hoàn thành
                                            @else
                                                Đang cập nhập
                                            @endif
                                        @else
                                            FULLHD
                                            HD
                                        @endif
                                    </li>

                                    @if ($movie->season != 0)
                                        <li class="list-info-group-item"><span>Season</span> :{{ $movie->season }}</li>
                                    @endif
                                    <li class="list-info-group-item"><span>Thể loại</span> :
                                        @foreach ($movie->movie_genre as $gen)
                                            <a href="{{ route('genre', $gen->slug) }}"
                                                rel="category tag">{{ $gen->title }} | </a>
                                        @endforeach
                                    </li>
                                    <li class="list-info-group-item"><span>Danh mục</span> :
                                        @foreach ($movie->movie_category as $catego)
                                            <a href="{{ route('category', $catego->slug) }}"
                                                rel="category tag">{{ $catego->title }} | </a>
                                        @endforeach
                                    </li>

                                    <li class="list-info-group-item"><span>Quốc gia</span> :
                                        <a href="{{ route('country', [$movie->country->slug]) }}"
                                            rel="tag">{{ $movie->country->title }}</a>
                                    </li>
                                    <li class="list-info-group-item"><span>Tập Phim Mới Nhất</span> :
                                        @if ($episode_current_list_count > 0)
                                            @if ($movie->thuocphim == 'phimbo')
                                                @foreach ($episode as $key => $epi)
                                                    <a href="{{ url('xem-phim/' . $epi->movie->slug . '/tap-' . $epi->episode) }}"
                                                        rel="tag">Tập {{ $epi->episode }}</a>
                                                @endforeach
                                            @elseif($movie->thuocphim == 'phimle')
                                                @foreach ($episode as $key => $epi_le)
                                                    <a
                                                        href="{{ url('xem-phim/' . $movie->slug . '/tap-' . $epi_le->episode) }}"rel="tag">{{ $epi_le->episode }}</a>
                                                @endforeach
                                            @endif
                                        @else
                                            Đang cập nhập
                                        @endif

                                    </li>
                                    <ul class="list-inline rating" title="Average Rating">

                                        @for ($count = 1; $count <= 5; $count++)
                                            @php

                                                if ($count >= $rating) {
                                                    $color = 'color:#ffcc00;'; //mau vang
                                                } else {
                                                    $color = 'color:#ccc;'; //mau xam
                                                }

                                            @endphp

                                            <li title="star_rating" id="{{ $movie->id }}-{{ $count }}"
                                                data-index="{{ $count }}" data-movie_id="{{ $movie->id }}"
                                                data-rating="{{ $rating }}" class="rating"
                                                style="cursor:pointer; {{ $color }} 

                                          font-size:30px;">
                                                &#9733;</li>
                                        @endfor

                                    </ul>
                                    <span class="total_rating"> Đánh giá: {{ $rating }}/{{ $count_total }}
                                        lượt</span>
                                </ul>
                                <div class="movie-trailer">
                                    @php
                                        $current_url = request()->url();
                                    @endphp
                                    <div class="fb-like" data-href="{{ $current_url }}" data-width=""
                                        data-layout="button_count" data-action="like" data-size="small" data-share="true">
                                    </div>
                                    <div class="fb-save" data-uri="{{ $current_url }}" data-size="small"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div id="halim_trailer"></div>
                    <div class="clearfix"></div>
                    <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Nội dung phim</span></h2>
                    </div>
                    <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                            <article id="post-38424" class="item-content">
                                {{ $movie->description }}
                            </article>
                        </div>
                    </div>
                    {{-- Tags phim --}}
                    <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Tags</span></h2>
                    </div>
                    <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                            <article id="post-38424" class="item-content">
                                @if ($movie->tags != null)
                                    @php
                                        $tags = [];
                                        $tags = explode(',', $movie->tags);

                                    @endphp
                                    @foreach ($tags as $key => $tag)
                                        <a href="{{ url('tag/' . $tag) }}">{{ $tag }}</a>
                                    @endforeach
                                @else
                                    {{ $movie->title }}
                                @endif
                            </article>
                        </div>
                    </div>
                    {{-- Trailer phim --}}
                    <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Trailer phim</span></h2>
                    </div>
                    <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                            <article id="watch_trailer" class="item-content">
                                @php
                                    // Phân tích ID video từ URL trên YouTube
                                    $video_id = substr($movie->trailer, strpos($movie->trailer, '=') + 1);
                                    // echo "<pre>";
                                    // print_r ($video_id);
                                    // echo "</pre>";
                                @endphp
                
                                <iframe width="703" height="395"
                                    src="https://www.youtube.com/embed/{{$video_id}}"
                                    title="NĂM ĐÊM KINH HOÀNG | Trailer D | Dự Kiến Khởi Chiếu: 27.10.2023"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen></iframe>
                            </article>
                        </div>
                    </div>

                    {{-- comment tren fb --}}
                    <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Bình Luận</span></h2>
                    </div>
                    <div class="entry-content htmlwrap clearfix">
                        @php
                            $current_url = Request::url();
                        @endphp
                        <div class="video-item halim-entry-box">
                            <article id="post-38424" class="item-content">
                                <div class="fb-comments" data-href="{{ $current_url }}" data-width="100%"
                                    data-numposts="">

                                </div>

                            </article>
                            {{-- <style>
                                /* Đổi màu chữ trong plugin comment Facebook */
                                .fb_iframe_widget span._5mdd {
                                    color: white;
                                   
                                }
                            </style> --}}

                        </div>
                    </div>
                </div>
            </section>
            <section class="related-movies">
                <div id="halim_related_movies-2xx" class="wrap-slider">
                    <div class="section-bar clearfix">
                        <h3 class="section-title"><span>CÓ THỂ BẠN MUỐN XEM</span></h3>
                    </div>
                    <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
                        @foreach ($related as $key => $hot)
                            <article class="thumb grid-item post-38498">
                                <div class="halim-item">
                                    <a class="halim-thumb" href="{{ route('movie', $hot->slug) }}"
                                        title="{{ $hot->title }}">
                                        <figure><img class="lazy img-responsive"
                                                src="{{ starts_with($hot->image, 'http://') || starts_with($hot->image, 'https://') ? $hot->image : asset('uploads/movie/' . $hot->image) }}"
                                                alt="{{ $hot->title }}" title=""></figure>
                                        <span class="status">
                                            @if ($hot->resolution == 0)
                                                HD
                                            @elseif($hot->resolution == 1)
                                                SD
                                            @elseif($hot->resolution == 2)
                                                HDCAM
                                            @elseif($hot->resolution == 3)
                                                CAM
                                            @elseif($hot->resolution == 4)
                                                FULLHD
                                            @else
                                                Trailer
                                            @endif
                                        </span>
                                        <span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                            {{ $hot->episode_count }}/{{ $hot->sotap }}

                                            @if ($hot->vietsub == 0)
                                                Phụ Đề
                                                @if ($hot->season != 0)
                                                    - Season {{ $hot->season }}
                                                @endif
                                            @else
                                                Thuyết Minh
                                                @if ($hot->season != 0)
                                                    - Season {{ $hot->season }}
                                                @endif
                                            @endif
                                        </span>
                                        <div class="icon_overlay"></div>
                                        <div class="halim-post-title-box">
                                            <div class="halim-post-title ">
                                                <p class="entry-title">{{ $hot->title }}</p>
                                                <p class="original_title">{{ $hot->name_eng }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </article>
                        @endforeach


                    </div>
                    <script>
                        jQuery(document).ready(function($) {
                            var owl = $('#halim_related_movies-2');
                            owl.owlCarousel({
                                loop: true,
                                margin: 4,
                                autoplay: true,
                                autoplayTimeout: 4000,
                                autoplayHoverPause: true,
                                nav: true,
                                navText: ['<i class="hl-down-open rotate-left"></i>',
                                    '<i class="hl-down-open rotate-right"></i>'
                                ],
                                responsiveClass: true,
                                responsive: {
                                    0: {
                                        items: 2
                                    },
                                    480: {
                                        items: 3
                                    },
                                    600: {
                                        items: 4
                                    },
                                    1000: {
                                        items: 4
                                    }
                                }
                            })
                        });
                    </script>
                </div>
            </section>
        </main>
        @include('pages.include.sidebar')
    </div>
    </div>
@endsection

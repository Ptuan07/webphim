<aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
            <div class="section-title">
                <span>Phim Hot</span>

            </div>
        </div>
        <section class="tab-content">
            <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                <div class="halim-ajax-popular-post-loading hidden"></div>
                <div id="halim-ajax-popular-post" class="popular-post">

                    @foreach ($phimhot_sidebar as $key => $hot_sidebar)
                        <div class="item post-37176">
                            <a href="{{ route('movie', $hot_sidebar->slug) }}" title="{{ $hot_sidebar->title }}">
                                <div class="item-link">
                                    <img src="{{ starts_with($hot_sidebar->image, 'http://') || starts_with($hot_sidebar->image, 'https://') ? $hot_sidebar->image : asset('uploads/movie/' . $hot_sidebar->image) }}"
                                        class="lazy post-thumb" alt="{{ $hot_sidebar->title }}"
                                        title="{{ $hot_sidebar->title }}" />
                                    <span class="is_trailer">
                                        @if ($hot_sidebar->resolution == 0)
                                            HD
                                        @elseif($hot_sidebar->resolution == 1)
                                            SD
                                        @elseif($hot_sidebar->resolution == 2)
                                            HDCAM
                                        @elseif($hot_sidebar->resolution == 3)
                                            CAM
                                        @elseif($hot_sidebar->resolution == 4)
                                            FULLHD
                                        @else
                                            Trailer
                                        @endif
                                    </span>

                                </div>
                                <p class="title">{{ $hot_sidebar->title }}</p>
                            </a>
                            <div class="viewsCount" style="color: #9d9d9d;">
                            @if($hot_sidebar->count_views >0)
                                {{$hot_sidebar->count_views}} lượt quan tâm
                            @else 
                                @php    
                                    echo rand(1000, 99999);
                                @endphp
                                lượt quan tâm
                                @endif
                            </div>
                            <div class="viewsCount" style="color: #9d9d9d;">{{$hot_sidebar->year}}</div>
                            <div style="float: left;">
                                <ul class="list-inline rating" title="Average Rating">
                                    @for ($count = 1; $count <= 5; $count++)
                                        <li title="star_rating" style="font-size: 20px; color:#ffcc00; padding:0">
                                            &#9733;</li>
                                    @endfor
                                </ul>
                                <span class="user-rate-image post-large-rate stars-large-vang"
                                    style="display: block;/* width: 100%; */">
                                    <span style="width: 0%"></span>
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <div class="clearfix"></div>
    </div>
</aside>
{{-- Phim sắp chiếu --}}
<aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
            <div class="section-title">
                <span>Phim Sắp Chiếu</span>

            </div>
        </div>
        <section class="tab-content">
            <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                <div class="halim-ajax-popular-post-loading hidden"></div>
                <div id="halim-ajax-popular-post" class="popular-post">

                    @foreach ($phimhot_trailer as $key => $hot_sidebar)
                        <div class="item post-37176">
                            <a href="{{ route('movie', $hot_sidebar->slug) }}" title="{{ $hot_sidebar->title }}">
                                <div class="item-link">
                                    <img src="{{ starts_with($hot_sidebar->image, 'http://') || starts_with($hot_sidebar->image, 'https://') ? $hot_sidebar->image : asset('uploads/movie/' . $hot_sidebar->image) }}"
                                        class="lazy post-thumb" alt="{{ $hot_sidebar->title }}"
                                        title="{{ $hot_sidebar->title }}" />
                                    <span class="is_trailer">
                                        @if ($hot_sidebar->resolution == 0)
                                            HD
                                        @elseif($hot_sidebar->resolution == 1)
                                            SD
                                        @elseif($hot_sidebar->resolution == 2)
                                            HDCAM
                                        @elseif($hot_sidebar->resolution == 3)
                                            CAM
                                        @elseif($hot_sidebar->resolution == 4)
                                            FULLHD
                                        @else
                                            Trailer
                                        @endif
                                    </span>

                                </div>
                                <p class="title">{{ $hot_sidebar->title }}</p>

                            </a>
                            <div class="viewsCount" style="color: #9d9d9d;">
                             @if($hot_sidebar->count_views >0)
                                {{$hot_sidebar->count_views}} lượt quan tâm
                            @else 
                                @php    
                                    echo rand(1000, 99999);
                                @endphp
                                lượt quan tâm
                                @endif
                            </div>
                            <div class="viewsCount" style="color: #9d9d9d;">{{$hot_sidebar->year}}</div>

                            <div style="float: left;">

                                <ul class="list-inline rating" title="Average Rating">
                                    @for ($count = 1; $count <= 5; $count++)
                                        <li title="star_rating" style="font-size: 20px; color:#ffcc00; padding:0">
                                            &#9733;</li>
                                    @endfor
                                </ul>

                                <span class="user-rate-image post-large-rate stars-large-vang"
                                    style="display: block;/* width: 100%; */">
                                    <span style="width: 0%"></span>
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <div class="clearfix"></div>
    </div>
</aside>
<aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">{{-- chức năng này bị lõi --}}
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
            <div class="section-title">
                <span>Top Views</span>
            </div>
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item active">
                <a class="nav-link filter-sidebar" id="home-tab" data-toggle="tab" href="#ngay" role="tab"
                    aria-controls="home" aria-selected="true">Ngày</a>
            </li>
            <li class="nav-item">
                <a class="nav-link filter-sidebar" id="profile-tab" data-toggle="tab" href="#tuan" role="tab"
                    aria-controls="profile" aria-selected="false">Tuần</a>
            </li>
            <li class="nav-item">
                <a class="nav-link filter-sidebar" id="contact-tab" data-toggle="tab" href="#thang" role="tab"
                    aria-controls="contact" aria-selected="false">Tháng</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div id="halim-ajax-popular-post-default" class="popular-post">

                <span id="show_data_default"></span>
            </div>
            <div class="tab-pane fade show active" id="tuan" role="tabpanel" aria-labelledby="home-tab">
                <div id="halim-ajax-popular-post" class="popular-post">
                    {{-- <div class="item post-37176">
                    <a href="chitiet.php" title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ">
                        <div class="item-link">
                            <img src="{{ }}" class="lazy post-thumb" alt="CHỊ MƯỜI BA: BA NGÀY SINH TỬ"
                                title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" />
                            <span class="is_trailer">Trailer</span>
                        </div>
                        <p class="title">CHỊ MƯỜI BA: BA NGÀY SINH TỬ</p>
                    </a>
                    <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                    <div style="float: left;">
                        <span class="user-rate-image post-large-rate stars-large-vang"
                            style="display: block;/* width: 100%; */">
                            <span style="width: 0%"></span>
                        </span>
                    </div>
                </div> --}}
                    <span id="show_data"></span><!--Tạo sao đánh giá ở MovieControll--->

                </div>

            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</aside>

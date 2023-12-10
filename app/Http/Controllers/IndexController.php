<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Movie;
use App\Models\Movie_Genre;
use App\Models\Movie_Category;
use App\Models\Rating;
use App\Models\Info;
use App\Models\LinkMovie;



// use App\Models\Watch;
// use App\Http\Controllers\DB;
use DB;

class IndexController extends Controller
{
    public function locphim()
    {

        $sapxep = $_GET['order'];
        $genre_get = $_GET['genre'];
        $country_get = $_GET['country'];
        $year_get = $_GET['year'];


        if ($order = '' && $genre_get = '' && $country_get = '' && $year_get = '') {
            return redirect()->back();
        } else {
            $meta_title = "Lọc theo phim";
            $meta_description = "Lọc theo phim";
            $meta_image = "";

            $movie_array = Movie::withcount('episode');
            // if ($genre_get) {
            //     $movie_array = $movie_array->where('genre_id', '=', $genre_get);
            // } 
            if ($country_get) {
                $movie_array = $movie_array->where('country_id', '=', $country_get);
            }
            if ($year_get) {
                $movie_array = $movie_array->where('year', '=', $year_get);
            } 
            if($order) {
                $movie_array = $movie_array->orderBy($order, 'DESC');
            }
            $movie_array = $movie_array->with('movie_genre');
            $movie = array();
            foreach($movie_array as $mov){
                foreach($mov->$movie_array as $mov_gen){
                    $movie = $movie_array->whereIn('genre_id', [$mov_gen->genre_id]);
                }
            }
            $movie = $movie_array->paginate(40);

            // $category = Category::orderby('id', 'DESC')->where('status', 1)->get();
            // $genre = Genre::orderby('id', 'DESC')->where('status', 1)->get();
            // $phimhot_sidebar = Movie::where('phim_hot', 1)->where('status', 1)->orderby('ngaycapnhat', 'DESC')->take(5)->get();
            // $phimhot_trailer = Movie::where('resolution', 5)->where('status', 1)->orderby('ngaycapnhat', 'DESC')->take(5)->get();
            // $country = Country::orderby('id', 'DESC')->where('status', 1)->get();
            // $movie = $movie->orderby('ngaycapnhat', 'DESC')->paginate(40); //phân trang phần danh mục cho đủ 40 phim
            // return view('pages.filter', compact('category', 'genre', 'country', 'movie', 'phimhot_sidebar', 'phimhot_trailer', 'meta_title', 'meta_description','meta_image'));
            return view('pages.filter', compact('movie','meta_title', 'meta_description','meta_image'));
        }
    }
    public function timkiem()
    {

        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $movie = Movie::withcount('episode')->where('title', 'LIKE', '%' . $search . '%')->orderby('ngaycapnhat', 'DESC')->paginate(40); //phân trang phần danh mục cho đủ 40 phim

            $meta_title = "Tìm kiếm  phim";
            $meta_description = "Tìm kiếm theo phim";
            // $country = Country::orderby('id', 'DESC')->where('status', 1)->get();
            // $category = Category::orderby('id', 'DESC')->where('status', 1)->get();
            // $genre = Genre::orderby('id', 'DESC')->where('status', 1)->get();
            $meta_image = '';
            // $phimhot_sidebar = Movie::where('phim_hot', 1)->where('status', 1)->orderby('ngaycapnhat', 'DESC')->take(5)->get();
            // $phimhot_trailer = Movie::where('resolution', 5)->where('status', 1)->orderby('ngaycapnhat', 'DESC')->take(5)->get();
            $movie = Movie::withcount('episode')->where('title', 'LIKE', '%' . $search . '%')->orderby('ngaycapnhat', 'DESC')->paginate(40); //phân trang phần danh mục cho đủ 40 phim
            return view('pages.search', compact('movie', 'search', 'meta_title', 'meta_description', 'meta_image'));
        } else {
            return redirect()->to('/');
        }
    }

    public function home()
    {
        $info = Info::find(1);
        $meta_title = $info->title;
        $meta_description = $info->description;
        $meta_image = "";
        $phimhot = Movie::withCount('episode')->where('phim_hot', 1)->where('status', 1)->orderby('ngaycapnhat', 'DESC')->get();
        //Chuyển sang AppServiceProvider

        // $phimhot_sidebar = Movie::where('phim_hot', 1)->where('status', 1)->orderby('ngaycapnhat', 'DESC')->take(5)->get();
        // $phimhot_trailer = Movie::where('resolution', 5)->where('status', 1)->orderby('ngaycapnhat', 'DESC')->take(5)->get();
        // $category = Category::orderby('id', 'DESC')->where('status', 1)->get();
        // $genre = Genre::orderby('id', 'DESC')->where('status', 1)->get();
        // $country = Country::orderby('id', 'DESC')->where('status', 1)->get();

        $category_home = Category::with([
            'movie' => function ($q) {
                $q->withcount('episode')->where('status', 1);
            }
        ])->orderby('position', 'ASC')->where('status', 1)->get();
        return view('pages.home', compact('category_home', 'phimhot', 'meta_title', 'meta_description','meta_image'));
    }
    public function category($slug)
    {
        $cate_slug = Category::where('slug', $slug)->first();

        $meta_title = $cate_slug->title;
        $meta_description = $cate_slug->description;
        $meta_image = "";

        //1 phim nhiều danh mục
        $movie_category = Movie_Category::where('category_id', $cate_slug->id)->get();
        $many_category = [];
        foreach ($movie_category as $key => $movi) {
            $many_category[] = $movi->movie_id;
        }
        if(isset($_GET['phimle'])) {
            $movie = Movie::withCount(['episode'=>function($q)
                {
                    $q->where('server', 3);
                }
            ])->where('thuocphim', 'phimle')->whereIn('id', $many_category)->orderBy('ngaycapnhat', 'DESC')->paginate(40);
        }else{
            $movie = Movie::withCount(['episode'=>function($q)
            {
                $q->where('server', 3);
            }
            ])->whereIn('id',$many_category)->orderBy('ngaycapnhat', 'DESC')->paginate(40);
        }

        return view('pages.category', compact('cate_slug', 'movie', 'meta_title', 'meta_description','meta_image'));
    }
    public function year($year)
    {
        $meta_title = 'Năm phim ' . $year;
        $meta_description = 'Tìm phim năm ' . $year;
        $meta_image = "";
        $year = $year;
        $movie = Movie::withcount('episode')->where('year', $year)->orderby('ngaycapnhat', 'DESC')->paginate(40); //phân trang phần danh mục cho đủ 40 phim

        return view('pages.year', compact('year', 'movie', 'meta_title', 'meta_description','meta_image'));
    }
    public function tag($tag)
    {

        $meta_title = $tag;
        $meta_description = $tag;
        $meta_image = "";
        $tag = $tag;
        $movie = Movie::withcount('episode')->where('tags', 'LIKE', '%' . $tag . '%')->orderby('ngaycapnhat', 'DESC')->paginate(40); //phân trang phần danh mục cho đủ 40 phim

        return view('pages.tag', compact('tag', 'movie', 'meta_title', 'meta_description','meta_image'));
    }
    public function genre($slug)
    {

        $gen_slug = Genre::where('slug', $slug)->first();
        $meta_title = $gen_slug->title;
        $meta_description = $gen_slug->description;
        $meta_image = "";

        //Nhiều thể loại
        $movie_genre = Movie_Genre::where('genre_id', $gen_slug->id)->get();
        $many_genre = [];
        foreach ($movie_genre as $key => $movi) {
            $many_genre[] = $movi->movie_id;
        }
        if(isset($_GET['phimle'])) {
            $movie = Movie::withCount(['episode'=>function($q)
                {
                    $q->where('server', 3);
                }
            ])->where('thuocphim', 'phimle')->whereIn('id', $many_genre)->orderBy('ngaycapnhat', 'DESC')->paginate(40);
        }else{
            $movie = Movie::withCount(['episode'=>function($q)
            {
                $q->where('server', 3);
            }
            ])->whereIn('id',$many_genre)->orderBy('ngaycapnhat', 'DESC')->paginate(40);
        }

        return view('pages.genre', compact('gen_slug', 'movie', 'meta_title', 'meta_description','meta_image'));
    }

    public function country($slug)
    {
        $coun_slug = Country::where('slug', $slug)->first();

        $meta_title = $coun_slug->title;
        $meta_description = $coun_slug->description;
        $meta_image = "";

        $movie = Movie::withcount('episode')->where('country_id', $coun_slug->id)->orderby('ngaycapnhat', 'DESC')->paginate(40);


        return view('pages.country', compact('coun_slug', 'movie', 'meta_title', 'meta_description','meta_image'));
    }
    public function movie($slug)
    {
        $movie = Movie::withcount('episode')->with('category', 'genre', 'country', 'movie_genre')->where('slug', $slug)->where('status', 1)->first();

        $meta_title = $movie->title;
        $meta_description = $movie->description;
        $meta_image =url('uploads/movie/'.$movie->image);

        //lấy 3 tập gần nhất
        $episode = Episode::with('movie')->where('movie_id', $movie->id)->orderby('episode', 'DESC')->take(3)->get();
        //Lấy tổng tập phim
        $episode_current_list = Episode::with('movie')->where('movie_id', $movie->id)->get();
        $episode_current_list_count = $episode_current_list->count();
        //Lấy tập 1
        $episode_tapdau = Episode::with('movie')->where('movie_id', $movie->id)->orderby('episode', 'ASC')->take(1)->first();
        $related = Movie::with('category', 'genre', 'country')->where('category_id', $movie->category->id)->orderby(DB::raw('RAND()'))->whereNotIn('slug', [$slug])->get(); // hiển thị những phim ở phần có thể bạn muốn xem ramdom trừ phim đang chọn
        //Đánh giá phim
        $rating = Rating::where('movie_id', $movie->id)->avg('rating');
        $rating = round($rating); //làm tròn đánh giá
        $count_total = Rating::where('movie_id', $movie->id)->count();


        //tăng view khi click
        $count_views = $movie->count_views;
        $count_views + 1;
        $movie->count_views = $count_views;
        $movie->save();


        return view('pages.movie', compact('movie', 'related', 'episode', 'episode_tapdau', 'episode_current_list_count', 'rating', 'count_total', 'meta_title', 'meta_description','meta_image'));
    }

    public function add_rating(Request $request)
    {
        $data = $request->all();
        $ip_address = $request->ip();

        $rating_count = Rating::where('movie_id', $data['movie_id'])->where('ip_address', $ip_address)->count();
        if ($rating_count > 0) {
            echo 'exist';
        } else {
            $rating = new Rating();
            $rating->movie_id = $data['movie_id'];
            $rating->rating = $data['index'];
            $rating->ip_address = $ip_address;
            $rating->save();
            echo 'done';
        }
    }


    public function watch($slug, $tap,$server_active)
    {


        $movie = Movie::withcount('episode')->with('category', 'genre', 'country', 'movie_genre','movie_category', 'episode')->where('slug', $slug)->where('status', 1)->first();

        $meta_title = $movie->title;
        $meta_description = $movie->description;
        $meta_image =url('uploads/movie/'.$movie->image);


        $related = Movie::with('category', 'genre', 'country')->where('category_id', $movie->category->id)->orderby(DB::raw('RAND()'))->whereNotIn('slug', [$slug])->get(); // hiển thị những phim ở phần có thể bạn muốn xem ramdom trừ phim đang chọn

        //lấy tập 1 
        if (isset($tap)) {
            // if($tap!='FULLHD'|| $tap!='HD'){
            $tapphim = $tap;
            $tapphim = substr($tapphim, 4, 20); // đoạn code này để rút ngắn phần slug của phim trừ đi 9 ký tự
            $episode = Episode::where('movie_id', $movie->id)->where('episode', $tapphim)->first();
        } else {

            $tapphim = 1;
            $episode = Episode::where('movie_id', $movie->id)->where('episode', $tapphim)->first();
        }

        $server = LinkMovie::orderBy('id', 'DESC')->get();
        $episode_movie = Episode::where('movie_id', $movie->id)->get()->unique('server');
        $episode_list = Episode::where('movie_id', $movie->id)->get();

        // return response()->json($movie);
        return view('pages.watch', compact( 'movie','episode', 'tapphim', 'related', 'meta_title', 'meta_description','meta_image', 'episode_movie', 'server', 'episode_list', 'server_active'));
    }
    public function episode()
    {
        return view('pages.episode');
    }
}

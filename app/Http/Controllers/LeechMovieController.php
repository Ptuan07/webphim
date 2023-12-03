<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use Carbon\Carbon;


class LeechMovieController extends Controller
{

    public function leech_movie(){
        $resp = Http::get("https://ophim1.com/danh-sach/phim-moi-cap-nhat?page=1")->json();
        return view("admincp.leech.index",compact('resp'));
    }

    public function leech_detail($slug)
    {
        $resp = Http::get("https://ophim1.com/phim/".$slug)->json();
        $resp_movie[] = $resp['movie'];
        return view("admincp.leech.leech_detail",compact('resp_movie'));
    }

    public function leech_store(Request $request, $slug)
    {
       
        $resp = Http::get("https://ophim1.com/phim/".$slug)->json();
        $resp_movie[] = $resp['movie'];
        $movie = new Movie();
        foreach($resp_movie as $key =>$res){
            $movie->title = $res['name'];
            $movie->trailer = $res['trailer_url'];
            $movie->sotap = $res['episode_total'];
            $movie->tags = $res['name'].','.$res['slug'];
            $movie->time = $res['time'];
            $movie->vietsub = 0;
            $movie->resolution = 0;

            $movie->slug = $res['slug'];
            $movie->name_eng = $res['origin_name'];
            $movie->phim_hot = 1;
            $movie->description = $res['content'];
            $movie->status = 0;
            $movie->thuocphim = 'phimle';

            $category = Category:: orderBy('id','desc')->first();
            $movie->category_id = $category->id;

            $country = Country:: orderBy('id','desc')->first();
            $movie->country_id = $country->id;

            $genre = Genre:: orderBy('id','desc')->first();
            $movie->genre_id = $genre->id;

    
            $movie->count_views = rand(100, 99999);
            $movie->slug = $res['slug'];
            $movie->ngaytao = Carbon::now('Asia/Ho_Chi_Minh');
            $movie->ngaycapnhat = Carbon::now('Asia/Ho_Chi_Minh');
            $movie->image = $res['thumb_url'];

            $movie->save();

            $movie->movie_genre()->attach($genre);
        }
        return redirect()->back();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

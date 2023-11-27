<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Episode;
use App\Models\Movie_Genre;
use App\Models\Info;


// use App\Http\Controllers\File;
use File;
use Illuminate\Http\Request;
use Carbon\Carbon; // xử lý về thời gian

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Movie::with('category', 'movie_genre', 'country', 'genre')->withCount('episode')->orderBy('id', 'DESC')->get();
        $category = Category::pluck('title', 'id');
        $country = Country::pluck('title', 'id');

        $path = public_path() . "/json/";
        if (!is_dir($path)) {
            mkdir($path, 0777, true); //cấp quyền cho file json toàn quyền với mã 0777
        }
        File::put($path . 'movie.json', json_encode($list));


        return view('admincp.movie.index', compact('list', 'category','country'));
    }

    public function category_choose(Request $request)
    {
        $data = $request -> all();
        $movie = Movie::find($data['movie_id']);
        $movie->category_id = $data['category_id'];
        $movie->save();
    }

    public function country_choose(Request $request)
    {
        $data = $request -> all();
        $movie = Movie::find($data['movie_id']);
        $movie->country_id = $data['country_id'];
        $movie->save();
    }

    public function genre_choose()
    {

    }

    public function vietsub_choose(Request $request)
    {
        $data = $request -> all();
        $movie = Movie::find($data['movie_id']);
        $movie->vietsub = $data['vietsub_val'];
        $movie->save();
    }

    public function status_choose(Request $request)
    {
        $data = $request -> all();
        $movie = Movie::find($data['movie_id']);
        $movie->status = $data['status_val'];
        $movie->save();
    }

    public function phimhot_choose(Request $request)
    {
        $data = $request -> all();
        $movie = Movie::find($data['movie_id']);
        $movie->phim_hot = $data['phimhot_val'];
        $movie->save();
    }
    public function thuocphim_choose(Request $request)
    {
        $data = $request -> all();
        $movie = Movie::find($data['movie_id']);
        $movie->thuocphim = $data['thuocphim_val'];
        $movie->save();
    }

    public function resolution_choose(Request $request)
    {
        $data = $request -> all();
        $movie = Movie::find($data['movie_id']);
        $movie->resolution = $data['resolution_val'];
        $movie->save();
    }

    public function update_image_movie_ajax(Request $request)
    {
    $get_image = $request->file('file');
    $movie_id = $request->movie_id;
        if($get_image){
            //xóa ảnh cũ 
        $movie = Movie::find($movie_id);
        unlink('uploads/movie/'.$movie->image);
        //Thêm ảnh mới
        $get_name_image =  $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();

        $get_image->move('uploads/movie/', $new_image);
        $movie->image = $new_image;
        $movie->save();
        }
        
    }
    

    public function update_year(Request $request)
    {
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->year = $data['year'];
        $movie->save();
    }

    public function update_season(Request $request)
    {
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->season = $data['season'];
        $movie->save();
    }

    public function filter_topview(Request $request) // lỗi chức năng
    {
        $data = $request->all();
        $movie = Movie::where('topview', $data['value'])->orderby('ngaycapnhat', 'DESC')->take(5)->get();
        $output = '';
        foreach ($movie as $key => $mov) {
            if ($mov->resolution == 0) {
                $text = 'HD';
            } elseif ($mov->resolution == 1) {
                $text = 'SD';
            } elseif ($mov->resolution == 2) {
                $text = 'HDCam';
            } else {
                $text = 'Cam';
            }
            $output .= '<div class="item ">
            <a href="' . url('phim/' . $mov->slug) . '" title="' . $mov->title . '">
                <div class="item-link">
                    <img src="' . url('uploads/movie/' . $mov->image) . '" class="lazy post-thumb" alt="' . $mov->title . '"
                        title="' . $mov->title . '" />
                    <span class="is_trailer">' . $text . '</span>
                </div>
                <p class="title">' . $mov->title . '</p>
            </a>
            <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
            <div class="viewsCount" style="color: #9d9d9d;">'.$mov->year.'</div>

            <div style="float: left;">
           
            <ul class="list-inline rating" title="Average Rating">
            ';
           
            for ($count = 1; $count <= 5; $count++){
                $output.='<li title="star_rating" style="font-size: 20px; color:#ffcc00; padding:0">&#9733;
                </li>';
            }
            $output.='<ul class="list-inline rating" title="Average Rating">
            </div>
        </div>';
        }
        echo $output;
    }

    public function filter_default(Request $request) // bị lỗi chức năng 
    {
        $data = $request->all();
        $movie = Movie::where('topview', 0)->orderby('ngaycapnhat', 'DESC')->take(5)->get();
        $output = '';
        foreach ($movie as $key => $mov) {
            if ($mov->resolution == 0) {
                $text = 'HD';
            } elseif ($mov->resolution == 1) {
                $text = 'SD';
            } elseif ($mov->resolution == 2) {
                $text = 'HDCam';
            } elseif ($mov->resolution == 3) {
                $text = 'Cam';
            } elseif ($mov->resolution == 4) {
                $text = 'FullHD';
            } else {
                $text = 'Trailer';
            }
            $output .= '<div class="item ">
            <a href="' . url('phim/' . $mov->slug) . '" title="' . $mov->title . '">
                <div class="item-link">
                    <img src="' . url('uploads/movie/' . $mov->image) . '" class="lazy post-thumb" alt="' . $mov->title . '"
                        title="' . $mov->title . '" />
                    <span class="is_trailer">' . $text . '</span>
                </div>
                <p class="title">' . $mov->title . '</p>
            </a>
            <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
            <div style="float: left;">
                <span class="user-rate-image post-large-rate stars-large-vang"
                    style="display: block;/* width: 100%; */">
                    <span style="width: 0%"></span>
                </span>
            </div>
        </div>';
        }
        echo $output;
    }

    public function update_topview(Request $request)
    {
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->topview = $data['topview'];
        $movie->save();
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::pluck('title', 'id');
        $country = Country::pluck('title', 'id');
        $genre = Genre::pluck('title', 'id');
        $list_genre = Genre::all();

        return view('admincp.movie.form', compact('category', 'country', 'genre', 'list_genre'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data = $request->validate(
            [
                'title'=>'required|max:255',
                'slug'=>'required|max:255',
                'description'=>'required',
                'status'=>'required',
                'trailer'=>'sometimes',
                'resolution'=>'required',
                'vietsub'=>'required',
                'phim_hot'=>'required',
                'category_id'=>'required',
                'thuocphim'=>'required',
                'country_id'=>'required',
                'image'=>'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100, min_height=100,max_width=2000, max_height=2000',
                'sotap'=> 'required|max:255',
                'time'=>'required|max:255',
                'name_eng'=>'required|max:255',
                'tags'=>'required|max:255',
                'genre' => 'required|array|min:1',

            ],
            [
                'title.unique' => 'Tên phim đã có, xin hãy điền lại',
                'slug.unique' => 'Slug phim đã có, xin hãy điền lại',
                'title.required' => 'Tên phim còn thiếu, xin hãy điền lại',
                'slug.required' => 'Slug phim còn thiếu, xin hãy điền lại',
                'description.required' => 'Mô tả phim còn thiếu',
                'image.required' => 'Ảnh phim còn thiếu',
                'name_eng.required' => 'Tên tiếng anh phim còn thiếu',
                'sotap.required' => 'Chưa điền số tập phim',
                'time.required' => 'Thời lượng phim còn thiếu',
                'genre.required' => 'Chọn ít nhất 1 thể loại phim',
                'tags.required' => 'Tags phim còn thiếu',


            ]
            );
        $movie = new Movie();
        $movie->title = $data['title'];
        $movie->trailer = $data['trailer'];
        $movie->time = $data['time'];
        $movie->tags = $data['tags'];
        $movie->sotap = $data['sotap'];

        $movie->resolution = $data['resolution'];
        $movie->vietsub = $data['vietsub'];
        $movie->name_eng = $data['name_eng'];
        $movie->phim_hot = $data['phim_hot'];
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->category_id = $data['category_id'];
        $movie->thuocphim = $data['thuocphim'];

        $movie->country_id = $data['country_id'];
        $movie->count_views = rand(100, 99999);
        $movie->slug = $data['slug'];
        $movie->ngaytao = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->ngaycapnhat = Carbon::now('Asia/Ho_Chi_Minh');

        foreach ($data['genre'] as $key => $gen) {
            $movie->genre_id = $gen[0];
        }
        //them anh
        $get_image = $request->file('image');

        // $path = 'public/upload/movie/';

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName(); // hinhanh1.jpg
            $name_image = current(explode('.', $get_name_image)); //[0]=> hinhanh1.jpg . [1]=> jpg
            $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('uploads/movie/', $new_image);
            // File::copy($path.$new_image);
            $movie->image = $new_image;
        }
        $movie->save();
        //them nhieu the loai cho phim
        $movie->movie_genre()->attach($data['genre']);

        toastr()->success('Thành công', 'Thêm phim thành công');


        return redirect()->route('movie.index');
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
        $category = Category::pluck('title', 'id');
        $country = Country::pluck('title', 'id');
        $genre = Genre::pluck('title', 'id');
        $list_genre = Genre::all();

        $movie = Movie::find($id);
        $movie_genre = $movie->movie_genre;

        // $list = Movie::with('category','genre','country')->orderby('id', 'DESC')->get();
        return view('admincp.movie.form', compact('category', 'country', 'genre', 'movie', 'list_genre', 'movie_genre'));
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
        // $data = $request->all();

        // $data = $request->validate(
        //     [
        //         'title'=>'required|unique:movies|max:255',
        //         'slug'=>'required|unique:movies|max:255',
        //         'description'=>'required|max:255',
        //         'status'=>'required',
        //         'image'=>'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_with=100, min_height=100,max_with=2000, max_height=2000',
        //         'sotap'=> 'required|unique:movies|max:255',
        //         'time'=>'required|unique:movies|max:255',
        //         'eng_name'=>'required|unique:movies|max:255',
        //         'tags'=>'required|unique:movies|max:255',
        //         'genre' => 'required|array|min:1',

        //     ],
        //     [
        //         'title.unique' => 'Tên phim đã có, xin hãy điền lại',
        //         'slug.unique' => 'Slug phim đã có, xin hãy điền lại',
        //         'title.required' => 'Tên phim còn thiếu, xin hãy điền lại',
        //         'slug.required' => 'Slug phim còn thiếu, xin hãy điền lại',
        //         'description.required' => 'Mô tả phim còn thiếu',
        //         'image.required' => 'Ảnh phim còn thiếu',
        //         'eng_name.required' => 'Mô tả phim còn thiếu',
        //         'sotap.required' => 'Chưa điền số tập phim',
        //         'time.required' => 'Thời lượng phim còn thiếu',
        //         'genre.required' => 'Chọn ít nhất 1 thể loại phim',
        //         'tags.required' => 'Tags phim còn thiếu',


        //     ]
        //     );
            $data = $request->validate(
                [
                    'title'=>'required|max:255',
                    'slug'=>'required|max:255',
                    'description'=>'required',
                    'status'=>'required',
                    'trailer'=>'sometimes',
                    'resolution'=>'required',
                    'vietsub'=>'required',
                    'phim_hot'=>'required',
                    'category_id'=>'required',
                    'thuocphim'=>'required',
                    'country_id'=>'required',
                    'image'=>'somtimes|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_with=100, min_height=100,max_with=2000, max_height=2000',
                    'sotap'=> 'required|max:255',
                    'time'=>'required|max:255',
                    'name_eng'=>'required|max:255',
                    'tags'=>'required|max:255',
                    'genre' => 'required|array|min:1',
    
                ],
                [
                    'title.unique' => 'Tên phim đã có, xin hãy điền lại',
                    'slug.unique' => 'Slug phim đã có, xin hãy điền lại',
                    'title.required' => 'Tên phim còn thiếu, xin hãy điền lại',
                    'slug.required' => 'Slug phim còn thiếu, xin hãy điền lại',
                    'description.required' => 'Mô tả phim còn thiếu',
                    'image.required' => 'Ảnh phim còn thiếu',
                    'name_eng.required' => 'Tên tiếng anh phim còn thiếu',
                    'sotap.required' => 'Chưa điền số tập phim',
                    'time.required' => 'Thời lượng phim còn thiếu',
                    'genre.required' => 'Chọn ít nhất 1 thể loại phim',
                    'tags.required' => 'Tags phim còn thiếu',
    
    
                ]
                );
    
        $movie =  Movie::find($id);
        $movie->title = $data['title'];
        $movie->trailer = $data['trailer'];
        $movie->time = $data['time'];
        $movie->tags = $data['tags'];
        $movie->sotap = $data['sotap'];

        $movie->resolution = $data['resolution'];
        $movie->vietsub = $data['vietsub'];
        $movie->name_eng = $data['name_eng'];
        $movie->phim_hot = $data['phim_hot'];
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->category_id = $data['category_id'];
        $movie->thuocphim = $data['thuocphim'];
        $movie->country_id = $data['country_id'];
        // $movie->count_views = rand(100, 99999);
        $movie->slug = $data['slug'];
        $movie->ngaycapnhat = Carbon::now('Asia/Ho_Chi_Minh');

        foreach ($data['genre'] as $key => $gen) {
            $movie->genre_id = $gen[0];
        }


        //them anh
        $get_image = $request->file('image');

        // $path = 'public/upload/movie/';

        if ($get_image) {
            if (file_exists('uploads/movie/' . $movie->image)) {
                unlink('uploads/movie/' . $movie->image);
            } else {
                $get_name_image = $get_image->getClientOriginalName(); // hinhanh1.jpg
                $name_image = current(explode('.', $get_name_image)); //[0]=> hinhanh1.jpg . [1]=> jpg
                $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('uploads/movie/', $new_image);
                // File::copy($path.$new_image);
                $movie->image = $new_image;
            }
        }


        $movie->save();
        //them nhieu the loai cho phim
        $movie->movie_genre()->sync($data['genre']);

        toastr()->success('Thành công', 'Update phim thành công');


        return redirect()->route('movie.index');
    }

    public function watch_video(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['movie_id']);
        $video = Episode::where('movie_id', $data['movie_id'])->where('episode', $data['episode_id'])->first();

        $output['video_title'] = $movie->title.'-tập'.$video->episode;
        $output['video_desc'] = $movie->description;
        $output['video_link'] = $video->linkphim;

        echo json_encode($output);

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Movie::find($id)->delete();
        $movie = Movie::find($id);
        // xoá ảnh
        if (file_exists('uploads/movie/' . $movie->image)) {
            unlink('uploads/movie/' . $movie->image);
        }
        // xoá thể loại
        Movie_Genre::whereIn('movie_id', [$movie->id])->delete();

        Episode::whereIn('movie_id', [$movie->id])->delete();
        $movie->delete();

        return redirect()->route('movie.index');
    }
}

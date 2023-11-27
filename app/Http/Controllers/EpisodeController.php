<?php

namespace App\Http\Controllers;
use App\Models\Episode;
use App\Models\Movie;
use App\Models\LinkMovie;

use Illuminate\Http\Request;
use Carbon\Carbon;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_episode = Episode::with('movie')->orderby('episode','DESC')->get();
        // return response()->json($list_episode);
        return view('admincp.episode.index',compact('list_episode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_movie = Movie::orderby('id','DESC')->pluck('title','id');
        return view('admincp.episode.form',compact('list_movie'));
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
        $episode_check = Episode::where('episode',$data['episode'])->where('movie_id',$data['movie_id'])->count();
        if($episode_check>0)
        {
            return redirect()->route('episode.index');
        }
        else
        {
            $ep = new Episode();
            $ep->movie_id =$data['movie_id'];
            $ep->linkphim =$data['link'];
            $ep->server =$data['linkserver'];
            $ep->episode =$data['episode'];
            $ep->created_at =Carbon::now('Asia/Ho_Chi_Minh');
            $ep->updated_at =Carbon::now('Asia/Ho_Chi_Minh');
            $ep->save();
            toastr()->success('Thành công', 'Thêm tập phim thành công');
            return redirect()->route('episode.index');
        }
        
        

    }

    public function add_episode($id)
    {
        $linkmovie = LinkMovie::orderBy('id', 'DESC')->pluck('title','id');
        $list_server = LinkMovie::orderBy('id', 'DESC')->get();

        $movie = Movie::find($id);
        $list_episode = Episode::with('movie')->where('movie_id',$id)->orderby('episode','DESC')->get();
        // return response()->json($list_episode);
        return view('admincp.episode.add_episode',compact('list_episode','movie','linkmovie','list_server'));
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
        $episode = Episode::find($id);
        $list_movie = Movie::orderby('id','DESC')->pluck('title','id');
        return view('admincp.episode.form',compact('list_movie','episode'));
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
        $data = $request->all();
        $ep =  Episode::find($id);
        $ep->movie_id =$data['movie_id'];
        $ep->linkphim =$data['link'];
        $ep->episode =$data['episode'];
        $ep->created_at =Carbon::now('Asia/Ho_Chi_Minh');
        $ep->updated_at =Carbon::now('Asia/Ho_Chi_Minh');
        $ep->save();
        toastr()->success('Thành công', 'Update tập phim thành công');
        return redirect()->route('episode.index');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $episode = Episode::find($id)->delete();
        toastr()->success('Thành công', 'Xóa tập phim thành công');
        return redirect()->route('episode.index');;

    }

    public function select_movie()
    {
        $id = $_GET['id'];
        $movie = Movie::find($id);
        $output = '<option>---Chọn tập phim---</option>';
        if($movie->thuocphim=='phimbo'){
        for($i=1;$i<=$movie->sotap;$i++){
            $output .= '<option value="'.$i.'">'.$i.'</option>';
        }
    }else{
        $output .= '<option value="HD">HD</option>
        <option value="FULLHD">FULLHD</option>
        <option value="CAM">CAM</option>
        <option value="HDCAM">HDCAM</option>';

      
    }
    echo $output;
    }

    }

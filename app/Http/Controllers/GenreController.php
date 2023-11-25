<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $list = Genre::orderby('id', 'DESC')->get();
        return view('admincp.genre.index', compact('list'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list = Genre::all();
        return view('admincp.genre.form',compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data = $request->all();
        $data = $request->validate(
            [
                'title'=>'required|unique:categories|max:255',
                'slug'=>'required|unique:categories|max:255',
                'description'=>'required|max:255',
                'status'=>'required',
            ],
            [
                'title.unique' => 'Tên thể loại đã có, xin hãy điền lại',
                'slug.unique' => 'Slug thể loại đã có, xin hãy điền lại',
                'title.required' => 'Tên thể loại còn thiếu, xin hãy điền lại',
                'slug.required' => 'Tên thể loại còn thiếu, xin hãy điền lại',
                'description.required' => 'Mô tả thể loại còn thiếu',

            ]
            );
        $genre = new Genre();
        $genre->title =$data['title'];
        $genre->description =$data['description'];
        $genre->status =$data['status'];
        $genre->slug =$data['slug'];

        $genre->save();
        toastr()->success('Thành công', 'Thêm thể loại phim thành công');
        return redirect()->route('genre.index');

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
        $genre = Genre::find($id);
        $list = Genre::all();
        return view('admincp.genre.form',compact('list','genre'));
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
        $data = $request->validate(
            [
                'title'=>'required|unique:categories|max:255',
                'slug'=>'required|unique:categories|max:255',
                'description'=>'required|max:255',
                'status'=>'required',
            ],
            [
                'title.unique' => 'Tên thể loại đã có, xin hãy điền lại',
                'slug.unique' => 'Slug thể loại đã có, xin hãy điền lại',
                'title.required' => 'Tên thể loại còn thiếu, xin hãy điền lại',
                'slug.required' => 'Tên thể loại còn thiếu, xin hãy điền lại',
                'description.required' => 'Mô tả thể loại còn thiếu',

            ]
            );
        $genre =  Genre::find($id);
        $genre->title =$data['title'];
        $genre->description =$data['description'];
        $genre->status =$data['status'];
        $genre->slug =$data['slug'];

        $genre->save();
        toastr()->success('Thành công', 'Update thể loại phim thành công');
        return redirect()->route('genre.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Genre::find($id)->delete();
        toastr()->success('Thành công', 'Xóa thể loại phim thành công');
        return redirect()->route('genre.index');


    }

    public function resorting(Request $request)
    {
        $data = $request->all();
        foreach($data['array_id'] as $key => $value){
            $genre= Genre::find($value);
            $genre -> position =$key;
            $genre-> save();
        }
        

    }
    
}

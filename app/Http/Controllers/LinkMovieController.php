<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LinkMovie;


class LinkMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $linkmovie = LinkMovie::orderby('id', 'DESC')->get();
        return view('admincp.linkmovie.index', compact('linkmovie'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.linkmovie.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'title'=>'required|unique:linkmovie|max:255',
                'description'=>'required|max:255',
                'status'=>'required',
            ],
            [
                'title.unique' => 'Tên link đã có, xin hãy điền lại',
                'title.required' => 'Tên link còn thiếu, xin hãy điền lại',
                'description.required' => 'Mô tả link còn thiếu',

            ]

        );

        $linkmovie = new LinkMovie();
        $linkmovie->title =$data['title'];
        $linkmovie->description =$data['description'];
        $linkmovie->status =$data['status'];
        $linkmovie->save();
        toastr()->success('Thành công', 'Thêm link thành công');
        return redirect()->route('linkmovie.create');
    
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
        $linkmovie=LinkMovie::find($id);
        return view('admincp.linkmovie.form', compact('linkmovie'));
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
        $data = $request->validate(
            [
                'title'=>'required|max:255',
                'description'=>'required|max:255',
                'status'=>'required',
            ],
            [
                'title.required' => 'Tên link còn thiếu, xin hãy điền lại',
                'description.required' => 'Mô tả link còn thiếu',

            ]

        );

        $linkmovie = LinkMovie::find($id);
        $linkmovie->title =$data['title'];
        $linkmovie->description =$data['description'];
        $linkmovie->status =$data['status'];
        $linkmovie->save();
        toastr()->success('Thành công', 'Cập nhật link thành công');
        return redirect()->route('linkmovie.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        LinkMovie::find($id)->delete();
        return redirect()->back();
    }
}

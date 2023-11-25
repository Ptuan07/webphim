<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Country::orderby('id', 'DESC')->get();
        return view('admincp.country.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list = Country::all();
        return view('admincp.country.form',compact('list'));
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
                'title.unique' => 'Tên quốc gia đã có, xin hãy điền lại',
                'slug.unique' => 'Slug quốc gia đã có, xin hãy điền lại',
                'title.required' => 'Tên quốc gia còn thiếu, xin hãy điền lại',
                'slug.required' => 'Tên quốc gia còn thiếu, xin hãy điền lại',
                'description.required' => 'Mô tả quốc gia còn thiếu',

            ]
            );
        $country = new Country();
        $country->title =$data['title'];
        $country->description =$data['description'];
        $country->status =$data['status'];
        $country->slug =$data['slug'];

        $country->save();
        toastr()->success('Thành công', 'Thêm quốc gia thành công');
        return redirect()->route('country.index');

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
        $country = Country::find($id);
        $list = Country::all();
        return view('admincp.country.form',compact('list','country'));
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
                'title.unique' => 'Tên quốc gia đã có, xin hãy điền lại',
                'slug.unique' => 'Slug quốc gia đã có, xin hãy điền lại',
                'title.required' => 'Tên quốc gia còn thiếu, xin hãy điền lại',
                'slug.required' => 'Tên quốc gia còn thiếu, xin hãy điền lại',
                'description.required' => 'Mô tả quốc gia còn thiếu',

            ]
            );
        $country =  Country::find($id);
        $country->title =$data['title'];
        $country->description =$data['description'];
        $country->slug =$data['slug'];
        $country->status =$data['status'];

        $country->save();
        toastr()->success('Thành công', 'Sửa quốc gia thành công');
        return redirect()->route('country.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Country::find($id)->delete();
        toastr()->success('Thành công', 'Xóa quốc gia thành công');
        return redirect()->route('country.index');


    }
    public function resorting(Request $request)
    {
        $data = $request->all();
        foreach($data['array_id'] as $key => $value){
            $country= Country::find($value);
            $country -> position =$key;
            $country-> save();
        }
        

    }
}

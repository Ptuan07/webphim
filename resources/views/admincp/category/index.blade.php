@extends('layouts.app')

@section('content')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#category">
    Thên nhanh
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        {!! Form::open(['route' => 'category.store', 'method' => 'POST']) !!}
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Thêm danh mục phim</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="card">
                {{-- <a href="{{ route('category.index') }}"class= "btn btn-primary">Liệt Kê</a> --}}
                <div class="card-header">Quản Lý Danh Mục</div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        
                  
                   
                    <div class="form-group">
                        {!! Form::label('title', 'Title', []) !!}
                        {!! Form::text('title', isset($category) ? $category->title : '', ['class' => 'form-control', 'placeholder' => 'Nhập dữ liệu...', 'id' => 'slug', 'onkeyup'=>'ChangeToSlug()']) !!} <!--'required'=>'required'--->
                    </div>
                    <div class="form-group">
                        {!! Form::label('slug', 'Slug', []) !!}
                        {!! Form::text('slug', isset($category) ? $category->slug : '', ['class' => 'form-control', 'placeholder' => 'Nhập dữ liệu...', 'id' => 'convert_slug']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Description', []) !!}
                        {!! Form::textarea('description',  isset($category) ? $category->description : '', [
                            'style' => 'resize:none',
                            'class' => 'form-control',
                            'placeholder' => 'Nhập dữ liệu...',
                            'id' => 'description',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Active', 'Active', []) !!}
                        {!! Form::select('status', ['1' => 'Hiển thị', '0' => 'Không'],isset($category) ? $category->status : '', ['class' => 'form-control']) !!}
                    </div>
                    {{-- @if(!isset($category))
                    {!! Form::submit('Thêm', ['class' => 'btn btn-success', 'style' => 'margin-top:5px']) !!}
                    @else
                    {!! Form::submit('Cập Nhật', ['class' => 'btn btn-success', 'style' => 'margin-top:5px']) !!}

                    @endif --}}
         
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
          {!! Form::submit('Thêm', ['class' => 'btn btn-primary', 'style' => 'margin-top:5px']) !!}
        </div>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                {{-- <a href="{{ route('category.create') }}"class= "btn btn-primary">Thêm </a> --}}
                <table id="tablephim" class="table">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Title</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Description</th>
                            <th scope="col">Active/Inactive</th>
                            <th scope="col">Manage</th>
                        </tr>
                    </thead>
                    <tbody class= "order_position">
                        @foreach ($list as $key => $cate)
                            <tr id ="{{$cate->id}}">
                                <th scope="row">{{ $key }}</th>
                                <td>{{ $cate->title }}</td>
                                <td>{{ $cate->slug }}</td>
                                <td>{{ $cate->description }}</td>
                                <td>
                                    @if ($cate->status)
                                        Hiển Thị
                                    @else
                                        Không
                                    @endif
                                </td>
                                <td>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['category.destroy', $cate->id],
                                        'onsubmit' => 'return confirm("Bạn có chắc muốn xoá không?")',
                                    ]) !!}

                                    {!! Form::submit('Xoá', ['class' => 'btn btn-danger']) !!}

                                    {!! Form::close() !!}

                                    <a href="{{route ('category.edit',$cate->id) }}" class="btn btn-warning">Sửa</a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

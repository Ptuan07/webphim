@extends('layouts.app')

@section('content')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#genre">
    Thêm nhanh
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="genre" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        {!! Form::open(['route' => 'genre.store', 'method' => 'POST']) !!}
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="card">
                <div class="card-header">Quản Lý Thể Loại</div>
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

                    <div class="form-gourp">
                        {!! Form::label('title', 'Title', []) !!}
                        {!! Form::text('title', isset($genre) ? $genre->title : '', [
                            'class' => 'form-control',
                            'placeholder' => 'Nhập dữ liệu...',
                            'id' => 'slug',
                            'onkeyup' => 'ChangeToSlug()',
                        ]) !!}
                    </div>
                    <div class="form-gourp">
                        {!! Form::label('slug', 'Slug', []) !!}
                        {!! Form::text('slug', isset($genre) ? $genre->slug : '', [
                            'class' => 'form-control',
                            'placeholder' => 'Nhập dữ liệu...',
                            'id' => 'convert_slug',
                        ]) !!}
                    </div>
                    <div class="form-gourp">
                        {!! Form::label('description', 'Description', []) !!}
                        {!! Form::textarea('description', isset($genre) ? $genre->description : '', [
                            'style' => 'resize:none',
                            'class' => 'form-control',
                            'placeholder' => 'Nhập dữ liệu...',
                            'id' => 'description',
                        ]) !!}
                    </div>
                    <div class="form-gourp">
                        {!! Form::label('Active', 'Active', []) !!}
                        {!! Form::select('status', ['1' => 'Hiển thị', '0' => 'Không'], isset($genre) ? $genre->status : '', [
                            'class' => 'form-control',
                        ]) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          {!! Form::submit('Thêm', ['class' => 'btn btn-success', 'style' => 'margin-top:5px']) !!}
        </div>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                {{-- <a href="{{ route('genre.create') }}"class= "btn btn-primary">Thêm</a> --}}
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
                    <tbody>
                        @foreach ($list as $key => $gen)
                            <tr>
                                <th scope="row">{{ $key }}</th>
                                <td>{{ $gen->title }}</td>
                                <td>{{ $gen->slug }}</td>
                                <td>{{ $gen->description }}</td>
                                <td>
                                    @if ($gen->status)
                                        Hiển Thị
                                    @else
                                        Không
                                    @endif
                                </td>
                                <td>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['genre.destroy', $gen->id],
                                        'onsubmit' => 'return confirm("Bạn có chắc muốn xoá không?")',
                                    ]) !!}

                                    {!! Form::submit('Xoá', ['class' => 'btn btn-danger']) !!}

                                    {!! Form::close() !!}

                                    <a href="{{route ('genre.edit',$gen->id) }}" class="btn btn-warning">Sửa</a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

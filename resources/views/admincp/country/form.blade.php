@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <a href="{{ route('country.index') }}"class= "btn btn-primary">Liệt Kê</a>
                    <div class="card-header">Quản Lý Quốc Gia</div>
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
                        @if(!@isset($country))
                            
                        {!! Form::open(['route' => 'country.store', 'method' => 'POST']) !!}
                        @else

                        {!! Form::open(['route' => ['country.update', $country->id], 'method' => 'PUT']) !!}

                        @endif

                        <div class="form-group">
                            {!! Form::label('title', 'Title', []) !!}
                            {!! Form::text('title', isset($country) ? $country->title : '', ['class' => 'form-control', 'placeholder' => 'Nhập dữ liệu...', 'id' => 'slug', 'onkeyup'=>'ChangeToSlug()']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('slug', 'Slug', []) !!}
                            {!! Form::text('slug', isset($country) ? $country->slug : '', ['class' => 'form-control', 'placeholder' => 'Nhập dữ liệu...', 'id' => 'convert_slug']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Description', []) !!}
                            {!! Form::textarea('description',  isset($country) ? $country->description : '', [
                                'style' => 'resize:none',
                                'class' => 'form-control',
                                'placeholder' => 'Nhập dữ liệu...',
                                'id' => 'description',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Active', 'Active', []) !!}
                            {!! Form::select('status', ['1' => 'Hiển thị', '0' => 'Không'],isset($country) ? $country->status : '', ['class' => 'form-control']) !!}
                        </div>
                        @if(!isset($country))
                        {!! Form::submit('Thêm', ['class' => 'btn btn-success', 'style' => 'margin-top:5px']) !!}
                        @else
                        {!! Form::submit('Cập Nhật', ['class' => 'btn btn-success', 'style' => 'margin-top:5px']) !!}

                        @endif

                        {!! Form::close() !!}

                    </div>
                </div>
                {{-- <table class="table">
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
                        @foreach ($list as $key => $coun)
                            <tr>
                                <th scope="row">{{ $key }}</th>
                                <td>{{ $coun->title }}</td>
                                <td>{{ $coun->slug }}</td>

                                <td>{{ $coun->description }}</td>
                                <td>
                                    @if ($coun->status)
                                        Hiển Thị
                                    @else
                                        Không
                                    @endif
                                </td>
                                <td>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['country.destroy', $coun->id],
                                        'onsubmit' => 'return confirm("Bạn có chắc muốn xoá không?")',
                                    ]) !!}

                                    {!! Form::submit('Xoá', ['class' => 'btn btn-danger']) !!}

                                    {!! Form::close() !!}

                                    <a href="{{route ('country.edit',$coun->id) }}" class="btn btn-warning">Sửa</a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> --}}
            </div>
        </div>
    </div>
@endsection

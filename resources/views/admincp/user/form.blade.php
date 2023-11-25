@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <a href="{{ route('user.index') }}"class= "btn btn-primary">Liệt Kê</a>
                    <div class="card-header">Quản Lý Tài Khoản</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if(!@isset($genre))
                            
                        {!! Form::open(['route' => 'user.store', 'method' => 'POST']) !!}
                        @else

                        {!! Form::open(['route' => ['user.update', $genre->id], 'method' => 'PUT']) !!}

                        @endif

                        <div class="form-gourp">
                            {!! Form::label('title', 'Title', []) !!}
                            {!! Form::text('title', isset($genre) ? $genre->title : '', ['class' => 'form-control', 'placeholder' => 'Nhập dữ liệu...', 'id' => 'slug', 'onkeyup'=>'ChangeToSlug()']) !!}
                        </div>
                        <div class="form-gourp">
                            {!! Form::label('slug', 'Slug', []) !!}
                            {!! Form::text('slug', isset($genre) ? $genre->slug : '', ['class' => 'form-control', 'placeholder' => 'Nhập dữ liệu...', 'id' => 'convert_slug']) !!}
                        </div>
                        <div class="form-gourp">
                            {!! Form::label('description', 'Description', []) !!}
                            {!! Form::textarea('description',  isset($genre) ? $genre->description : '', [
                                'style' => 'resize:none',
                                'class' => 'form-control',
                                'placeholder' => 'Nhập dữ liệu...',
                                'id' => 'description',
                            ]) !!}
                        </div>
                        <div class="form-gourp">
                            {!! Form::label('Active', 'Active', []) !!}
                            {!! Form::select('status', ['1' => 'Hiển thị', '0' => 'Không'],isset($genre) ? $genre->status : '', ['class' => 'form-control']) !!}
                        </div>
                        @if(!isset($genre))
                        {!! Form::submit('Thêm', ['class' => 'btn btn-success', 'style' => 'margin-top:5px']) !!}
                        @else
                        {!! Form::submit('Cập Nhật', ['class' => 'btn btn-success', 'style' => 'margin-top:5px']) !!}

                        @endif

                        {!! Form::close() !!}

                    </div>
                </div>
            
            </div>
        </div>
    </div>
@endsection

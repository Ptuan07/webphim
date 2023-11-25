@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <a href="{{ route('movie.index') }}"class="btn btn-primary">Liệt Kê</a>
                    <div class="card-header">Quản Lý Phim</div>
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
                        @if (!@isset($movie))
                            {!! Form::open(['route' => 'movie.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        @else
                            {!! Form::open(['route' => ['movie.update', $movie->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
                        @endif


                        <div class="form-group">
                            {!! Form::label('title', 'Title', []) !!}
                            {!! Form::text('title', isset($movie) ? $movie->title : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập dữ liệu...',
                                'id' => 'slug',
                                'onkeyup' => 'ChangeToSlug()',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('sotap', 'Episode', []) !!}
                            {!! Form::text('sotap', isset($movie) ? $movie->sotap : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập dữ liệu...',
                                
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('time', 'Time', []) !!}
                            {!! Form::text('time', isset($movie) ? $movie->time : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập dữ liệu...',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('English Name', 'English Name', []) !!}
                            {!! Form::text('name_eng', isset($movie) ? $movie->name_eng : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập dữ liệu...',
                            ]) !!}
                            <div class="form-group">
                                {!! Form::label('trailer', 'Trailer', []) !!}
                                {!! Form::text('trailer', isset($movie) ? $movie->trailer : '', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập dữ liệu...',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('slug', 'Slug', []) !!}
                                {!! Form::text('slug', isset($movie) ? $movie->slug : '', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập dữ liệu...',
                                    'id' => 'convert_slug',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('description', 'Description', []) !!}
                                {!! Form::textarea('description', isset($movie) ? $movie->description : '', [
                                    'style' => 'resize:none',
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập dữ liệu...',
                                    // 'id' => 'description',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('tags', 'Tags', []) !!}
                                {!! Form::textarea('tags', isset($movie) ? $movie->tags : '', [
                                    'style' => 'resize:none',
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập dữ liệu...',
                                    'id' => 'description',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Category', 'Category', []) !!}
                                {!! Form::select('category_id', $category, isset($movie) ? $movie->category_id : '', [
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('thuocphim', 'Thuộc thể loại phim', []) !!}
                                {!! Form::select('thuocphim', ['phimle'=>'Phim Lẻ', 'phimbo'=>'Phim Bộ'],isset($movie) ? $movie->thuocphim : '', [
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Country', 'Country', []) !!}
                                {!! Form::select('country_id', $country, isset($movie) ? $movie->country_id : '', ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Genre', 'Genre') !!}<br>
                                {{-- {!! Form::select('genre_id', $genre, isset($movie) ? $movie->genre_id : '', ['class' => 'form-control']) !!} --}}
                                @foreach ($list_genre as $key => $gen)
                                    @if (@isset($movie))
                                        {!! Form::checkbox('genre[]', $gen->id, isset($movie_genre) && $movie_genre->contains($gen->id) ? true : false) !!}
                                    @else
                                        {!! Form::checkbox('genre[]', $gen->id, '') !!}
                                    @endif
                                    {!! Form::label('Genre', $gen->title) !!}
                                @endforeach
                            </div>


                            <div class="form-group">
                                {!! Form::label('Image', 'Image') !!}
                                {!! Form::file('image', ['class' => 'form-control-file']) !!}
                                @if (!empty($movie))
                                    <img width="20%" src="{{ asset('uploads/movie/' . $movie->image) }}" alt="{{ $movie->image }}">
                                @endif
                            </div>
                            <div class="form-group">
                                {!! Form::label('Hot', 'Hot', []) !!}
                                {!! Form::select('phim_hot', ['1' => 'Có', '0' => 'Không'], isset($movie) ? $movie->phim_hot : '', [
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('resolution', 'Resolution', []) !!}
                                {!! Form::select(
                                    'resolution',
                                    ['0' => 'HD', '1' => 'SD', '2' => 'HDCAM', '3' => 'CAM', '4' => 'FULL HD', '5' => 'Trailer'],
                                    isset($movie) ? $movie->resolution : '',
                                    [
                                        'class' => 'form-control',
                                    ],
                                ) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('VietSub', 'VietSub', []) !!}
                                {!! Form::select('vietsub', ['0' => 'Phụ Đề', '1' => 'Thuyết Minh'], isset($movie) ? $movie->vietsub : '', [
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Active', 'Active', []) !!}
                                {!! Form::select('status', ['1' => 'Hiển Thị', '0' => 'Không'], isset($movie) ? $movie->status : '', [
                                    'class' => 'form-control',
                                ]) !!}
                            </div>

                            @if (!isset($movie))
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

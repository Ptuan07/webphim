@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Quản Lý Tập Phim</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (!@isset($episode))
                            {!! Form::open(['route' => 'episode.store', 'method' => 'POST']) !!}
                        @else
                            {!! Form::open(['route' => ['episode.update', $episode->id], 'method' => 'PUT']) !!}
                        @endif

                        <div class="form-group">
                            {!! Form::label('movie_title', 'Phim', []) !!}
                            {!! Form::text('movie_title', isset($movie) ? $movie->title : '', ['class' => 'form-control', 'readonly']) !!}
                            {!! Form::hidden('movie_id', isset($movie) ? $movie->id : '') !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('link', 'Link Phim') !!}
                            {!! Form::text('link', isset($episode) ? $episode->linkphim : '', ['class' => 'form-control']) !!}
                        </div>

                        @if (isset($episode))
                            <div class="form-group">
                                {!! Form::label('episode', 'Tập Phim', []) !!}
                                {!! Form::text('episode', isset($episode) ? $episode->episode : '', [
                                    'class' => 'form-control',
                                    isset($episode) ? 'readonly' : '',
                                ]) !!}
                            </div>
                        @else
                            {!! Form::label('episode', 'Tập Phim', []) !!}
                            {!! Form::selectRange('episode', 1, $movie->sotap, $movie->sotap, ['class' => 'form-control']) !!}
                        @endif

                        @if (!isset($episode))
                            {!! Form::submit('Thêm', ['class' => 'btn btn-success', 'style' => 'margin-top:5px']) !!}
                        @else
                            {!! Form::submit('Cập Nhật', ['class' => 'btn btn-success', 'style' => 'margin-top:5px']) !!}
                        @endif

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
            {{-- Liệt Kê Tập phim --}}
            <div class="col-md-12">
                <table id="tablephim" class="table">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên Phim</th>
                            <th scope="col">Hình Ảnh </th>
                            <th scope="col">Tập Phim</th>
                            <th scope="col">Link Phim</th>
                            {{-- <th scope="col">Active/Inactive</th> --}}
                            <th scope="col">Quản Lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_episode as $key => $epi)
                            <tr>
                                <th scope="row">{{ $key }}</th>
                                <td>{{ $epi->movie->title }}</td>
                                <td><img width="100%" src="{{ asset('uploads/movie/' . $epi->movie->image) }}"></td>
                                <td>{{ $epi->episode }}</td>

                                <td style="width: 20%">{!! $epi->linkphim !!}</td>

                                <td>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['episode.destroy', $epi->id],
                                        'onsubmit' => 'return confirm("Bạn có chắc muốn xoá không?")',
                                    ]) !!}

                                    {!! Form::submit('Xoá', ['class' => 'btn btn-danger']) !!}

                                    {!! Form::close() !!}

                                    <a href="{{ route('episode.edit', $epi->id) }}" class="btn btn-warning">Sửa</a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

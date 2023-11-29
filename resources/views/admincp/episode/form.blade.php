@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <a href="{{ route('episode.index') }}"class= "btn btn-primary">Liệt Kê</a>
                    <div class="card-header">Quản Lý Tập Phim</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if(!@isset($episode))
                            
                        {!! Form::open(['route' => 'episode.store', 'method' => 'POST']) !!}
                        @else

                        {!! Form::open(['route' => ['episode.update', $episode->id], 'method' => 'PUT']) !!}

                        @endif

                        
                        <div class="form-group">
                            {!! Form::label('Movie', 'Chọn Phim', []) !!}
                            {!! Form::select('movie_id',['0'=>'Chọn phim','Phim mới nhất'=>$list_movie] ,isset($episode) ? $episode->movie_id : '', ['class' => 'form-control select-movie' , 'readonly']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('link', 'Link Phim', []) !!}
                            {!! Form::text('link',isset($episode) ? $episode->linkphim : '', ['class' => 'form-control']) !!}
                        </div>

                        @if(isset($episode))
                        <div class="form-group">
                            {!! Form::label('episode', 'Tập Phim', []) !!}
                            {!! Form::text('episode',isset($episode) ? $episode->episode : '', ['class' => 'form-control',isset($episode) ? 'readonly' : '']) !!}
                        </div>
                        @else
                        {!! Form::label('episode', 'Tập Phim', []) !!}
                        <select name="episode" class="form-control" id="show_movie"></select>
                        @endif


                        <div class="form-group">
                            {!! Form::label('linkserver', 'Link Movie', []) !!}
                            {!! Form::select('linkserver', $linkmovie,  isset($episode) ? $episode->server:'', ['class' => 'form-control']) !!}
                        </div>


                        @if(!isset($movie))
                        <div class="form-group">
                        {!! Form::submit('Thêm', ['class' => 'btn btn-success', 'style' => 'margin-top:5px']) !!}
                        @else
                        {!! Form::submit('Cập Nhật', ['class' => 'btn btn-success', 'style' => 'margin-top:5px']) !!}
                        </div>
                        @endif

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

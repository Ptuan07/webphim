@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    {{-- <a href="{{ route('linkmovie.index') }}"class= "btn btn-primary">Liệt Kê</a> --}}
                    <div class="card-header">Quản Lý Link Phim</div>
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
                        @if(!@isset($linkmovie))
                            
                        {!! Form::open(['route' => 'linkmovie.store', 'method' => 'POST']) !!}
                        @else

                        {!! Form::open(['route' => ['linkmovie.update', $linkmovie->id], 'method' => 'PUT']) !!}

                        @endif

                        <div class="form-group">
                            {!! Form::label('title', 'Tên link', []) !!}
                            {!! Form::text('title', isset($linkmovie) ? $linkmovie->title : '', ['class' => 'form-control', 'placeholder' => 'Nhập dữ liệu...']) !!} <!--'required'=>'required'--->
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Mô tả link', []) !!}
                            {!! Form::textarea('description',  isset($linkmovie) ? $linkmovie->description : '', [
                                'style' => 'resize:none',
                                'class' => 'form-control',
                                'placeholder' => 'Nhập dữ liệu...',
                                'id' => 'description',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Active', 'Active', []) !!}
                            {!! Form::select('status', ['1' => 'Hiển thị', '0' => 'Không'],isset($linkmovie) ? $linkmovie->status : '', ['class' => 'form-control']) !!}
                        </div>
                        @if(!isset($linkmovie))
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

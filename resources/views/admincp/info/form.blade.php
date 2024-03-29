@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <a href="{{ route('info.index') }}"class= "btn btn-primary">Liệt Kê</a>
                    <div class="card-header">Quản Lý Thông Tin Website</div>
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
                        {!! Form::open(['route' => ['info.update', $info->id], 'method' => 'PUT',  'enctype' => 'multipart/form-data']) !!}

                        <div class="form-group">
                            {!! Form::label('title', 'Tiêu đề website', []) !!}
                            {!! Form::text('title', isset($info) ? $info->title : '', ['class' => 'form-control', 'placeholder' => 'Nhập dữ liệu...']) !!} <!--'required'=>'required'--->
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Description', []) !!}
                            {!! Form::textarea('description',  isset($info) ? $info->description : '', [
                                'style' => 'resize:none',
                                'class' => 'form-control',
                                'placeholder' => 'Nhập dữ liệu...',
                                'id' => 'description',
                            ]) !!}
                        </div>
                        
                        <div class="form-group">
                            {!! Form::label('Image', 'Hình ảnh logo') !!}
                            {!! Form::file('image', ['class' => 'form-control-file']) !!}
                            @if (isset($info))
                                <img width="50%" src="{{ asset('uploads/logo/'.$info->logo) }}">
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('copyright', 'Copyright', []) !!}
                            {!! Form::text('copyright', isset($info) ? $info->copyright : '', ['class' => 'form-control', 'placeholder' => 'Nhập dữ liệu...']) !!} <!--'required'=>'required'--->
                        </div>
                        {!! Form::submit('Cập Nhật Thông Tin Website', ['class' => 'btn btn-success']) !!}

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>   
        </div>
    </div>
@endsection

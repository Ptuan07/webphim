@extends('layouts.app')

@section('content')
    <style>
        .card-header {
            margin-bottom: 20px;
            color: blue
                /* Điều chỉnh khoảng cách dưới của mỗi phần tử div */
        }

        .card-button {
            margin-bottom: 50px;
                /* Điều chỉnh khoảng cách dưới của mỗi phần tử div */
        }

    </style>
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">


                    

                    <div class="container">
                        <div class="card-body ">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="card-header"><strong style="font-size: 110%">Quản Lý Cá Nhân</strong></div>
                            {!! Form::model($user, ['route' => ['update-profile', $user->id], 'method' => 'POST']) !!}
                            <div class="form-group">
                                {!! Form::label('name', 'Name', []) !!}
                                {!! Form::text('name', isset($user) ? $user->name : '', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập dữ liệu...',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('email', 'Email', []) !!}
                                {!! Form::email('email', isset($user) ? $user->email : '', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập dữ liệu...',
                                ]) !!}
                            </div>
                            {{-- @if (!isset($user->id))
                            {!! Form::submit('Thêm', ['class' => 'btn btn-success', 'style' => 'margin-top:5px']) !!}
                            @else --}}
                            {!! Form::submit('Cập Nhật', ['class' => 'btn btn-success card-button', 'style' => 'margin-top:5px']) !!}
                            {{-- @endif --}}

                            {!! Form::close() !!}

                        </div>

                        <div class="card-body ">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="card-header"><strong style="font-size: 110%">Quản Lý Cá Nhân</strong></div>
                            {!! Form::open(['route' => ['update-password', $user->id], 'method' => 'POST']) !!}

                            <div class="form-group">
                                {!! Form::label('current_password', 'Mật khẩu cũ', []) !!}
                                {!! Form::password('current_password', ['class' => 'form-control', 'placeholder' => 'Nhập mật khẩu cũ...']) !!}
                                @if ($errors->has('current_password'))
                                    <span class="text-danger">{{ $errors->first('current_password') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                {!! Form::label('new_password', 'Mật khẩu mới', []) !!}
                                {!! Form::password('new_password', ['class' => 'form-control', 'placeholder' => 'Nhập mật khẩu mới...']) !!}
                                @if ($errors->has('new_password'))
                                    <span class="text-danger">{{ $errors->first('new_password') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                {!! Form::label('new_password_confirmation', 'Nhập lại mật khẩu mới', []) !!}
                                {!! Form::password('new_password_confirmation', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập lại mật khẩu mới...',
                                ]) !!}
                                @if ($errors->has('new_password_confirmation'))
                                    <span class="text-danger">{{ $errors->first('new_password_confirmation') }}</span>
                                @endif
                            </div>

                            {!! Form::submit('Đổi mật khẩu', ['class' => 'btn btn-success', 'style' => 'margin-top:5px']) !!}

                            {!! Form::close() !!}
                        </div>

                    </div>
                </div>
            </div>
        @endsection

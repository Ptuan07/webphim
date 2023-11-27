@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <a href="{{ route('info.index') }}"class= "btn btn-primary">Liệt Kê</a>
                <div class="card-header">Quản Lý link phim</div>
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
                    <table id="tablephim" class="table">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Active/Inactive</th>
                                <th scope="col">Manage</th>
                            </tr>
                        </thead>
                        <tbody class= "order_position">
                            @foreach ($linkmovie as $key => $movielink)
                                <tr >
                                    <th scope="row">{{ $key }}</th>
                                    <td>{{ $movielink->title }}</td>
                                    <td>{{ $movielink->description }}</td>
                                    <td>
                                        @if ($movielink->status)
                                            Hiển Thị
                                        @else
                                            Không
                                        @endif
                                    </td>
                                    <td>
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['linkmovie.destroy', $movielink->id],
                                            'onsubmit' => 'return confirm("Bạn có chắc muốn xoá không?")',
                                        ]) !!}
    
                                        {!! Form::submit('Xoá', ['class' => 'btn btn-danger']) !!}
    
                                        {!! Form::close() !!}
    
                                        <a href="{{route ('linkmovie.edit',$movielink->id) }}" class="btn btn-warning">Sửa</a>
    
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>   
    </div>
</div>
  

            </div>
        </div>
    </div>
@endsection

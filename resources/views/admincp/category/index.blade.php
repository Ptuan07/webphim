@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <a href="{{ route('category.create') }}"class= "btn btn-primary">Thêm </a>
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
                    <tbody class= "order_position">
                        @foreach ($list as $key => $cate)
                            <tr id ="{{$cate->id}}">
                                <th scope="row">{{ $key }}</th>
                                <td>{{ $cate->title }}</td>
                                <td>{{ $cate->slug }}</td>
                                <td>{{ $cate->description }}</td>
                                <td>
                                    @if ($cate->status)
                                        Hiển Thị
                                    @else
                                        Không
                                    @endif
                                </td>
                                <td>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['category.destroy', $cate->id],
                                        'onsubmit' => 'return confirm("Bạn có chắc muốn xoá không?")',
                                    ]) !!}

                                    {!! Form::submit('Xoá', ['class' => 'btn btn-danger']) !!}

                                    {!! Form::close() !!}

                                    <a href="{{route ('category.edit',$cate->id) }}" class="btn btn-warning">Sửa</a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

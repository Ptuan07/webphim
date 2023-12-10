@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="table-responsive">
                {{-- <a href="{{ route('user.create') }}"class= "btn btn-primary">Thêm</a> --}}
                <table id="tablephim" class="table"  style=" display:block">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Password</th>
                            {{-- <th scope="col">Active/Inactive</th> --}}
                            <th scope="col">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $key => $use)
                            <tr>
                                <th scope="row">{{ $key }}</th>
                                <td>{{ $use->name }}</td>
                                <td>{{ $use->email }}</td>
                                <td>{{ $use->password }}</td>
                                {{-- <td>
                                    @if ($use->status)
                                        Hiển Thị
                                    @else
                                        Không
                                    @endif
                                </td> --}}
                                <td>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['user.destroy', $use->id],
                                        'onsubmit' => 'return confirm("Bạn có chắc muốn xoá không?")',
                                    ]) !!}

                                    {!! Form::submit('Xoá', ['class' => 'btn btn-danger']) !!}

                                    {!! Form::close() !!}

                                    <a href="{{route ('user.edit',$use->id) }}" class="btn btn-warning">Sửa</a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

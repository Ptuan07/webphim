@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <a href="{{ route('episode.create') }}"class= "btn btn-primary">Thêm </a>
                <table id="tablephim" class="table table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên Phim</th>
                            {{-- <th scope="col">Tập Phim</th> --}}
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
                                <td >{{ $epi->episode }}</td>

                                <td style="width: 20%">{{$epi->linkphim }}</td>
                                {{-- <td>
                                    @if ($epi->status)
                                        Hiển Thị
                                    @else
                                        Không
                                    @endif
                                </td> --}}
                                <td>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['episode.destroy', $epi->id],
                                        'onsubmit' => 'return confirm("Bạn có chắc muốn xoá không?")',
                                    ]) !!}

                                    {!! Form::submit('Xoá', ['class' => 'btn btn-danger']) !!}

                                    {!! Form::close() !!}

                                    <a href="{{route ('episode.edit',$epi->id) }}" class="btn btn-warning">Sửa</a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

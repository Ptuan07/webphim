@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                {{-- <a href="{{ route('category.create') }}"class= "btn btn-primary">Thêm </a> --}}
                <table id="tablephim" class="table">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên phim</th>
                            <th scope="col">Tên tiếng anh</th>
                            <th scope="col">Hình ảnh phim</th>
                            <th scope="col">Hình ảnh poster</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Id</th>
                            <th scope="col">Year</th>
                            <th scope="col">Quản lý</th>

                        </tr>
                    </thead>
                    <tbody class= "order_position">
                        @foreach ($resp['items'] as $key => $res)
                            <tr>
                                <th scope="row">{{ $key }}</th>
                                <td>{{ $res['name'] }}</td>
                                <td>{{ $res['origin_name'] }}</td>
                                <td><img src="{{ $resp['pathImage'] . $res['thumb_url'] }}" height="80" width="80">
                                </td>
                                <td><img src="{{ $resp['pathImage'] . $res['poster_url'] }}" height="80" width="80">
                                </td>
                                <td>{{ $res['slug'] }}</td>
                                <td>{{ $res['_id'] }}</td>
                                <td>{{ $res['year'] }}</td>
                                <td><a href="{{ route('leech-detail', $res['slug']) }}" class="btn btn-primary btn-sm">Chi tiết phim</a>
                                    <a href="{{ route('leech-episode', $res['slug']) }}" class="btn btn-danger btn-sm">Tập phim</a>
                                    @php
                                        $movie = \App\Models\Movie::where('slug', $res['slug'])->first();
                                    @endphp
                                    @if (!$movie)
                                    <form method="POST" action="{{ route('leech-store', $res['slug']) }}">
                                        @csrf
                                        <input type="submit" class="btn btn-success btn-sm" value="Thêm phim">
                                    </form>
                                    @else
                                    <form method="POST" action="{{ route('movie.destroy', $movie->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="btn btn-danger btn-sm" value="Xóa phim">
                                    </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

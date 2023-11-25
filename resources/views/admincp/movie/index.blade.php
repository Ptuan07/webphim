@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <a href="{{ route('movie.create') }}"class="btn btn-primary">Thêm</a>
                <table style="display:block;" id="tablephim" class="table table-responsive" >
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên Phim</th>
                            <th scope="col">Tập Phim</th>
                            {{-- <th scope="col">Tên Tiếng Anh</th> --}}

                            <th scope="col">Ảnh</th>
                            <th scope="col">Thời Lượng Phim</th>
                            {{-- <th scope="col">Tags</th> --}}
                            <th scope="col">Số Tập</th>
                            {{-- <th scope="col">Đường Dẫn</th> --}}
                            {{-- <th scope="col">Description</th> --}}
                            <th scope="col">Danh Mục</th>
                            <th scope="col">Quốc Gia</th>
                            <th scope="col">Thể Loại</th>
                            <th scope="col">Thước Phim</th>
                            <th scope="col">Hot</th>
                            <th scope="col">Chất Lượng Phim</th>
                            <th scope="col">Phụ Đề</th>
                            {{-- <th scope="col">Ngày Tạo</th>
                            <th scope="col">Ngày Cập Nhật</th> --}}
                            <th scope="col">Năm Phim</th>
                            <th scope="col">Top View</th>
                            <th scope="col">Mùa Phim</th>
                            <th scope="col">Hoạt Động</th>
                            <th scope="col">Quản Lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $key => $mov)
                            <tr>
                                <th scope="row">{{ $key }}</th>
                                <td>{{ $mov->title }}</td>
                                <td><a href="{{ route('add-episode', $mov->id) }}" class="btn btn-info btn-sm">Thêm Tập
                                        Phim</a></td>

                                <td><img width="50%" src="{{ asset('uploads/movie/' . $mov->image) }}"> 
                                    <input type="file" data-movie_id="{{$mov->id}}" id="file-{{$mov->id}}" class="form-controll-file file_image" accept="image/*">   <!--Chọn tất cả file ảnh-->
                                    <span id="success_image"></span>
                                </td>
                                <td>{{ $mov->time }}</td>
                                {{-- <td>
                                    @if ($mov->tags != null)
                                        {{ substr($mov->tags, 0, 50) }}...
                                    @else
                                        Chưa có từ khoá cho phim_hot
                                    @endif
                                </td> --}}
                                <td>
                                    {{ $mov->episode_count }}/{{ $mov->sotap }} Tập
                                </td>
                                {{-- <td>{{ $mov->name_eng }}</td> --}}


                                {{-- <td>{{ $mov->slug }}</td> --}}
                                {{-- <td>{{ $mov->description }}</td> --}}

                                <td>
                                    {{-- {{ $mov->category->title }} --}}
                                    {!! Form::select('category_id', $category, isset($mov) ? $mov->category->id : '', [
                                        'class' => 'form-control category_choose',
                                        'id' => $mov->id,
                                    ]) !!}
                                </td>
                                <td>
                                    {{-- {{ $mov->country->title }} --}}
                                    {!! Form::select('country_id', $country, isset($mov) ? $mov->country->id : '', [
                                        'class' => 'form-control country_choose',
                                        'id' => $mov->id,
                                    ]) !!}
                                </td>

                                <td>
                                    @foreach ($mov->movie_genre as $gen)
                                        <span class="badge badge-dark">{{ $gen->title }}</span>
                                    @endforeach
                                </td>

                                <td>
                                
                                    <select class="thuocphim_choose" id="{{ $mov->id }}">
                                        @if ($mov->thuocphim == 'phimbo')
                                            <option value="phimle">Phim Lẻ</option>
                                            <option selected value="phimbo">Phim Bộ</option>
                                        @else
                                            <option selected value="phimle">Phim Lẻ</option>
                                            <option value="phimbo">Phim Bộ</option>
                                        @endif

                                    </select>

                                </td>

                                <td>
                                    {{-- @if ($mov->phim_hot == 0)
                                        Không
                                    @else
                                        Có
                                    @endif --}}
                                    <select class="phimhot_choose" id="{{ $mov->id }}">
                                        @if ($mov->vietsub == 0)
                                            <option value="1">Có</option>
                                            <option selected value="0">Không</option>
                                        @else
                                            <option selected value="1">Có</option>
                                            <option value="0">Không</option>
                                        @endif

                                    </select>

                                </td>
                                <td>
                                    {{-- @if ($mov->resolution == 0)
                                        HD
                                    @elseif($mov->resolution == 1)
                                        SD
                                    @elseif($mov->resolution == 2)
                                        HDCAM
                                    @elseif($mov->resolution == 3)
                                        CAM
                                    @elseif($mov->resolution == 4)
                                        FULLHD
                                    @else
                                        Trailer
                                    @endif --}}
                                    @php
                                    $options = $arrayName = array('0' =>'HD' , '1' =>'SD' , '2' =>'HDCAM' , '3' =>'CAM' ,'4' =>'FULHD' ,'5' =>'TRAILER'  );

                                    @endphp
                                    <select id="{{$mov->id}}" class="resolution_choose">
                                    @foreach($options as $key =>$resolution)
                                    <option {{$mov->resolution==$key ? 'selected': ''}} value="{{$key}}">{{$resolution}}</option>
                                    @endforeach
                                    </select>
                                </td>
                                <td>
                                    {{-- @if ($mov->vietsub == 0)
                                        Phụ Đề
                                    @else
                                        Thuyết Minh
                                    @endif --}}

                                    <select class="vietsub_choose" id="{{ $mov->id }}">
                                        @if ($mov->vietsub == 0)
                                            <option value="1">Thuyết Minh</option>
                                            <option selected value="0">Phụ Đề</option>
                                        @else
                                            <option selected value="1">Thuyết Minh</option>
                                            <option value="0">Phụ Đề</option>
                                        @endif

                                    </select>
                                </td>
                                {{-- <td>{{ $mov->ngaytao }}</td>
                                <td>{{ $mov->ngaycapnhat }}</td> --}}
                                <td>
                                    <form method="POST">
                                        @csrf
                                        {!! Form::selectYear('year', 2000, 2023, isset($mov->year) ? $mov->year : '', [
                                            'class' => 'select-year',
                                            'id' => $mov->id,
                                            'placeholder' => '--Năm Phim--',
                                        ]) !!}
                                    </form>
                                    {{-- sử dụng ajax vào form app.blade.php --}}
                                </td>
                                <td>
                                    {!! Form::select(
                                        'topview',
                                        ['0' => 'Ngày', '1' => 'Tuần', '2' => 'Tháng'],
                                        isset($mov->topview) ? $mov->topview : '',
                                        [
                                            'class' => 'select-topview',
                                            'id' => $mov->id,
                                            'placeholder' => '--Views--',
                                        ],
                                    ) !!}
                                </td>
                                {{-- <td>
                                    <form method="POST">
                                        @csrf
                                        <select name="top_view" class="topview">
                                            @if ($mov->top_view == 1)
                                                <option id="{{ $mov->id }}" value="0">Ngày</option>
                                                <option selected id="{{ $mov->id }}" value="1">Tuần</option>
                                                <option id="{{ $mov->id }}" value="2">Tháng</option>
                                                <option id="{{ $mov->id }}" value="3">Năm</option>
                                            @elseif($mov->top_view == 2)
                                                <option id="{{ $mov->id }}" value="0">Ngày</option>
                                                <option id="{{ $mov->id }}" value="1">Tuần</option>
                                                <option selected id="{{ $mov->id }}" value="2">Tháng</option>
                                                <option id="{{ $mov->id }}" value="3">Năm</option>
                                            @elseif($mov->top_view == 3)
                                                <option id="{{ $mov->id }}" value="0">Ngày</option>
                                                <option id="{{ $mov->id }}" value="1">Tuần</option>
                                                <option id="{{ $mov->id }}" value="2">Tháng</option>
                                                <option selected id="{{ $mov->id }}" value="3">Năm</option>
                                            @else
                                                <option selected id="{{ $mov->id }}" value="0">Ngày</option>
                                                <option id="{{ $mov->id }}" value="1">Tuần</option>
                                                <option id="{{ $mov->id }}" value="2">Tháng</option>
                                                <option id="{{ $mov->id }}" value="3">Năm</option>
                                            @endif

                                        </select>
                                    </form>
                                </td> --}}
                                <td>
                                    <form method="POST">
                                        @csrf

                                        {!! Form::selectRange('season', 1, 10, '', [
                                            'class' => 'select-season',
                                            'id' => $mov->id,
                                            'placeholder' => '--Mùa Phim--',
                                        ]) !!}
                                    </form>
                                </td>
                                <td>
                                    {{-- @if ($mov->status)
                                        Hiển Thị
                                    @else
                                        Không
                                    @endif --}}
                                    <select class="status_choose" id="{{ $mov->id }}">
                                        @if ($mov->status == 0)
                                            <option value="1">Hiển Thị</option>
                                            <option selected value="0">Không</option>
                                        @else
                                            <option selected value="1">Hiển Thi</option>
                                            <option value="0">Không</option>
                                        @endif

                                    </select>
                                </td>
                                <td>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['movie.destroy', $mov->id],
                                        'onsubmit' => 'return confirm("Bạn có chắc muốn xoá không?")',
                                    ]) !!}

                                    {!! Form::submit('Xoá', ['class' => 'btn btn-danger']) !!}

                                    {!! Form::close() !!}

                                    <a href="{{ route('movie.edit', $mov->id) }}" class="btn btn-warning">Sửa</a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')

  
    <div class="table-responsive">
                <table class="table" id="tablephim">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">ID</th>
                            <th scope="col">Tên phim</th>
                            <th scope="col">Tên tiếng anh</th>
                            <th scope="col">Nội dung</th>
                            <th scope="col">Loại</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">thumb_url</th>
                            {{-- <th scope="col">is_copyright</th> --}}
                            <th scope="col">Trailer</th>
                            <th scope="col">Thời lượng</th>
                            <th scope="col">Tập hiện tại</th>
                            <th scope="col">Tổng số tập</th>
                            <th scope="col">Chất lượng phim</th>
                            <th scope="col">Lang</th>
                            <th scope="col">Thông báo</th>
                            <th scope="col">ShowTimes</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Năm</th>
                            <th scope="col">View</th>
                            <th scope="col">Diễn viên</th>
                            <th scope="col">Nhà sản xuất</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Quốc gia</th>
                            <th scope="col">is_copyright</th>
                            <th scope="col">Chiếu rạp</th>
                            <th scope="col">Poster url</th>
                            <th scope="col">Sub độc quyền</th>

                        </tr>
                    </thead>
                    <tbody class= "order_position">
                        @foreach ($resp_movie as $key => $res)
                            <tr>
                                <th scope="row">{{ $key }}</th>
                                <td>{{ $res['_id'] }}</td>
                                <td>{{ $res['name'] }}</td>
                                <td>{{ $res['origin_name'] }}</td>
                                <td>{!!$res['content']!!}</td>
                                <td>{{ $res['type'] }}</td>
                                
                                <td>{{ $res['status'] }}</td>
                                <td><img src="{{$res['thumb_url']}}" height="80" width="80"></td>
                                {{-- <td>
                                    <td>
                                    @if($res['is_copyright'==true])
                                    <span class="text text-success">True</span>
                                    @else
                                    <span class="text text-danger">False</span>
                                    @endif
                                </td>
                                </td> --}}
                                <td>{{ $res['trailer_url'] }}</td>
                                <td>{{ $res['time'] }}</td>
                                <td>{{ $res['episode_current'] }}</td>
                                <td>{{ $res['episode_total'] }}</td>
                                <td>{{ $res['quality'] }}</td>
                                <td>{{ $res['lang'] }}</td>
                                <td>{{ $res['notify'] }}</td>
                                <td>{{ $res['showtimes'] }}</td>
                                <td>{{ $res['slug'] }}</td>
                                <td>{{ $res['year'] }}</td>
                                <td>{{ $res['view'] }}</td>
                                <td>
                                    @foreach($res['actor'] as $actor)
                                    <span class="badge badge-info">{{$actor}}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($res['director'] as $director)
                                    <span class="badge badge-info">{{$director}}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($res['category'] as $category)
                                    <span class="badge badge-info">{{$category['name']}}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($res['country'] as $country)
                                    <span class="badge badge-info">{{$country['name']}}</span>
                                    @endforeach
                                </td>

                                <
                                    <td>
                                    @if($res['is_copyright']==true)
                                    <span class="text text-success">True</span>
                                    @else
                                    <span class="text text-danger">False</span>
                                    @endif
                                </td>
                                

                            
                                <td>
                                    @if($res['chieurap']==true)
                                    <span class="text text-success">True</span>
                                    @else
                                    <span class="text text-danger">False</span>
                                    @endif
                                </td>
                            <

                                <td><img src="{{$res['poster_url']}}" height="80" width="80"></td>

                                
                                    <td>
                                        @if($res['sub_docquyen']==true)
                                        <span class="text text-success">True</span>
                                        @else
                                        <span class="text text-danger">False</span>
                                        @endif
                                    </td>
                                
                                </tr>
                        @endforeach
                    </tbody>
                </table>
    </div>
@endsection

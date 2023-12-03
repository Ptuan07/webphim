@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                {{-- <a href="{{ route('category.create') }}"class= "btn btn-primary">Thêm </a> --}}
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Link embed</th>
                            <th scope="col">Link M3U8</th>
                            <th scope="col">Tên phim</th>
                            <th scope="col">Slug phim</th>
                            {{-- <th scope="col">Tên tiếng anh</th> --}}
                            <th scope="col">Số tập</th>
                            <th scope="col">Tập phim</th>
                            <th scope="col">Quản lý</th>

                        </tr>
                    </thead>
                    <tbody class= "order_position">
                        @foreach ($resp['episodes'] as $key => $res)
                            <tr>
                                <th scope="row">{{ $key }}</th>
                                <td>
                                    @foreach ($res['server_data'] as $key =>$server_1)
                                       <ul>
                                         <li>Tập {{$server_1['name']}}
                                             <input type="text" class="form-control" value="{{$server_1['link_embed']}}">
                                         </li>
                                       </ul> 
                                    @endforeach 
                                 </td>
                                 <td>
                                    @foreach ($res['server_data'] as $key =>$server_2)
                                       <ul>
                                         <li>Tập {{$server_2['name']}}
                                             <input type="text" class="form-control" value="{{$server_2['link_m3u8']}}">
                                         </li>
                                       </ul> 
                                    @endforeach 
                                 </td>
                                <td>{{ $resp['movie']['name'] }}</td>
                                <td>{{ $resp['movie']['slug'] }}</td>
                                <td>{{ $resp['movie']['episode_total'].' Tập' }}</td>
                                <td>{{ $resp['movie']['episode_current'] }}</td>

                                
                                <td>
                                    <td>{{ $res['server_name'] }}</td>
                                </td>
                                <td>
                                    <form method="POST" action="">
                                        @csrf
                                        <input type="submit" value="Thêm tâp phim" class="btn btn-success btn sm">
                                    </form>

                                    <form method="POST" action="">
                                        @csrf
                                        <input type="submit" value="Xóa tâp phim" class="btn btn-danger btn sm">
                                    </form>
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

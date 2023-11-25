<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{ route('home') }}">Trang Chủ</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{route('info.create') }}">Thông Tin Website</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('category.index') }}">Danh Mục Phim</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="{{route('genre.index')}}">Thể Loại</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('country.index')}}">Quốc Gia</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('movie.index')}}">Phim</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('episode.index')}}">Tập Phim</a>
      </li>
      {{-- <li class="nav-item">
        <a class="nav-link" href="{{route('user.index')}}">Tài Khoản</a>
      </li> --}}

    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="..." aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm Kiếm</button>
    </form>
  </div>
</nav>
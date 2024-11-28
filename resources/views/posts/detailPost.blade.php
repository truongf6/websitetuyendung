@extends('layout.layout')
@section('content')
<style>
    .content-post img {
        width: 100% !important;
        height: auto !important;
    }
    .single-carousel img {
        max-width: inherit !important;
    }
</style>
<section class="section-hero overlay inner-page bg-image" style="background-image: url('/temp/assets/images/hero_1.jpg');" id="home-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="custom-breadcrumbs mb-0 text-white font-weight-bold">
            <span class="slash text-white font-weight-bold">Đăng bởi</span> Admin 
            <span class="mx-2 slash">•</span>
            <span class="text-white"><strong>{{$post->created_at}}</strong></span>
          </div>
          <h1 class="text-white">{{$post->Title}}</h1>
        </div>
      </div>
    </div>
  </section>
  <section class="site-section" id="next-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 blog-content">
          <h3 class="mb-4">{{$post->Title}}</h3>
          {{-- <div class="post-thumbnils">
            <img class="w-100" src="/temp/images/post/{{$post->thumb}}" alt="Ảnh của bài viết {{ $post->Title }}">
        </div> --}}
            <div class="content-post">
                {!! $post->content !!}
            </div>
        </div>
        {{-- <div class="col-lg-4 sidebar pl-lg-5">
          <div class="sidebar-box">
            <form action="#" class="search-form">
              <div class="form-group">
                <span class="icon fa fa-search"></span>
                <input type="text" class="form-control form-control-lg" placeholder="Nhập từ khóa và nhấn Enter">
              </div>
            </form>
          </div>
          <div class="sidebar-box">
            <img src="images/person_1.jpg" alt="Ảnh minh họa" class="img-fluid mb-4 w-50 rounded-circle">
            <h3>Về tác giả</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos fugit cupiditate numquam!</p>
            <p><a href="#" class="btn btn-primary btn-sm">Đọc thêm</a></p>
          </div>

          <div class="sidebar-box">
            <div class="categories">
              <h3>Danh mục</h3>
              <li><a href="#">Sáng tạo <span>(12)</span></a></li>
              <li><a href="#">Tin tức <span>(22)</span></a></li>
              <li><a href="#">Thiết kế <span>(37)</span></a></li>
              <li><a href="#">HTML <span>(42)</span></a></li>
              <li><a href="#">Phát triển Web <span>(14)</span></a></li>
            </div>
          </div>
          

          <div class="sidebar-box">
            <h3>Đoạn văn</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos fugit cupiditate numquam!</p>
          </div>
        </div> --}}
      </div>
    </div>
  </section>
  <section class="bg-light py-5 testimony-full">
      
    <h1 class="text-center font-weight-bold my-4">Các bài viết liên quan</h1>
    <div class="owl-carousel single-carousel">
        @foreach($listPosts as $item)
            <div class="p-4">
                <a href="{{ route('detailPost', $item->slug) }}"><img src="{{ asset("temp/images/post/" . $item->thumb) }}" alt="Hình ảnh bài viết" class="img-fluid rounded mb-4"></a>
                <h3><a href="{{ route('detailPost', $item->slug) }}" class="text-black">{{$item->Title}}</a></h3>
                <div>{{$item->created_at}} <span class="mx-2">|</span> <a href="#">2 Bình luận</a></div>
            </div>
        @endforeach
    </div>

</section>
@endsection

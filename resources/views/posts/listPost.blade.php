@extends('layout.layout')
@section('content')
<section class="section-hero overlay inner-page bg-image" style="background-image: url('/temp/assets/images/hero_1.jpg');" id="home-section">
    <div class="container">
      <div class="row">
        <div class="col-md-7">
          <h1 class="text-white font-weight-bold">Bài viết</h1>
          <div class="custom-breadcrumbs">
            <a href="/">Trang chủ</a> <span class="mx-2 slash">/</span>
            <span class="text-white"><strong>Danh sách bài viết</strong></span>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="site-section">
    <div class="container">
      <div class="row mb-5">
        @foreach($listPosts as $item)
        <div class="col-md-6 col-lg-4 mb-5">
            <a href="{{ route('detailPost', $item->slug) }}"><img src="{{ asset("temp/images/post/" . $item->thumb) }}" alt="Image" class="img-fluid rounded mb-4"></a>
            <h3><a href="{{ route('detailPost', $item->slug) }}" class="text-black">{{$item->Title}}</a></h3>
            <div>{{$item->created_at}} <span class="mx-2">|</span> <a href="#">2 Comments</a></div>
          </div>
        @endforeach
      </div>
      <div class="pagination mt-4 pb-4">
        {{ $listPosts->links() }}
    </div>
      
    </div>
  </section>
@endsection
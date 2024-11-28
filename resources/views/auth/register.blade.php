@extends('layout.layout')
@section('content')
<section class="section-hero overlay inner-page bg-image" style="background-image: url('/temp/assets/images/hero_1.jpg');" id="home-section">
    <div class="container">
      <div class="row">
        <div class="col-md-7">
          <h1 class="text-white font-weight-bold">Đăng ký tài khoản</h1>
          <div class="custom-breadcrumbs">
            <a href="/">Trang chủ</a> <span class="mx-2 slash">/</span>
            <span class="text-white"><strong>Đăng ký</strong></span>
          </div>
        </div>
      </div>
    </div>
  </section>
<section class="site-section">
    <div class="container">
      <div class="row">
        <div class="col-3"></div>
        <div class="col-lg-6 mb-5">
          <h2 class="mb-4 text-center font-weight-bold">Đăng ký </h2>
          <div class="error">
            @include('admin.error')
        </div>  
          <form action="{{route('register')}}" method="post" class="p-4 border rounded">
            @csrf
            <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Full Name</label>
                  <input type="text" class="form-control" placeholder="Email address" name="name">
                </div>
              </div>
            <div class="row form-group">
              <div class="col-md-12 mb-3 mb-md-0">
                <label class="text-black" for="fname">Email</label>
                <input type="email" class="form-control" placeholder="Email address" name="email">
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-12 mb-3 mb-md-0">
                <label class="text-black" for="fname">Password</label>
                <input type="password" class="form-control" placeholder="Password" name="password">
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-12 mb-3 mb-md-0">
                <label class="text-black" for="fname">Re-Type Password</label>
                <input type="password" class="form-control" placeholder="Re-type Password" name="confirmPassword">
              </div>
            </div>
            <div class="row form-group mb-4">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Chọn thể loại</label>
                  <select class="" name="type" id="">
                    <option value="2">Đăng kí cho nhà tuyển dụng</option>
                    <option value="3">Đăng kí cho người tìm việc</option>
                  </select>
                </div>
              </div>
            <div class="row form-group">
              <div class="col-md-12">
                <input type="submit" value="Đăng ký" class="btn px-4 btn-primary text-white">
                <div>
                  Đã có tài khoản?
                  <a href="{{route('showLogin')}}" class="fw-bold text-info"> Đăng nhập</a>
                </div>
              </div>
            </div>

          </form>
        </div>
        <div class="col-3"></div>
      </div>
    </div>
  </section>
@endsection
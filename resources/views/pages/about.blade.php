@extends('layout.layout')
@section('content')
<style>
  .img-shadow{
    height: 275px;
    object-fit: cover; 
  }
</style>
<section class="section-hero overlay inner-page bg-image" style="background-image: url('/temp/assets/images/hero_1.jpg');" id="home-section">
    <div class="container">
      <div class="row">
        <div class="col-md-7">
          <h1 class="text-white font-weight-bold">Về chúng tôi</h1>
          <div class="custom-breadcrumbs">
            <a href="/">Trang chủ</a> <span class="mx-2 slash">/</span>
            <span class="text-white"><strong>Về chúng tôi</strong></span>
          </div>
        </div>
      </div>
    </div>
</section>

<section class="py-5 bg-image overlay-primary fixed overlay" id="next-section" style="background-image: url('images/hero_1.jpg');">
    <div class="container">
      <div class="row mb-5 justify-content-center">
        <div class="col-md-7 text-center">
          <h2 class="section-title mb-2 text-white">Thống kê JobBoard</h2>
          <p class="lead text-white">Nơi tập trung hàng nghìn cơ hội việc làm, tạo sự kết nối giữa nhà tuyển dụng và ứng viên.</p>
        </div>
      </div>
      <div class="row pb-0 block__19738 section-counter">

        <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
          <div class="d-flex align-items-center justify-content-center mb-2">
            <strong class="number" data-number="{{$count_employee}}">0</strong>
          </div>
          <span class="caption">Người tìm việc</span>
        </div>

        <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
          <div class="d-flex align-items-center justify-content-center mb-2">
            <strong class="number" data-number="{{$count_job}}">0</strong>
          </div>
          <span class="caption">Công việc đã đăng</span>
        </div>

        <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
          <div class="d-flex align-items-center justify-content-center mb-2">
            <strong class="number" data-number="{{$applied}}">0</strong>
          </div>
          <span class="caption">Công việc đã nạp đơn</span>
        </div>

        <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
          <div class="d-flex align-items-center justify-content-center mb-2">
            <strong class="number" data-number="{{$company}}">0</strong>
          </div>
          <span class="caption">Công ty</span>
        </div>

          
      </div>
    </div>
</section>

<section class="site-section pb-5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <img src="/temp/images/about2.png" width="570" height="275" alt="Image" class="img-fluid img-shadow">

        </div>
        <div class="col-lg-5 ml-auto">
          <h2 class="section-title mb-3">JobBoard dành cho Freelancers và Lập trình viên</h2>
          <p class="lead">Cơ hội tuyệt vời để kết nối với các dự án phù hợp và kiếm thu nhập tốt hơn mỗi ngày.</p>
          <p>Nền tảng giúp bạn dễ dàng tìm kiếm công việc từ các công ty uy tín, xây dựng hồ sơ chuyên nghiệp và tăng khả năng được tuyển dụng.</p>
        </div>
      </div>
    </div>
</section>

<section class="site-section pt-0 pb-5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0 order-md-2">
            <img src="/temp/images/about1.png" width="570" height="275" alt="Image" class="img-fluid img-shadow">
        </div>
        <div class="col-lg-5 mr-auto order-md-1 mb-5 mb-lg-0">
          <h2 class="section-title mb-3">JobBoard dành cho Người lao động</h2>
          <p class="lead">Chúng tôi tạo điều kiện cho bạn tiếp cận với hàng nghìn cơ hội việc làm hấp dẫn.</p>
          <p>Khám phá các vị trí phù hợp với kỹ năng và kinh nghiệm của bạn, từ đó đạt được mục tiêu nghề nghiệp nhanh chóng và hiệu quả.</p>
        </div>
      </div>
    </div>
</section>

<section class="pb-5 mb-5">
    <div class="container">
      <div class="row mb-5">
        <div class="col-12 text-center" data-aos="fade">
          <h2 class="section-title mb-3">Đội ngũ của chúng tôi</h2>
        </div>
      </div>

      <div class="row align-items-center block__69944">

        <div class="col-md-6">
          <img src="/temp/images/about3.png" width="570" height="275" alt="Image" class="img-fluid img-shadow">
        </div>

        <div class="col-md-6">
          <h3>Biện Đan Trường</h3>
          <p class="text-muted">Giám đốc Sáng tạo</p>
          <p>Elisabeth mang đến sự đổi mới và sáng tạo vượt bậc trong từng chiến dịch. Tôi có kinh nghiệm làm việc với các thương hiệu hàng đầu và luôn mang lại giá trị vượt mong đợi.</p>
          <div class="social mt-4">
            <a href="#"><span class="icon-facebook"></span></a>
            <a href="#"><span class="icon-twitter"></span></a>
            <a href="#"><span class="icon-instagram"></span></a>
            <a href="#"><span class="icon-linkedin"></span></a>
          </div>
        </div>

        {{-- <div class="col-md-6 order-md-2 ml-md-auto">
          <img src="/temp/images/about4.png" width="570" height="275" alt="Image" class="img-fluid img-shadow">
        </div>

        <div class="col-md-6">
          <h3>Chintan Patel</h3>
          <p class="text-muted">Giám đốc Kỹ thuật</p>
          <p>Chintan chịu trách nhiệm quản lý các dự án công nghệ, đảm bảo hệ thống luôn hoạt động trơn tru và hiệu quả. Anh mang đến các giải pháp kỹ thuật tiên tiến, phù hợp với nhu cầu của từng khách hàng.</p>
          <div class="social mt-4">
            <a href="#"><span class="icon-facebook"></span></a>
            <a href="#"><span class="icon-twitter"></span></a>
            <a href="#"><span class="icon-instagram"></span></a>
            <a href="#"><span class="icon-linkedin"></span></a>
          </div>
        </div> --}}
    </div>
  </div>
</section>
@endsection

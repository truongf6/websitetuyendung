@extends('layout.layout')
@section('content')
<section class="section-hero overlay inner-page bg-image" style="background-image: url('/temp/assets/images/hero_1.jpg');" id="home-section">
    <div class="container">
      <div class="row">
        <div class="col-md-7">
          <h1 class="text-white font-weight-bold">Liên hệ chúng tôi</h1>
          <div class="custom-breadcrumbs">
            <a href="/">Trang chủ</a> <span class="mx-2 slash">/</span>
            <span class="text-white"><strong>Liên hệ chúng tôi</strong></span>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="site-section" id="next-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <form action="{{route('postContact')}}" method="post" class="" id="formContact">
            @csrf
            <div class="row form-group">
              <div class="col-md-6 mb-3 mb-md-0">
                <label class="text-black" for="fname">Tên đầy đủ</label>
                <input type="text" id="fname" name="fullname" required class="form-control input-field" data-require="Vui lòng nhập tên!" placeholder="Nhập tên">
              </div>
              <div class="col-md-6">
                <label class="text-black" for="lname">Số điện thoại</label>
                <input type="text" id="lname" name="phone_number" required class="form-control" placeholder="Nhập số điện thoại">
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-12">
                <label class="text-black" for="email">Email</label> 
                <input type="email" name="email" required class="form-control input-field" data-require="Vui lòng nhập Email!" placeholder="Nhập Email">
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-12">
                <label class="text-black" for="subject">Tiêu đề</label> 
                <input type="subject" id="subject" name="title" required class="form-control input-field" data-require="Vui lòng nhập tiêu đề!" placeholder="Nhập tiêu đề">
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-12">
                <label class="text-black" for="message">Nội dung</label> 
                <textarea id="message" required name="contents" cols="30" rows="7" class="form-control input-field" data-require="Vui lòng nhập nội dung!" placeholder="Nhập nội dung phản hồi ở đây..."></textarea>
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-12">
                <button type="submit" class="btn btn-primary btn-md text-white">Gửi phản hồi</button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-lg-5 ml-auto">
          <div class="p-4 mb-3 bg-white">
            <p class="mb-0 font-weight-bold">Địa chỉ</p>
            <p class="mb-4">Đại học Vinh</p>

            <p class="mb-0 font-weight-bold">Số điện thoại</p>
            <p class="mb-4"><a href="#">+1 232 3235 324</a></p>

            <p class="mb-0 font-weight-bold">Địa chỉ Email</p>
            <p class="mb-0"><a href="#">biendantruong@gmail.com</a></p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="site-section bg-light">
    <div class="container">
      <div class="row mb-5">
        <div class="col-12 text-center" data-aos="fade">
          <h2 class="section-title mb-3">Khách hàng hài lòng nói gì</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="block__87154 bg-white rounded">
            <blockquote>
              <p>
                "Tôi thực sự hài lòng khi làm việc với đội ngũ chuyên nghiệp. Họ luôn lắng nghe và đáp ứng mọi yêu cầu của tôi một cách nhanh chóng và hiệu quả. Quả thực, đây là một trải nghiệm tuyệt vời và đáng nhớ."
              </p>
            </blockquote>
            <div class="block__91147 d-flex align-items-center">
              <figure class="mr-4"><img src="/temp/assets/images/person_1.jpg" alt="Image" class="img-fluid"></figure>
              <div>
                <h3>Elisabeth Smith</h3>
                <span class="position">Doanh nhân thành đạt</span>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="block__87154 bg-white rounded">
            <blockquote>
              <p>
                "Dịch vụ tuyệt vời! Tôi cảm thấy được hỗ trợ tận tình và đội ngũ luôn sẵn sàng đưa ra các giải pháp sáng tạo, phù hợp với nhu cầu của tôi. Rất vui khi chọn họ là đối tác."              </p>
            </blockquote>
            <div class="block__91147 d-flex align-items-center">
              <figure class="mr-4"><img src="/temp/assets/images/person_2.jpg" alt="Image" class="img-fluid"></figure>
              <div>
                <h3>Chris Peter</h3>
                <span class="position">Nhà thiết kế Web</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

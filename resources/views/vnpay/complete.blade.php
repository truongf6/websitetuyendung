@extends('layout.layout')
@section('content')
<section class="section-hero overlay inner-page bg-image" style="background-image: url('/temp/assets/images/hero_1.jpg');" id="home-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="custom-breadcrumbs mb-0 text-white font-weight-bold">
            <span class="slash text-white font-weight-bold">Nạp tiền
          </div>
          <h1 class="text-white">Nạp tiền thành công!</h1>
          
        </div>
      </div>
    </div>
</section>
<section class="pb-5" id="next-section">
    <div class="">
        <div class="site-cart__wrapper py-5 mt-5 mx-auto border rounded" style="max-width:700px">
            <div class="d-flex align-items-center justify-content-center">
                <img src="/temp/images/check_success.png" width="100px" alt="">
                <h1 class="fw-bold">Nạp tiền thành công</h1>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <div class="">
                    <div class="d-flex mb-3 align-items-center border-bottom">
                        <h3 class="fw-bold mr-2"> <i> Số hóa đơn: </i></h3>
                        <h4> {{ $checkout->order_code }}</h4>
                    </div>
                    <div class="d-flex mb-3 align-items-center border-bottom">
                        <h3 class="fw-bold mr-2"> <i> Số tiền nạp: </i></h3>
                        <h4> {{ number_format($checkout->amount_money, 0, ',', '.') }} đ</h4>
                    </div>
                    <div class="d-flex mb-3 align-items-center border-bottom">
                        <h3 class="fw-bold mr-2"> <i> Trạng thái: </i></h3>
                        <h4>Thành công</h4>
                    </div>
                    <div class="d-flex mb-3 align-items-center border-bottom">
                        <h3 class="fw-bold mr-2"> <i> Date: </i></h3>
                        <h4> {{ $checkout->created_at }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
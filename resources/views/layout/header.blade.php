<style>
  /* .dropdown:hover .dropdown-menu {
    display: block;
} */

.dropdown-menu {
    margin-top: 0; /* Để căn chỉnh menu không bị lệch */
}
.dropdown-user{
    width: 180px;
}
</style>
<header class="site-navbar mt-3">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="site-logo col-6"><a href="/">Web tuyển dụng</a></div>

        <nav class="mx-auto site-navigation">
          <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0 font-weight-bold">
            <li class="" style="font-size:15px"><a href="/" class="nav-link active" style="padding: 5px !important">Trang chủ</a></li>
            <li class="" style="font-size:15px"><a href="{{route('about')}}" style="padding: 5px !important">Giới thiệu</a></li>
            <li class="" style="font-size:15px">
              <a href="{{route('jobList')}}" style="padding: 5px !important">Danh sách công việc</a>
            </li>
            <li class="" style="font-size:15px"><a href="{{route('listPost')}}" style="padding: 5px !important">Bài viết</a></li>
            <li class="" style="font-size:15px"><a href="{{route('contact')}}" style="padding: 5px !important">Liên hệ</a></li>
            @if(Auth::check() && Auth::user()->role_id != 3)
            <li class="d-lg-none"><a href="{{route('postJobPage')}}"><span class="mr-2">+</span> Đăng công việc</a></li>
            @endif
            <li class="d-lg-none"><a href="{{route('showLogin')}}">Đăng nhập</a></li>
          </ul>
        </nav>
        <!-- Modal Thông báo -->
        <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content text-dark">
              <div class="modal-header">
                <h5 class="modal-title" id="infoModalLabel">Thông báo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                @if($newAppliedCv)
                  @foreach($newAppliedCv as $item)
                  <a href="{{ route('jobApplications', $item->job_id) }}" class="text-dark">
                    <i class="font-weight-bold">{{$item->created_at}}</i>
                    <p class="border-bottom pb-3">Người dùng <b><u>{{ $item->user->name }}</u></b> đã ứng tuyển công việc <b><u>{{ $item->job->title }}</u></b> trên website.</p>
                  </a>
                  @endforeach
                @endif
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <div class="right-cta-menu text-right d-flex align-items-center col-6">
          <div class="ml-auto d-flex align-items-center">
              @if(Auth::check())
                @if(Auth::user()->role_id != 3)
                <div class="ms-auto me-4 payment-contain">
                  @auth
                  <button type="button" class="btn btn-info mr-3" data-toggle="modal" data-target="#exampleModal">
                    Nạp tiền
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document" style="max-width:720px">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Nạp tiền vào tài khoản - ( Số dư: @if(Auth::user()->money === null) 0đ @else <span class="money">{{ number_format(Auth::user()->money, 0, ',', '.') }} đ</span> @endif )</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form id="form-pay__money" action="{{route('checkout.payment.vnpay')}}" method="post">
                            @csrf
                            <div class="form-group d-flex align-items-center text-nowrap">
                              <label for="" class="me-3 mb-0 fw-bold"> <i class="fa-solid fa-circle-right"></i> Nhập số tiền( VD: 10000 ):</label>
                              <div class="input-group text-black ml-2">
                                  <input id="input-amount__money" type="float" name="amount_money" class="form-control" placeholder="Nhập số tiền > 5000đ">
                                  <span class="input-group-text">VNĐ</span>
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Nạp</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  @else
                      <a href="{{route('login')}}" class="btn btn-info fw-bold">
                          Nạp tiền
                      </a>
                  @endauth
              </div>
                <a href="{{route('postJobPage')}}" class="btn btn-outline-white border-width-2 d-none d-lg-inline-block mr-3">
                    <span class="mr-2 icon-add"></span>Đăng công việc
                </a>
                @endif
              <!-- Menu thả xuống cho 'Trang cá nhân' -->
              <div class="dropdown dropdown-user">
                @if(Auth::user()->role_id === 3)
                    <a href="#" class="btn btn-primary border-width-2 d-none d-lg-inline-block mr-3 dropdown-toggle"
                    id="personalMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                    {{Auth::user()->name}}
                  </a>
                @else
                  <a href="#" class="btn btn-primary border-width-2 d-none d-lg-inline-block mr-3 dropdown-toggle"
                      id="personalMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <span class="badge badge-danger rounded-circle position-absolute d-flex align-items-center justify-content-center" style="right:5%; top:-20%; width:25px; font-size:16px">{{$count_newAppliedCv}}</span>
                      {{Auth::user()->name}} - @if(Auth::user()->money === null) 0đ @else <br> <span class="money">{{ number_format(Auth::user()->money, 0, ',', '.') }} đ</span> @endif
                    </a>
                @endif
                  <div class="dropdown-menu text-center dropdown-user" aria-labelledby="personalMenu">
                      <a class="dropdown-item" href="{{route('profile')}}">Thông tin cá nhân</a>


                      <a class="dropdown-item" href="{{route('changePassword')}}">Đổi mật khẩu</a>
                        @if(Auth::user()->role_id != 3)
                        <button type="button" class="btn dropdown-item d-flex align-items-center justify-content-center" data-toggle="modal" data-target="#infoModal">Thông báo<span class="badge ml-2 badge-danger rounded-circle d-flex align-items-center justify-content-center" style="width:25px ;font-size:16px">{{$count_newAppliedCv}}</span></button>
                        <a class="dropdown-item" href="{{route('viewJobPage')}}">Công việc đã Đăng</a>
                        <a class="dropdown-item" href="{{route('checkout.history')}}">Lịch sử nạp tiền</a>
                        @else
                        <a class="dropdown-item" href="{{route('CvApplied')}}">Công việc đã ứng tuyển</a>
                        <a class="dropdown-item" href="{{route('JobSaved')}}">Công việc đã lưu lại</a>
                        @endif
                      <form class="text-center" action="{{route('logout')}}" method="post">
                        @csrf
                        <button type="submit" class="border-0 bg-white">Đăng xuất</button>
                      </form>
                  </div>
              </div>
              @else
              <a href="{{route('showLogin')}}" class="btn btn-primary border-width-2 d-none d-lg-inline-block ">
                  <span class="mr-2 icon-lock_outline"></span>Đăng nhập/ Đăng ký
              </a>
              @endif
          </div>
          <a href="#" class="site-menu-toggle js-menu-toggle d-inline-block d-xl-none mt-lg-2 ml-3">
              <span class="icon-menu h3 m-0 p-0 mt-2"></span>
          </a>
      </div>


      </div>
    </div>
  </header>

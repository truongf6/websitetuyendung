@extends('admin.main')
@section('contents')
    <!-- / Navbar -->
    <!-- Content wrapper -->
    <div class='content-wrapper'>
        <!-- Content -->
        <div class='container-xxl flex-grow-1 container-p-y'>
            <div class='row'>
                <div class='col-12 mb-4 order-0'>
                    <div class='card'>
                        <div class='d-flex align-items-end row'>
                            <div class='col-sm-7'>
                                <div class='card-body'>
                                    <h5
                                        class='card-title text-primary'
                                    >Congratulations ! 🎉</h5>
                                    <p class='mb-4'>
                                        You have done
                                        <span class='fw-bold'>72%</span>
                                        more sales today. Check your new badge in
                                        your profile.
                                    </p>
                                    <a
                                        href='javascript:;'
                                        class='btn btn-sm btn-outline-primary'
                                    >View Badges</a>
                                </div>
                            </div>
                            <div class='col-sm-5 text-center text-sm-left'>
                                <div class='card-body pb-0 px-0 px-md-4'>
                                    <img
                                        src='/temp/admin/assets/img/illustrations/man-with-laptop-light.png'
                                        height='140'
                                        alt='View Badge User'
                                        data-app-dark-img='illustrations/man-with-laptop-dark.png'
                                        data-app-light-img='illustrations/man-with-laptop-light.png'
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='col-12 order-1'>
                    <h3>Thống kê</h3>
                    <div class='row'>
                        <div class="col-lg-4 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block mb-1 fs-5">Tổng doanh thu</span>

                                        <div class="avatar flex-shrink-0">
                                            <img
                                            src='/temp/admin/assets/img/icons/unicons/chart-success.png'
                                            alt='chart success'
                                            class='rounded'
                                        />                                        </div>
                                    </div>
                                    <h3 class="card-title mb-2">{{ number_format((float)str_replace(',', '', $tongdoanhthu), 0, ',', '.') }} đ</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block mb-1 fs-5">Doanh thu tháng này</span>

                                        <div class="avatar flex-shrink-0">
                                            <img
                                            src='/temp/admin/assets/img/icons/unicons/chart-success.png'
                                            alt='chart success'
                                            class='rounded'
                                        />                                        </div>
                                    </div>
                                    <h3 class="card-title mb-2">{{ number_format((float)str_replace(',', '', $tongdoanhthuThangNay), 0, ',', '.') }} đ</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block mb-1 fs-5">Doanh thu hôm nay</span>

                                        <div class="avatar flex-shrink-0">
                                            <img
                                            src='/temp/admin/assets/img/icons/unicons/chart-success.png'
                                            alt='chart success'
                                            class='rounded'
                                        />                                        </div>
                                    </div>
                                    <h3 class="card-title mb-2">{{ number_format((float)str_replace(',', '', $tongdoanhthuHomNay), 0, ',', '.') }} đ</h3>
                                </div>
                            </div>
                        </div>



                        <div class="col-lg-3 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block mb-1 fs-5">Tài khoản quản trị</span>

                                        <div class="avatar flex-shrink-0">
                                            <img
                                            src='/temp/admin/assets/img/icons/unicons/chart-success.png'
                                            alt='chart success'
                                            class='rounded'
                                        />                                        </div>
                                    </div>
                                    <h3 class="card-title mb-2">{{$count_userAdmin}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block mb-1 fs-5">Tài khoản công ty</span>

                                        <div class="avatar flex-shrink-0">
                                            <img
                                            src='/temp/admin/assets/img/icons/unicons/chart-success.png'
                                            alt='chart success'
                                            class='rounded'
                                        />                                        </div>
                                    </div>
                                    <h3 class="card-title mb-2">{{$count_company}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block mb-1 fs-5">Tài khoản tìm việc</span>

                                        <div class="avatar flex-shrink-0">
                                            <img
                                            src='/temp/admin/assets/img/icons/unicons/chart-success.png'
                                            alt='chart success'
                                            class='rounded'
                                        />                                        </div>
                                    </div>
                                    <h3 class="card-title mb-2">{{$count_employee}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block mb-1 fs-5">Danh mục công việc</span>

                                        <div class="avatar flex-shrink-0">
                                            <img
                                            src='/temp/admin/assets/img/icons/unicons/chart-success.png'
                                            alt='chart success'
                                            class='rounded'
                                        />                                        </div>
                                    </div>
                                    <h3 class="card-title mb-2">{{$job_cate}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block mb-1 fs-5">Công việc đã đăng</span>

                                        <div class="avatar flex-shrink-0">
                                            <img
                                            src='/temp/admin/assets/img/icons/unicons/chart-success.png'
                                            alt='chart success'
                                            class='rounded'
                                        />                                        </div>
                                    </div>
                                    <h3 class="card-title mb-2">{{$job}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block mb-1 fs-5">Công ty đăng tuyển</span>

                                        <div class="avatar flex-shrink-0">
                                            <img
                                            src='/temp/admin/assets/img/icons/unicons/chart-success.png'
                                            alt='chart success'
                                            class='rounded'
                                        />                                        </div>
                                    </div>
                                    <h3 class="card-title mb-2">{{$company}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block mb-1 fs-5">CV đã ứng tuyển</span>

                                        <div class="avatar flex-shrink-0">
                                            <img
                                            src='/temp/admin/assets/img/icons/unicons/chart-success.png'
                                            alt='chart success'
                                            class='rounded'
                                        />                                        </div>
                                    </div>
                                    <h3 class="card-title mb-2">{{$applied}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block mb-1 fs-5">Bài viết </span>

                                        <div class="avatar flex-shrink-0">
                                            <img
                                            src='/temp/admin/assets/img/icons/unicons/chart-success.png'
                                            alt='chart success'
                                            class='rounded'
                                        />                                        </div>
                                    </div>
                                    <h3 class="card-title mb-2">{{$post}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block mb-1 fs-5">Phản hồi </span>

                                        <div class="avatar flex-shrink-0">
                                            <img
                                            src='/temp/admin/assets/img/icons/unicons/chart-success.png'
                                            alt='chart success'
                                            class='rounded'
                                        />                                        </div>
                                    </div>
                                    <h3 class="card-title mb-2">{{$feedback}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Total Revenue -->
                <!--/ Total Revenue -->
            </div>
        </div>
        <!-- / Content -->
        <!-- Footer -->
        <footer class='content-footer footer bg-footer-theme'>
            <div
                class='container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column'
            >
                <div class='mb-2 mb-md-0'>
                    ©
                    <script>
                        document.write(new Date().getFullYear());
                    </script>2023 , made with ❤️ by
                    <a
                        href='https://themeselection.com'
                        target='_blank'
                        class='footer-link fw-bolder'
                    >Biện Đan Trường</a>
                </div>
                <div>
                    <a
                        href='https://themeselection.com/license/'
                        class='footer-link me-4'
                        target='_blank'
                    >License</a>
                    <a
                        href='https://themeselection.com/'
                        target='_blank'
                        class='footer-link me-4'
                    >More Themes</a>
                    <a
                        href='https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/'
                        target='_blank'
                        class='footer-link me-4'
                    >Documentation</a>
                    <a
                        href='https://github.com/themeselection/sneat-html-admin-template-free/issues'
                        target='_blank'
                        class='footer-link me-4'
                    >Support</a>
                </div>
            </div>
        </footer>
        <!-- / Footer -->
        <div class='content-backdrop fade'></div>
    </div>
    <!-- Content wrapper -->
@endsection

@extends('layout.layout')
@section('content')
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('/temp/assets/images/hero_1.jpg');"
        id="home-section">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h1 class="text-white font-weight-bold">Công việc đã lưu lại</h1>
                    <div class="custom-breadcrumbs">
                        <a href="/">Trang chủ</a> <span class="mx-2 slash">/</span>
                        <span class="text-white"><strong>Dơn đã lưu lại</strong></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="site-section">
        <div class="container">

            <div class="row align-items-center mb-5">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2>Công việc đã lưu lại</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-lg-12">
                    <table class="table table-dark">
                        <thead>
                            <tr class="text-nowrap">
                                <th>STT</th>
                                <th>Hình ảnh</th>
                                <th>Tiêu đề công việc</th>
                                <th>Vị trí</th>
                                <th>Công ty</th>
                                <th>Địa chỉ</th>
                                <th>Thời gian làm việc</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($favourites as $favourite)
                                <tr data-id="{{ $favourite->Job->id }}">
                                    <td> {{ $loop->iteration }}</td>
                                    <td><img src="{{ asset("temp/images/job/" . $favourite->Job->thumb) }}"
                                        alt="{{ $favourite->Job->title }}" srcset="{{ $favourite->Job->title }}" width="90px"
                                        height="90px"></td>
                                        <td>{{ $favourite->Job->title }}</td>
                                    <td>{{ $favourite->Job->position }}</td>
                                    <td>{{ $favourite->Job->Company->name }}</td>
                                    <td>{{ $favourite->Job->location ?? '' }}</td>
                                    <td>{{ $favourite->Job->type }}</td>
                                    <td class="">
                                        <a href="{{ route('jobDetail', $favourite->Job->slug) }}" type="button"
                                            class="btn btn-info btnDeleteAsk px-2 me-2 py-1 fw-bolder text-nowrap"
                                            data-bs-toggle="modal" data-bs-target="#modalDetail{{ $favourite->Job->id }}">Chi
                                            tiết
                                        </a>
                                        <a href="#" type="button" class="btn btn-danger remove-job-btn px-2 me-2 py-1 fw-bolder" data-job-id="{{ $favourite->Job->id }}">Bỏ lưu
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <div class="pagination mt-4 pb-4">
                        {{ $favourites->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $('.remove-job-btn').on('click', function(e) {
            e.preventDefault();

            let job_id = $(this).data('job-id');

            $.ajax({
                url: "{{ route('favourite.destroy') }}",
                method: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}",
                    job_id: job_id
                },
                success: function(response) {
                    if(response.status === 'success') {
                        alert(response.message);
                        window.location.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    if(xhr.status === 401) {
                        alert("Bạn cần đăng nhập để bỏ lưu công việc");
                    } else {
                        alert("Đã xảy ra lỗi, vui lòng thử lại sau");
                    }
                }
            });
        });
    </script>
@endsection

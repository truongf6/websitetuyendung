@extends('layout.layout')
@section('content')
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('/temp/assets/images/hero_1.jpg');"
        id="home-section">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h1 class="text-white font-weight-bold">Công việc đã ứng tuyển</h1>
                    <div class="custom-breadcrumbs">
                        <a href="/">Trang chủ</a> <span class="mx-2 slash">/</span>
                        <span class="text-white"><strong>Dơn đã ứng tuyển</strong></span>
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
                            <h2>Công việc đã ứng tuyển</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-lg-12">
                    <table class="table table-dark table-hover">
                        <thead>
                            <tr class="text-nowrap">
                                <th>STT</th>
                                <th>Hình ảnh</th>
                                <th>Tiêu đề công việc</th>
                                <th>Vị trí</th>
                                <th>Công ty</th>
                                <th>Địa chỉ</th>
                                <th>Thời gian làm việc</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($applications as $application)
                                <tr data-id="{{ $application->Job->id }}">
                                    <td> {{ $loop->iteration }}</td>
                                    <td><img src="{{ asset("temp/images/job/" . $application->Job->thumb) }}"
                                        alt="{{ $application->Job->title }}" srcset="{{ $application->Job->title }}" width="90px"
                                        height="90px"></td>
                                        <td>{{ $application->Job->title }}</td>
                                    <td>{{ $application->Job->position }}</td>
                                    <td>{{ $application->Job->Company->name }}</td>
                                    <td>{{ $application->Job->location ?? '' }}</td>
                                    <td>{{ $application->Job->type }}</td>
                                    <td>
                                        @if($application->status === null)
                                            <span class="badge bg-warning text-dark p-2">Chưa duyệt</span>
                                        @else
                                            @if ($application->status === 0)
                                                <span class="badge bg-danger text-white p-2 ">Đã từ chối</span>
                                            @elseif ($application->status === 1)
                                                <span class="badge bg-success p-2 ">Đã duyệt</span>
                                            @endif
                                        @endif
                                    </td>
                                    {{-- @if($application->status == null)
                                        <td class="text-warning text-wrap font-weight-bold">Đang chờ duyệt</td>
                                    @elseif($application->status == 0)
                                        <td class="text-danger text-wrap font-weight-bold" font-weight-bold>Không được duyệt</td>
                                    @else
                                        <td class="text-success text-wrap font-weight-bold">Đã duyệt</td>
                                    @endif --}}
                                    <td class="">
                                        <a href="{{ route('jobDetail', $application->Job->slug) }}" type="button"
                                            class="btn btn-info btnDeleteAsk px-2 me-2 py-1 fw-bolder text-nowrap"
                                            data-bs-toggle="modal" data-bs-target="#modalDetail{{ $application->Job->id }}">Chi
                                            tiết
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <div class="pagination mt-4 pb-4">
                        {{ $applications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

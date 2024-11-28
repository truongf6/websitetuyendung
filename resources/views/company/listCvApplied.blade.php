@extends('layout.layout')

@section('content')
<section class="section-hero overlay inner-page bg-image" style="background-image: url('/temp/assets/images/hero_1.jpg');" id="home-section">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1 class="text-white font-weight-bold">Đơn nạp</h1>
                <div class="custom-breadcrumbs">
                    <a href="/">Trang chủ</a> <span class="mx-2 slash">/</span>
                    <a href="{{ route('viewJobPage') }}">Danh sách công việc</a> <span class="mx-2 slash">/</span>
                    <span class="text-white"><strong>Đơn nạp</strong></span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="site-section">
    <div class="container">
        <h2 class="mb-4">Danh sách ứng tuyển cho công việc: <u class="font-weight-bold">{{ $job->title }}</u></h2>
        <table class="table text-dark table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Ảnh đại diện</th>
                    <th>Tên ứng viên</th>
                    <th>Email</th>
                    <th>CV</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($applications as $application)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($application->user->thumb == null)
                                <i class="fa-regular fa-user border p-2" style="font-size: 40px"></i>
                            @else
                                <img width="40" height="40" src="/temp/images/avatar/{{$application->user->thumb}}">
                            @endif
                        </td>
                        <td>{{ $application->user->name }}</td>
                        <td>{{ $application->user->email }}</td>
                        <td>
                            @if ($application->fileCv)
                                <a class=" font-weight-bold" href="{{ asset("temp/cvs/$application->fileCv") }}" target="_blank">Xem CV</a>
                            @else
                                Không có
                            @endif
                        </td>
                        <td>
                            @if($application->status === null)
                                <span class="badge bg-warning p-2">Chưa duyệt</span>
                            @else
                                @if ($application->status === 0)
                                    <span class="badge bg-danger text-white p-2 ">Đã từ chối</span>
                                @elseif ($application->status === 1)
                                    <span class="badge bg-success p-2 ">Đã duyệt</span>
                                @endif
                            @endif
                        </td>
                        <td class="">
                            @if($application->status === null)

                                <button class="btn btn-success btn-sm btnApprove font-weight-bold" data-id="{{ $application->id }}">Duyệt</button>
                                <button class="btn btn-danger btn-sm btnReject font-weight-bold" data-id="{{ $application->id }}">Hủy</button>                       
                            @else
                                @if ($application->status === 0)
                                    <button class="btn btn-success btn-sm btnApprove font-weight-bold" data-id="{{ $application->id }}">Duyệt lại</button>
                                @elseif ($application->status === 1)
                                <button class="btn btn-danger btn-sm btnReject font-weight-bold" data-id="{{ $application->id }}">Hủy</button>                       
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
            
        </table>
    </div>
</section>
<script>
    // Xử lý nút "Duyệt"
    $('.btnApprove').on('click', function() {
            var applicationId = $(this).data('id'); // Lấy ID của đơn ứng tuyển

            $.ajax({
                url: `/application/${applicationId}/approve`, // Route duyệt đơn
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        location.reload(); // Reload trang để cập nhật trạng thái
                    }
                },
                error: function(xhr) {
                    alert('Có lỗi xảy ra, vui lòng thử lại.');
                }
            });
        });

        // Xử lý nút "Hủy"
        $('.btnReject').on('click', function() {
            var applicationId = $(this).data('id'); // Lấy ID của đơn ứng tuyển

            $.ajax({
                url: `/application/${applicationId}/reject`, // Route hủy đơn
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        location.reload(); // Reload trang để cập nhật trạng thái
                    }
                },
                error: function(xhr) {
                    alert('Có lỗi xảy ra, vui lòng thử lại.');
                }
            });
        });
</script>
@endsection

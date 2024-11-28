@extends('admin.main')
@section('contents')
<style>
    .modal-dialog{
        max-width: 992px;
    }
    .modal-dialog .p{
        text-wrap: auto;
    }
</style>
    <div class="container-fluid flex-grow-1 container-p-y">
        <h3 class="fw-bold text-primary py-3 mb-4">{{ $title }}</h3>
        <div>
            <form class="form-search" method="GET" action="{{ route('jobs.index') }}">
                @csrf
                <div class="d-flex align-items-center mb-4">
                    <h4 class="ten-game me-3 mb-0">Tìm kiếm</h4>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <!-- Tìm kiếm theo tên người đăng -->
                        <div class="col-lg-4 col-sm-6 col-12 mb-3">
                            <input class="form-control shadow-none" type="text" name="search_poster"
                                placeholder="Tìm theo tên người đăng" value="{{ request()->search_poster }}">
                        </div>

                        <!-- Tìm kiếm theo tên công ty -->
                        <div class="col-lg-4 col-sm-6 col-12 mb-3">
                            <input class="form-control shadow-none" type="text" name="search_company"
                                placeholder="Tìm theo tên công ty" value="{{ request()->search_company }}">
                        </div>

                        <!-- Tìm kiếm theo tiêu đề công việc -->
                        <div class="col-lg-4 col-sm-6 col-12 mb-3">
                            <input class="form-control shadow-none" type="text" name="search_title"
                                placeholder="Tìm theo tiêu đề công việc" value="{{ request()->search_title }}">
                        </div>

                        <!-- Tìm kiếm theo vị trí -->
                        <div class="col-lg-4 col-sm-6 col-12 mb-3">
                            <input class="form-control shadow-none" type="text" name="search_position"
                                placeholder="Tìm theo vị trí" value="{{ request()->search_position }}">
                        </div>

                        <!-- Tìm kiếm theo địa chỉ -->
                        <div class="col-lg-4 col-sm-6 col-12 mb-3">
                            <input class="form-control shadow-none" type="text" name="search_location"
                                placeholder="Tìm theo địa chỉ" value="{{ request()->search_location }}">
                        </div>

                        <!-- Tìm kiếm theo kiểu làm việc -->
                        <div class="col-lg-4 col-sm-6 col-12 mb-3">
                            <select class="form-control shadow-none" name="search_type">
                                <option value="">Chọn kiểu làm việc</option>
                                <option value="Full-time" {{ request()->search_type == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                <option value="Part-time" {{ request()->search_type == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                <option value="Freelance" {{ request()->search_type == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                            </select>
                        </div>

                        <!-- Tìm kiếm theo thu nhập -->
                        <div class="col-lg-4 col-sm-6 col-12 mb-3">
                            <input class="form-control shadow-none" type="text" name="search_salary"
                                placeholder="Tìm theo thu nhập" value="{{ request()->search_salary }}">
                        </div>

                        <!-- Nút tìm kiếm và xóa lọc -->
                        <div class="col-lg-4 col-sm-6 col-12 mb-3">
                            <div class="text-center text-nowrap">
                                <button type="submit" class="btn btn-danger rounded-pill">
                                    <i class="fas fa-search me-2"></i>Tìm kiếm
                                </button>
                                <a href="{{ route('jobs.index') }}" class="btn btn-secondary rounded-pill ms-2">
                                    <i class="fas fa-times me-2"></i>Xóa lọc
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Người đăng</th>
                            <th>Hình ảnh</th>
                            <th>Tiêu đề công việc</th>
                            <th>Vị trí</th>
                            <th>Địa chỉ</th>
                            <th>Kiểu làm việc</th>
                            <th>Thu nhập</th>
                            <th>Ngày đăng</th>
                            <th>Tên công ty</th>
                            <th>Ẩn</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if($Jobs->isEmpty())
                            <tr>
                                <td colspan="11" class="text-center">Không tìm thấy công việc nào phù hợp với từ khóa tìm kiếm.</td>
                            </tr>
                        @else
                            @foreach ($Jobs as $job)
                                <tr data-id="{{ $job->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $job->User->name }}</td>
                                    <td><img src="{{ asset("temp/images/job/$job->thumb") }}" alt="{{ $job->title }}"
                                        width="90px" height="90px"></td>
                                    <td>{{ $job->title }}</td>
                                    <td>{{ $job->position }}</td>
                                    <td>{{ $job->location ?? '' }}</td>
                                    <td>{{ $job->type }}</td>
                                    <td>{{ $job->salary }}</td>
                                    <td>{{ $job->created_at }}</td>
                                    <td>{{ $job->Company->name ?? " " }}</td>
                                    <td>
                                        <input type="checkbox" class="toggle-hide" data-id="{{ $job->id }}"
                                               {{ $job->Hide ? 'checked' : '' }}>
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="{{ route('jobDetail', $job->slug) }}" class="btn btn-info px-2 py-1 text-dark fw-bold" target="_blank">Chi tiết</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>

                </table>
                <div class="pagination mt-4 pb-4">
                    {{ $Jobs->links() }}
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.toggle-hide').on('change', function () {
                let jobId = $(this).data('id');
                let isChecked = $(this).is(':checked');

                $.ajax({
                    url: `/job/hide/${jobId}`,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: JSON.stringify({ hide: isChecked }),
                    contentType: 'application/json',
                    success: function (response) {
                        if (response.status === 'success') {
                            alert(`Trạng thái ẩn: ${response.Hide ? 'Đã ẩn' : 'Hiện công khai'}`);
                        } else {
                            alert('Cập nhật trạng thái thất bại!');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Lỗi:', error);
                        alert('Có lỗi xảy ra!');
                    },
                });
            });
        });

    </script>
@endsection

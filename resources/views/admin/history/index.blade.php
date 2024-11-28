@extends('admin.main')

@section('contents')
<div class="container-fluid flex-grow-1 container-p-y">
    <h3 class="fw-bold text-primary py-3 mb-4">{{ $title }}</h3>
    <div class="row">
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
    </div>
    <!-- Form tìm kiếm -->
    <form method="GET" action="{{ route('doanhthu.index') }}" class="mb-4">
        <div class="row">
            <!-- Tìm kiếm theo số tiền -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="amount">Số tiền tối thiểu</label>
                    <input type="text" name="amount" id="amount" class="form-control" 
                        placeholder="Nhập số tiền tối thiểu" value="{{ request()->amount }}">
                </div>
            </div>

            <!-- Tìm kiếm theo tên người dùng -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="user">Người dùng</label>
                    <input type="text" name="user" id="user" class="form-control" 
                        placeholder="Tên người dùng hoặc ID" value="{{ request()->user }}">
                </div>
            </div>

            <!-- Tìm kiếm theo ngày -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="date">Ngày giao dịch</label>
                    <input type="date" name="date" id="date" class="form-control" value="{{ request()->date }}">
                </div>
            </div>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            <a href="{{ route('doanhthu.index') }}" class="btn btn-secondary">Xóa lọc</a>
        </div>
    </form>

    <!-- Bảng hiển thị lịch sử doanh thu -->
    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Số tiền (VNĐ)</th>
                        <th>Mô tả</th>
                        <th>Tài khoản người đăng</th>
                        <th>Ngày giao dịch</th>
                    </tr>
                </thead>
                <tbody>
                    @if($history->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center">Không có dữ liệu doanh thu</td>
                        </tr>
                    @else
                        @foreach($history as $record)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ number_format($record->amount, 0, ',', '.') }} đ</td>
                                <td>{{ $record->description }}</td>
                                <td>
                                    @if($record->user)
                                        {{ $record->user->name }} (ID: {{ $record->user_id }})
                                    @else
                                        Không xác định
                                    @endif
                                </td>
                                <td>{{ $record->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Phân trang -->
        <div class="pagination mt-4">
            {{ $history->links() }}
        </div>
    </div>
</div>
@endsection

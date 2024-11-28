@extends('admin.main')

@section('contents')
    <div class="container-fluid flex-grow-1 container-p-y">
        <h3 class="fw-bold text-primary py-3 mb-4">{{ $title }}</h3>

        <!-- Form tìm kiếm -->
        <form method="GET" action="{{ route('applications.index') }}">
            <div class="row mb-3">
                <!-- Tìm kiếm theo tên người ứng tuyển -->
                <div class="col-md-4">
                    <input type="text" name="search_applicant" class="form-control" placeholder="Tìm theo tên người ứng tuyển"
                           value="{{ request('search_applicant') }}">
                </div>
                <!-- Tìm kiếm theo email người ứng tuyển -->
                <div class="col-md-4">
                    <input type="text" name="search_email" class="form-control" placeholder="Tìm theo email người ứng tuyển"
                           value="{{ request('search_email') }}">
                </div>
                <!-- Tìm kiếm theo trạng thái -->
                <div class="col-md-4">
                    <select name="search_status" class="form-control">
                        <option value="">Tất cả trạng thái</option>
                        <option value="0" {{ request('search_status') == '0' ? 'selected' : '' }}>Chưa duyệt</option>
                        <option value="1" {{ request('search_status') == '1' ? 'selected' : '' }}>Đã duyệt</option>
                        <option value="2" {{ request('search_status') == '2' ? 'selected' : '' }}>Đã từ chối</option>
                    </select>
                </div>
                <!-- Tìm kiếm theo tiêu đề công việc -->
                <div class="col-md-4 mt-3">
                    <input type="text" name="search_job" class="form-control" placeholder="Tìm theo tiêu đề công việc"
                           value="{{ request('search_job') }}">
                </div>
                <!-- Tìm kiếm theo tên công ty -->
                <div class="col-md-4 mt-3">
                    <input type="text" name="search_company" class="form-control" placeholder="Tìm theo tên công ty"
                           value="{{ request('search_company') }}">
                </div>
                <div class="col-md-4 mt-3">
                    <button type="submit" class="btn btn-danger">Tìm kiếm</button>
                    <a href="{{ route('applications.index') }}" class="btn btn-secondary">Xóa lọc</a>
                </div>
            </div>
        </form>


        <!-- Bảng danh sách đơn ứng tuyển -->
        <div class="card mt-4">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Ảnh</th>
                        <th>Tên người ứng tuyển</th>
                        <th>CV</th>
                        <th>Email</th>
                        <th>Trạng thái</th>
                        <th>Tiêu đề công việc</th>
                        <th>Công ty</th>
                        <th>Thời gian</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($applications->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center">Không có đơn ứng tuyển nào.</td>
                        </tr>
                    @else
                        @foreach($applications as $application)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <!-- Ảnh người ứng tuyển -->
                                <td>
                                    <img width="40" height="40" src="/temp/images/avatar/{{$application->User->thumb}}">
                                </td>
                                <!-- Tên người ứng tuyển -->
                                <td>{{ $application->user->name }}</td>
                                <!-- CV -->
                                <td>
                                    @if($application->fileCv)
                                        <a href="{{ asset('temp/cvs/' . $application->fileCv) }}" target="_blank">Xem CV</a>
                                    @else
                                        Không có
                                    @endif
                                </td>
                                <!-- Email -->
                                <td>{{ $application->user->email }}</td>
                                <!-- Trạng thái -->
                                <td>
                                    @if($application->status == 0)
                                        <span class="badge bg-warning">Chưa duyệt</span>
                                    @elseif($application->status == 1)
                                        <span class="badge bg-success">Đã duyệt</span>
                                    @else
                                        <span class="badge bg-danger">Đã từ chối</span>
                                    @endif
                                </td>
                                <!-- Tiêu đề công việc -->
                                <td>{{ $application->job->title }}</td>
                                <td>{{ $application->job->company->name }}</td>
                                <!-- Thời gian -->
                                <td>{{ $application->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>

            <!-- Phân trang -->
            <div class="mt-3">
                {{ $applications->links() }}
            </div>
        </div>
    </div>
@endsection

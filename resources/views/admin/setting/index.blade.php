@extends('admin.main')

@section('contents')
    <div class="container-fluid flex-grow-1 container-p-y">
        <h3 class="fw-bold text-primary py-3 mb-4">Thiết lập</h3>

        <!-- Hiển thị thông báo thành công -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Hiển thị lỗi -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('settings.update') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fs-4" for="money">
                    1. Phí đăng bài tuyển dụng (VNĐ)
                </label>
                <input
                    type="text"
                    class="form-control"
                    id="money"
                    name="money"
                    value="{{ $money->value ?? '' }}"
                    placeholder="VD: 30000"
                />
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success fw-semibold text-dark">Lưu lại</button>
            </div>
        </form>
    </div>
@endsection

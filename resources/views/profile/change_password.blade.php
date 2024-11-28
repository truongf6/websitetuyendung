@extends('layout.layout')

@section('content')
<section class="section-hero overlay inner-page bg-image" style="background-image: url('/temp/assets/images/hero_1.jpg');" id="home-section">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1 class="text-white font-weight-bold">Đổi mật khẩu</h1>
                <div class="custom-breadcrumbs">
                    <a href="/">Trang chủ</a> <span class="mx-2 slash">/</span>
                    <a href="{{ route('profile') }}">Thông tin cá nhân</a> <span class="mx-2 slash">/</span>
                    <span class="text-white"><strong>Đổi mật khẩu</strong></span>
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
                        <h2>Đổi mật khẩu</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hiển thị thông báo lỗi hoặc thành công -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row mb-5">
            <div class="col-lg-12">
                <form class="p-4 p-md-5 border rounded" action="{{ route('updatePassword') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="current_password">Mật khẩu hiện tại</label>
                        <input type="password" name="current_password" class="form-control" id="current_password" placeholder="Nhập mật khẩu hiện tại..." value="{{ old('current_password') }}">
                        @error('current_password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="new_password">Mật khẩu mới</label>
                        <input type="password" name="new_password" class="form-control" id="new_password" placeholder="Nhập mật khẩu mới..." value="{{ old('new_password') }}">
                        @error('new_password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="new_password_confirmation">Xác nhận mật khẩu mới</label>
                        <input type="password" name="new_password_confirmation" class="form-control" id="new_password_confirmation" placeholder="Xác nhận mật khẩu mới...">
                        @error('new_password_confirmation')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-md">Cập nhật mật khẩu</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

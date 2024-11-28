@extends('layout.layout')
@section('content')
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('/temp/assets/images/hero_1.jpg');"
        id="home-section">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h1 class="text-white font-weight-bold">Đăng công việc</h1>
                    <div class="custom-breadcrumbs">
                        <a href="/">Trang chủ</a> <span class="mx-2 slash">/</span>
                        <a href="#">Công việc</a> <span class="mx-2 slash">/</span>
                        <span class="text-white"><strong>Đăng công việc</strong></span>
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
                            <h2>Đăng công việc</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-lg-12">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-nowrap">
                                <th>STT</th>
                                <th>Tiêu đề công việc</th>
                                <th>Hình ảnh</th>
                                <th>Vị trí</th>
                                <th>Địa chỉ</th>
                                <th>Thời gian làm việc</th>
                                <th>Ẩn</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($Jobs as $job)
                                <tr data-id="{{ $job->id }}">
                                    <td> {{ $loop->iteration }}</td>
                                    <td>{{ $job->title }}</td> 
                                    <td><img src="{{ asset("temp/images/job/$job->thumb") }}"
                                            alt="{{ $job->title }}" width="90px"
                                            height="90px"></td>
                                    <td>{{ $job->position }}</td>
                                    <td>{{ $job->location ?? '' }}</td>
                                    <td>{{ $job->type }}</td>
                                    <td>
                                        <input type="checkbox" class="toggle-hide" data-id="{{ $job->id }}"
                                               {{ $job->Hide ? 'checked' : '' }}>
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="{{ route('jobDetail', $job->slug) }}" type="button"
                                            class="btn btn-danger btnDeleteAsk px-2 me-2 py-1 fw-bolder"
                                            data-bs-toggle="modal" data-bs-target="#modalDetail{{ $job->id }}">Chi
                                            tiết</a>
                                        <a href="{{ route('viewJobPageEdit', $job->slug) }}" type="button"
                                            class="btn btn-warning btnDeleteAsk px-2 me-2 py-1 fw-bolder"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalDetail{{ $job->id }}">edit</a>
                                            <a href="{{ route('jobApplications', $job->id) }}" class="btn btn-info px-2 py-1">Đơn được nạp</a>

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <div class="pagination mt-4 pb-4">
                        {{ $Jobs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $('#addCategory').on('click', function() {
                $('.selectpicker').prop('disabled', true);
                $('.selectpicker').removeClass('input-field');
                $('.addCate').removeClass('d-none');
                $('.addCate-input').addClass('input-field');
            })

            $('#removeCategory').on('click', function() {
                $('.addCate-input').removeClass('input-field');
                $('.selectpicker').prop('disabled', false);
                $('.addCate').addClass('d-none');
            })

            function previewImages(input, previewId) {
                var previewContainer = $('#' + previewId);
                previewContainer.empty(); // Clear previous previews

                var files = input.files;
                if (files) {
                    $.each(files, function(i, file) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            // Tạo div chứa ảnh và nút xóa
                            var imageContainer = $('<div>', {
                                class: 'image-container',
                                css: {
                                    position: 'relative',
                                    display: 'inline-block',
                                    margin: '10px'
                                }
                            });

                            var imgElement = $('<img>', {
                                src: e.target.result,
                                css: {
                                    width: '100px',
                                    height: '100px',
                                    objectFit: 'cover'
                                }
                            });

                            // Tạo nút xóa
                            var removeButton = $('<button>', {
                                text: 'X',
                                class: 'btn btn-danger btn-sm',
                                css: {
                                    position: 'absolute',
                                    top: '5px',
                                    right: '5px'
                                }
                            });

                            // Sự kiện xóa ảnh
                            removeButton.on('click', function() {
                                imageContainer.remove();
                            });

                            // Thêm ảnh và nút xóa vào div container
                            imageContainer.append(imgElement).append(removeButton);
                            previewContainer.append(imageContainer);
                        };

                        reader.readAsDataURL(file);
                    });
                }
            }

            // Sự kiện thay đổi cho các input file
            $('#file-input-form_product_store').on('change', function() {
                previewImages(this, 'image-preview-form_product_store');
            });

            $('#file-input-thumb_company').on('change', function() {
                previewImages(this, 'image-preview-thumb_company');
            });

            $('#form-post_job').on('submit', function(e) {
                e.preventDefault(); // Ngăn form submit truyền thống

                // Tạo một đối tượng FormData để chứa tất cả dữ liệu
                var formData = new FormData(this);

                // Lấy nội dung của thẻ .description và .description-company
                var description = $('.description').html();
                var descriptionCompanyContent = $('.descriptionCompanyContent').html();
                var requirement = $('.requirement').html();
                // Thêm nội dung mô tả công việc và mô tả công ty vào formData
                formData.append('description', description);
                formData.append('descriptionCompanyContent', descriptionCompanyContent);
                formData.append('requirement', requirement);

                $.ajax({
                    url: "{{ route('postJob') }}", // Đặt URL tới route của bạn
                    method: 'POST',
                    data: formData,
                    contentType: false, // Điều này rất quan trọng để gửi dữ liệu dạng multipart/form-data
                    processData: false, // Không xử lý dữ liệu vì chúng ta đang sử dụng FormData
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Công việc đã được đăng thành công!');
                            // Bạn có thể xử lý thêm logic sau khi thành công, ví dụ như chuyển hướng
                        }
                    },
                    error: function(xhr) {
                        // Xử lý lỗi, hiển thị thông báo cho người dùng
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            alert(value[0]); // Hiển thị lỗi
                        });
                    }
                });
            });

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
        })
    </script>
@endsection

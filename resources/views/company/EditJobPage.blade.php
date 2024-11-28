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
                        <span class="text-white"><strong>Cập nhật công việc</strong></span>
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
                            <h2>Cập nhật công việc</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-lg-12">
                    <form class="p-4 p-md-5 border rounded" id="form-postEdit_job" data-slug={{ $Jobs->slug }} enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-8">
                                <h3 class="text-black mb-5 border-bottom pb-2">Chi tiết công việc</h3>
                            </div>
                            <div class="row col-4">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-block btn-primary btn-md">Lưu lại</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="file-input-form_product_store">Ảnh</label>
                            <input type="file" name="thumb" class="file-input" id="file-input-form_product_store"
                                multiple>
                            <div class="image-preview" id="image-preview-form_product_store"></div>
                        </div>


                        <div class="form-group">
                            <label for="job-title">Tiêu đề công việc</label>
                            <input type="text" name="title" class="form-control input-field" id="job-title"
                                value="{{ $Jobs->title ?? '' }}" data-require="Mời nhập tiêu đề"
                                placeholder="Nhập tiêu đề công việc">
                        </div>
                        <input type="text" class="d-none" value="{{ Auth::user()->id }}" name="used_id">
                        <div class="form-group">
                            <label for="job-time">Thời gian làm việc</label>
                            <select class="selectpicker border rounded" name="type" id="job-time"
                                data-require="Mời chọn loại làm việc" data-style="btn-black" data-width="100%"
                                data-live-search="true" title="Chọn thời gian làm việc">
                                <option value="Part Time" {{ $Jobs->type == 'Part Time' ? 'selected' : '' }}>Part Time
                                </option>
                                <option value="Full Time" {{ $Jobs->type == 'Full Time' ? 'selected' : '' }}>Full Time
                                </option>
                                <option value="Freelance" {{ $Jobs->type == 'Freelance' ? 'selected' : '' }}>Freelance
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="job-cate">Danh mục công việc</label>
                            <div class="d-flex align-items-center">
                                <select class="selectpicker border rounded " data-require="Mời chọn danh mục"
                                    name="job_categories_id-select" id="job-cate" data-style="btn-black" data-width="100%"
                                    data-live-search="true" title="Chọn danh mục công việc">
                                    @foreach ($job_categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $Jobs->job_categories_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->title }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-success ml-2" id="addCategory">+</button>
                            </div>
                        </div>
                        <div class="form-group addCate d-none">
                            <label for="company-name">Thêm danh mục khác</label>
                            <div class="d-flex align-items-center">
                                <input type="text" name="job_categories_id-new" data-require="Mời chọn danh mục"
                                    value="" class="form-control addCate-input" id=""
                                    placeholder="Nhập danh mục mới">
                                <button type="button" class="btn btn-success ml-2" id="removeCategory">-</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="company-position">Vị trí tuyển dụng</label>
                            <input type="text" name="position" class="form-control input-field" id="position"
                                value=" {{ $Jobs->position ?? '' }}" data-require="Mời nhập vị trí tuyển dụng"
                                placeholder="VD : Thực tập sinh...">
                        </div>

                        <div class="form-group">
                            <label for="company-Experience">Kinh nghiệm</label>
                            <input type="text" name="Experience" class="form-control input-field" id="Experience"
                                value=" {{ $Jobs->Experience ?? '' }}" data-require="Mời nhập kinh nghiệm"
                                placeholder="VD : 2-3 năm...">
                        </div>

                        <div class="form-group">
                            <label for="company-gender">Giới tính</label>
                            <select class=" " data-require="Mời chọn giới tính" name="gender" id="job-cate"
                                data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn giới tính">
                                <option value="Nam" {{ $Jobs->type == 'Nam' ? 'selected' : '' }}>Nam</option>
                                <option value="Nữ" {{ $Jobs->type == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                                <option value="Bất kì" {{ $Jobs->type == 'Bất kì' ? 'selected' : '' }}>Bất kì</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="location">Địa chỉ nơi làm việc</label>
                            <input type="text" name="location" class="form-control input-field"
                                value=" {{ $Jobs->location ?? '' }}" data-require="Mời nhập địa chỉ nơi làm việc"
                                id="location" placeholder="VD : Tòa nhà A, ngõ B, ...">
                        </div>

                        <div class="form-group">
                            <label for="job-description">Mô tả công việc</label>
                            <div class="editor description" data-require="Mời nhập mô tả công việc" id="editor-1">
                                {!! $Jobs->description ?? '' !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="job-requirement">Yêu cầu tuyển dụng</label>
                            <div class="editor requirement" data-require="Mời nhập yêu cầu" id="editor-3">
                                {!! $Jobs->requirements ?? '' !!}
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="salary">Thu nhập</label>
                            <input type="text" name="salary" class="form-control input-field w-25" id="salary"
                                value=" {{ $Jobs->salary ?? '' }}" data-require="Nhập lương"
                                placeholder="VD : 600k - 1000k VNĐ">
                        </div>

                        <div class="form-group">
                            <label for="expires">Hạn tuyển dụng</label>
                            <input type="date" name="expires" class="form-control input-field w-25" id="expires"
                                value="{{ $Jobs->expires_at ?? '' }}" data-require="Chọn hạn tuyển dụng">
                        </div>

                        <h3 class="text-black my-5 border-bottom pb-2">Chi tiết Công ty</h3>
                        <div class="form-group">
                            <label for="company-name">Tên công ty</label>
                            <input type="text" name="name" class="form-control input-field" value="{{ $Jobs->Company->name}}"
                                data-require="Mời nhập tên công ty" id="company-name" placeholder="Nhập tên công ty">
                        </div>

                        <div class="form-group">
                            <label for="company-phone">Số điện thoại</label>
                            <input type="text" name="phone_number" class="form-control input-field"
                                value="{{ $Jobs->Company->phone_number}}"
                                data-require="Mời nhập số điện thoại" id="company-phone"
                                placeholder="Nhập số điện thoại">
                        </div>

                        <div class="form-group">
                            <label for="company-description">Mô tả công ty</label>
                            <div class="editor descriptionCompanyContent" data-require="Mời nhập mô tả công ty"
                                id="editor-2">
                                {!! $Jobs->Company->description ?? '' !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="company-website">Website</label>
                            <input type="text" name="website" class="form-control" id="company-website"
                                value="{{ $Jobs->Company->website}}"
                                placeholder="https://">
                        </div>

                        <div class="form-group">
                            <label class='form-label' for='file-input-thumb_company'>Logo</label>
                            <input type="file" name="thumb-company" class="file-input" id="file-input-thumb_company" data-thumb={{ $Jobs->Company->thumb }}
                                multiple onchange="previewImages(event, 'image-preview-thumb_company')">
                            <div class="image-preview" id="image-preview-thumb_company"></div>
                        </div>
                        <div class="row align-items-center mb-5">
                            <div class="col-lg-4 ml-auto">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-block btn-primary btn-md">Lưu lại</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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

            // Sự kiện thay đổi cho các input file
            $('#file-input-form_product_store').on('change', function() {
                previewImages(this, 'image-preview-form_product_store');
            });

            $('#file-input-thumb_company').on('change', function() {
                previewImages(this, 'image-preview-thumb_company');
            });
        })

        $(document).ready(function() {
            previewImages(document.getElementById('file-input-form_product_store'),
                'image-preview-form_product_store', '{{ asset("temp/images/job/$Jobs->thumb") }}');
            const thumbCompany = $('#file-input-thumb_company').data('thumb');
            // Sử dụng Blade để lấy URL gốc, sau đó nối thêm tên file
            const thumbCompanyFull = `{{ asset('temp/images/company') }}/${thumbCompany}`;
            previewImages(
                document.getElementById('file-input-thumb_company'),
                'image-preview-thumb_company',
                thumbCompanyFull
            );
            
        $('#form-postEdit_job').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            var slug = $(this).data('slug'); // Lấy id từ thuộc tính data-id của form
            var description = $('.description').html();
            var descriptionCompanyContent = $('.descriptionCompanyContent').html();
            var requirement = $('.requirement').html();

            // Thêm nội dung mô tả công việc và mô tả công ty vào formData
            formData.append('description', description);
            formData.append('descriptionCompanyContent', descriptionCompanyContent);
            formData.append('requirement', requirement);

            $.ajax({
                url: "/PostJobPageEdit/" + slug,
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
                },
                success: function(response) {
                    if (response.success) {
                        alert('Công việc đã được đăng thành công!');
                    }
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        alert(value[0]);
                    });
                }
            });
        });
        });

        function previewImages(input, previewId, defaultImageUrl = null) {
            var previewContainer = $('#' + previewId);
            previewContainer.empty(); // Clear previous previews

            var files = input.files;
            if (files && files.length > 0) {
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
            } else if (defaultImageUrl) {
                // Nếu không có file nào được chọn và có ảnh mặc định
                var imageContainer = $('<div>', {
                    class: 'image-container',
                    css: {
                        position: 'relative',
                        display: 'inline-block',
                        margin: '10px'
                    }
                });

                var imgElement = $('<img>', {
                    src: defaultImageUrl,
                    css: {
                        width: '100px',
                        height: '100px',
                        objectFit: 'cover'
                    }
                });

                previewContainer.append(imageContainer.append(imgElement));
            }
        }
    </script>
@endsection

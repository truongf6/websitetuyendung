@extends('layout.layout')
@section('content')
<section class="section-hero overlay inner-page bg-image" style="background-image: url('/temp/assets/images/hero_1.jpg');" id="home-section">
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
              <h2>Đăng công việc  - ( Phí mỗi bài đăng : @if($money === null) 0đ @else <span class="money">{{ number_format((float)str_replace(',', '', $money), 0, ',', '.') }} đ</span> )@endif</h2> 
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-5">
        <div class="col-lg-12">
          @if($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif

          @if(session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
              </div>
          @endif

          <form class="p-4 p-md-5 border rounded" id="form-post_job" enctype="multipart/form-data" action="" data-money_user="{{Auth::user()->money}}" data-money_post="{{$money}}" method="post">
            @csrf
            <div class="row">
                <div class="col-8">
                    <h3 class="text-black mb-5 border-bottom pb-2">Chi tiết công việc</h3>
                </div>
                <div class="row col-4">
                    <div class="col-6">
                    </div>
                    <div class="col-6">
                    <button type="submit" class="btn btn-block btn-primary btn-md">Đăng bài</button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class='form-label' for='file-input-form_product_store'>Ảnh</label>
                <input type="file" name="thumb" class="file-input" id="file-input-form_product_store" multiple onchange="previewImages(event, 'image-preview-form_product_store')">
                <div class="image-preview" id="image-preview-form_product_store"></div>
            </div>
            <div class="form-group">
              <label for="job-title">Tiêu đề công việc</label>
              <input type="text" name="title" class="form-control input-field" id="job-title" data-require="Mời nhập tiêu đề" placeholder="Nhập tiêu đề công việc">
            </div>
            <input type="text" class="d-none" value="{{Auth::user()->id}}" name="used_id">
            <div class="form-group">
              <label for="job-time">Thời gian làm việc</label>
              <select class="selectpicker border rounded" name="type" id="job-time" data-require="Mời chọn loại làm việc" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn thời gian làm việc">
                <option value="Part Time">Part Time</option>
                <option value="Full Time">Full Time</option>
                <option value="Freelance">Freelance</option>
              </select>
            </div>

            <div class="form-group">
                <label for="job-cate">Danh mục công việc</label>
                <div class="d-flex align-items-center">
                  <select class="selectpicker border rounded " data-require="Mời chọn danh mục" name="job_categories_id-select" id="job-cate" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn danh mục công việc">
                    @foreach($job_categories as $category)
                        <option value="{{ $category->id }}">{{$category->title}}</option>
                    @endforeach
                  </select>
                  <button type="button" class="btn btn-success ml-2" id="addCategory">+</button>
                </div>
            </div>
            <div class="form-group addCate d-none">
                <label for="company-name">Thêm danh mục khác</label>
                <div class="d-flex align-items-center">
                    <input type="text" name="job_categories_id-new" data-require="Mời chọn danh mục" class="form-control addCate-input" id="" placeholder="Nhập danh mục mới">
                    <button type="button" class="btn btn-success ml-2" id="removeCategory">-</button>
                </div>
            </div>

            <div class="form-group">
                <label for="company-position">Vị trí tuyển dụng</label>
                <input type="text" name="position" class="form-control input-field" id="position" data-require="Mời nhập vị trí tuyển dụng" placeholder="VD : Thực tập sinh...">
              </div>

              <div class="form-group">
                <label for="company-Experience">Kinh nghiệm</label>  
                <input type="text" name="Experience" class="form-control input-field" id="Experience" data-require="Mời nhập kinh nghiệm" placeholder="VD : 2-3 năm...">
              </div>

              <div class="form-group">
                <label for="company-gender">Giới tính</label>
                <select class=" " data-require="Mời chọn giới tính" name="gender" id="job-cate" data-style="btn-black" data-width="100%" data-live-search="true" title="Chọn giới tính">
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                    <option value="Bất kì">Bất kì</option>
                </select>
                </div>

              <div class="form-group">
                <label for="location">Địa chỉ nơi làm việc</label>
                <input type="text" name="location" class="form-control input-field" data-require="Mời nhập địa chỉ nơi làm việc" id="location" placeholder="VD : Tòa nhà A, ngõ B, ...">
              </div>

            <div class="form-group">
              <label for="job-description">Mô tả công việc</label>
              <div class="editor description" data-require="Mời nhập mô tả công việc" id="editor-1">
                <p>Viết mô tả công việc!</p>
              </div>
            </div>

            <div class="form-group">
                <label for="job-requirement">Yêu cầu tuyển dụng</label>
                <div class="editor requirement" data-require="Mời nhập yêu cầu" id="editor-3">
                  <p>Yêu cầu tuyển dụng 1</p>
                </div>
            </div>

            <div class="form-group">
                <label for="salary">Thu nhập</label>
                <input type="text" name="salary" class="form-control input-field w-25" id="salary" data-require="Nhập lương" placeholder="VD : 600k - 1000k VNĐ">
              </div>

            <div class="form-group">
                <label for="expires">Hạn tuyển dụng</label>
                <input type="date" name="expires" class="form-control input-field w-25" id="expires" data-require="Chọn hạn tuyển dụng">
              </div>

            <h3 class="text-black my-5 border-bottom pb-2">Chi tiết Công ty</h3>
            <div class="form-group">
              <label for="select-company">Chọn công ty đã tạo</label>
              <select class="form-control selectpicker" id="select-company" data-live-search="true" title="Chọn công ty cũ">
                  <option value="">Tạo công ty mới</option>
                  @foreach($companies as $company)
                      <option value="{{ $company->id }}" 
                          data-name="{{ $company->name }}" 
                          data-phone="{{ $company->phone_number }}" 
                          data-description="{{ $company->description }}" 
                          data-website="{{ $company->website }}" 
                          data-logo="{{ $company->thumb }}">
                          {{ $company->name }}
                      </option>
                  @endforeach
              </select>
            </div>
            <div id="new-company-form">
              <div class="form-group">
                  <label for="company-name">Tên công ty</label>
                  <input type="text" name="name" class="form-control input-field" id="company-name" placeholder="Nhập tên công ty">
              </div>
          
              <div class="form-group">
                  <label for="company-phone">Số điện thoại</label>
                  <input type="text" name="phone_number" class="form-control input-field" id="company-phone" placeholder="Nhập số điện thoại">
              </div>
          
              <div class="form-group">
                  <label for="company-description">Mô tả công ty</label>
                  <textarea name="description" class="form-control input-field" id="company-description" placeholder="Nhập mô tả công ty"></textarea>
              </div>
          
              <div class="form-group">
                  <label for="company-website">Website</label>
                  <input type="text" name="website" class="form-control" id="company-website" placeholder="https://">
              </div>
          
              <div class="form-group">
                  <label class='form-label' for='file-input-thumb_company'>Logo</label>
                  <input type="file" name="thumb-company" class="file-input" id="file-input-thumb_company" multiple>
                  <div class="image-preview" id="image-preview-thumb_company"></div>
              </div>
            </div>
            <div class="row align-items-center mb-5">
                <div class="col-lg-4 ml-auto">
                  <div class="row">
                    <div class="col-6">
                    </div>
                    <div class="col-6">
                      <button type="submit" class="btn btn-block btn-primary btn-md">Đăng bài</button>
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
    $(document).ready(function(){
      $('#select-company').on('change', function () {
          const selectedOption = $(this).find(':selected'); // Lấy option được chọn

          if (selectedOption.val()) {
              // Điền thông tin công ty đã chọn
              $('#company-name').val(selectedOption.data('name'));
              $('#company-phone').val(selectedOption.data('phone'));
              $('#company-description').val(selectedOption.data('description'));
              $('#company-website').val(selectedOption.data('website'));

              // Hiển thị logo nếu có
              const logo = selectedOption.data('logo');
              if (logo) {
                  $('#image-preview-thumb_company').html(
                      `<img src="/temp/images/company/${logo}" class="img-fluid rounded" alt="Logo công ty">`
                  );
              }
          } else {
              // Xóa thông tin nếu chọn "Tạo công ty mới"
              $('#company-name').val('');
              $('#company-phone').val('');
              $('#company-description').val('');
              $('#company-website').val('');
              $('#image-preview-thumb_company').html('');
          }
      });


        $('#addCategory').on('click', function(){
            $('.selectpicker').prop('disabled', true);
            $('.selectpicker').removeClass('input-field');
            $('.addCate').removeClass('d-none');
            $('.addCate-input').addClass('input-field');
        })

        $('#removeCategory').on('click', function(){
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
            e.preventDefault();  // Ngăn form submit truyền thống
            const money_user = $(this).data('money_user');
            const money_post = $(this).data('money_post');
            // Tạo một đối tượng FormData để chứa tất cả dữ liệu
            if(money_user < money_post){
              alert('Số tiền trong tài khoản không đủ! Vui lòng nạp thêm tiền!');
            }else{
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
                url: "{{ route('postJob') }}",  // Đặt URL tới route của bạn
                method: 'POST',
                data: formData,
                contentType: false,  // Điều này rất quan trọng để gửi dữ liệu dạng multipart/form-data
                processData: false,  // Không xử lý dữ liệu vì chúng ta đang sử dụng FormData
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  // CSRF token
                },
                success: function(response) {
                    if(response.success) {
                        alert('Công việc đã được đăng thành công!');
                        window.location.reload()
                        // Bạn có thể xử lý thêm logic sau khi thành công, ví dụ như chuyển hướng
                    }
                },
                error: function(xhr) {
                    // Xử lý lỗi, hiển thị thông báo cho người dùng
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        alert(value[0]);  // Hiển thị lỗi
                    });
                }
            });
            }
        });
    })
</script>
@endsection

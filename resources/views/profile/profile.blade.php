@extends('layout.layout')
@section('content')
<section class="section-hero overlay inner-page bg-image" style="background-image: url('/temp/assets/images/hero_1.jpg');" id="home-section">
    <div class="container">
      <div class="row">
        <div class="col-md-7">
          <h1 class="text-white font-weight-bold">Cập nhật thông tin cá nhân</h1>
          <div class="custom-breadcrumbs">
            <a href="/">Trang chủ</a> <span class="mx-2 slash">/</span>
            <a href="#">Thông tin cá nhân</a> <span class="mx-2 slash">/</span>
            <span class="text-white"><strong>Cập nhật thông tin cá nhân</strong></span>
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
              <h2>Cập nhật thông tin cá nhân</h2>
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-5">
        <div class="col-lg-12">
            <form class="p-4 p-md-5 border rounded" id="form-post_job" enctype="multipart/form-data" action="{{ route('updateProfile') }}" method="post">
                @csrf
            <div class="row">
                <div class="col-8">
                    <h3 class="text-black mb-5 border-bottom pb-2">Thông tin cá nhân</h3>
                </div>
                <div class="row col-4">
                    <div class="col-6">
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary btn-md">Lưu lại</button>
                    </div>
                </div>
            </div>
            <div class="form-group d-flex align-items-center justify-content-between">
              <div>
                <label class='form-label' for='file-input-form_product_store'>Ảnh đại diện</label>
                <input type="file" name="thumb" class="file-input" id="file-input-form_product_store" multiple onchange="previewImages(event, 'image-preview-form_product_store')">
                {{-- <div class="image-preview" id="image-preview-form_product_store"></div> --}}
              </div>
              <div id="image-preview-form_product_store" class="avatar border image-preview d-flex align-items-center justify-content-center" style="width:150px; height:150px">
                @if($user->thumb == null)
                    <i class="fa-regular fa-user" style="font-size: 130px"></i>
                @else
                    <img width="150" height="150" src="/temp/images/avatar/{{$user->thumb}}">
                @endif
              </div>
            </div>
            <div class="form-group">
              <label for="fullname">Tên đầy đủ</label>
              <input type="text" name="name" class="form-control input-field" id="fullname" value="{{$user->name}}" data-require="Mời nhập tên" placeholder="Nhập tên...">
            </div>

            <div class="form-group ">
                <label for="email">Email</label>
                <div class="d-flex align-items-center">
                    <input type="email" name="email"  value="{{$user->email}}" class="form-control" id="" placeholder="Nhập email...">
                </div>
            </div>

            <div class="form-group">
                <label for="phone">Số điện thoại</label>
                <input type="text" name="phone_number" class="form-control" value="{{$user->phone_number}}" id="phone" placeholder="Nhập số điện thoại...">
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <script>
    $(document).ready(function(){
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
                                width: '150px',
                                height: '150px',
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
                            // Sau khi xóa ảnh, bạn có thể reset lại input file nếu cần thiết
                            $('#file-input-form_product_store').val('');
                        });

                        // Thêm ảnh và nút xóa vào div container
                        imageContainer.append(imgElement).append(removeButton);
                        previewContainer.append(imageContainer);
                    };

                    reader.readAsDataURL(file);
                });
            }
        }

        $('#file-input-form_product_store').on('change', function() {
            previewImages(this, 'image-preview-form_product_store');
        });


        $('#file-input-thumb_company').on('change', function() {
            previewImages(this, 'image-preview-thumb_company');
        });

    })
</script>
@endsection
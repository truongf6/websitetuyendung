@extends('admin.main')
@section('contents')

    <div class="container-fluid flex-grow-1 container-p-y">
        <h3 class="fw-bold text-primary py-3 mb-4">{{$title}}</h3>
        <div>
            <form class="form-search" method="GET" action="{{ route('job_categories.index') }}">
                @csrf
                <div class="d-flex align-items-center mb-4">
                    <h4 class="ten-game me-3 mb-0">Tìm kiếm</h4>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12 mb-3">
                            <input class="form-control shadow-none" 
                                   type="text" 
                                   id="searchInputNv" 
                                   name="search_id" 
                                   placeholder="Tìm theo mã số..." 
                                   value="{{ request()->search_id }}">
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12 mb-3">
                            <input class="form-control shadow-none" 
                                   type="text" 
                                   id="searchInputVk" 
                                   name="search_name" 
                                   placeholder="Tìm theo tên danh mục..." 
                                   value="{{ request()->search_name }}">
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12 mb-3">
                            <div class="text-center text-nowrap">
                                <button type="submit" class="btn btn-danger rounded-pill">
                                    <i class="fas fa-search me-2"></i>Tìm kiếm
                                </button>
                                <a href="{{ route('job_categories.index') }}" class="btn btn-secondary rounded-pill ms-2">
                                    <i class="fas fa-times me-2"></i>Xóa lọc
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="card">
            <div class="d-flex p-4 justify-content-between">
                <h5 class=" fw-bold">Danh sách danh mục  </h5>
                <button type="button" data-id="" class="btn btn-success text-dark px-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#createcategory">Thêm mới</button>
            </div>
            <div class="modal fade" id="createcategory" tabindex="-1" aria-labelledby="createcategoryLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 text-white" id="createcategoryLabel">Thêm mới Danh mục.</h1>
                        </div>
                        <div class="card-body">
                            <div class="error">
                                @include('admin.error')
                            </div>
                            <form id="form_category_store" class="form-create" method='POST' action='{{route('job_categories.store')}}'>
                                @csrf
                                <div class='mb-3'>
                                    <label
                                        class='form-label'
                                        for='basic-default-fullname'
                                    >Tên danh mục</label>
                                    <input
                                        type='text'
                                        class='form-control name input-field '
                                        id='title-store'
                                        placeholder='Nhập Tên danh mục'
                                        name='title' data-require='Mời nhập Tên danh mục'
                                        value="{{ old('title') }}"
                                    />
                                </div>
                                <div class='mb-3'>
                                    <label
                                        class='form-label'
                                        for='basic-default-fullname'
                                    >Slug</label>
                                    <input
                                        type='text'
                                        class='form-control name input-field '
                                        id='slug-store'
                                        placeholder='Slug'
                                        name='slug' data-require='Mời nhập slug'
                                        value="{{ old('slug') }}"
                                    />
                                </div>
                                <div class='mb-3'>
                                    <label
                                        class='form-label'
                                        for='basic-default-fullname'
                                    >Mô tả</label>
                                    <input
                                        type='text'
                                        class='form-control name'
                                        id='desc'
                                        placeholder='Nhập mô tả'
                                        name='desc'
                                        value="{{ old('desc') }}"
                                    />
                                </div>
                                <div class="form-group">
                                    <label class='form-label'
                                           for='basic-default-email'>Danh mục cha</label>
                                    <select name="parent_id" class="form-control" id="parent">
                                        <option value="">Chọn danh mục cha</option>
                                        @foreach($parent_ids as $parent)
                                            <option value="{{ $parent->id }}">{{ $parent->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type='submit' class='btn btn-success fw-semibold text-dark'>Thêm mới</button>
                                    <button type="button" class="btn btn-secondary fw-semibold" data-bs-dismiss="modal">Đóng</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>ID Danh mục</th>
                        <th>Tên danh mục</th>
                        <th>Mô tả</th>
                        <th>Danh mục cha</th>
                        <th>Thời gian tạo</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($job_categories as $category)
                        <tr data-id="{{$category->id}}">
                            <td> {{ $loop->iteration }}</td>
                            <td>{{$category->id}}</td>
                            <td>{{$category->title}}</td>
                            <td>{{$category->desc}}</td>
                            <td>{{$category->Parent->title??""}}</td>
                            <td>{{$category->created_at}}</td>
                            <td class="">
                                <button type="button" data-url="/admin/job_categories/{{$category->id}}" data-id="{{$category->id}}" class="btn btn-danger btnDeleteAsk px-2 me-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#deleteModal{{$category->id}}">Xóa</button>
                                <button type="button" data-id="{{$category->id}}" class="btn btn-edit btnEditCategory btn-info text-dark px-2 py-1 fw-bolder">Sửa</button>
                            </td>

                            <!-- Modal Delete -->
                            <div class="modal fade" id="deleteModal{{$category->id}}" tabindex="-1" aria-labelledby="deleteModal{{$category->id}}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 text-white text-wrap" id="deleteModal{{$category->id}}Label">Bạn có chắc chắn xóa Danh mục <b><u>{{$category->title}}</u></b>  không ?</h1>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="delete-forever btn btn-danger" data-id="{{ $category->id }}">Xóa</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                <div class="modal fade ModelEditCategory" id="editCategory" tabindex="-1" aria-labelledby="editCategoryLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-white text-danger" id="createCategoryLabel"> </h1>
                            </div>
                            <div class="card-body">
                                <form method='post' action='' enctype="multipart/form-data" class="editCategoryForm form-edit" id="form_categoryAdmin_update">
                                    @method('PATCH')
                                    @csrf
                                    <div class='mb-3'>
                                        <label
                                            class='form-label'
                                            for='basic-default-fullname'
                                        >Tên danh mục</label>
                                        <input
                                            type='text'
                                            class='form-control title input-field '
                                            id='title-edit'
                                            placeholder='Nhập Tên danh mục'
                                            name='title' data-require='Mời nhập Tên danh mục'
                                        />
                                    </div>
                                    <div class='mb-3'>
                                        <label
                                            class='form-label'
                                            for='basic-default-fullname'
                                        >Slug</label>
                                        <input
                                            type='text'
                                            class='form-control slug input-field '
                                            id='slug-edit'
                                            placeholder='Nhập Slug'
                                            name='slug' data-require='Mời nhập Slug'
                                        />
                                    </div>
                                    <div class='mb-3'>
                                        <label
                                            class='form-label'
                                            for='basic-default-fullname'
                                        >Mô tả</label>
                                        <input
                                            type='text'
                                            class='form-control name'
                                            id='desc-edit'
                                            placeholder='Nhập mô tả'
                                            name='desc'
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label class='form-label'
                                               for='basic-default-email'>Danh mục cha</label>
                                        <select name="parent_id" class="form-control" id="edit-parent">
                                            <option value="">Chọn danh mục cha</option>
                                            @foreach($parent_ids as $parent)
                                                <option value="{{ $parent->id }}">{{ $parent->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type='submit' class='btn btn-success fw-semibold text-dark'>Cập nhật</button>
                                        <button type="button" class="btn btn-secondary fw-semibold" data-bs-dismiss="modal">Đóng</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="pagination mt-4 pb-4">
                    {{ $job_categories->links() }}
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            if ($('#createcategory .alert-error').length > 0) {
                // Nếu có, hiển thị modal
                $('#createcategory').modal('show');
            }
            $('.btnEditCategory').on('click', function() {
                var categoryID = $(this).data('id'); // Lấy ID từ nút Sửa
                const ModelEdit = $('.ModelEditCategory');
                const editCategory = ModelEdit.attr('id', 'editCategory'+categoryID);
                const IdEditCategory = editCategory.attr('id');

                $.ajax({
                    url: '/admin/job_categories/' + categoryID, // URL API để lấy thông tin Danh mục
                    type: 'GET',
                    success: function(response) {
                        // Cập nhật các trường dữ liệu trong modal
                        $('#'+IdEditCategory + ' #title-edit').val(response.title);
                        $('#'+IdEditCategory + ' #slug-edit').val(response.slug);
                        $('#'+IdEditCategory + ' .modal-title').text('Chỉnh sửa Danh mục: ' + response.title);
                        $('#'+IdEditCategory + ' #desc-edit').val(response.desc);
                        $('#'+IdEditCategory + ' #edit-parent').val(response.parent_id);
                        $('#form_categoryAdmin_update').attr('action', '/admin/job_categories/' + categoryID); 
                        $(editCategory).modal('show'); // Hiển thị modal
                    },
                    error: function() {
                        alert('Không thể lấy dữ liệu khách hàng!');
                    }
                });
            });

        });
    </script>
@endsection


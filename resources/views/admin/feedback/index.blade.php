@extends('admin.main')
@section('contents')

    <div class="container-fluid flex-grow-1 container-p-y">
        <h3 class="fw-bold text-primary py-3 mb-4">{{$title}}</h3>
        <div>
            <form class="form-search" method="GET" action="{{ route('feedbacks.index') }}">
                @csrf
                <div class="d-flex align-items-center mb-4">
                    <h4 class="ten-game me-3 mb-0">Tìm kiếm</h4>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12 mb-3">
                            <input disabled class="form-control shadow-none" 
                                   type="text" 
                                   id="searchInputNv" 
                                   name="search_id" 
                                   placeholder="Tìm theo mã số..." 
                                   value="{{ request()->search_id }}">
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12 mb-3">
                            <input disabled class="form-control shadow-none" 
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
                                <a href="{{ route('feedbacks.index') }}" class="btn btn-secondary rounded-pill ms-2">
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
                <h5 class=" fw-bold">Danh sách phản hồi </h5>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tiêu đề</th>
                        <th>Nội dung</th>
                        <th>Tên Người gửi</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Trạng thái</th>
                        <th>Thời gian gửi</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($feedbacks as $feedback)
                        <tr data-id="{{$feedback->id}}">
                            <td> {{ $loop->iteration }}</td>
                            <td>{{$feedback->title}}</td>
                            <td>{{$feedback->contents}}</td>
                            <td>{{$feedback->fullname}}</td>
                            <td>{{$feedback->email}}</td>
                            <td>{{$feedback->phone_number}}</td>
                            <td>
                                @if($feedback->status != true)
                                    <span class="badge bg-danger">Chưa đọc</span>
                                @else
                                    <span class="badge bg-success text-dark fw-bold">Đã đọc</span>
                                @endif
                            </td>
                            <td>{{$feedback->created_at}}</td>
                            <td class="">
                                <button type="button" data-id="{{$feedback->id}}" class="btn btn-edit btnEditfeedback btn-info text-dark px-2 py-1 fw-bolder">Đọc</button>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                <div class="modal fade ModelEditfeedback" id="editfeedback" tabindex="-1" aria-labelledby="editfeedbackLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-4 text-white fw-bold" id="createfeedbackLabel"> </h1>
                            </div>
                            <div class="card-body">
                                <form method='post' action='' enctype="multipart/form-data" class="editfeedbackForm form-edit" id="form_feedbackAdmin_update">
                                    @method('PATCH')
                                    @csrf
                                    <div class='mb-3'>
                                        <label
                                            class='form-label'
                                            for='basic-default-fullname'
                                        >Tiêu đề</label>
                                        <input disabled
                                            type='text'
                                            class='form-control title  '
                                            id='title'
                                        />
                                    </div>
                                    <div class='mb-3'>
                                        <label
                                            class='form-label'
                                            for='basic-default-fullname'
                                        >Nội dung</label>
                                        <input disabled
                                            type='text'
                                            class='form-control slug  '
                                            id='content'
                                        />
                                    </div>
                                    <div class='mb-3'>
                                        <label
                                            class='form-label'
                                            for='basic-default-fullname'
                                        >Tên người gửi</label>
                                        <input disabled
                                            type='text'
                                            class='form-control name'
                                            id='fullname'
                                        />
                                    </div>
                                    <div class='mb-3'>
                                        <label
                                            class='form-label'
                                            for='basic-default-fullname'
                                        >Email</label>
                                        <input disabled
                                            type='text'
                                            class='form-control name'
                                            id='email'
                                        />
                                    </div>
                                    <div class='mb-3'>
                                        <label
                                            class='form-label'
                                            for='basic-default-fullname'
                                        >Số điện thoại</label>
                                        <input disabled
                                            type='text'
                                            class='form-control name'
                                            id='phone'
                                        />
                                    </div>
                                    <div class='mb-3'>
                                        <label
                                            class='form-label'
                                            for='basic-default-fullname'
                                        >Thời gian gửi</label>
                                        <input disabled
                                            type='text'
                                            class='form-control name'
                                            id='time'
                                        />
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-dong fw-semibold" data-bs-dismiss="modal">Đóng</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="pagination mt-4 pb-4">
                    {{ $feedbacks->links() }}
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.btnEditfeedback').on('click', function() {
                var feedbackID = $(this).data('id'); // Lấy ID từ nút Sửa
                const ModelEdit = $('.ModelEditfeedback');
                const editfeedback = ModelEdit.attr('id', 'editfeedback'+feedbackID);
                const IdEditfeedback = editfeedback.attr('id');

                $.ajax({
                    url: '/admin/feedbacks/' + feedbackID, // URL API để lấy thông tin Danh mục
                    type: 'GET',
                    success: function(response) {
                        // Cập nhật các trường dữ liệu trong modal
                        $('#'+IdEditfeedback + ' #title').val(response.title);
                        $('#'+IdEditfeedback + ' #content').val(response.contents);
                        $('#'+IdEditfeedback + ' #fullname').val(response.fullname);
                        $('#'+IdEditfeedback + ' #email').val(response.email);
                        $('#'+IdEditfeedback + ' #phone').val(response.phone_number);
                        $('#'+IdEditfeedback + ' .modal-title').text(response.title);
                        $('#'+IdEditfeedback + ' #time').val(response.created_at);
                        $(editfeedback).modal('show'); // Hiển thị modal
                    },
                    error: function() {
                        alert('Không thể lấy dữ liệu khách hàng!');
                    }
                });

                $('.btn-dong').on('click', function(){
                    location.reload(); // Tải lại trang để hiển thị thông tin mới
                })

            });
        });
    </script>
@endsection


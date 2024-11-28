<aside
    id='layout-menu'
    class='layout-menu menu-vertical menu bg-menu-theme'
    data-bg-class='bg-menu-theme'
>
    <div class='app-brand demo'>
        <a href='/admin' class='app-brand-link'>
            <img src='/temp/assets/images/general/logo.png' width='200' alt='' />
        </a>

        <a
            href='javascript:void(0);'
            class='layout-menu-toggle menu-link text-large ms-auto d-xl-none'
        >
            <i class='bx bx-chevron-left bx-sm align-middle'></i>
        </a>
    </div>

    <div class='menu-inner-shadow'></div>

    <ul class='menu-inner py-1 ps ps--active-y'>
        <!-- Dashboard -->
        <li class='menu-item active'>
            <a href='/admin' class='menu-link'>
                <i class='menu-icon tf-icons bx bx-home-circle'></i>
                <div data-i18n='Analytics'>Dashboard</div>
            </a>
        </li>


        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Users</span>
        </li>
        <li class='menu-item'>
            <a href='javascript:void(0);' class='menu-link menu-toggle'>
                <i class='menu-icon tf-icons bx bxs-user-account'></i>
                <div data-i18n='Layouts'>Quản lý tài khoản</div>
            </a>
            <ul class='menu-sub'>
                <li class='menu-item'>
                    <a href='{{route('adminUser')}}' class='menu-link'>
                        <div data-i18n='Without menu'>Tài khoản quản trị</div>
                    </a>
                </li>
                <li class='menu-item'>
                    <a href='{{route('companyUser')}}' class='menu-link'>
                        <div data-i18n='Without menu'>Tài khoản nhà tuyển dụng</div>
                    </a>
                </li>
                <li class='menu-item'>
                    <a href='{{route('employeeUser')}}' class='menu-link'>
                        <div data-i18n='Without menu'>Tài khoản người tìm việc</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">JOBS</span>
        </li>
        <li class='menu-item'>
            <a href='{{route('job_categories.index')}}' class='menu-link'>
                <i class='menu-icon tf-icons bx bx-category-alt'></i>
                <div data-i18n='Layouts'>Quản lý danh mục jobs</div>
            </a>
        </li>
        <li class='menu-item'>
            <a href='{{route('jobs.index')}}' class='menu-link'>
                <i class='menu-icon tf-icons bx bx-store-alt'></i>
                <div data-i18n='Layouts'>Quản lý jobs</div>
            </a>
        </li>
        <li class='menu-item'>
            <a href='{{route('applications.index')}}' class='menu-link'>
                <i class='menu-icon tf-icons bx bx-street-view'></i>
                <div data-i18n='Layouts'>Quản lý đơn đã ứng tuyển</div>
            </a>
        </li>
        <li class='menu-item'>
            <a href='{{route('posts.index')}}' class='menu-link'>
                <i class='menu-icon tf-icons bx bx-news'></i>
                <div data-i18n='Layouts'>Quản lý bài viết</div>
            </a>
        </li>
        
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Orthers</span>
        </li>
        <li class='menu-item'>
            <a href='{{route('feedbacks.index')}}' class='menu-link'>
                <i class="menu-icon tf-icons bx bx-comment-detail"></i>
                <div data-i18n='Layouts'>Quản lý phản hồi</div>
            </a>
        </li>
        <li class='menu-item'>
            <a href='{{route('doanhthu.index')}}' class='menu-link'>
                <i class='menu-icon tf-icons bx bx-food-menu'></i>
                <div data-i18n='Layouts'>Lịch sử doanh thu</div>
            </a>
        </li>
        <li class='menu-item'>
            <a href='{{route('settings.index')}}' class='menu-link'>
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n='Layouts'>Thiết lập</div>
            </a>
        </li>
    </ul>
</aside>

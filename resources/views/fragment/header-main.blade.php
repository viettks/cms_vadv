@php
    $user = auth()->user();
    $name = $user->name;
@endphp
<!-- HEADER DESKTOP-->
<header class="header-desktop">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap">
                <div class="d-flex">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="/">Trang chủ</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                          <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                          <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ url('order/list') }}">Danh sách đơn hàng</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ url('revenue') }}">Quản lý chi</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ url('debt') }}">Quản lý công nợ</a>
                            </li>
                            @can('ADMIN')
                            <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                                    Cài đặt
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item" href="{{ url('settings/add-print-1') }}">Tạo mới loại in 1</a>
                                  <a class="dropdown-item" href="{{ url('settings/add-print-2') }}">Tạo mới loại in 2</a>
                                  <a class="dropdown-item" href="{{ url('/settings/list-print') }}">Danh sách loại in</a>
                                  <a class="dropdown-item" href="{{ url('/settings/member') }}">Danh sách thành viên</a>
                                </div>
                            </li>
                            @endcan
                          </ul>
                        </div>
                      </nav>
                </div>
                <a href="{{ url('order/add') }}" class="ml-auto mr-5" style="width: 250px;">
                    <img src="{{ url('images/icon/tao-ke-hoach-in.png')}}" alt="tao-ke-hoach-in">
                </a>
                <div class="header-button">
                    <div class="account-wrap">
                        <div class="account-item clearfix js-item-menu">
                            <div class="image">
                                <img src="{{url('images/icon/avatar-01.jpg')}}" alt="{{ $name }}" />
                            </div>
                            <div class="content">
                                <a class="js-acc-btn" href="#">{{ $name }} </a>
                            </div>
                            <div class="account-dropdown js-dropdown">
                                <div class="info clearfix">
                                    <div class="image">
                                        <a href="#">
                                            <img src="{{url('images/icon/avatar-01.jpg')}}" alt="John Doe" />
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h5 class="name">
                                            <a href="#">{{ $name }}</a>
                                        </h5>
                                    </div>
                                </div>
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__item">
                                        <a href="{{ url('/settings/changePW') }}">
                                            <i class="zmdi zmdi-account"></i>Tài khoản</a>
                                    </div>
                                </div>
                                <div class="account-dropdown__footer">
                                    <a href="{{ url('/logout') }}">
                                        <i class="zmdi zmdi-power"></i>Đăng xuất</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- HEADER DESKTOP-->
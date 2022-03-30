<!-- MENU SIDEBAR-->
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="{{ url('images/icon/logo.png')}}" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li>
                    <a href="chart.html">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-chart-bar"></i>Quản lý đơn hàng</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="{{ url('order/add') }}">Tạo mới đơn hàng</a>
                        </li>
                        <li>
                            <a href="{{ url('order/list') }}">Danh sách đơn hàng</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ url('revenue') }}">
                        <i class="fa fa-signal"></i>Quản lý doanh thu</a>
                </li>
                <li>
                    <a href="{{ url('debt') }}">
                        <i class="fa fa-usd mr-20"></i>Quản lý công nợ</a>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-chart-bar"></i>Cài đặt</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="{{ url('settings/add-print') }}">Tạo mới loại in</a>
                        </li>
                        <li>
                            <a href="{{ url('order/list') }}">Danh sách đơn hàng</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->
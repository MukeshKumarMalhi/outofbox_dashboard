<!-- Sidebar-left -->
<div id="sidebar-wrapper" class="link-light p-2">
  <button class="menu-press text-left btn btn-danger rounded-0 d-lg-none"><i class="fal fa-bars"></i></button>
    <!-- Menu Button -->
    <a class="navbar-brand mb-3" href="{{ url('admin/dashboard') }}"><img src="{{ asset('web_asset/images/main-logo.png') }}" alt="" class="img-fluid"></a>
    <ul class="list-unstyled fa-ul bs-menu">
        <li class="nav-item"><a href="{{ url('admin/dashboard') }}"><i class="fa-li fal fa-chart-pie-alt text-light"></i><span>Dashboard</span></a></li>
        <li class="nav-item"><a href="{{ url('admin/view_categories') }}"><i class="fa-li fal fa-list text-light"></i><span>Categories</span></a></li>
    </ul>
</div>

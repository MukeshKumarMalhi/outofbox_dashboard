<!-- heading text nav -->
<div class="container-fluid py-3 clearfix">
    <div class="float-right dropdown">
        <ul class="nav list-inline">
            <!-- <li class="nav-item text-light link-light pr-2">
                <a class="btn bg-dark my-2" href="#" data-toggle="modal" data-target="#CategoryModal" data-whatever="@mdo"><i class="fa fa-plus" aria-hidden="true"></i> Add Category</a>
            </li> -->
            <li class="nav-item">
                <a href="#" class="nav-link text-danger link-danger p-0 m-0 font-weight-bold" data-toggle="dropdown" aria-expanded="true">
                    <div class="d-table bs-users">
                        <div class="d-table-cell px-2 pt-1">
                            <h4>OutOfBox Dashboard</h4>
                            <p class="small">ADMIN</p>
                        </div>
                        <!-- <div class="d-table-cell bs-photo bg-center-url" style="background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQEN1LSM42Fym4c2saamPHM_C4SSk5vdK6sZw&usqp=CAU');"></div> -->
                        <div class="d-table-cell bs-photo"><i class="fas fa-user-circle"></i></div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item small" href="{{ url('/logout') }}"><i class="fal fa-sign-out-alt"></i> Log out</a>
                  <form id="logout-form" style="display: none;" action="{{ url('/logout') }}" method="POST">
                    @csrf
                  </form>
                </div>
            </li>
        </ul>
    </div>
    <h3 class="text-danger pt-3 float-left"><i class="fa fa-align-left text-dark"></i> @yield('title')</h3>
</div>

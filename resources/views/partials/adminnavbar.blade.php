<nav class="admin-navbar sticky-top">
    <div>
        <h4 class="mb-0">@yield('page-title')</h4>

    </div>

<div class="d-flex align-items-center gap-3">

    {{-- <button class="btn admin-icon-btn">
        <i class="bi bi-bell-fill"></i>
        <span>3</span>
    </button> --}}

    <div class="dropdown">

        <div class="admin-profile"
             role="button"
             data-bs-toggle="dropdown"
             aria-expanded="false">

            <div class="profile-circle">A</div>

            <div class="d-none d-md-block">
                <h6 class="mb-0">Admin</h6>
            </div>

            <i class="bi bi-chevron-down ms-2 small"></i>

        </div>

        <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">

            <li>
                <a class="dropdown-item py-2"
                   href="{{ route('admin.profile') }}">
                    <i class="bi bi-person me-2"></i>
                    My Profile
                </a>
            </li>

            <li><hr class="dropdown-divider"></li>

            <li>
                <a href="{{ route('logout') }}"
                   class="dropdown-item text-danger py-2"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">

                    <i class="bi bi-box-arrow-right me-2"></i>
                    Logout
                </a>
            </li>

        </ul>

    </div>

</div>

<form id="logout-form"
      action="{{ route('logout') }}"
      method="POST"
      class="d-none">
    @csrf
</form>
</nav>

           {{-- <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form> --}}
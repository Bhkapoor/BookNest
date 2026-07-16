<aside class="admin-sidebar">
    <div class="sidebar-logo">
        <h3>Book<span>Nest</span></h3>
        <p>Campus Admin Panel</p>
    </div>

    <ul class="nav flex-column sidebar-menu">

        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}"
                class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.students') }}"
                class="nav-link {{ request()->routeIs('admin.students') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i>
                <span>Students</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.books') }}"
                class="nav-link {{ request()->routeIs('admin.books') ? 'active' : '' }}">
                <i class="bi bi-book-half"></i>
                <span>Book Listings</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.transactions') }}"
                class="nav-link {{ request()->routeIs('admin.transactions') ? 'active' : '' }}">
                <i class="bi bi-receipt-cutoff"></i>
                <span>Transactions</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.pyqs') }}" class="nav-link {{ request()->routeIs('admin.pyqs') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-pdf-fill"></i>
                <span>PYQ Papers</span>
            </a>
        </li>
<li>
    <a href="{{ route('admin.profile') }}" class="nav-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
               <i class="bi bi-person-circle"></i>
    <span>My Profile</span>
</a>
</li>


    </ul>
<div class="sidebar-bottom">
    <a href="{{ route('logout') }}"
       class="nav-link logout-link"
       onclick="event.preventDefault();
       document.getElementById('logout-form').submit();">

        <i class="bi bi-box-arrow-right"></i>
        <span>Logout</span>
    </a>

    <form id="logout-form"
          action="{{ route('logout') }}"
          method="POST"
          class="d-none">
        @csrf
    </form>
</div>

</aside>

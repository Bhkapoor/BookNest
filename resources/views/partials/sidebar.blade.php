<aside class="bn-sidebar">

    <!-- Top Branding -->
    <div class="bn-sidebar-brand">
        <h3>User<span>Dashboard</span></h3>
        <p>Student Portal</p>
    </div>

    <!-- Menu -->
    <div class="bn-sidebar-menu">

     <a href="{{ url('/home') }}"
   class="bn-sidebar-item {{ request()->is('home') ? 'active' : '' }}">
    <i class="bi bi-grid-1x2-fill me-2"></i> <span>Overview</span>
</a>

       <a href="{{ route('books.listings') }}"
   class="bn-sidebar-item {{ request()->routeIs('books.listings') ? 'active' : '' }}">
    <i class="bi bi-journal-bookmark-fill me-2"></i> <span>My Listings</span>
</a>

      <a href="{{ route('books.profile') }}"
   class="bn-sidebar-item {{ request()->routeIs('books.profile') ? 'active' : '' }}">
    <i class="bi bi-person-circle me-2"></i> <span>My Profile</span>
</a>

        <hr>

    <a href="{{ route('books.request') }}"
   class="bn-sidebar-item {{ request()->routeIs('books.request') ? 'active' : '' }}">
    <i class="bi bi-envelope-paper-fill me-2"></i> <span>My Requests</span>
</a>

       <a href="{{ route('books.browse') }}"
   class="bn-sidebar-item {{ request()->routeIs('books.browse') ? 'active' : '' }}">
    <i class="bi bi-search me-2"></i> <span>Browse Books</span>
</a>

   <a href="{{ route('pyq.index') }}"
   class="bn-sidebar-item {{ request()->routeIs('pyq.index') ? 'active' : '' }}">
    <i class="bi bi-file-earmark-pdf-fill me-2"></i> <span>PYQ Papers</span>
</a>

    </div>

    <!-- Bottom Logout -->
    <div class="bn-sidebar-footer">

        <a href="{{ route('logout') }}"
           class="bn-logout-btn"
           onclick="event.preventDefault();
           document.getElementById('logout-form').submit();">

            🚪 Logout
        </a>

        <form id="logout-form"
              action="{{ route('logout') }}"
              method="POST"
              class="d-none">
            @csrf
        </form>

    </div>

</aside>
<nav class="bn-navbar sticky-top">

    <div class="bn-logo">
        <a href="{{ url('/') }}">
            <span>BookNest</span>
        </a>
    </div>

    <div class="bn-navbar-right">

        @auth

            <a href="{{ route('home') }}" class="bn-nav-link">
                Dashboard
            </a>

            <div class="dropdown">

                <a href="#" class="bn-nav-link dropdown-toggle text-decoration-none" data-bs-toggle="dropdown"
                    aria-expanded="false">

                    👤 {{ Auth::user()->name }}
                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">

                    <li>
                        <a class="dropdown-item" href="{{ route('books.profile') }}">
                            My Profile
                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                    </li>

                </ul>

            </div>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
            </form>

        @endauth

        @guest
            <a href="{{ route('login') }}" class="bn-nav-link">Login</a>
            <a href="{{ route('register') }}" class="bn-nav-link">Register</a>
        @endguest

    </div>

</nav>

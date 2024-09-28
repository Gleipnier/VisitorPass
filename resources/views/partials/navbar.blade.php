<nav id="navbar" class="navbar">
    <div class="navbar-container">
        <div class="logo">
            <!-- Replace with your actual logo -->
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/file.png') }}" alt="Logo">
            </a>
        </div>
        <button id="menu-toggle" class="menu-toggle">☰</button>
        <ul class="nav-list">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('profile.edit') }}">Edit Profile</a></li>
            @if (Route::has('login'))
            @auth
            <li><a href="{{ route('edit') }}">Edit Visitor Pass</a></li>
            <li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-button">Logout</button>
                </form>
            </li>
            @else
            <li><a href="{{route('login')}}">LogIn</a></li>
            <li><a href="{{route('register')}}">Register</a></li>
            @endauth
            @endif
        </ul>
    </div>
</nav>
<nav id="navbar" class="navbar">
    <div class="navbar-container">
        <div class="logo">
            <!-- Replace with your actual logo -->
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            </a>
        </div>
        <button id="menu-toggle" class="menu-toggle">☰</button>
        <ul class="nav-list">
            <li>
                <a href="{{ route('home') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="30" height="16">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10l9-7 9 7v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V10z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 21V12h6v9" />
                      </svg>                      
                    Home
                </a>
            </li>
        
            @if (Route::has('login'))
                @auth
                <li>
                    <a href="{{ route('user.profile.edit') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536-9 9H6v-3.768l9-9z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.5 3.5a1.5 1.5 0 0 1 2.121 2.121l-1.121 1.121"/>
                          </svg>                                                   
                        Edit Visitor Pass
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.edit') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16" class="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12c3.333 0 6-2.667 6-6s-2.667-6-6-6-6 2.667-6 6 2.667 6 6 6zm0 2c-4 0-12 2-12 6v3h24v-3c0-4-8-6-12-6z"/>
                        </svg>
                        Edit Profile
                    </a>
                </li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-button">
                            Logout
                        </button>
                    </form>
                </li>
                @else
                <li>
                    <a href="{{ route('login') }}">LogIn</a>
                </li>
                <li>
                    <a href="{{ route('register') }}">Register</a>
                </li>
                @endauth
            @endif
        </ul>
        
    </div>
</nav>
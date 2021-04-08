<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">

        <div class="container">

            <a class="navbar-brand me-5 d-flex justify-content-center align-items-center p-0 western text-orange" href="{{ route('home') }}">
                <img src="{{ asset('images/westernssat.png') }}" width="40" height="40" class="me-2" alt="Logo">
                WESTERN'SSAT
            </a>

            <a class="navbar-toggler collapsed" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <i class="fas fa-bars"></i>
            </a>

            <div class="collapse navbar-collapse pt-3 pt-lg-0" id="navbarSupportedContent">

                <ul class="navbar-nav me-auto mb-3 mb-lg-0">

                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link {{ Route::is('home') ? 'active' : '' }}">
                            <i class="fas fa-home"></i>
                            Accueil
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('game') }}" class="nav-link {{ Route::is('game') ? 'active' : '' }}">
                            <i class="fas fa-gamepad"></i>
                            Western Game
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="{{ route('geocache.index') }}" class="nav-link {{ Route::is('geocache.*') ? 'active' : '' }}">
                            <i class="fas fa-gamepad"></i>
                            Géocaching
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('events.index') }}" class="nav-link {{ Route::is('events.*') ? 'active' : '' }}">
                            <i class="fas fa-calendar-day"></i>
                            Événements
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('members.index') }}" class="nav-link {{ Route::is('members.*') ? 'active' : '' }}">
                            <i class="fas fa-users-crown"></i>
                            Membres
                        </a>
                    </li>

                    <!--
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-globe-europe"></i>
                            Poles
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    -->
                </ul>

                <ul class="navbar-nav">
                    @auth

                        @can('admin')

                            <li class="nav-item">
                                <a href="{{ route('admin') }}" class="nav-link {{ Route::is('admin*') ? 'active' : '' }}">
                                    <i class="fas fa-user-shield"></i>
                                    Admin
                                </a>
                            </li>

                        @endcan

                        <li class="nav-item">
                            <a href="{{ route('profile') }}" class="nav-link {{ Route::is('profile') ? 'active' : '' }}">
                                <i class="fas fa-user"></i>
                                Profil
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link">
                                <i class="fas fa-sign-out"></i>
                                Déconnexion
                            </a>
                        </li>

                    @else

                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link {{ Route::is('login') ? 'active' : '' }}">
                                <i class="fas fa-sign-in"></i>
                                Connexion
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link {{ Route::is('register') ? 'active' : '' }}">
                                <i class="fas fa-glass-cheers"></i>
                                Inscription
                            </a>
                        </li>

                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>

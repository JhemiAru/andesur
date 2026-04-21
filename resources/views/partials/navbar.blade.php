<nav class="navbar navbar-expand-lg navbar-dark shadow">
    <div class="container">

        <!-- LOGO -->
        <a class="navbar-brand fw-bold" href="/">
            <i class="fa fa-layer-group"></i> PlantillasPRO
        </a>

        <!-- BOTÓN MOBILE -->
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- MENÚ -->
        <div class="collapse navbar-collapse" id="menu">

            <!-- LINKS -->
            <ul class="navbar-nav ms-auto align-items-center">

                <li class="nav-item">
                    <a class="nav-link" href="/">Inicio</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/plantillas">Plantillas</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Premium</a>
                </li>

                <!-- USUARIO -->
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard">
                            <i class="fa fa-user"></i> Panel
                        </a>
                    </li>

                    <li class="nav-item">
                        <span class="nav-link text-warning">
                            <i class="fa fa-user-circle"></i> {{ Auth::user()->name }}
                        </span>
                    </li>

                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-sm btn-danger ms-2">
                                Salir
                            </button>
                        </form>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link position-relative" href="#">
                            <i class="fa fa-shopping-cart"></i>

                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                0
                            </span>
                        </a>
                    </li>
                @endauth

                <!-- INVITADO -->
                @guest
                    <li class="nav-item">
                        <a class="btn btn-outline-light ms-2" href="{{ route('login') }}">
                            Login
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="btn btn-warning ms-2" href="{{ route('register') }}">
                            Registro
                        </a>
                    </li>
                @endguest

            </ul>

        </div>
    </div>
</nav>

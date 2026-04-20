<!DOCTYPE html>
<html>

<head>
    <title>Catálogo de Plantillas</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Iconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', sans-serif;
        }

        /* NAVBAR */
        .navbar {
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
        }

        /* HERO */
        .hero {
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
            color: white;
            padding: 60px 30px;
            text-align: center;
            border-radius: 15px;
        }

        /* BUSCADOR PRO */
        .search-box {
            position: relative;
            max-width: 600px;
            margin: auto;
        }

        .search-box input {
            border-radius: 50px;
            padding-left: 45px;
            height: 50px;
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 15px;
            color: gray;
        }

        /* CARDS */
        .card {
            border: none;
            border-radius: 15px;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-8px);
        }

        .card img {
            height: 200px;
            object-fit: cover;
        }

        .btn-preview {
            background-color: #0d6efd;
            color: white;
        }

        .btn-preview:hover {
            background-color: #0a58ca;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fa fa-layer-group"></i> PlantillasPRO
            </a>

            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Categorías</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Premium</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contacto</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">

        <!-- HERO -->
        <div class="hero mb-4">
            <h1 class="fw-bold">Descubre Plantillas Web Profesionales</h1>
            <p class="mb-3">Diseños modernos listos para tu negocio 🚀</p>
            <a href="#contenedor" class="btn btn-light">
                Explorar ahora
            </a>
        </div>

        <!-- BUSCADOR -->
        <div class="search-box my-4">
            <i class="fa fa-search"></i>
            <input type="text" id="buscador" class="form-control shadow"
                placeholder="Buscar plantillas modernas...">

            <p class="text-center text-muted">
                Más de {{ count($plantillas) }} plantillas disponibles
            </p>
        </div>


        <!-- CATEGORÍAS -->
        <div class="mb-4 text-center">
            <button class="btn btn-outline-primary rounded-pill px-3 m-1"
                onclick="filtrarCategoria('todas')">Todas</button>

            <button class="btn btn-outline-primary rounded-pill px-3 m-1"
                onclick="filtrarCategoria('Diseño artístico')">Diseño
                artístico</button>
            <button class="btn btn-outline-primary rounded-pill px-3 m-1"
                onclick="filtrarCategoria('Tecnología')">Tecnología</button>
            <button class="btn btn-outline-primary rounded-pill px-3 m-1"
                onclick="filtrarCategoria('Derecho empresarial')">Derecho</button>
            <button class="btn btn-outline-primary rounded-pill px-3 m-1"
                onclick="filtrarCategoria('Comida y restaurante')">Restaurantes</button>
            <button class="btn btn-outline-primary rounded-pill px-3 m-1"
                onclick="filtrarCategoria('Arquitectura y Edificación')">Arquitectura</button>
            <button class="btn btn-outline-primary rounded-pill px-3 m-1"
                onclick="filtrarCategoria('Belleza de la moda')">Moda</button>
            <button class="btn btn-outline-primary rounded-pill px-3 m-1"
                onclick="filtrarCategoria('Educación')">Educación</button>
            <button class="btn btn-outline-primary rounded-pill px-3 m-1"
                onclick="filtrarCategoria('Industrial')">Industrial</button>
            <button class="btn btn-outline-primary rounded-pill px-3 m-1"
                onclick="filtrarCategoria('Interior')">Interior</button>
            <button class="btn btn-outline-primary rounded-pill px-3 m-1"
                onclick="filtrarCategoria('Automóviles y transporte')">Autos</button>
            <button class="btn btn-outline-primary rounded-pill px-3 m-1"
                onclick="filtrarCategoria('Viajes y hoteles')">Viajes</button>
            <button class="btn btn-outline-primary rounded-pill px-3 m-1"
                onclick="filtrarCategoria('Música y entretenimiento')">Música</button>
            <button class="btn btn-outline-primary rounded-pill px-3 m-1"
                onclick="filtrarCategoria('Deportes')">Deportes</button>
            <button class="btn btn-outline-primary rounded-pill px-3 m-1"
                onclick="filtrarCategoria('Rebaja')">Ofertas</button>
            <button class="btn btn-outline-primary rounded-pill px-3 m-1"
                onclick="filtrarCategoria('Medicina y ciencia')">Medicina</button>
            <button class="btn btn-outline-primary rounded-pill px-3 m-1"
                onclick="filtrarCategoria('Naturaleza')">Naturaleza</button>
            <button class="btn btn-outline-primary rounded-pill px-3 m-1"
                onclick="filtrarCategoria('Bienes raíces')">Bienes
                raíces</button>

        </div>

        <!-- CATÁLOGO -->
        <div class="row" id="contenedor">
            @foreach ($plantillas as $p)
                <div class="col-md-4 plantilla-item" data-categoria="{{ $p->categoria }}">
                    <div class="card shadow mb-4">

                        <img src="{{ asset('imagenes/' . $p->imagen) }}">

                        <div class="card-body text-center">
                            <h5 class="nombre">{{ $p->nombre }}</h5>
                            <p>{{ $p->descripcion }}</p>

                            <span clasbtn-outline-primary rounded-pill px-3 mb-2">{{ $p->categoria }}</span><br>

                            <button class="btn btn-preview mb-2" onclick="verPlantilla('{{ $p->carpeta }}')">
                                <i class="fa fa-eye"></i> Vista previa
                            </button>

                            <br>

                            <a href="/plantilla/{{ $p->id }}" class="btn btn-success">
                                <i class="fa fa-external-link"></i> Abrir
                            </a>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

    </div>

    <!-- MODAL -->
    <div class="modal fade" id="modalPlantilla" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Vista previa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <iframe id="framePlantilla" style="width:100%; height:500px; border:none;"></iframe>
                </div>

            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // VISTA PREVIA
        function verPlantilla(carpeta) {
            let url = "/plantillas/" + carpeta + "/index.html";
            document.getElementById("framePlantilla").src = url;

            let modal = new bootstrap.Modal(document.getElementById('modalPlantilla'));
            modal.show();
        }

        // BUSCADOR
        document.getElementById("buscador").addEventListener("keyup", function() {
            let filtro = this.value.toLowerCase();
            let items = document.querySelectorAll(".plantilla-item");

            items.forEach(item => {
                let nombre = item.querySelector(".nombre").textContent.toLowerCase();
                item.style.display = nombre.includes(filtro) ? "" : "none";
            });
        });

        // FILTRO POR CATEGORÍA
        function filtrarCategoria(categoria) {
            let items = document.querySelectorAll(".plantilla-item");

            items.forEach(item => {
                let cat = item.getAttribute("data-categoria");

                if (categoria === "todas" || cat === categoria) {
                    item.style.display = "";
                } else {
                    item.style.display = "none";
                }
            });
        }
    </script>

</body>

</html>

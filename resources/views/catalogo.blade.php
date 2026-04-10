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
            background-color: #f5f7fa;
        }

        .navbar {
            background-color: #0d6efd;
        }

        .navbar-brand {
            color: white;
            font-weight: bold;
        }

        .hero {
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
            color: white;
            padding: 50px;
            text-align: center;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-10px);
            transition: 0.3s;
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
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <span class="navbar-brand">PlantillasPRO</span>
    </div>
</nav>

<div class="container mt-4">

    <!-- HERO -->
    <div class="hero">
        <h1>Explora Plantillas Web</h1>
        <p>Elige el diseño perfecto para tu negocio</p>
    </div>

    <!-- BUSCADOR -->
    <input type="text" id="buscador" class="form-control mb-4" placeholder="Buscar plantilla...">

    <!-- CATÁLOGO -->
    <div class="row" id="contenedor">
        @foreach($plantillas as $p)
            <div class="col-md-4 plantilla-item">
                <div class="card shadow mb-4">

                    <img src="{{ asset('imagenes/'.$p->imagen) }}">

                    <div class="card-body text-center">
                        <h5 class="nombre">{{ $p->nombre }}</h5>
                        <p>{{ $p->descripcion }}</p>

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
</script>

</body>
</html>
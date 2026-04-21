@extends('layouts.app')

@section('title', 'Catálogo')

@section('content')

    {{-- ALERTA --}}
    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <!-- HERO -->
    <div class="hero mb-4">
        <h1 class="fw-bold">Descubre Plantillas Web</h1>
        <p>Diseños modernos para tu negocio 🚀</p>
    </div>

    <!-- BUSCADOR -->
    <div class="search-box my-4">
        <i class="fa fa-search"></i>
        <input type="text" id="buscador" class="form-control shadow" placeholder="Buscar plantillas...">
    </div>

    <p class="text-center text-muted">
        {{ count($plantillas) }} plantillas disponibles
    </p>

    <!-- CATEGORÍAS -->
    <div class="text-center mb-4">
        <button class="btn btn-outline-primary rounded-pill m-1" onclick="filtrarCategoria('todas')">Todas</button>
        <button class="btn btn-outline-primary rounded-pill m-1"
            onclick="filtrarCategoria('Tecnología')">Tecnología</button>
        <button class="btn btn-outline-primary rounded-pill m-1"
            onclick="filtrarCategoria('Comida y restaurante')">Restaurantes</button>
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

                        {{-- BADGE --}}
                        <span class="badge bg-primary">{{ $p->categoria }}</span><br><br>

                        {{-- TIPO --}}
                        @if ($p->tipo == 'premium')
                            <span class="badge bg-warning text-dark mb-2">Premium</span>
                        @else
                            <span class="badge bg-success mb-2">Gratis</span>
                        @endif

                        <br>

                        {{-- BOTONES --}}
                        <button class="btn btn-primary" onclick="verPlantilla('{{ $p->carpeta }}')">
                            <i class="fa fa-eye"></i> Vista previa
                        </button>

                        <a href="/plantilla/{{ $p->id }}" class="btn btn-success">
                            Abrir
                        </a>

                        {{-- COMPRA --}}
                        @if ($p->tipo == 'premium')
                            <form method="POST" action="/comprar/{{ $p->id }}">
                                @csrf
                                <input type="hidden" name="precio" value="{{ $p->precio }}">

                                <button class="btn btn-warning w-100 mt-2">
                                    <i class="fa fa-shopping-cart"></i> Comprar (${{ $p->precio }})
                                </button>
                            </form>
                        @endif

                    </div>

                </div>
            </div>
        @endforeach
    </div>

    <!-- MODAL VISTA PREVIA -->
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

@endsection

@section('scripts')
    <script>
        // VISTA PREVIA
        function verPlantilla(carpeta) {
            let url = "/plantillas/" + carpeta + "/index.html";
            document.getElementById("framePlantilla").src = url;

            let modal = new bootstrap.Modal(document.getElementById('modalPlantilla'));
            modal.show();
        }

        // BUSCADOR AJAX PRO
        document.getElementById("buscador").addEventListener("keyup", function() {

            let query = this.value;

            fetch(`/buscar?q=${query}`)
                .then(res => res.json())
                .then(data => {

                    let contenedor = document.getElementById("contenedor");
                    contenedor.innerHTML = "";

                    if (data.length === 0) {
                        contenedor.innerHTML = "<p class='text-center'>No se encontraron resultados</p>";
                        return;
                    }

                    data.forEach(p => {

                        let tipoBadge = p.tipo === 'premium' ?
                            `<span class="badge bg-warning text-dark mb-2">Premium</span>` :
                            `<span class="badge bg-success mb-2">Gratis</span>`;

                        let botonCompra = '';

                        if (p.tipo === 'premium') {
                            botonCompra = `
                    <form method="POST" action="/comprar/${p.id}">
                        <input type="hidden" name="_token" value="${document.querySelector('meta[name=csrf-token]').content}">
                        <input type="hidden" name="precio" value="${p.precio}">
                        <button class="btn btn-warning w-100 mt-2">
                            Comprar ($${p.precio})
                        </button>
                    </form>`;
                        }

                        contenedor.innerHTML += `
                <div class="col-md-4 plantilla-item" data-categoria="${p.categoria}">
                    <div class="card shadow mb-4">

                        <img src="/imagenes/${p.imagen}">

                        <div class="card-body text-center">
                            <h5 class="nombre">${p.nombre}</h5>
                            <p>${p.descripcion}</p>

                            <span class="badge bg-primary">${p.categoria}</span><br><br>

                            ${tipoBadge}<br>

                            <button class="btn btn-primary" onclick="verPlantilla('${p.carpeta}')">
                                Vista previa
                            </button>

                            <a href="/plantilla/${p.id}" class="btn btn-success">
                                Abrir
                            </a>

                            ${botonCompra}
                        </div>
                    </div>
                </div>
                `;
                    });

                });

        });

        // FILTRO POR CATEGORÍA
        function filtrarCategoria(cat) {
            let items = document.querySelectorAll(".plantilla-item");

            items.forEach(item => {
                let categoria = item.getAttribute("data-categoria");

                if (cat === "todas" || categoria === cat) {
                    item.style.display = "";
                } else {
                    item.style.display = "none";
                }
            });
        }
    </script>
@endsection

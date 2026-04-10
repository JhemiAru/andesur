<!DOCTYPE html>
<html>
<head>
    <title>Agregar Plantilla</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Agregar Nueva Plantilla</h2>

    <form action="/guardar" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="nombre" class="form-control mb-2" placeholder="Nombre">

        <textarea name="descripcion" class="form-control mb-2" placeholder="Descripción"></textarea>

        <input type="file" name="imagen" class="form-control mb-2">

        <input type="text" name="carpeta" class="form-control mb-2" placeholder="Nombre de carpeta (ej: plantilla3)">

        <button class="btn btn-success">Guardar</button>
    </form>
</div>

</body>
</html>
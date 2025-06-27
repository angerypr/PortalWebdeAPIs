<?php
include('../plantilla.php');
Plantilla::aplicar();
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: rgb(231, 231, 192);
    }

    .btn-primary {
        background-color: rgb(214, 173, 61);
        border: none;
    }

    .btn-primary:hover {
        background-color: rgb(160, 130, 46);
    }

    .img-result {
        margin-top: 20px;
        text-align: center;
    }

    .img-result img {
        max-width: 100%;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }
</style>

<div class="container mt-4 mb-5">
    <h2 class="text-center mb-4">Generador de imágenes con IA 🖼️</h2>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form id="formImagen" class="card p-4 rounded-4 shadow" onsubmit="return false;">
                <div class="mb-3">
                    <label for="palabraClave" class="form-label">Palabra clave:</label>
                    <input type="text" class="form-control" id="palabraClave" placeholder="Ej. cat, robot, beach" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Buscar imagen</button>
            </form>

            <div id="resultadoImagen" class="img-result"></div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="../index.php" class="btn btn-secondary">Volver al Inicio</a>
    </div>
</div>

<script>
document.getElementById("formImagen").addEventListener("submit", () => {
    const palabra = document.getElementById("palabraClave").value.trim();
    const resultado = document.getElementById("resultadoImagen");
    resultado.innerHTML = "";

    if (!palabra) {
        resultado.innerHTML = `<div class="alert alert-warning">Ingresa una palabra clave.</div>`;
        return;
    }

    fetch(`../api_unsplash.php?q=${encodeURIComponent(palabra)}`)
        .then(res => {
            if (!res.ok) throw new Error("No se pudo obtener imagen.");
            return res.json();
        })
        .then(data => {
            if (!data.results || data.results.length === 0) {
                resultado.innerHTML = `<div class="alert alert-secondary">No se encontraron imágenes para <strong>${palabra}</strong>.</div>`;
                return;
            }

            const imagen = data.results[0].urls.small;
            resultado.innerHTML = `<img src="${imagen}" alt="Imagen de ${palabra}" class="img-fluid mt-3">`;
        })
        .catch(error => {
            resultado.innerHTML = `<div class="alert alert-danger">Error: ${error.message}</div>`;
            console.error(error);
        });
});
</script>

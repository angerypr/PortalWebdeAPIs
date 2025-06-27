<?php
include('../plantilla.php');
Plantilla::aplicar();
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<style>
    body {
        background: rgb(231, 231, 192);
        font-family: 'Poppins', sans-serif;
    }

    .card-chiste {
        background: white;
        border-radius: 12px;
        padding: 20px;
        margin-top: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        font-size: 1.2rem;
    }

    .chiste-pregunta {
        font-weight: bold;
        font-size: 1.3rem;
    }

    .btn-recargar {
        margin-top: 20px;
        background-color: rgb(214, 173, 61);
        border: none;
    }

    .btn-recargar:hover {
        background-color: rgb(160, 130, 46);
    }
</style>

<div class="container mt-4 mb-5">
    <h2 class="text-center mb-4">Generador de chistes 🤣</h2>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="chisteContenedor" class="card-chiste">
                Cargando chiste...
            </div>
            <div class="text-center">
                <button class="btn btn-primary btn-recargar mt-3" onclick="cargarChiste()">
                    <i class="bi bi-arrow-repeat"></i> Otro chiste
                </button>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="../index.php" class="btn btn-secondary">Volver al Inicio</a>
    </div>
</div>

<script>
function cargarChiste() {
    const contenedor = document.getElementById("chisteContenedor");
    contenedor.innerHTML = "Cargando chiste...";

    fetch("https://official-joke-api.appspot.com/random_joke")
        .then(response => {
            if (!response.ok) throw new Error("No se pudo cargar el chiste.");
            return response.json();
        })
        .then(data => {
            contenedor.innerHTML = `
                <div class="chiste-pregunta">${data.setup}</div>
                <div class="chiste-respuesta mt-3">${data.punchline}</div>
            `;
        })
        .catch(error => {
            contenedor.innerHTML = `<div class="text-danger">Error al cargar el chiste.</div>`;
            console.error(error);
        });
}

// Cargar chiste automáticamente al entrar
window.addEventListener("DOMContentLoaded", cargarChiste);
</script>

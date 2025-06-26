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

    .form-label {
        font-weight: 600;
    }

    .btn-primary {
        background-color: rgb(214, 173, 61);
        border: none;
    }

    .btn-primary:hover {
        background-color: rgb(160, 130, 46);
    }

    .card-universidad {
        background: white;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .card-universidad a {
        text-decoration: none;
        color: rgb(17, 50, 71);
        font-weight: bold;
    }

    .card-universidad small {
        color: #555;
    }
</style>

<div class="container mt-4 mb-5">
    <h2 class="text-center mb-4">Universidades de un país 🎓</h2>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form id="formUniversidades" class="card p-4 rounded-4 shadow border-0" onsubmit="return false;">
                <div class="mb-3">
                    <label for="paisUniversidades" class="form-label">Nombre del país (en inglés):</label>
                    <input type="text" class="form-control" id="paisUniversidades" placeholder="Ej. Dominican Republic" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Buscar universidades</button>
            </form>

            <div id="resultadoUniversidades" class="mt-4"></div>
        </div>
    </div>
</div>

<script>
    document.getElementById("formUniversidades").addEventListener("submit", function () {
        const paisUniversidades = document.getElementById("paisUniversidades").value.trim();
        const resultadoUniversidades = document.getElementById("resultadoUniversidades");
        resultadoUniversidades.innerHTML = "";

        if (paisUniversidades === "") {
            resultadoUniversidades.innerHTML = `<div class="alert alert-warning">Por favor ingresa un país en inglés.</div>`;
            return;
        }

        fetch(`http://universities.hipolabs.com/search?country=${encodeURIComponent(paisUniversidades)}`)
            .then(response => response.json())
            .then(universidades => {
                if (universidades.length === 0) {
                    resultadoUniversidades.innerHTML = `<div class="alert alert-secondary">No se encontraron universidades para <strong>${paisUniversidades}</strong>.</div>`;
                    return;
                }

                let htmlUniversidades = '';
                universidades.forEach(universidad => {
                    htmlUniversidades += `
                        <div class="card-universidad">
                            <div><i class="bi bi-mortarboard-fill"></i> <strong>${universidad.name}</strong></div>
                            <small>${universidad.domains[0]}</small><br>
                            <a href="${universidad.web_pages[0]}" target="_blank"><i class="bi bi-link-45deg"></i> Visitar sitio web</a>
                        </div>
                    `;
                });

                resultadoUniversidades.innerHTML = htmlUniversidades;
            })
            .catch(error => {
                resultadoUniversidades.innerHTML = `<div class="alert alert-danger">Error al consultar la API.</div>`;
                console.error(error);
            });
    });
</script>

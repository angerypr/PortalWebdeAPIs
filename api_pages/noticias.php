<?php
include('../plantilla.php');
Plantilla::aplicar();
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: rgb(231, 231, 192);
    }
    .card {
        border-radius: 12px;
    }
    .site-logo {
        max-height: 50px;
        margin-bottom: 15px;
    }
    .btn-primary {
        background-color: rgb(214, 173, 61);
        border: none;
    }

    .btn-primary:hover {
        background-color: rgb(160, 130, 46);
    }
</style>

<div class="container mt-4 mb-5">
    <h2 class="text-center mb-4">Noticias desde WordPress 📰</h2>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form id="formNoticias" class="card p-4 shadow" onsubmit="return false;">
                <div class="mb-3">
                    <label for="urlWordpress" class="form-label">URL base de la página WordPress:</label>
                    <input type="url" class="form-control" id="urlWordpress" placeholder="Ej. https://elpais.com" required>
                    <div class="form-text">Debe ser la URL base del sitio, sin barra al final.</div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Obtener noticias</button>
            </form>

            <div id="resultadoNoticias" class="mt-4"></div>
        </div>
    </div>
    <div class="text-center mt-4">
    <a href="../index.php" class="btn btn-secondary">Volver al Inicio</a>
</div>
</div>

<script>
document.getElementById('formNoticias').addEventListener('submit', () => {
    const baseUrl = document.getElementById('urlWordpress').value.trim().replace(/\/$/, '');
    const resultado = document.getElementById('resultadoNoticias');
    resultado.innerHTML = "";

    if (!baseUrl) {
        resultado.innerHTML = `<div class="alert alert-warning">Por favor, ingresa la URL base del sitio WordPress.</div>`;
        return;
    }

    fetch(`${baseUrl}/wp-json/`)
        .then(res => {
            if (!res.ok) throw new Error('No es un sitio WordPress válido o no permite acceso a la API.');
            return res.json();
        })
        .then(apiData => {
            let logoUrl = null;
            if (apiData && apiData.site_logo) {
                logoUrl = apiData.site_logo;
            } else if (apiData?.home) {
                logoUrl = null;
            }

            return fetch(`${baseUrl}/wp-json/wp/v2/posts?per_page=3`);
        })
        .then(res => {
            if (!res.ok) throw new Error('No se pudo obtener las noticias.');
            return res.json();
        })
        .then(posts => {
            if (!posts.length) {
                resultado.innerHTML = `<div class="alert alert-info">No se encontraron noticias.</div>`;
                return;
            }

            let html = '<div class="list-group">';
            posts.forEach(post => {
                const titulo = post.title.rendered || "Sin título";
                const resumen = post.excerpt.rendered.replace(/<\/?[^>]+(>|$)/g, "").slice(0, 200) + '...';
                const enlace = post.link;

                html += `
                    <a href="${enlace}" target="_blank" class="list-group-item list-group-item-action mb-3 shadow-sm rounded">
                        <h5>${titulo}</h5>
                        <p>${resumen}</p>
                        <small><i class="bi bi-box-arrow-up-right"></i> Leer más</small>
                    </a>
                `;
            });
            html += '</div>';

            resultado.innerHTML = html;
        })
        .catch(error => {
            resultado.innerHTML = `<div class="alert alert-danger">Error: ${error.message}</div>`;
            console.error(error);
        });
});
</script>

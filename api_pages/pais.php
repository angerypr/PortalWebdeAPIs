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

    .card-pais {
        background: white;
        border-radius: 12px;
        padding: 20px;
        margin-top: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .card-pais img {
        width: 150px;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .card-pais h4 {
        font-weight: bold;
    }

    .card-pais p {
        margin-bottom: 6px;
    }
</style>

<div class="container mt-4 mb-5">
    <h2 class="text-center mb-4">Datos de un país 🌍</h2>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form id="formPais" class="card p-4 rounded-4 shadow border-0" onsubmit="return false;">
                <div class="mb-3">
                    <label for="nombrePais" class="form-label">Nombre del país:</label>
                    <input type="text" class="form-control" id="nombrePais" placeholder="Ej. Dominican Republic" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Buscar</button>
            </form>

            <div id="resultadoPais" class="mt-4"></div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="../index.php" class="btn btn-secondary">Volver al Inicio</a>
    </div>
</div>

<script>
    document.getElementById("formPais").addEventListener("submit", () => {
        const nombrePais = document.getElementById("nombrePais").value.trim();
        const resultadoPais = document.getElementById("resultadoPais");
        resultadoPais.innerHTML = "";

        if (!nombrePais) {
            resultadoPais.innerHTML = `<div class="alert alert-warning">Por favor ingresa el nombre de un país.</div>`;
            return;
        }

        fetch(`https://restcountries.com/v3.1/name/${encodeURIComponent(nombrePais)}`)
            .then(response => {
                if (!response.ok) throw new Error("País no encontrado.");
                return response.json();
            })
            .then(data => {
                const pais = data[0];
                const nombre = pais.name.common;
                const capital = pais.capital ? pais.capital[0] : "No disponible";
                const poblacion = pais.population.toLocaleString();
                const moneda = Object.values(pais.currencies)[0].name + " (" + Object.values(pais.currencies)[0].symbol + ")";
                const bandera = pais.flags.png;

                resultadoPais.innerHTML = `
                    <div class="card-pais shadow-sm">
                        <img src="${bandera}" alt="Bandera de ${nombre}">
                        <h4>${nombre}</h4>
                        <p><i class="bi bi-geo-alt-fill"></i> Capital: <strong>${capital}</strong></p>
                        <p><i class="bi bi-people-fill"></i> Población: <strong>${poblacion}</strong></p>
                        <p><i class="bi bi-currency-exchange"></i> Moneda: <strong>${moneda}</strong></p>
                    </div>
                `;
            })
            .catch(error => {
                resultadoPais.innerHTML = `<div class="alert alert-danger">Error: ${error.message}</div>`;
                console.error(error);
            });
    });
</script>

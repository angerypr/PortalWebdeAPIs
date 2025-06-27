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

    .btn-primary {
        background-color: rgb(214, 173, 61);
        border: none;
    }

    .btn-primary:hover {
        background-color: rgb(160, 130, 46);
    }

    .resultado-conversion {
        font-size: 1.3rem;
        margin-top: 20px;
    }

    .moneda-icon {
        font-size: 1.5rem;
        margin-right: 8px;
        vertical-align: middle;
    }
</style>

<div class="container mt-5 mb-5">
    <h2 class="text-center mb-4">Conversión de Monedas 💰</h2>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form id="formConversion" class="card p-4 rounded-4 shadow" onsubmit="return false;">
                <div class="mb-3">
                    <label for="cantidadUSD" class="form-label">Cantidad en USD:</label>
                    <input type="number" class="form-control" id="cantidadUSD" placeholder="Ej. 100" min="0" step="any" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Convertir</button>
            </form>

            <div id="resultadoConversion" class="resultado-conversion"></div>
        </div>
    </div>
    <div class="text-center mt-4">
    <a href="../index.php" class="btn btn-secondary">Volver al Inicio</a>
</div>
</div>

<script>
document.getElementById('formConversion').addEventListener('submit', () => {
    const cantidad = parseFloat(document.getElementById('cantidadUSD').value);
    const resultadoDiv = document.getElementById('resultadoConversion');
    resultadoDiv.innerHTML = '';

    if (isNaN(cantidad) || cantidad <= 0) {
        resultadoDiv.innerHTML = `<div class="alert alert-warning">Por favor ingresa una cantidad válida mayor que 0.</div>`;
        return;
    }

    fetch('https://api.exchangerate-api.com/v4/latest/USD')
        .then(res => {
            if (!res.ok) throw new Error('Error al obtener los tipos de cambio.');
            return res.json();
        })
        .then(data => {
            const monedas = {
    DOP: '<i class="bi bi-currency-dollar"></i>',
    EUR: '<i class="bi bi-currency-euro"></i>',
    MXN: '<i class="bi bi-currency-dollar"></i>',
    GBP: '<i class="bi bi-currency-pound"></i>',
    JPY: '<i class="bi bi-currency-yen"></i>'
};

            let html = `<h5>Resultados para <strong>${cantidad.toFixed(2)} USD</strong>:</h5><ul class="list-group mt-3">`;

            for (const [moneda, icono] of Object.entries(monedas)) {
                const tasa = data.rates[moneda];
                if (!tasa) continue;
                const valor = (cantidad * tasa).toFixed(2);
                html += `<li class="list-group-item"><span class="moneda-icon">${icono}</span> <strong>${moneda}:</strong> ${valor}</li>`;
            }

            html += '</ul>';
            resultadoDiv.innerHTML = html;
        })
        .catch(error => {
            resultadoDiv.innerHTML = `<div class="alert alert-danger">Error: ${error.message}</div>`;
            console.error(error);
        });
});
</script>

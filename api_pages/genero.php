<?php
include('../plantilla.php');
Plantilla::aplicar();

$nombreGenero = '';
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<style>
    body {
        background: rgb(231, 231, 192);
    }

    .titulo-prediccion {
        font-family: 'Poppins', sans-serif;
        font-size: 2.5rem;
        font-weight: 700;
        text-align: center;
        color: rgb(17, 50, 71);
        margin-bottom: 40px;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.4);
        letter-spacing: 1px;
    }

    .form-card {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 20px;
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

    .alert {
        font-size: 1.2rem;
        border-radius: 12px;
    }
</style>

<div class="container mt-4 mb-5">
    <h2 class="text-center mb-4">Predicción de Género 👦👧</h2>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form id="formGenero" class="card p-4 rounded-4 shadow border-0" onsubmit="return false;">
                <div class="mb-3">
                    <label for="nombreGenero" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" name="nombreGenero" id="nombreGenero" placeholder="Ej. Georgia" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Predecir género</button>
            </form>

            <div id="resultadoGenero" class="mt-4"></div>
        </div>
    </div>
<div class="text-center mt-4">
    <a href="../index.php" class="btn btn-secondary">Volver al Inicio</a>
</div>
</div>

<script>
    document.getElementById('formGenero').addEventListener('submit', function() {
        const nombreGenero = document.getElementById('nombreGenero').value.trim();
        const resultadoGeneroDiv = document.getElementById('resultadoGenero');
        resultadoGeneroDiv.innerHTML = ''; 

        if (nombreGenero === '') {
            resultadoGeneroDiv.innerHTML = `<div class="alert alert-warning">Por favor ingresa un nombre.</div>`;
            return;
        }

        fetch(`https://api.genderize.io/?name=${encodeURIComponent(nombreGenero)}`)
            .then(response => response.json())
            .then(data => {
                if (!data.gender) {
                    resultadoGeneroDiv.innerHTML = `
                        <div class="alert alert-secondary text-center">
                            <i class="bi bi-question-circle"></i>
                            El nombre <strong>${nombreGenero}</strong> no pudo ser identificado.
                        </div>`;
                    return;
                }

                let color = '';
                let icono = '';
                let generoTexto = '';
                if (data.gender === 'male') {
                    color = 'rgb(46, 80, 148)';
                    icono = 'bi-gender-male';
                    generoTexto = 'Masculino';
                } else if (data.gender === 'female') {
                    color = 'rgb(229, 106, 184)';
                    icono = 'bi-gender-female';
                    generoTexto = 'Femenino';
                } else {
                    color = '#6c757d';
                    icono = 'bi-question-circle';
                    generoTexto = '';
                }

                const probabilidad = data.probability ? (data.probability * 100).toFixed(1) : null;
                if (probabilidad) {
                    generoTexto += ` <small>(${probabilidad}% seguro)</small>`;
                }

                resultadoGeneroDiv.innerHTML = `
                    <div class="alert text-white text-center" style="background-color: ${color};">
                        <i class="bi ${icono}"></i> El nombre <strong>${nombreGenero}</strong> es probablemente <strong>${generoTexto}</strong>
                    </div>`;
            })
            .catch(error => {
                resultadoGeneroDiv.innerHTML = `<div class="alert alert-danger">Error al obtener datos de la API.</div>`;
                console.error('Error:', error);
            });
    });
</script>

<?php
include('plantilla.php');
Plantilla::aplicar();
?>
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

<style>
    body{
        background: rgb(231, 231, 192);
        font-family: 'Poppins', sans-serif;
    }

    .profile-img {
        border: 4px solid rgb(214, 173, 61);
        border-radius: 50%;
        width: 160px;
        height: 160px;
        object-fit: cover;
    }

    .titulo.seccion {
        color: rgb(17, 50, 71);
        font-size: 1.8rem;
        font-weight: bold;
        margin: 60px 0 20px;
        text-align: center;
    }

    .api-card {
        border-radius: 20px;
        background: rgb(214, 173, 61);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        transition: 0.3s ease-in-out;
        text-align: center;
        padding: 25px, 20px;
        height: 100%;
        color: rgb(211, 211, 211);
    }

    .api-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(115, 25, 25, 0.4);
        background: rgb(160, 130, 46);
    }

    .api-icon {
        font-size: 2.5rem;
        color: white;
        margin-bottom: 10px;
    }

    .api-title {
        font-weight: 600;
        color: white;
    }

    .api-desc {
        color: white;
        font-size: 0.95rem;
    }

</style>

<div class="container mt-2">
    <div class="row justify-content-center text-center">
        <div class="col-lg-8 mb-1">
            <img src="imagenes/mifoto.jpg" class="profile-img shadow mb-3">
            <h1 class="fw-bold">Angery Payamps</h1>
            <p class="text-muted">Portal Web en PHP con 10 APIs Externas</p>
        </div>
    </div>

    <h2 class="titulo seccion shadow">Menú de navegación</h2>
    <div class="row g-4 mb-5 justify-content-center text-center">
        <?php
        $apis = [
            ["genero.php", "Predicción de Género", "bi-gender-ambiguous", "Detecta si un nombre es masculino o femenino"],
            ["edad.php", "Predicción de Edad", "bi-hourglass-split", "Estima edad a partir de un nombre"],
            ["universidades.php", "Universidades", "bi-mortarboard-fill", "Universidades por país"],
            ["clima.php", "Clima", "bi-cloud-sun", "Consulta el clima por ciudad"],
            ["pokemon.php", "Pokémon", "bi-lightning-fill", "Detalles del Pokémon (incluye sonido)"],
            ["noticias.php", "Noticias", "bi-newspaper", "Últimas noticias desde WordPress"],
            ["monedas.php", "Conversor de Monedas", "bi-currency-exchange", "Convierte USD a DOP y más"],
            ["imagenes.php", "Imágenes IA", "bi-image-fill", "Busca imágenes por palabra clave"],
            ["pais.php", "Datos de País", "bi-geo-alt-fill", "Capital, bandera, población, etc."],
            ["chistes.php", "Chistes Aleatorios", "bi-emoji-laughing", "Chistes para alegrarte el día"]
        ];

        foreach ($apis as $api) {
            echo '
            <div class="col-12 col-sm-6 col-md-4">
                <a href="api_pages/' . $api[0] . '" class="text-decoration-none">
                    <div class="api-card">
                        <div class="api-icon"><i class="bi ' . $api[2] . '"></i></div>
                        <h5 class="api-title">' . $api[1] . '</h5>
                        <p class="api-desc">' . $api[3] . '</p>
                    </div>
                </a>
            </div>';
        }
        ?>
    </div>
    <div class="row justify-content-center text-center">
        <div class="col-lg-10">
            <div class="card p-4 rounded-4 shadow-sm border-0">
                <h2 class="mb-3">Acerca de</h2>
                <p>
                    Este portal fue desarrollado usando <strong>PHP</strong> y el framework <strong>Bootstrap 5</strong>
                    para crear una interfaz moderna, responsiva y limpia. Bootstrap fue elegido por su sistema de
                    componentes personalizables y facilidad para diseñar aplicaciones web profesionales sin necesidad
                    de escribir mucho CSS personalizado y por preferencia de estilo.
                </p>
            </div>
        </div>
    </div>
</div>
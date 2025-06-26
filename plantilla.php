<?php
class Plantilla {
    public static $instancia = null;

    public static function aplicar(): Plantilla {
        if (self::$instancia == null) {
            self::$instancia = new Plantilla();
        }
        return self::$instancia;
    }

    public function __construct() {
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Portal de APIs - Angery Payamps</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
            <style>
                body {
                    font-family: 'Inter', sans-serif;
                    padding-top: 90px;
                    background-color:transparent;
                }
                .navbar-custom {
                    background-color:rgb(17, 50, 71);
                    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
                }
                .nav-link {
                    font-weight: 500;
                    transition: 0.3s ease;
                }
                .nav-link:hover {
                    background-color: rgba(255,255,255,0.1);
                    border-radius: 5px;
                }
                footer {
                    padding-top: 2rem;
                }
            </style>
        </head>
        <body>
            <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
                <div class="container">
                    <a class="navbar-brand fw-bold" href="/index.php">Portal APIs</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto gap-2">
                            <li class="nav-item"><a class="nav-link" href="/api_pages/genero.php">Género</a></li>
                            <li class="nav-item"><a class="nav-link" href="/api_pages/edad">Edad</a></li>
                            <li class="nav-item"><a class="nav-link" href="/api_pages/universidades">Universidades</a></li>
                            <li class="nav-item"><a class="nav-link" href="/api_pages/clima">Clima</a></li>
                            <li class="nav-item"><a class="nav-link" href="/api_pages/pokemon">Pokémon</a></li>
                            <li class="nav-item"><a class="nav-link" href="/api_pages/noticias">Noticias</a></li>
                            <li class="nav-item"><a class="nav-link" href="/api_pages/monedas">Monedas</a></li>
                            <li class="nav-item"><a class="nav-link" href="/api_pages/imagenes">Imágenes</a></li>
                            <li class="nav-item"><a class="nav-link" href="/api_pages/pais">País</a></li>
                            <li class="nav-item"><a class="nav-link" href="/api_pages/chistes">Chistes</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <?php
    }

    public function __destruct() {
        ?>
        <footer class="text-center text-muted mt-5 mb-4">
            <hr>
            <p>&copy; <?= date('Y') ?> Angery Payamps - Portal Web con APIs</p>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
        <?php
    }
}
?>
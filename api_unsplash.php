<?php
require_once __DIR__ . '/vendor/autoload.php'; 

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

header('Content-Type: application/json');

if (!isset($_GET['q']) || empty(trim($_GET['q']))) {
    echo json_encode(['error' => 'No se proporcionó palabra clave']);
    exit;
}

$query = urlencode(trim($_GET['q']));
$accessKey = $_ENV['UNSPLASH_ACCESS_KEY'];

$url = "https://api.unsplash.com/search/photos?query={$query}&per_page=1&client_id={$accessKey}";

$response = file_get_contents($url);

if ($response === false) {
    echo json_encode(['error' => 'Error al obtener datos de Unsplash']);
    exit;
}

echo $response;

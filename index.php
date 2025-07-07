<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// CORS - doit être fait avant toute sortie
$allowedOrigins = ['http://localhost:5174'];

if (isset($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'], $allowedOrigins)) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
}

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Inclure les fichiers ensuite
require_once __DIR__ . '/Models/User.php';
require_once __DIR__ . '/Controllers/UserController.php';

$uri = strtolower(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$method = $_SERVER['REQUEST_METHOD'];
var_dump($uri);
switch ($uri) {
    case '/api-ldvelh/api/login':
        if ($method === 'POST') {
            (new UserController())->login();
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Méthode non autorisée']);
        }
        break;
    case '/api-ldvelh/api/signup':
        if ($method === 'POST') {
            (new UserController())->signup();
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Méthode non autorisée']);
        }
        break;
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Route non trouvée']);
        break;
}

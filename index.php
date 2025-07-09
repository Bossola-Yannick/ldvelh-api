<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// CORS - doit être fait avant toute sortie
// si le front est sur localhost 5173 le changer ici ET dans le .htaccess
$allowedOrigins = ['http://localhost:5173'];
// $allowedOrigins = ['http://localhost:5174'];

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
require_once __DIR__ . '/Controllers/LoneWolfController.php';

$uri = strtolower(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$method = $_SERVER['REQUEST_METHOD'];
// var_dump($uri);
switch ($uri) {
    case '/api-ldvelh/api/login':
        if ($method === 'POST') {
            (new UserController())->login();
        } else {
            http_response_code(405);
            echo json_encode([
                'status' => 'error',
                'message' => 'Methode non autorisée'
            ]);
            exit();
        }
        break;
    case '/api-ldvelh/api/signup':
        if ($method === 'POST') {
            (new UserController())->signup();
        } else {
            http_response_code(405);
            echo json_encode([
                'status' => 'error',
                'message' => 'Methode non autorisée'
            ]);
            exit();
        }
        break;
    case '/api-ldvelh/api/getalladventurebyuser':
        if ($method === 'GET') {
            if (isset($_GET['userId'])) {
                $userId = intval($_GET['userId']); // sécurisation de l'entrée
                (new UserController())->getAllAdventureByUser($userId);
            } else {
                http_response_code(400);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Paramètre "userId" manquant'
                ]);
                exit();
            }
        } else {
            http_response_code(405);
            echo json_encode([
                'status' => 'error',
                'message' => 'Méthode non autorisée'
            ]);
            exit();
        }
        break;
    case '/api-ldvelh/api/lonewolf/getadventurebyid':
        if ($method === 'GET') {
            if (isset($_GET['adventureId'])) {
                $adventureId = intval($_GET['adventureId']);
                (new LoneWolfController())->getAdventureById($adventureId);
            } else {
                http_response_code(400);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Paramètre "userId" manquant'
                ]);
                exit();
            }
        } else {
            http_response_code(405);
            echo json_encode([
                'status' => 'error',
                'message' => 'Méthode non autorisée'
            ]);
            exit();
        }
        break;
    //  TODO route a faire !!!
    case '/api-ldvelh/api/lonewolf/createadventure':
        if ($method === 'POST') {
            (new LoneWolfController())->createAdventure();
        } else {
            http_response_code(405);
            echo json_encode([
                'status' => 'error',
                'message' => 'Methode non autorisée'
            ]);
            exit();
        }
        break;
    // case '/api-ldvelh/api/lonewolf/updateadventurebyid':
    // case '/api-ldvelh/api/lonewolf/deleteadventurebyid':
    // case '/api-ldvelh/api/fighhtingfantasy/getadventurebyid':
    // case '/api-ldvelh/api/fighhtingfantasy/updateadventurebyid':
    // case '/api-ldvelh/api/fighhtingfantasy/deleteadventurebyid':
    // case '/api-ldvelh/api/fighhtingfantasy/createadventurebyid':
    // case '/api-ldvelh/api/grailquest/getadventurebyid':
    // case '/api-ldvelh/api/grailquest/updateadventurebyid':
    // case '/api-ldvelh/api/grailquest/deleteadventurebyid':
    // case '/api-ldvelh/api/grailquest/createadventurebyid':
    default:
        http_response_code(404);
        echo json_encode([
            'status' => 'error',
            'message' => 'Route non trouvée'
        ]);
        exit();
        break;
}

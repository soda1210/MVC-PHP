<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../app/controllers/ItemController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);
$method = $_SERVER['REQUEST_METHOD'];

if (!isset($uri[3]) || $uri[2] != 'public' || $uri[3] != 'index.php') {
    sendResponse(404, "Page not found");
    exit();
}

if (!isset($uri[4]) || $uri[4] != 'items') {
    sendResponse(404, "Page not found");
    exit();
}

$controller = new ItemController();
handleRequest($controller, $method, $uri);

function handleRequest($controller, $method, $uri) {
    switch ($method) {
        case 'GET':
            if (isset($uri[5])) {
                $controller->read($uri[5]);
            } else {
                $controller->read();
            }
            break;
        case 'POST':
            echo json_encode(["message" => "POST Method"]);
            // 處理POST請求
            break;
        case 'PUT':
            // 處理PUT請求
            break;
        case 'DELETE':
            // 處理DELETE請求
            break;
        default:
            sendResponse(405, "Method not allowed");
            break;
    }
}

function sendResponse($statusCode, $message) {
    header("HTTP/1.1 $statusCode");
    echo json_encode(["message" => $message]);
}
?>

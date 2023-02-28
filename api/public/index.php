<?php
require_once __DIR__ . '/../vendor/autoload.php';

use FastRoute\RouteCollector;
use App\Middlewares\ApiToken;

$path = dirname(__FILE__, 2);

$dotenv = Dotenv\Dotenv::createUnsafeImmutable($path);
$dotenv->load();

$_POST = json_decode(file_get_contents('php://input' ),true);

$headers = apache_request_headers();

if (!isset($headers['Authorization']) || !ApiToken::validate($headers['Authorization'])) {
    header('HTTP/1.1 401 Unauthorized');
    echo json_encode([
        'error' => 'Token inválido'
    ]);
    exit;
}

$dispatcher = FastRoute\simpleDispatcher(function(RouteCollector $r) {
    require_once __DIR__ . "/../src/routes.php";
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        header('HTTP/1.1 404 Not Found');
        echo json_encode([
            'error' => 'Endpoint does not exist'
        ]);
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        echo ('Erro 405');
        // Tratar erro 405
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = ($httpMethod === 'POST' || $httpMethod === 'PUT') ? $_POST : $routeInfo[2];
        $controllerName = 'App\\Controllers\\' . $handler[0];
        $actionName = $handler[1];
        $controller = new $controllerName();
        $result = $controller->$actionName($vars);
        echo json_encode($result);
        break;
}

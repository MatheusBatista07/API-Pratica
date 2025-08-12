<?php
require_once __DIR__ . '/vendor/autoload.php';

use Controller\GerenciamentoController;
$gerenciamentoController = new GerenciamentoController();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $gerenciamentoController->getGerenciamentos();
        break;
    case 'POST':
        $gerenciamentoController->createGerenciamento();
        break;

    case 'PUT':
        $gerenciamentoController->updateGerenciamento();
        break; 
    case 'DELETE':
        $gerenciamentoController->deleteGerenciamento();
        break;
    default:
        // FORMATA TEXTO EM JSON
        echo json_encode(["message" => "Method not allowed"]);
        break;
}
?>
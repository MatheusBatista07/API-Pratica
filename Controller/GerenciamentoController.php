<?php

namespace Controller;

use Model\Gerenciamento;

class GerenciamentoController {
    public function getGerenciamentos()
    {
        $id = isset($_GET['id']) ? intval($_GET['id']) : null;

        $gerenciamento = new Gerenciamento();
        $gerenciamentos = $gerenciamento->getGerenciamento($id);

        if ($gerenciamentos) {
            // Envia a resposta JSON
            header('Content-Type: application/json', true, 200);
            echo json_encode($gerenciamentos);
        } else {
            header('Content-Type: application/json', true, 404);
            echo json_encode(["message" => "Nenhuma trufa encontrada"]);
        }
    }

     public function createGerenciamento()
    {
        // Obtém os dados da requisição
        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->sabor) && isset($data->tamanho)) {
            $gerenciamento = new Gerenciamento();
            $gerenciamento->sabor = $data->sabor;
            $gerenciamento->tamanho = $data->tamanho;

            if ($gerenciamento->createGerenciamento()) {
                header('Content-Type: application/json', true, 201);
                echo json_encode(["message" => "Trufa criada com sucesso"]);
            } else {
                header('Content-Type: application/json', true, 500);
                echo json_encode(["message" => "Falha ao criar uma trufa"]);
            }
        } else {
            header('Content-Type: application/json', true, 400);
            echo json_encode(["message" => "Invalid input"]);
        }
    }

    public function updateGerenciamento()
    {
        //Obtem os dados da requisição
        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->sabor) && isset($data->tamanho)) {
            $gerenciamento = new Gerenciamento();
            $gerenciamento->id = $data->id;
            $gerenciamento->sabor = $data->sabor;
            $gerenciamento->tamanho = $data->tamanho;

            if ($gerenciamento->updateGerenciamento())
            {
                header('Content-Type: application/json', true, 200);
                echo json_encode(["message" => "Trufa atualizado com sucesso"]);
            } else {
                header('Content-Type: application/json', true, 500);
                echo json_encode(["message"=> "falha ao excluir trufa"]);
            }

        } else {
            header('Content-Type: application/json', true, 400);
            echo json_encode(["message"=>"Trufa inválida"]);
        }
    }

    public function deleteGerenciamento()
    {
        $id = $_GET["id"] ?? null; 

        if($id) {
            $gerenciamento = new Gerenciamento();
            $gerenciamento->id = $id;

            if ($gerenciamento->deleteGerenciamento())
            {
                header('Content-Type: application/json', true, 200);
                echo json_encode(["message"=> "Trufa excluída com sucesso"]);
            } else {
                header('Content-Type: application/json', true, 500);
                echo json_encode(["message"=>"Falha ao excluir Trufa"]);
            }
        } else {
            header('Content-Type: application/json', true, 400);
            echo json_encode(["message" => "ID inválido"]);
        }
    }
}

?>
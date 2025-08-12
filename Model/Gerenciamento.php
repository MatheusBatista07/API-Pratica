<?php
    namespace Model;

    use PDO;
    use Model\Connection;

    class Gerenciamento {

        private $conn;

        public $id;
        public $sabor;
        public $tamanho;

        public function __construct()
        {
                $this->conn = Connection::getConnection();
        }

        public function getGerenciamento()
        {
            $sql= "SELECT * FROM gerenciamento";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function createGerenciamento()
        {
            $sql = "INSERT INTO gerenciamento(sabor, tamanho) VALUE (:sabor, :tamanho)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":sabor", $this->sabor, PDO::PARAM_STR);
            $stmt->bindParam(":tamanho", $this->tamanho, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return true;
            }

            return false;
        }

        public function updateGerenciamento()
        {
            $sql = "UPDATE gerenciamento SET sabor = :sabor, tamanho = :tamanho WHERE id =:id";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
            $stmt->bindParam(":sabor", $this->sabor, PDO::PARAM_STR);
            $stmt->bindParam(":tamanho", $this->tamanho, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return true;
            }

            return false;
        }

        public function deleteGerenciamento()
        {
            $sql = "DELETE FROM gerenciamento WHERE id = :id";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return true;
            }

            return false;
        }
    }
?>
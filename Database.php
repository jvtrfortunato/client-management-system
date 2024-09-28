<?php
class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $DBConn; // conexao com o banco

    public function __construct($servidor, $nomeBanco, $usuario, $senha) {
        $this->host = $servidor;
        $this->db_name = $nomeBanco;
        $this->username = $usuario;
        $this->password = $senha;
    }

    public function getConnection() {
        $this->DBConn = null;

        try {
            $this->DBConn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->DBConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->DBConn;
    }
}

class DBClientes {
    private $conexao;
    private $tableName = 'clientes';

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

    public function create($id, $nome, $cpf, $email) {
        $query = "INSERT INTO " . $this->tableName . " (id, nome, cpf, email) VALUES (:id, :nome, :cpf, :email)";
        $stmt = $this->conexao->prepare($query);

        // bind dos parâmetros
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':email', $email);

        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function recovery() {
        $query = "SELECT * FROM " . $this->tableName;
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function recoveryById($idBusca) {
        $query = "SELECT * FROM " . $this-> tableName . " WHERE id = :id";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(':id', $idBusca);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function recoveryByName($nomeBusca) {
        $query = "SELECT * FROM " . $this->tableName . " WHERE nome = :nome";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(':nome', $nomeBusca);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $nome, $cpf, $email) {
        $query = "UPDATE " . $this->tableName . " SET nome = :nome, cpf = :cpf, email = :email WHERE id = :id";
        $stmt = $this->conexao->prepare($query);

        // bind dos parâmetros
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':email', $email);

        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->tableName . " WHERE id = :id";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(':id', $id);

        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}








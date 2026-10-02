<?php
namespace App\Model;

use PDO;

class Veiculo {
    private $conn;
    private $table = "veiculos";

    public function __construct(PDO $db) {
        $this->conn = $db;
    }

    public function listar_publico($busca = '', $filtros = []) {
        $sql = "SELECT * FROM " . $this->table . " WHERE visivel = TRUE";
        $params = [];

        if (!empty($busca)) {
            $sql .= " AND (marca LIKE :busca OR modelo LIKE :busca)";
            $params[':busca'] = "%" . $busca . "%";
        }

        if (!empty($filtros['year'])) {
            $sql .= " AND year = :year";
            $params[':year'] = $filtros['year'];
        }

        if (!empty($filtros['km_max'])) {
            $sql .= " AND kilometragem <= :km_max";
            $params[':km_max'] = $filtros['km_max'];
        }

        if (!empty($filtros['cor'])) {
            $sql .= " AND cor = :cor";
            $params[':cor'] = $filtros['cor'];
        }

        if (!empty($filtros['motor'])) {
            $sql .= " AND motor = :motor";
            $params[':motor'] = $filtros['motor'];
        }

        if (!empty($filtros['cambio'])) {
            $sql .= " AND cambio = :cambio";
            $params[':cambio'] = $filtros['cambio'];
        }

        if (isset($filtros['ar']) && $filtros['ar'] !== '') {
            $sql .= " AND ar_condicionado = :ar";
            $params[':ar'] = $filtros['ar'];
        }

        if (!empty($filtros['valor_max'])) {
            $sql .= " AND valor <= :valor_max";
            $params[':valor_max'] = $filtros['valor_max'];
        }

        if (!empty($filtros['ordem']) && $filtros['ordem'] == 'maior') {
            $sql .= " ORDER BY valor DESC";
        } else {
            $sql .= " ORDER BY valor ASC";
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarTodosAdmin() {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table . " ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table . " WHERE id = :id");
        $stmt->execute([':id' => $id]);
        //return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function salvar($dados) {
        if (!empty($dados['id'])) {
            $sql = "UPDATE " . $this->table . " SET marca=:marca, modelo=:modelo, year=:year, kilometragem=:km, cor=:cor, motor=:motor, cambio=:cambio, ar_condicionado=:ar, valor=:valor, status=:status, visivel=:visivel";
            if (!empty($dados['imagem'])) {
                $sql .= ", imagem=:imagem";
            }
            $sql .= " WHERE id=:id";
        } else {
            $sql = "INSERT INTO " . $this->table . " (marca, modelo, year, kilometragem, cor, motor, cambio, ar_condicionado, valor, imagem, status, visivel) VALUES (:marca, :modelo, :year, :km, :cor, :motor, :cambio, :ar, :valor, :imagem, :status, :visivel)";
        }
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($dados);
    }

    public function excluir($id) {
        $stmt = $this->conn->prepare("DELETE FROM " . $this->table . " WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function buscarOpcoesFiltros() {
        $filtros = [];
        $filtros['anos'] = $this->conn->query("SELECT DISTINCT year FROM " . $this->table . " WHERE visivel = TRUE ORDER BY year DESC")->fetchAll(PDO::FETCH_COLUMN);
        $filtros['cores'] = $this->conn->query("SELECT DISTINCT cor FROM " . $this->table . " WHERE visivel = TRUE ORDER BY cor")->fetchAll(PDO::FETCH_COLUMN);
        $filtros['motores'] = $this->conn->query("SELECT DISTINCT motor FROM " . $this->table . " WHERE visivel = TRUE ORDER BY motor")->fetchAll(PDO::FETCH_COLUMN);
        $filtros['cambios'] = $this->conn->query("SELECT DISTINCT cambio FROM " . $this->table . " WHERE visivel = TRUE ORDER BY cambio")->fetchAll(PDO::FETCH_COLUMN);
        return $filtros;
    }
}
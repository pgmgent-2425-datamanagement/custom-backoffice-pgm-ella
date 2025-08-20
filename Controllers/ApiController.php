<?php

namespace App\Controllers;

class ApiController {

    private \PDO $db;
    public function __construct() {
        $this->db = new \PDO($_ENV['DB_DSN'], $_ENV['DB_USER'], $_ENV['DB_PASS'], [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]);
        header('Content-Type: application/json');
    }

    public function flowersIndex()
    {
        $q = $_GET['q'] ?? '';
        $min = isset($_GET['min']) ? (float)$_GET['min'] : null;
        $max = isset($_GET['max']) ? (float)$_GET['max'] : null;

        $sql = "SELECT id, name, price, image FROM flowers WHERE 1=1";
        $params = [];
        if ($q !== '') { $sql .= " AND name LIKE :q"; $params[':q'] = "%{$q}%"; }
        if ($min !== null) { $sql .= " AND price >= :min"; $params[':min'] = $min; }
        if ($max !== null) { $sql .= " AND price <= :max"; $params[':max'] = $max; }
        $sql .= " ORDER BY id DESC LIMIT 100";

        $st = $this->db->prepare($sql);
        $st->execute($params);
        echo json_encode($st->fetchAll(\PDO::FETCH_ASSOC));
    }

    public function addFlowerComment()
    {
        // Optional very simple API key:
        if (($_GET['key'] ?? '') !== ($_ENV['PUBLIC_API_KEY'] ?? '')) {
            http_response_code(401); echo json_encode(['error'=>'Unauthorized']); return;
        }
        $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;

        if (!isset($input['flower_id'],$input['author'],$input['content'])) {
            http_response_code(422); echo json_encode(['error'=>'Missing fields']); return;
        }

        $st = $this->db->prepare("INSERT INTO flower_comments (flower_id, author, content) VALUES (:f,:a,:c)");
        $st->execute([':f'=>$input['flower_id'], ':a'=>$input['author'], ':c'=>$input['content']]);

        echo json_encode(['ok'=>true, 'id'=>(int)$this->db->lastInsertId()]);
    }
}
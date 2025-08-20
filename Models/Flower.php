<?php

namespace App\Models;

use PDO;

class Flower extends BaseModel
{
    public function all(?string $q = null, string $sort = 'id', string $dir = 'DESC'): array
    {
        $sql = "SELECT * FROM flowers WHERE 1";
        $params = [];

        if ($q) {
            $sql .= " AND name LIKE :q";
            $params[':q'] = "%$q%";
        }

        $sql .= " ORDER BY $sort $dir";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM flowers WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public function create(array $data): int
    {
        $stmt = $this->db->prepare("
            INSERT INTO flowers (name, description, price, image, created_at) 
            VALUES (:name, :description, :price, :image, NOW())
        ");
        $stmt->execute($data);
        return (int)$this->db->lastInsertId();
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->db->prepare("
            UPDATE flowers SET name=:name, description=:description, price=:price, image=:image, updated_at=NOW()
            WHERE id=:id
        ");
        $data['id'] = $id;
        $stmt->execute($data);
    }
}

<?php

use App\Models\BaseModel;

class Bouquet extends BaseModel
{

    public function recent()
    {
        $sql = 'SELECT * FROM `' . $this->table . '` ORDER BY `created_at` DESC LIMIT 20';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute();

        $db_items = $pdo_statement->fetchAll();

        return self::castToModel($db_items);
    }
}

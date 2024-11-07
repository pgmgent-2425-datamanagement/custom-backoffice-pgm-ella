<?php

namespace App\Models;

use App\Models\BaseModel;

class Flower extends BaseModel
{
    // Public function to save the new values (update existing table row)
    public function save()
    {
        $sql = 'UPDATE flowers SET name = :name, price = :price, description = :description, image = :image WHERE id = :id';

        $pdo_statement = $this->db->prepare($sql);

        $pdo_statement->execute([
            ':name' => $this->name,
            ':price' => $this->price,
            ':image' => $this->image,
            ':description' => $this->description,
            ':id' => $this->id
        ]);
    }

    // Public function to add a row from the table

    public function add()
    {
        $sql = 'INSERT INTO flowers (name, price, image, description) VALUES (:name, :price, :image, :description)';

        $pdo_statement = $this->db->prepare($sql);

        $pdo_statement->execute([
            ':name' => $this->name,
            ':price' => $this->price,
            ':image' => $this->image,
            ':description' => $this->description
        ]);
    }


    // Public function to delete a row from the table

    public function delete()
    {
        $sql = 'DELETE FROM flowers WHERE id = :id';

        $pdo_statement = $this->db->prepare($sql);

        $pdo_statement->execute([
            ':id' => $this->id
        ]);
    }
}

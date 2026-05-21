<?php

namespace App\Models;

use Lib\Database;
use PDO;

class CategoryModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAll()
    {
        return $this->db->query("SELECT * FROM categories")->fetchAll();
    }

    public function getBySlug(string $slug): array|false
    {
        $statement = $this->db->prepare("
        SELECT * FROM categories WHERE slug = ?
    ");

        $statement->execute([$slug]);

        return $statement->fetch();
    }
}

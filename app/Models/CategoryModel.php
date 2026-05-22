<?php

namespace App\Models;

use PDO;

use Lib\Database;

class CategoryModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAll()
    {
        return $this->db
            ->query(
                "SELECT id, name, slug, description, created_at FROM categories"
            )
            ->fetchAll();
    }

    public function getBySlug(string $slug): array|false
    {
        $statement = $this->db->prepare("
        SELECT id, name, slug, description, created_at FROM categories WHERE slug = ?
    ");

        $statement->execute([$slug]);

        return $statement->fetch();
    }
}

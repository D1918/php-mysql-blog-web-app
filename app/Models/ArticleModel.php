<?php

namespace App\Models;

use Lib\Database;
use PDO;

class ArticleModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getLatestByCategory(int $categoryId, int $limit = 3): array
    {
        $statement = $this->db->prepare("
        SELECT a.*
        FROM articles a
        JOIN article_category ac ON a.id = ac.article_id
        WHERE ac.category_id = ?
        ORDER BY a.created_at DESC
        LIMIT $limit
    ");

        $statement->execute([$categoryId]);

        return $statement->fetchAll();
    }

    public function getBySlug(string $slug): array|false
    {
        $statement = $this->db->prepare("
            SELECT *
            FROM articles
            WHERE slug = ?
        ");

        $statement->execute([$slug]);

        return $statement->fetch();
    }

    public function incrementViews(int $id): void
    {
        $statement = $this->db->prepare("
            UPDATE articles
            SET views = views + 1
            WHERE id = ?
        ");

        $statement->execute([$id]);
    }

    public function getByCategory(
        int $categoryId,
        int $limit,
        int $offset,
        string $sort
    ): array {
        $orderBy = match ($sort) {
            "views" => "a.views DESC",
            default => "a.created_at DESC",
        };

        $statement = $this->db->prepare("
        SELECT a.*
        FROM articles a
        JOIN article_category ac ON a.id = ac.article_id
        WHERE ac.category_id = ?
        ORDER BY $orderBy
        LIMIT $limit OFFSET $offset
    ");

        $statement->execute([$categoryId]);

        return $statement->fetchAll();
    }

    public function countByCategory(int $categoryId): int
    {
        $statement = $this->db->prepare("
        SELECT COUNT(*) as cnt
        FROM articles a
        JOIN article_category ac ON a.id = ac.article_id
        WHERE ac.category_id = ?
    ");

        $statement->execute([$categoryId]);

        return (int) $statement->fetch()["cnt"];
    }
}

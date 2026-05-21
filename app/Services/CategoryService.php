<?php

namespace App\Services;

use App\Models\CategoryModel;
use App\Models\ArticleModel;

class CategoryService
{
    private CategoryModel $categoryModel;
    private ArticleModel $articleModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->articleModel = new ArticleModel();
    }

    public function getCategoryPage(
        string $slug,
        int $page,
        string $sort
    ): array {
        $limit = 6;
        $offset = ($page - 1) * $limit;

        $category = $this->categoryModel->getBySlug($slug);

        if (!$category) {
            return [
                "category" => null,
                "articles" => [],
                "pagination" => null,
            ];
        }

        $total = $this->articleModel->countByCategory($category["id"]);

        $articles = $this->articleModel->getByCategory(
            $category["id"],
            $limit,
            $offset,
            $sort
        );

        return [
            "category" => $category,
            "articles" => $articles,
            "pagination" => [
                "page" => $page,
                "limit" => $limit,
                "total" => $total,
                "pages" => ceil($total / $limit),
            ],
        ];
    }
}

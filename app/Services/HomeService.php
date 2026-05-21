<?php

namespace App\Services;

use App\Models\CategoryModel;
use App\Models\ArticleModel;

class HomeService
{
    private CategoryModel $categoryModel;
    private ArticleModel $articleModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->articleModel = new ArticleModel();
    }

    public function getHomeSections(int $limitPerCategory = 3): array
    {
        $categories = $this->categoryModel->getAll();

        $sections = [];

        foreach ($categories as $category) {
            $sections[] = [
                "category" => $category,
                "articles" => $this->articleModel->getLatestByCategory(
                    $category["id"],
                    $limitPerCategory
                ),
            ];
        }

        return $sections;
    }
}

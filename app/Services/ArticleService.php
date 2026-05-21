<?php

namespace App\Services;

use App\Models\ArticleModel;

class ArticleService
{
    private ArticleModel $articleModel;

    public function __construct()
    {
        $this->articleModel = new ArticleModel();
    }

    public function getArticlePageData(string $slug): ?array
    {
        $article = $this->articleModel->getBySlug($slug);

        if (!$article) {
            return null;
        }

        $this->articleModel->incrementViews($article["id"]);

        $similar = $this->articleModel->getSimilarArticles($article["id"], 3);

        return [
            "article" => $article,
            "similar" => $similar,
        ];
    }
}

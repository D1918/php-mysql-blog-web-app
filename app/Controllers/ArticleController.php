<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use Lib\View;

class ArticleController
{
    public function index(string $slug)
    {
        $view = new View();
        $model = new ArticleModel();

        $article = $model->getBySlug($slug);

        if (!$article) {
            http_response_code(404);
            echo "Article not found";
            return;
        }

        $model->incrementViews($article["id"]);

        $view->assign("article", $article);
        $view->render("article.tpl");
    }
}

<?php

namespace App\Controllers;

use Lib\View;
use App\Services\ArticleService;

class ArticleController
{
    private View $view;
    private ArticleService $articleService;

    public function __construct()
    {
        $this->view = new View();
        $this->articleService = new ArticleService();
    }

    public function index(string $slug)
    {
        $data = $this->articleService->getArticlePageData($slug);

        if (!$data) {
            http_response_code(404);
            echo "Article not found";
            return;
        }

        $this->view->assign("article", $data["article"]);
        $this->view->assign("similar", $data["similar"]);
        $this->view->assign("styles", ["category"]);

        $this->view->render("pages/article/index.tpl");
    }
}

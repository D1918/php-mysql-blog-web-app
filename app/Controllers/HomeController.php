<?php

namespace App\Controllers;

use Lib\View;

use App\Models\ArticleModel;
use App\Models\CategoryModel;

class HomeController
{
    private View $view;
    private CategoryModel $categoryModel;
    private ArticleModel $articleModel;

    public function __construct()
    {
        $this->view = new View();
        $this->categoryModel = new CategoryModel();
        $this->articleModel = new ArticleModel();
    }

    public function index()
    {
        $categories = $this->categoryModel->getAll();

        $data = [];

        foreach ($categories as $category) {
            $data[] = [
                "category" => $category,
                "articles" => $this->articleModel->getLatestByCategory(
                    $category["id"],
                    3
                ),
            ];
        }

        $this->view->assign("pageTitle", "Categories");
        $this->view->assign("styles", ["home"]);
        $this->view->assign("sections", $data);

        $this->view->render("pages/home/index.tpl");
    }
}

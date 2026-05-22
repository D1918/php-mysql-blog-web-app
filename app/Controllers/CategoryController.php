<?php

namespace App\Controllers;

use Lib\View;

use App\Services\CategoryService;

class CategoryController
{
    private View $view;
    private CategoryService $categoryService;

    public function __construct()
    {
        $this->view = new View();
        $this->categoryService = new CategoryService();
    }

    public function index(string $slug): void
    {
        $page = max(1, (int) ($_GET["page"] ?? 1));
        $sort = $_GET["sort"] ?? "date";

        $data = $this->categoryService->getCategoryPage($slug, $page, $sort);

        if (!$data["category"]) {
            http_response_code(404);
            echo "Category not found";
            return;
        }

        $pageTitle =
            mb_convert_case($slug, MB_CASE_TITLE, "UTF-8") . " Articles" ??
            "Articles";

        $this->view->assign("pageTitle", $pageTitle);
        $this->view->assign("styles", ["category"]);
        $this->view->assign("category", $data["category"]);
        $this->view->assign("articles", $data["articles"]);
        $this->view->assign("pagination", $data["pagination"]);
        $this->view->assign("sort", $sort);

        $this->view->render("pages/category/index.tpl");
    }
}

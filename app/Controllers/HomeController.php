<?php

namespace App\Controllers;

use Lib\View;

use App\Services\HomeService;

class HomeController
{
    private View $view;
    private HomeService $homeService;

    public function __construct()
    {
        $this->view = new View();
        $this->homeService = new HomeService();
    }

    public function index()
    {
        $sections = $this->homeService->getHomeSections(3);

        $this->view->assign("pageTitle", "Categories");
        $this->view->assign("styles", ["home"]);
        $this->view->assign("sections", $sections);

        $this->view->render("pages/home/index.tpl");
    }
}

<?php

namespace Lib;

use Smarty\Smarty;

class View
{
    private Smarty $smarty;

    public function __construct()
    {
        $this->smarty = new Smarty();

        $this->smarty->setTemplateDir(__DIR__ . "/../app/Views");
        $this->smarty->setCompileDir(__DIR__ . "/../storage/smarty/compile");
        $this->smarty->setCacheDir(__DIR__ . "/../storage/smarty/cache");
        $this->smarty->debugging = ($_ENV["APP_MODE"] ?? "prod") === "dev";
    }

    public function assign(string $key, mixed $value): void
    {
        $this->smarty->assign($key, $value);
    }

    public function render(string $template): void
    {
        $this->smarty->display($template);
    }
}

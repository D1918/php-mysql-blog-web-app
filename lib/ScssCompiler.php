<?php

namespace Lib;

use ScssPhp\ScssPhp\Compiler;

class ScssCompiler
{
    private Compiler $compiler;

    public function __construct()
    {
        $this->compiler = new Compiler();
    }

    public function compile(string $scssFile, string $cssFile): void
    {
        $scssContent = file_get_contents($scssFile);

        $compiledCss = $this->compiler->compileString($scssContent)->getCss();

        file_put_contents($cssFile, $compiledCss);
    }
}

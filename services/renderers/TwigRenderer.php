<?php

namespace app\services\renderers;

use app\interfaces\RendererInterface;

class TwigRenderer implements RendererInterface
{


    public function render($template, array $params = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader(TWIG_VIEWS_DIR);
        $this->renderer = new \Twig\Environment($loader, []);
        $template .= ".twig";
        return $this->renderer->render($template, $params);

    }
}
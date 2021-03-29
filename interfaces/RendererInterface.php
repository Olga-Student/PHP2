<?php


namespace app\interfaces;


interface RendererInterface
{
    public function render($templateName, array $params = []);
}

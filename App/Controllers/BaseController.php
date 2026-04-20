<?php

namespace App\Controllers;

class BaseController
{
    protected function view($view, $data = [])
    {
        extract($data);

        $viewPath = str_replace('.', '/', $view);

        $fullPath = __DIR__ . "/../Views/{$viewPath}.php";

        if (!file_exists($fullPath)) {
            throw new \Exception("View {$view} not found at: {$fullPath}");
        }

        require $fullPath;
    }

    protected function redirect($url)
    {
        header("Location: {$url}");
        exit;
    }
}

<?php

namespace App\Controllers;

class BaseController
{
    protected function view($view, $data = [])
    {
        extract($data);

        $viewPath = str_replace('.', '/', $view);

        $fullPath = __DIR__ . "/../Views/{$viewPath}.php";

        if (file_exists($fullPath)) {
            require $fullPath;
        } else {
            throw new \Exception("View {$view} not found");
        }
    }

    protected function json($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    protected function redirect($url)
    {
        header("Location: {$url}");
        exit;
    }
}

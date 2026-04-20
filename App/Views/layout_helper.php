<?php

function start_layout()
{
    ob_start();
}

function end_layout($layout, $data = [])
{
    $content = ob_get_clean();
    extract($data);
    $layoutPath = __DIR__ . '/layout/' . $layout . '.php';
    require $layoutPath;
}

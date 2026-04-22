<?php
function asset(string $path): string
{
    return '/' . ltrim($path, '/');
}

<?php
function asset(string $path): string
{
    return '/assets/' . ltrim($path, '/');
}

<?php
function redirect(string $uri): never {
    header('Location: ' . $uri);
    exit();
}

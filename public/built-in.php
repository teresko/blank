<?php

$uri = $_SERVER['REQUEST_URI'];

if (file_exists(__DIR__ . '/../tmp/db.sqlite') === false) {
    copy(__DIR__ . '/../docs/db.sqlite', __DIR__ . '/../tmp/db.sqlite');
}


if (file_exists(__DIR__ . $uri) && is_file(__DIR__ . $uri)) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $type =  finfo_file($finfo, __DIR__ . $uri);
    finfo_close($finfo);

    header('Content-Type: ' . $type);
    echo file_get_contents(__DIR__ . $uri);
    exit;
}

require __DIR__ . '/index.php';

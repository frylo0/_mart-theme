<?php

$folders = scandir(__DIR__);

foreach ($folders as $folder) {
    if (preg_match('/\.map$/', $folder)) {
        continue;
    }

    switch ($folder) {
        case '.':
        case '..': 
        case 'entry.js':
        case 'entry.php':
        case 'entry.css':
            break;
        default:
            require_once __DIR__ . "/$folder/$folder.php";
    }
}
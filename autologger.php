<?php
/**
 * AutoLogger
 *
 * Wraps STDIN stream into log format with date and time at the beginning of every line and outputs it to STDOUT.
 */

$config = require __DIR__ . '/config.php';

while (!feof(STDIN)) {
    $message = rtrim(fgets(STDIN));
    if (feof(STDIN) && $message == "") {
        continue;
    }
    $dateTime = date($config['dateFormat']);
    $line = str_replace([
            "%DATETIME%",
            "%MESSAGE%",
        ], [
            $dateTime,
            $message,
        ], $config['lineFormat']);
    echo $line, "\n";
}

<?php

namespace TuringFrame;

// Main APP
const COLOR_RESET = "\033[0m";
const COLOR_GREEN = "\033[32m";
const COLOR_YELLOW = "\033[33m";
const COLOR_BLUE = "\033[34m";
const COLOR_RED = "\033[31m";

function printColored($text, $color)
{
    if (function_exists('posix_isatty') && posix_isatty(STDOUT)) {
        echo $color . $text . COLOR_RESET . PHP_EOL;
    } else {
        echo $text . PHP_EOL;
    }
}

function TuringFrame()
{

    global $executionStatusFile;

    $executionStatusFile = './.TuringFrame_executed';

    if (file_exists($executionStatusFile)) {
        printColored("TuringFrame has already been executed.", COLOR_YELLOW);
        $targetDir = file_get_contents($executionStatusFile);
    } else {
        echo COLOR_YELLOW . "Please Input your Project Name " . COLOR_RESET;
        $projectName = trim(fgets(STDIN));
        $targetDir = "\TuringFrame\public/$projectName"; // Change the target directory to be inside TuringFrame
        printColored("Project $projectName was created", COLOR_GREEN);

        if (!is_dir($targetDir)) {
            if (!mkdir($targetDir, 0777, true)) {
                die(COLOR_RED . "Dir Died!" . COLOR_RESET);
            }
            $templates = "$targetDir/templates";
            $App = "$targetDir/App";
            @mkdir($templates, 0777, true);
            @mkdir($App, 0777, true);

        }
        file_put_contents($executionStatusFile, $targetDir);
    }

    return $targetDir; // Return $targetDir
}

function StartServer($targetDir, $port)
{
    echo "Starting Server..." . COLOR_GREEN;
    echo "\n" . "Server Started! \n" . COLOR_GREEN;
    exec("php ClassLoader.php");

    while (true) {
        exec("php -S localhost:$port -t \TuringFrame\public"); // Specify the targetDir as document root
        echo "PHP CLI Server was running on localhost:$port";
    }
}

$targetDir = TuringFrame();
StartServer($targetDir, 8000);

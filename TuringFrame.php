<?php

// 定义颜色常量
const COLOR_RESET = "\033[0m";
const COLOR_GREEN = "\033[32m";
const COLOR_YELLOW = "\033[33m";
const COLOR_BLUE = "\033[34m";
const COLOR_RED = "\033[31m";

// 颜色字打印
function printColored($text, $color)
{
    if (function_exists('posix_isatty') && posix_isatty(STDOUT)) {
        echo $color . $text . COLOR_RESET . PHP_EOL;
    } else {
        echo $text . PHP_EOL;
    }
}

// 必要目录
$executionStatusFile = './.TuringFrame_executed';
$checkNginx = './.htaccess';


// 图灵框架主程序
function TuringFrame()
{
    global $executionStatusFile;
    global $checkNginx;

    // 如果这个文件存在，则说明已经执行过，不再执行
    if (file_exists($executionStatusFile)) {
        printColored("TuringFrame has already been executed.", COLOR_YELLOW);
        $targetFile = file_get_contents($executionStatusFile);
    } else {
        // 更改提示
        echo COLOR_YELLOW . "Please Input your Project Name " . COLOR_RESET;
        $targetDir = trim(fgets(STDIN));
        printColored("=$targetDir!", COLOR_GREEN);
        $targetFile = $targetDir . '/RoutesConfig.php';

        if (!is_dir($targetDir)) {
            if (!mkdir($targetDir, 0777, true)) {
                die(COLOR_RED . "Dir Died!" . COLOR_RESET);
            }
            // 创建模板文件夹
            @mkdir($targetDir . '/templates', 0777, true);
        }

        $routes = [];
        while (true) {
            echo "Enter route name (or 'done' to finish): ";
            $routeName = trim(fgets(STDIN));
            if ($routeName === 'done' or ctype_upper($routeName)) {
                break;
            }
            echo "Enter handler (e.g.,'home' => 'Home::index',): ";
            $handler = trim(fgets(STDIN));
            $routes[$routeName] = $handler;
        }

        // 定义一个字段，这个字段是路由配置
        $content = '<?php' . PHP_EOL .
            '$routes = [// Write Your Routes Here //EXAMPLE: ‘ROUTENAME’ => ‘Class::Method’' . PHP_EOL;

        foreach ($routes as $routeName => $handler) {
            $content .= "    '" . $routeName . "' => '" . $handler . "'," . PHP_EOL;
        }

        $content .= '];' . PHP_EOL;

        if (file_put_contents($targetFile, $content) === false) {
            die(COLOR_RED . "File Died!" . COLOR_RESET);
        }

        file_put_contents($executionStatusFile, $targetFile);
    }

    printColored("Success Created, Now Next Env Check", COLOR_GREEN);

    if (file_exists($checkNginx)){
        echo('[TuringEnvCheck] Nginx Env is Prepare') . COLOR_YELLOW;
    } else {
        echo ('[TuringEnvCheck] Couldnt find Nginx Env') . COLOR_RED;
    }

    return $targetFile;
}

// 服务器启动函数
function StartServer($routesConfigPath)
{
    if (file_exists($routesConfigPath)) {
        require_once $routesConfigPath;
        echo "Server is starting with routes config from: " . $routesConfigPath;
    } else {
        echo "RoutesConfig file does not exist.";
    }

}

$routesConfigPath = TuringFrame();
StartServer($routesConfigPath);

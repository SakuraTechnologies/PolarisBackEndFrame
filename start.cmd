
@echo off

TITLE TuringFrame Server Software

cd /d "%~dp0"

REM 检查是否存在 php.exe
if exist bin\php\php.exe (
    set "PHPRC="
    set "PHP_BINARY=.\bin\php.exe"
) else (
    set "PHP_BINARY=php"
)

REM 检查是否存在 mintty.exe
if exist bin\mintty.exe (
    REM 使用 mintty 启动 PHP 脚本
    start "" bin\mintty.exe -o 'Columns=88' -o 'Rows=32' -o AllowBlinking=0 -o FontQuality=3 -o 'Font=Consolas' -o FontHeight=10 -o CursorType=0 -o CursorBlinks=1 -h error -t "TuringFrame" -w max "%PHP_BINARY%" "TuringFrame.php" --enable-ansi %*
) else (
    REM 直接使用 PHP 脚本
    "%PHP_BINARY%" -c bin\php "TuringFrame.php" %*
)
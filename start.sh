# shellcheck disable=SC2164
cd src # 假设脚本位于project目录下的某个子目录中
screen -S TuringFrame
chmod 755 ./start.sh
php TuringFrame.php
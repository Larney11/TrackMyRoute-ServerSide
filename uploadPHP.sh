#!/bash/bin
sudo rsync -av --progress ./* /Library/WebServer/Documents/ --exclude ./uploadPHP.sh

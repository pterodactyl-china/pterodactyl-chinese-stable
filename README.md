
# Pterodactyl Panel 中文汉化
这里是我 Pterodacyl 中文汉化仓库  
你可以自由使用我汉化修改后的软件，甚至删除位于 Panel 底部的署名。  
不过为了支持我的汉化工作，还请您尽量保留！  
本仓库作为官方的 Fork 版本，会在本人有空时间第一时间与官方更新保持一致，  
并仅修改语言部分！您大可放心使用，因为我本人也在使用我的 Fork 版本。  
如果有什么没有汉化到的地方，汉化不准确的地方欢迎建立 issues！  
目前仅完成用户部分汉化，管理员面板部分还未完成汉化  



## 如何使用
由于汉化仓库要和官方库同步 不便于修改过多，所以这个库的作用是引导你前往我 Fork 过后的库  
并告诉你如何进行汉化  
我的汉化仓库地址为：https://github.com/ilworkcn/panel


你可以在面板安装完成后开始使用我的汉化文件。  

1.替换面板文件 [2.3]

2.将 “resources” 文件夹进行覆盖操作

3.将 “app” 文件夹进行覆盖操作

4.重新构建面板 [5.6.7]

5.安装相关依赖 {

对于 Ubuntu：  
curl -sL https://deb.nodesource.com/setup_14.x | sudo -E bash -  
apt install -y nodejs

对于 Centos：  
curl -sL https://rpm.nodesource.com/setup_14.x | sudo -E bash -  
sudo yum install -y nodejs yarn # CentOS 7  
sudo dnf install -y nodejs yarn # CentOS 8

然后

npm i -g yarn # 安装 Yarn

cd /var/www/pterodactyl # 进入 pterodactyl panel 的安装目录 注意此行目录为示范使用，请根据实际安装环境填写路径！  
yarn # 安装面板构建资源  
}  

6.开始重新构建面板 {  
cd /var/www/pterodactyl  # 进入 pterodactyl panel 的安装目录 注意此行目录为示范使用，请根据实际安装环境填写路径！  
yarn build:production # 开始构建面板  

}  

7.当构建完成后，您可以享用汉化完成后的翼龙面板啦！
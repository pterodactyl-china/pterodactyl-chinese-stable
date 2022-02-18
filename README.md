# 翼龙面板中文汉化 来自 iLwork.CN Studio

- 目前支持 翼龙面板 V1.7.0 ；
- 汉化已完成至 用户面板 管理面板暂未进行完全汉化 ；
- 仅修改内核语言部分！您大可放心使用，我本人也在使用我的 Fork 版本 ；

## 注意事项
:tw-1f603:  建议使用 **翼龙面板前端 V1.7.0 ** 进行汉化操作

:tw-1f621: 不建议在安装第三方插件后进行汉化操作

:tw-1f621:  不建议在翼龙官方仓库提交关于汉化问题的 issues

:tw-1f603: 欢迎对我发起关于汉化不准确等问题的 issues

:tw-1f636: 你可以自由使用我汉化修改后的软件，甚至删除位于 Panel 底部的署名

:tw-1f603: 请尊重社区开发组的劳动成果，请勿违反翼龙面板前端的开源协议

:tw-1f623: 我接受且仅接受关于汉化的问题，有关翼龙面板的使用等问题勿扰。（可付费打扰 :tw-1f616:）





## 如何进行汉化

### 访问汉化仓库
                
----
https://github.com/ilworkcn/panel

### 下载源码并进行覆盖操作
                
----
下载源码 将 “resources”与 “app”文件夹对安装后的面板文件进行覆盖操作


### 重新构建面板
                
----
> 此部分引用于 https://pterodactyl.io/community/customization/panel.html
> Panel 的前端是用 React 构建的。 对源文件的任何更改都需要重新编译。
以下部分说明了如何执行此操作。 

##### 1.安装依赖项
`以下命令将安装构建面板资产所需的依赖项。 构建工具需要 NodeJS，yarn 用作包管理器。`
```
# Ubuntu/Debian 系统
curl -sL https://deb.nodesource.com/setup_14.x | sudo -E bash -
apt install -y nodejs

# CentOS 系统
curl -sL https://rpm.nodesource.com/setup_14.x | sudo -E bash -
sudo yum install -y nodejs yarn      # CentOS 7 系统
sudo dnf install -y nodejs yarn      # CentOS 8 系统
```
`接下来安装所需的 javascript 包`
```
npm i -g yarn      # 安装yarn

cd /var/www/pterodactyl  #进入面板前端目录，请按您的运行环境进行调整
yarn       # 安装面板构建依赖项
```
##### 2.开始构建面板
`以下命令将重新构建 翼龙面板前端。`
```
cd /var/www/pterodactyl
yarn build:production       # 开始构建面板
```

`您可以使用命令 yarn run watch 几乎实时地查看构建的进度`

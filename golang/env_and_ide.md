###官网: https://golang.org/
    安装:
    http://docscn.studygolang.com/doc/install

安装配置Golang
下载地址: https://golangtc.com/download
可以从Golang中国这里下载，下载好后使用sudo tar -xvzf ~/Downloads/go*.linux-amd64.tar.gz -C /usr/local/命令将其解压到/usr/local/位置，然后配置环境变量。
使用命令vim ~/.bashrc打开.bashrc文件，然后在最后追加下面内容：

export GOROOT=/usr/local/go
export PATH=$PATH:$GOROOT/bin
export GOPATH=~/Go

然后使用命令source ~/.bashrc使其生效，需要注意的是，GOPATH这个环境变量指的是之后需要存放源码的目录，我使用的是~/Go目录

使用go version以及go env等命令来查看是否正确安装Go
安装配置LiteIDE
下载地址: https://golangtc.com/download/liteide?spm=a2c4e.11153940.blogcont58010.4.22e615aa0bj27T
可以从Golang中国这里下载，然后将其解压到某个目录，这里我是解压到了/usr/local/目录，然后在该目录下，就可以看到liteide目录了
然后执行命令gksudo gedit /usr/share/applications/liteide.desktop，如果没安装gksu，首先根据提示安装即可
然后讲下面的内容写到新建的liteide.desktop文件中：

[Desktop Entry]
Name=liteIDE
Encoding=UTF-8
Type=Application
Exec=/usr/local/liteide/bin/liteide
Terminal=false
Icon=/usr/local/liteide/share/liteide/welcome/images/liteide400.png
Comment=Integrated Development Environment
StartupNotify=true
Categories=Development;IDE;
Name[en]=liteIDE

然后我们就可以搜索到LiteIDE了，将其固定到桌面，打开之后在选项中修改LiteEnv的linux64以及linux64-local这两个文件，将其中的GOROOT修改为/usr/local/go
#工具安装
###install sublime text3
1: 添加sublime源
    sudo add-apt-repository ppa:webupd8team/sublime-text-3
    sudo apt-get update
    sudo apt-get install sublime-text-installer
    注：
    中间我手动中断了 sudo apt-get install sublime-text-installer， 软件安装就报错了。
    sudo rm /var/lib/dpkg/updates/*

###输入法
    sudo add-apt-repository ppa:fcitx-team/nightly
    sudo apt-get update
    sudo apt-get install fcitx-sogoupinyin
　　  注:
        也可以用sudo apt-get install fcitx-**** 来安装其他输入法。

###sougou 输入法
安装依赖
1:　sudo apt-get install fcitx libssh2-1
    查看依赖　
    dpkg -l | grep fcitx
    dpkg -l | grep libssh

2: 选择版本
    #32位
    wget "http://pinyin.sogou.com/linux/download.php?f=linux&bit=32" -O "sougou_32.deb"
    #64位
    wget "http://pinyin.sogou.com/linux/download.php?f=linux&bit=64" -O "sougou_64.deb"
3: sudo dpkg -i sougou_64.deb
4: 系统设置>语言支持>键盘输入方式系统->选择 fcitx 项
    参考: http://jingyan.baidu.com/article/08b6a591cb06f114a8092209.html

#系统更新
1、更换源
    $ sudo -i
    $ apt-get clean
    $ cd /var/lib/apt
    $ mv lists lists.back
    $ mkdir -p lists/partial
    $ apt-get clean
    $ apt-get update

2. update 的时候可能会出现类似下边的错误
    W: GPG 错误：http://ppa.launchpad.net precise Release: 由于没有公钥，无法验证下列签名： NO_PUBKEY 32B18A1260D8DA0B // "32B18A1260D8DA0B"就是缺失的签名(公钥)
3. 添加签名
    sudo apt-key adv --recv-keys --keyserver keyserver.ubuntu.com ××××××××(有多个签名需要更新使用空格分离即可)
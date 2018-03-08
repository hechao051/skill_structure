Git 使用 http://rogerdudler.github.io

1.git init 创建新文件夹,打开,然后执行,git init 以创建新的git库

###2.检出仓库(克隆)
```
  创建一个本地的克隆版本 git clone /path/to/repository
  创建远程服务器上的仓库 git clone username@host:/path/to/repository
```
###3.添加提交
```
  提出更改: git add <filename>或 git add *
  提交实际改动: git commit -m “代码提交信息”
```
###4.推送提交
```
  提交到远程仓库: git push origin master(任何分支名)
  如果还没有克隆现有仓库并欲将你的仓库连接到某个远程服务器:git remote add origin <server>
```
5.分支
```
  分支是用来将特性开发绝缘开来的。在你创建仓库的时候 master是“默认的”分支。在其他分支上进行开发，完成后再将它们合并到主分支上。 
  1.穿件一个叫”featur_x”的分支,并切换过去 : git checkout -b featur_x
  2.切换回分支 : git checkout master
  3.删除新建分支 : git branch -d featur_x
  4.除非你将分支推送到远程仓库,不然该分支是不为他人所见的 : git push origin <branch> 
```
6.更新与合并
```
  1.跟新本地仓库为最新改动 : git pull
  2.要合并其他分支到你当前分支 : git merge <branch>
  3.改完之后将它们标记为合并成功 : git add <filename>
  4.在合并之前预览差异 : git diff <source_branch><targe_branch>
```
7.标签
```
  1.创建标签 : git tag 1.0.0 1b2e1d63ff   1b2e1d63ff是你想标记的提交ID的前10位字符
  2.获取提交ID : git log
```
8.替换本地的改动
```
  1.加入操作失误,换掉本地改动 : git checkout --<filename>
  2.假如想丢掉在本地的所有改动与提交可以到服务器上获取最新的版本历史并将你本地主分支指向它 : 
    git fetch origin
    git reset –hard origin/master
```
###9.实用贴士
```
  1.图形话git : gitk
  2.彩色的 git输出 : git config color.ui true
  3.显示历史记录时,每个提交信息只显示一行 : git config format.pretty oneline
  4.交互式添加文件到暂存区 : git add -i
```

###删除远程分支
```
git push origin --delete branch-name // 删除
git remote update origin --prune // 同步更新远程分支
```
###多人协作:
```
  查看远程库信息，使用git remote -v；
  本地新建的分支如果不推送到远程，对其他人就是不可见的；
  从本地推送分支，使用git push origin branch-name，如果推送失败，先用git pull抓取远程的新提交；
  在本地创建和远程分支对应的分支，使用git checkout -b branch-name origin/branch-name，本地和远程分支的名称最好一致；
  建立本地分支和远程分支的关联，使用git branch --set-upstream branch-name origin/branch-name；
  从远程抓取分支，使用git pull，如果有冲突，要先处理冲突。
```

###你确实想添加该文件，可以用-f强制添加到Git
```
  eg: git add -f App.class
  .gitignore写得有问题，需要找出来到底哪个规则写错了，可以用git check-ignore命令检查
  git check-ignore -v App.class
```
###设置别名
```
  $ git config --global alias.st status
  $ git config --global alias.co checkout
  $ git config --global alias.ci commit
  $ git config --global alias.br branch
  $ git config --global core.editor vim // 配置 git shell 编辑器为vim 或者在　.git/config 文件 [core]中添加 editor=vim
```
###搭建Git服务器
sudo权限的用户账号
```
  第一步，安装git：
  $ sudo apt-get install git
  第二步，创建一个git用户，用来运行git服务：
  $ sudo adduser git
  第三步，创建证书登录：
    收集所有需要登录的用户的公钥，就是他们自己的id_rsa.pub文件
    把所有公钥导入到/home/git/.ssh/authorized_keys文件里，一行一个。
  第四步，初始化Git仓库
    先选定一个目录作为Git仓库，假定是/srv/sample.git，在/srv目录下输入命令：
    $ sudo git init --bare sample.git
    Git就会创建一个裸仓库，裸仓库没有工作区，因为服务器上的Git仓库纯粹是为了共享，所以不让用户直接登录到服务器上去改工作区，并且服务器上的Git仓库通常都以.git结尾。然后，把owner改为git：
    $ sudo chown -R git:git sample.git
  第五步，禁用shell登录：
    出于安全考虑，第二步创建的git用户不允许登录shell，这可以通过编辑/etc/passwd文件完成。找到类似下面的一行：
    git:x:1001:1001:,,,:/home/git:/bin/bash
    改为：
    git:x:1001:1001:,,,:/home/git:/usr/bin/git-shell
    这样，git用户可以正常通过ssh使用git，但无法登录shell，因为我们为git用户指定的git-shell每次一登录就自动退出。
  第六步，克隆远程仓库：
    现在，可以通过git clone命令克隆远程仓库了，在各自的电脑上运行：
    $ git clone git@server:/srv/sample.git
    Cloning into 'sample'...
    warning: You appear to have cloned an empty repository.
    剩下的推送就简单了。
```
###GIT 管理公钥
```
  如果团队小，把每个人的公钥收集起来放到服务器的/home/git/.ssh/authorized_keys文件里就是可行的
  https://github.com/res0nat0r/gitosis
```
###GIT 控制权限，用Gitolite
  https://github.com/sitaramc/gitolite

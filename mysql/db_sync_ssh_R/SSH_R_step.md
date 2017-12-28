# 准备和SSH端口映射

## 医院编号

|    名称      | 编号 |
|:-----------:|:-------:|
|京和总院       |111     |
|西京分院       |112     |
|和和分院       |113     |
|八府庄分院      |114     |
|世家星城分院     |115    |
|测试机器何永鹏  |191     |

## M (Mysql 主从的 Master) 机信息（假设）

系统信息

|系统版本|系统管理员用户名|系统管理员密码|
|:---:|:---:|:---:|
|win7 sp1 x64| administrator | 123456 |

mysql信息

|版本|地址|端口|管理员用户名|管理员密码|数据库|编码|
|:---:|:---:|:---:|:---:|:---:|:---:|:---:|
|5.6|127.0.0.1|3306|m_root|123456|evetdb|utf-8|

|配置文件位置|数据库位置|
|:---:|:---:|
|D:\Program Files\EVet\EvetDB\my.cnf|D:\Program Files\EVet\EvetDB\data|

修改 D:\Program Files\EVet\EvetDB/my.cnf

```
[mysqld]
log_bin_trust_function_creators=1
log-bin=mysql-bin
binlog_format=mixed

server_id=111
```

重启 mysqld

## S (Mysql 主从的 SLAVE) 机信息（假设）

系统信息

|系统版本|ssh连接用户名|
|:---:|:---:|
|ubuntu 14.04|db_sync|

mysql信息

|版本|地址|端口|管理员用户名|管理员密码|数据库|编码|
|:---:|:---:|:---:|:---:|:---:|:---:|:---:|
|5.6|127.0.0.1|33111|s_root|123456|evetdb|utf-8|

|配置文件位置|数据库位置|
|:---:|:---:|
|/etc/mysql/my.cnf|/usr/share/mysql|

修改/etc/mysql/my.cnf

```
[mysqld]
log-bin=mysql-bin
log_bin_trust_function_creators=1
binlog_format=mixed

server_id=111
```

重启 mysqld

新建立ssh连接用户步骤

```bash
$ sudo adduser db_sync
$ sudo passwd db_sync
$ su - db_sync
$ mkdir ~/.ssh
$ chmod 700 ~/.ssh
$ touch ~/.ssh/authorized_keys
$ chmod 644 ~/.ssh/authorized_keys
```

## 如果不知道 M 机mysql超级用户密码

1. 先停止 mysqld ，结束进程或停止服务

2. 再启动 mysqld 加 --skip-grant-tables

```bash
$ "D:\Program Files\EVet\EvetDB\bin\mysqld" --defaults-file="D:\Program Files\EVet\EvetDB\my.ini" --skip-grant-tables
```

3. 用root用户登录

```bash
$ "D:\Program Files\EVet\EvetDB\bin\mysql" -h localhost -u root
```

4. 建超级用户

```sql
mysql> insert into mysql.user set Host='%', User='db_sync', Password=PASSWORD("123456"), ssl_cipher='', x509_issuer='', x509_subject='';

mysql> update mysql.user set Grant_priv='Y', Super_priv='Y' where User= 'db_sync';

mysql> update mysql.user set Create_priv='Y', Create_tmp_table_priv='Y', Create_user_priv='Y', Execute_priv='Y', Index_priv='Y', References_priv='Y', Drop_priv='Y', Select_priv='Y', Insert_priv='Y', Update_priv='Y', Delete_priv='Y', Lock_tables_priv='Y', Show_db_priv='Y', Alter_priv='Y', Reload_priv='Y', Repl_client_priv='Y', Repl_slave_priv='Y', Show_view_priv='Y', Create_view_priv='Y' where User='db_sync';

```

5. 关闭刚启动的 mysqld，通过服务启动mysqld

6. 尝试连接

```bash
$ "D:\Program Files\EVet\EvetDB\bin\mysql" -h localhost -u db_sync -p
```

## SSH 端口映射

1. M机 拷贝 ssh_R 目录到 C盘根目录

2. M机 运行 C:\ssh_R\PUTTYGEN.EXE 生成 私钥（id_rsa.ppk），Key Comment 为 db_sync_ssh_R_111 （111为医院编号），都放到 C:\ssh_R 目录，并做备份

3. S机 修改 db_sync 用户下的 .ssh/authorized_keys ，加入 M机 上生成的公钥（运行 C:\ssh_R\PUTTYGEN.EXE，load保存的id_rsa.ppk文件）

4. M机 修改 ssh_R.bat 中的 rl_port 为 36111，（36是定值，111是医院编号）
打开cmd，运行 C:\ssh_R\ssh_R.bat ，保证第一次可连接

5. S机 测试SSH 端口映射是否工作

```bash
$ mysql -h 127.0.0.1 -P 36111 -u m_root -p
```

6. M机 安装 AlwaysUp 并注册（soft\AlwaysUp_Installer.exe 和 soft\staru.net_AlwaysUp_keygen.7z）
进入Register Now， 复制机器码后返回 ，粘贴到注册机生成code，复制code，点击AlwaysUp(enter code),粘贴code，完成注册

7. M机 运行 AlwaysUp

General->Name 为 ssh_R

General->Application 为 C:\ssh_R\hstart.exe 或 C:\ssh_R\hstart64.exe

General->Arguments 为 /NOCONSOLE C:\ssh_R\ssh_R.bat

Logon->输入User name 和 Password,将上边的checkbox勾上

Startup -> check "Ensure that the Windows Networking components have started"

点击save按钮

参考 http://www.coretechnologies.com/products/AlwaysUp/Apps/RunPuTTYAsAService.html

## 注

关闭Win7交互式服务检测提醒,参考  http://jingyan.baidu.com/article/2d5afd698a05f485a2e28e20.html

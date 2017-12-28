# 配置mysql多实例

1. 编辑配置文件

```bash
$ vim /etc/mysql/my_mulit.conf

[mysqld_multi]
mysqld = /usr/bin/mysqld_safe
mysqladmin = /usr/bin/mysqladmin
log=/var/log/mysql_multi.log

user = multi_admin
password = multipass

# [mysqld1]
# port = 3306
# bind-address = 0.0.0.0
# datadir = /var/lib/mysql
# socket = /var/run/mysqld/mysqld.sock
# pid-file = /var/run/mysqld/mysqld.pid
#
# character-set-server=utf8
# collation-server=utf8_general_ci
#
# log-bin=mysql-bin
# log_bin_trust_function_creators=1
# binlog-format=mixed
#
# server-id=1

[mysqld2]
port = 33111
bind-address = 127.0.0.1
datadir = /var/lib/mysql_33111
socket = /var/run/mysqld/mysqld_33111.sock
pid-file = /var/run/mysqld/mysqld_33111.pid

character-set-server=utf8
collation-server=utf8_general_ci

log-bin=mysql-bin
log_bin_trust_function_creators=1
binlog_format=mixed

server_id=33111

innodb_buffer_pool_size=8M
query_cache_size=8M
tmp_table_size=8M
key_buffer_size=8M


[mysqld3]
port = 33115
bind-address = 127.0.0.1
datadir = /var/lib/mysql_33115
socket = /var/run/mysqld/mysqld_33115.sock
pid-file = /var/run/mysqld/mysqld_33115.pid

character-set-server=utf8
collation-server=utf8_general_ci

log-bin=mysql-bin
log_bin_trust_function_creators=1
binlog_format=mixed

server_id=33115

innodb_buffer_pool_size=8M
query_cache_size=8M
tmp_table_size=8M
key_buffer_size=8M

```

2. 初始化数据库

```bash
$ mysql_install_db --datadir=/var/lib/mysql_33111 --user=mysql --basedir=/usr/
```

3. 启动服务

```bash
$ mysqld_multi --defaults-file=/etc/mysql/my_mulit.conf --verbose --no-log start 2
```

4. 建stop用户

```bash
$ mysql -u root -S /var/run/mysqld/mysqld_33111.sock -p

mysql> grant shutdown on *.* to multi_admin@'localhost' identified by 'multipass';

mysql> exit
```

5. 停止服务

```bash
$ mysqld_multi --defaults-file=/etc/mysql/my_mulit.conf --verbose --no-log stop 2
```

6. 启动脚本

```bash

$ vim /etc/init.d/mysqld_multi

ref mysqld_multi.server.sh

$ chmod +x /etc/init.d/mysqld_multi

$ /etc/init.d/mysqld_multi stop 2

$ /etc/init.d/mysqld_multi start 2

```

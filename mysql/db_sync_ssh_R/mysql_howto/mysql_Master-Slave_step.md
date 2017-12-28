# 配置mysql主从

## M (Mysql 主从的 Master) 机信息（假设）

mysql信息

|版本|地址|端口|管理员用户名|管理员密码|数据库|编码|
|:---:|:---:|:---:|:---:|:---:|:---:|:---:|
|5.6|127.0.0.1|36111|m_root|123456|evetdb|utf-8|

## S (Mysql 主从的 SLAVE) 机信息（假设）

mysql信息

|版本|地址|端口|管理员用户名|管理员密码|数据库|编码|
|:---:|:---:|:---:|:---:|:---:|:---:|:---:|
|5.6|127.0.0.1|33111|s_root|123456|evetdb|utf-8|

## 主从

1. M机 配置新 mysql 用户，用于主从

```bash
$ mysql -h 127.0.0.1 -P 36111 -u m_root -p123456
```

```mysql
mysql> GRANT REPLICATION SLAVE ON *.* to 'sync'@'%' identified by '123456';
mysql> FLUSH PRIVILEGES;
mysql> exit
```

2. M机 锁表并导出数据库

```bash
$ mysql -h 127.0.0.1 -P 36111 -u m_root -p123456
```

```mysql
mysql> use evetdb;
mysql> FLUSH TABLES WITH READ LOCK;
mysql> exit
```

```bash
$ mysqldump -h 127.0.0.1 -P 36111 -u m_root -p123456 --flush-logs -R evetdb > /tmp/111_evetdb.sql
```

3. M机 查看 MASTER STATUS 并解锁

```bash
$ mysql -h 127.0.0.1 -P 36111 -u m_root -p123456
```

```mysql
mysql> SHOW MASTER STATUS;
+------------------+----------+----------------------+------------------+
| File             | Position | Binlog_Do_DB         | Binlog_Ignore_DB |
+------------------+----------+----------------------+------------------+
| mysql-bin.000112 |      106 | evetdb               |                  |
+------------------+----------+----------------------+------------------+
1 row in set (0.00 sec)
注意：这里要记录File和Position的值

mysql> UNLOCK TABLES;
mysql> exit
```

4. S机 导入数据

```bash
$ mysql -h 127.0.0.1 -P 33111 -u s_root -p123456 evetdb < /tmp/111_evetdb.sql
```

5. S机 建立主从

```bash
$ mysql -h 127.0.0.1 -P 33111 -u s_root -p123456
```

```mysql
mysql> stop slave;

mysql> CHANGE MASTER TO MASTER_HOST = '127.0.0.1', MASTER_USER = 'sync', MASTER_PASSWORD = '123456', MASTER_PORT = 36111, MASTER_LOG_FILE = 'mysql-bin.000112', MASTER_LOG_POS = 106;

mysql> start slave;

mysql> show slave status;

```

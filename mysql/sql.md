## 常用sql语句整理：mysql


1. 增

- 增加一张表
```
CREATE TABLE `table_name`(
  ...
  )ENGINE=InnoDB DEFAULT CHARSET=utf8;
```

- 增加记录
```
INSERT INTO `your_table_name`(`column_name`)
VALUES
('your_value_one'),
('your_value_two');
```

- 增加字段
```
ALTER TABLE `your_table_name`
ADD `your_column_name` ...
AFTER `column_name`;
```

- 增加索引
  + 主键
  ```
  ALTER TABLE `your_table_name`
  ADD PRIMARY KEY your_index_name(your_column_name);
  ```
  + 唯一索引
  ```
  ALTER TABLE `your_table_name`
  ADD UNIQUE your_index_name(your_column_name);
  ```
  + 普通索引
  ```
  ALTER TABLE `your_table_name`
  ADD INDEX your_index_name(your_column_name);
  ```
  + 全文索引
  ```
  ALTER TABLE `your_table_name`
  ADD FULLTEXT your_index_name(your_column_name);
  ```


2. 删

- 逐行删除
```
DELETE FORM `table_name`
WHERE ...;
```

- 清空整张表
```
TRUNCATE TABLE `your_table_name`;
```

- 删除表
```
DROP TABLE `your_table_name`;
```

- 删除字段
```
ALTER TABLE `your_table_name`
DROP `column_name`;
```

- 删除索引
```
ALTER TABLE `your_table_name`
DROP INDEX your_index_name(your_column_name);
```


3. 改

- 变更数据
```
UPDATE `table_name`
SET column_name=your_value
WHERE ...;
```

- 变更字段
```
ALTER TABLE `your_table_name`
CHANGE `your_column_name` `your_column_name` ...(变更);
```

- 变更字段值为另一张表的某个值
```
UPDATE `your_table_name`
AS a
JOIN `your_anther_table_name`
AS b
SET a.column = b.anther_column
WHERE a.id = b.a_id...;
```

4. 查


- 普通查询
```
SELECT `column_name_one`, `column_name_two`
FROM `table_name`;
```

- 关联查询
```
SELECT *
FROM `your_table_name`
AS a
JOIN `your_anther_table_name`
AS b
WHERE a.column_name = b.column_name...;
```

- 合计函数条件查询：WHERE 关键字无法与合计函数一起使用
```
SELECT aggregate_function(column_name)
FROM your_table_name
GROUP BY column_name
HAVING aggregate_function(column_name)...;
```

- 同一个实例下跨库查询
```
SELECT *
FROM database_name.your_table_name
AS a
JOIN another_database_name.your_another_table_name
AS b
WHERE a.column_name = b.column_name...;
```

5. 复制一张表结构
```
CREATE TABLE `your_table_name`
LIKE `destination_table_name`;
```

6. 完全复制一张表：表结构+全部数据
```
CREATE TABLE `your_table_name`
LIKE `destination_table_name`;

INSERT INTO `your_table_name`
SELECT *
FROM `destination_table_name`;
```

7. 嵌套查询 (子查询)
```
  场景： 统计一个学校所有班级(classes)的学生(students) 考试成绩(score)总分
  select count(score) from (select count(score) from students where group by classes) as a
```

### 附录：mysql常用命令
- 登陆： mysql -h host -u username -p
- 列出数据库：SHOW DATABESES;
- 列出表:SHOW TABLES;
- 列出表结构:DESC table_name
- 使用一个数据库：USE database_name;
- 导入：source 'file';
- 导出：mysqldump -h 127.0.0.1 -u root -p "database_name" "table_name" --where="condition" > file_name.sql;
- 查看慢日志：mysqldumpslow -s [c:按记录次数排序/t:时间/l:锁定时间/r:返回的记录数] -t [n:前n条数据] -g "正则"　/path
- 新增用户： insert into `user`(`Host`, `User`, `authentication_string`) value('localhost', 'username', password('pwd'))

### mysql 5.7 新增用户

```
// 插入新用户
insert into mysql.user(Host, User, authentication_string, ssl_cipher, x509_issuer, x509_subject
value('localhost', 'username', password('password'), '', '', '');

// 数据库授权
grant all privileges on dbname.name.* to username@localhost identified by 'password';

// 刷新权限信息
FLUSH PRIVILEGES;
```

### 实现远程连接(授权法)
    #将host字段的值改为%就表示在任何客户端机器上能以root用户登录到mysql服务器，建议在开发时设为%
      update user set host = '%' where user = 'root';
    #将权限改为ALL PRIVILEGES
      mysql> use mysql;
      Database changed
      mysql> grant all privileges  on *.* to root@'%' identified by "root";
      Query OK, 0 rows affected (0.00 sec)

###数据类型


1、整型

MySQL数据类型 含义（有符号）
tinyint(m)  1个字节  范围(-128~127)
smallint(m) 2个字节  范围(-32768~32767)
mediumint(m)  3个字节  范围(-8388608~8388607)
int(m)  4个字节  范围(-2147483648~2147483647)
bigint(m) 8个字节  范围(+-9.22*10的18次方)
取值范围如果加了unsigned，则最大值翻倍，如tinyint unsigned的取值范围为(0~256)。 
int(m)里的m是表示SELECT查询结果集中的显示宽度，并不影响实际的取值范围，没有影响到显示的宽度，不知道这个m有什么用。

2、浮点型(float和double)

MySQL数据类型 含义
float(m,d)  单精度浮点型    8位精度(4字节)     m总个数，d小数位
double(m,d) 双精度浮点型    16位精度(8字节)    m总个数，d小数位
设一个字段定义为float(5,3)，如果插入一个数123.45678,实际数据库里存的是123.457，但总个数还以实际为准，即6位。

3、定点数

浮点型在数据库中存放的是近似值，而定点类型在数据库中存放的是精确值。 
decimal(m,d) 参数m　<　65 是总个数，d　<　30且 d　<　m 是小数位。

4、字符串(char,varchar,_text)

MySQL数据类型 含义
char(n) 固定长度，最多255个字符
varchar(n)  固定长度，最多65535个字符
tinytext  可变长度，最多255个字符
text  可变长度，最多65535个字符
mediumtext  可变长度，最多2的24次方-1个字符
longtext  可变长度，最多2的32次方-1个字符
char和varchar：
1.char(n) 若存入字符数小于n，则以空格补于其后，查询之时再将空格去掉。所以char类型存储的字符串末尾不能有空格，varchar不限于此。 
2.char(n) 固定长度，char(4)不管是存入几个字符，都将占用4个字节，varchar是存入的实际字符数+1个字节（n<=255）或2个字节(n>255)，所以varchar(4),存入3个字符将占用4个字节。 
3.char类型的字符串检索速度要比varchar类型的快。

varchar和text： 
1.varchar可指定n，text不能指定，内部存储varchar是存入的实际字符数+1个字节（n<=255）或2个字节(n>255)，text是实际字符数+2个字节。 
2.text类型不能有默认值。 
3.varchar可直接创建索引，text创建索引要指定前多少个字符。varchar查询速度快于text,在都创建索引的情况下，text的索引似乎不起作用。

5.二进制数据(_Blob)

1._BLOB和_text存储方式不同，_TEXT以文本方式存储，英文存储区分大小写，而_Blob是以二进制方式存储，不分大小写。 
2._BLOB存储的数据只能整体读出。 
3._TEXT可以指定字符集，_BLO不用指定字符集。

6.日期时间类型

MySQL数据类型 含义
date  日期 '2008-12-2'
time  时间 '12:25:36'
datetime  日期时间 '2008-12-2 22:06:44'
timestamp 自动存储记录修改时间
若定义一个字段为timestamp，这个字段里的时间数据会随其他字段修改的时候自动刷新，所以这个数据类型的字段可以存放这条记录最后被修改的时间。

数据类型的属性

MySQL关键字          含义
NULL                数据列可包含NULL值
NOT NULL            数据列不允许包含NULL值
DEFAULT             默认值
PRIMARY KEY         主键
AUTO_INCREMENT      自动递增，适用于整数类型
UNSIGNED            无符号
CHARACTER SET name  指定一个字符集


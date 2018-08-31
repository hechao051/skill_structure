重新安装的php7 环境
配置phpfpm listen=127.0.0.1:9000

#php 需要编译安装的扩展
    redis
    pgsql
    mongodb

thinkphp 扩展
https://yangweijie.github.io/thinkphp-lts

查看php mongo 对应获取版本
https://docs.mongodb.com/ecosystem/drivers/driver-compatibility-reference/#reference-compatibility-mongodb-php

下载扩展
https://pecl.php.net/package/mongodb
https://pecl.php.net/package/PDO_MYSQL

解压
tar xvf ~/mongodb-1.3.0.tgz
cd ~/mongodb-1.3.0
phpize
生成configure
./configure --with-php-config=/usr/bin/php-config
编译
make
make test
make install
编译完成之后会输出:
Installing shared extensions:     /usr/lib/php/20131226/

#给php ini 配置文件写入扩展
    /etc/php/5.6/cli/php.ini
    $ echo "extension=mongodb.so" >> `/usr/local/php7/bin/php --ini | grep "Loaded Configuration" | sed -e "s|.*:\s*||"`

#当前php 版本扩展位置
    php -i | grep extension_dir
    extension_dir => /usr/lib/php/20131226 => /usr/lib/php/20131226






###编译安装
sudo apt-get install php7.0-dev

1: 解压

2: cd redis-x.x.x

3: phpize7.0

4: ./configure --with-php-config=/usr/bin/php-config7.0

5: sudo make && sudo make install


###php 常见问题解决办法
http://www.zixuephp.net/iphp-1-3.html


###########

#安装php7.1.x
./configure --prefix=/opt/php71 --with-config-file-path=/opt/php71/etc/ --enable-fpm --with-fpm-user=www --with-fpm-group=www --with-mysql=mysqlnd --with-mysqli=mysqlnd --with-pdo-mysql=mysqlnd --with-iconv=/usr/local/lib --with-freetype-dir --with-jpeg-dir --with-png-dir --with-zlib --with-libxml-dir --enable-xml --disable-rpath --enable-bcmath --enable-shmop --enable-sysvsem --enable-inline-optimization --with-curl --enable-mbregex --enable-mbstring --with-mcrypt --with-gd --enable-gd-native-ttf --with-openssl --with-mhash --enable-pcntl --enable-sockets --with-xmlrpc --enable-zip --enable-soap --with-gettext --enable-opcache --enable-ftp
make && make install

#安装redis扩展
wget http://pecl.php.net/get/redis-3.1.6.tgz
tar zxvf redis-3.1.6.tgz
cd redis-3.1.6
/opt/php71/bin/phpize
./configure --with-php-config=/opt/php71/bin/php-config
make && make install

vim /opt/php71/etc/php.ini
#添加extension = redis.so
php -m
#查看是否支持redis


#下载hiredis编译
https://github.com/redis/hiredis/archive/v0.13.3.tar.gz
make -j
sudo make install
# mkdir -p /usr/local/include/hiredis /usr/local/lib
# cp -a hiredis.h async.h read.h sds.h adapters /usr/local/include/hiredis
# cp -a libhiredis.so /usr/local/lib/libhiredis.so.0.13
# cd /usr/local/lib && ln -sf libhiredis.so.0.13 libhiredis.so
# cp -a libhiredis.a /usr/local/lib
# mkdir -p /usr/local/lib/pkgconfig
# cp -a hiredis.pc /usr/local/lib/pkgconfig
sudo ldconfig

#开始编译swoole，其中--enable-openssl
#是启动ssl支持，需要安装openssl库（可以不选择开启ssl支持）。
wget https://github.com/swoole/swoole-src/archive/v1.10.0.tar.gz
tar zxvf v1.10.0.tar.gz
cd v1.10.0.tar.gz
/opt/php71/bin/phpize
./configure --with-php-config=/opt/php71/bin/php-config --enable-async-redis  --enable-openssl
make clean
make -j
sudo make install

#安装phalcon
1. 从C源代码创建扩展请按照下面的步骤:
git clone --depth=1 "git://github.com/phalcon/cphalcon.git"
cd cphalcon/build
/opt/php71/bin/phpize

2. 添加扩展到php.ini文件:
extension=phalcon.so


#安装inotify
/opt/php71/bin/pecl install inotify

#安装Phalcon
git clone --depth=1 "git://github.com/phalcon/cphalcon.git"
cd cphalcon/build/php7/64bits
/opt/php71/bin/phpize
./configure --with-php-config=/opt/php71/bin/php-config  --enable-phalcon
make && make install

#安装Memcached


#安装Composer，将composer换为中国镜像
#1. 下载安装脚本
/opt/php71/bin/php -r "copy('https://install.phpcomposer.com/installer', 'composer-setup.php');"

#2. 执行安装过程。
/opt/php71/bin/php composer-setup.php

#3. 删除安装脚本。
/opt/php71/bin/php -r "unlink('composer-setup.php');"

#安装Redis服务
wget http://download.redis.io/releases/redis-stable.tar.gz
tar zxvf redis-stable.tar.gz
cd redis-stable
执行make编译Redis：
make MALLOC=libc
注意：make命令执行完成编译后，会在src目录下生成6个可执行文件，分别是redis-server、redis-cli、redis-benchmark、redis-check-aof、redis-check-rdb、redis-sentinel。
安装Redis：
make install 
配置Redis能随系统启动:
./utils/install_server.sh

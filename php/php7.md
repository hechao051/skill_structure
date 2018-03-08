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

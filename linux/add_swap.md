Ubuntu14.04LTS增加SWAP交换分区

因为一开始设置的交换分区不够大，所以后来又自行添加。在这里把过程记录下来.

1.创建文件

sudo dd if=/dev/zero of=/swapfile bs=1024 count=4096k
这里最后的4096,即说明创建的交换分区最终为4096MB，用bs*count可得出。同时，该文件将被创建在根目录，如果需要指定目录，则修改“of=/swapfile”这一处的内容。

2.制作交换分区文件

sudo mkswap /swapfile
这一步是将过程一中创建的文件转换成交换分区文件。
执行命令后输出如下类似的内容:

Setting up swapspace version 1, size = 4194300 KiB
no label, UUID=103c4545-5fc5-47f3-a8b3-dfbdb64fd7eb
3.启用swap文件

sudo swapon /swapfile
这一句执行成功后，那么之前建立的swap文件就生效了。

4.查看swap

sudo swapon -s
运行结果如下图：
图片描述

5.设置开机自动挂载

sudo gedit /etc/fstab
在打开的文件最后面加上如下一行内容：

/home/xxx/xxx/xxx/swapfile none swap sw 0 0
其中/home/xxx/xxx/xxx/swapfile指的是你自己的swap文件的路径。

6.设置swap文件权限

对你的swap文件加上权限，避免误操作，这一步不是必需的，如果需要的话，使用chown命令和chmod命令

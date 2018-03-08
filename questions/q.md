mysql:
```
  乐观锁,悲观锁

  数据库引擎的区别

  大数据,高并发的处理办法

  索引失效的情况
      所以建议一般情况下不要在字符串列建立索引，如果非要使用字符串索引，可以采用以下两种方法：
      1.只是用字符串的最左边n个字符建立索引，推荐n<=10;比如index left(address,8),但是需要知道前缀索引不能在order by中使用，也不能用在索引覆盖上。
      2.对字符串使用hash方法将字符串转化为整数，address_key=hashToInt(address)，对address_key建立索引，查询时可以用如下查询where address_key = hashToInt(‘beijing,china’) and address = ‘beijing,china’;
```
编码范围
```
    utf8: 汉字编码范围 0x4e00-0x9fa5 ANSI(gb2312) 0xb0-0xf7, 0xa1-0xfe
```
php5中魔术方法函数有哪几个
```
    __construct() :实例化对象时被调用；
    __destuct()：当删除一个对象或者对象操作终止是被执行；
    __call()：调用对象不存在方法时被调用；
    __get()：调用对象不存在的属性时被调用；
    __set()：设置对象不存在的属性时被调用；
    __toString()：打印一个对象时被调用，比如echo $obj,print($obj);
    __clone():克隆对象时被调用，比如$t = new Test();$tt = clone $t;
    __sleep():serialize之前被调用，若对象比较大，想做一些删除在序列化，可以考虑使用该方法；
    __wakeup()：unserialize之前被调用，做些对象的初始化；
    __isset()：检测对象是否存在属性的时候被调用，如 isset($c->name)；
    __unset():unset一个对象属性时被调用，如：unset($c->name);
    __set_state()：调用 var_export 时被调用，用__set_state的返回值作为 var_export的返回值
    __autoload()：实例化一个对象时，如果对应的类不存在，在该方法被调用

    魔术常量：
    __LINE__：返回当前行号；
    __FILE__：返回文件的完整路径和文件名，如果用在包含文件里面，则返回包含文件名，自 php4.0.2开始，
    __FILE__ 总是包含一个绝对路径，而在此前的版本有时候会包含一个相对路径
    __FUNCTION__：返回函数名称（自 php4.3.0新加的）。自php5起本常量返回该函数被定义时的名称，区分大小写，在php4中该值总是小写；
    __CLASS__：返回类的名称，自 php4.3.0新加的，自php5起本常量返回该类被定义时的名称，区分大小写，在php4中该值总是小写的；
    __METHOD__：返回类的方法名。 php5新加的
```
#目录遍历:
```
  <?php
  $dir = './test';
  // 1:打开目录 2:读取目录当中的文件 3:如果文件类型是目录，继续打开目录 4:读取子目录的文件 5:如果文件类型是文件，输出文件名称 6:关闭目录

  function loopDir($dir)
  {
    $handle = opendir($dir);
    while(false!==($file = readdir($handle)))
    {
      if ($file != '.' && $file != '..')
      {
          echo $file. "\n";
          if (filetype($dir. '/'. $file) == 'dir')
          {
              loopDir($dir. '/'. $file);
          }
      }
    }
  }

  loopDir($dir);
```
#从一个标准 url 里取出文件的扩展名
```
    例如: http://www.sina.com.cn/abc/de/fg.php?id=1 需要取出 php 或 .php
    答案1:
    function getExt($url){
            $arr = parse_url($url);
            $file = basename($arr['path']);
            $ext = explode(".",$file);
            return $ext[1];
    }
```
#linux 指定的遍历目录
```
  vi loopdir.sh
  #!/bin/bash
  function show()
  {
      cd $1
      for i in `ls -a`
      do
          if [ "$i" == "." ] || [ "$i" == ".." ]
          then
              continue;
          fi
          if [ -d "$i" ]
          then
              show "$i"
          else
              echo "$i"
          fi
      done
      cd ..
  }
  show $1
  exit 0
```
#php 文件操作:
```
  <?php
  // 1:打开文件 2:将文件的内容读取出来，在开头加入Hello World 3:将拼接好的字符串写回到文件当中
  // sample: Hello 7891234567890
  $file = './hello.txt';
  $handle = fopen($file, 'r');
  $content = fread($handle, filesize($file));
  $content = 'Hello World'. $content;
  fclose($handle);
  $handle = fopen($file, 'w');
  fwrite($handle, $content);
  fclose($handle);
```
PDO 连接:
```
  <?php
  $title = $_POST['title'];
  $content = $_POST['content'];
  $user_name = $_POST['user_name'];

  if (empty($title) || empty($content) || empty($user_name)) {exit('标题或者内容或者用户名不能为空');}

  try {

      $dsn = 'mysql:dbname=test;host=localhost';
      $username = 'test';
      $password = 'test';
      $attr = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      ];
      $pdo = new PDO($dsn, $username, $password, $attr);
      $sql = 'insert into message(title, content, created_at, user_name)
    values(:title, :content, :created_at, :user_name)';
      $stmt = $pdo->prepare($sql);
      $data = [
    ':title' => $title,
    ':content' => $content,
    ':created_at' => time(),
    ':user_name' => $user_name
      ];
      $stmt->execute($data);
      $rows = $stmt->rowCount();

      if($rows)
      {
    exit('添加成功');
      } else {
    exit('添加失败');
      }
  } catch(PDOException $e) {
      echo $e->getMessge(); // 异常
  }
```
高并发解决方案类
```
  1 高并发和大流量解决方案
  2 web资源防盗链
  3 减少HTTP请求
  4 浏览器缓存和压缩优化技术
  5 CDN加速
  6 建立独立的图片服务器
  7 动态语言静态化
  8 动态语言层的并发处理视频
  9 数据库缓存层的优化
  10 Mysql数据层的优化
  11 Web服务器的负载均衡、请求分发
```
php面向对象 
```
   http://www.imooc.com/learn/887
```

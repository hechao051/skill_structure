<?php
 // 打开目录
 // 读取目录中的文件
 // 如果文件类型是目录,继续打开
 // 读取子目录文件
 // 如果文件类型是文件,输出文件名
 // 关闭目录
 // 遍历目录
$dir = __DIR__.'php_demos';
function loopDir($dir)
{
  $handle = opendir($dir);
  while(false !== ($file = readdir($handle)))
  {
    if($file != '.' && $file != '..'){
     echo $file."\n";
     if(filetype($dir.'/'.$file) == 'dir'){
	     loopDir($dir.'/'.$file);
     }
    }
  }
}
loopdir($dir);

// 文件操作
// 打开文件
// 读取文件
// 关闭文件
// 打开文件
// 写入文件
// 关闭文件
$file = '/home/hecc/php_demos/dir1/hello.text';

$handle = fopen($file, 'r');
$content = fread($handle, filesize($file));
$content = 'word! '.$content;
fclose($handle);
$handle = fopen($file, 'w');
fwrite($handle, $content);
fclose($handle);

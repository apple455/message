<?php
header("content-type:text/html;charset=utf-8");
include_once 'filter.php';
$mag=new  Filter();

$title=$mag->magic($_POST['title']);
$username=$mag->magic($_POST['username']);
$content=$mag->magic($_POST['content']);
// print_r($title);
// print_r($username);
// print_r($content);
include_once 'connect.php';
$sql="INSERT  INTO sw_message (title,content,recontent,replay,username,created) VALUES('{$title}','{$content}','','0','{$username}','".date("Y-m-d H:i:s")."')";
$re=mysql_query($sql);
//var_dump($re);
if ($re){
    echo '<script>alert("执行成功");location.href="index.php";</script>';
}else{
   echo '<script>alert("执行失败");location.href="index.php";</script>';
}
<?php
error_reporting(0);
header("content-type:text/html;charset=utf-8");
include 'filter.php';
include 'connect.php';
$mag=new Filter();
$username=$mag->magic($_POST['username']);
$password=$mag->magic($_POST['password']);

$sql="select  count(*) from sw_user where  username= '".$username."' and  password= '".$password."' ";
$result=mysql_query($sql);
$row=mysql_fetch_row($result);

if ($row[0]==1) {
	session_start();
	$_SESSION['login']='ok';
	echo "<script>alert('登录成功');window.location.href='index.php';</script>";
}else{
	echo "<script>alert('登录失败');window.location.href='index.php';</script>";
}
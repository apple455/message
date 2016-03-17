<?php

$id=$_GET['id'];
include 'connect.php';
$result=mysql_query("update  sw_message  set  deleted=1 where id=".$id);
$rs=mysql_affected_rows();
if ($rs) {
	echo '<script>alert("删除成功！");location.href="index.php";</script>';
}
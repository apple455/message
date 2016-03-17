<?php
header("content-type:text/html;chatset=utf-8");
include 'connect.php';
include 'filter.php';
$id=$_GET['id'];
$mag=new Filter();
$recontent=$mag->magic($_POST['recontent']);

// $sql="update  sw_message  set recontent='".$recontent."',replay=1  where  id=".$id;
$sql="UPDATE  sw_message  SET  recontent='".$recontent."',replay=1  WHERE deleted=0 and id={$id}";
$res=mysql_query($sql);
$ms=mysql_affected_rows();
// echo $sql;
// echo '<hr/>';
// echo $ms;
if($ms){
 echo '<script>alert("留言回复成功！");location.href="index.php";</script>';
}else{
 echo '<script>alert("留言回复失败！");location.href="edit.php";</script>';
}
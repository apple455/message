<?php
error_reporting(0);
$id=$_GET['id'];
include 'connect.php';
include 'filter.php';
//显示回复页面
$result=mysql_query("select  * from sw_message where deleted=0 and  id=".$id);
$row=mysql_fetch_assoc($result);
$replay=$row['replay'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>留言板</title> 
<link href="images/index.css" rel="stylesheet" type="text/css"/>
<script  type="text/javascript">

function  replay(){
	var  sum;
	if (document.frm.recontent.value=='')
	 {
	 	alert("回复内容不能为空！");
	 	return false;
	 }else
	 {
	 	sum=document.frm.recontent.value.length;
	 	if (sum<10) 
	 	{
	 		alert("回复内容>10个字符");
	 		return  false;
	 	}
	 }
	 return  true;
}

</script>
</head>
 
 
<body>
    
<div id="main">

   	<div style="margin:100px auto;"></div>
	<div id="left" >
	
		<fieldset>
		<legend>回复留言</legend>
		<form action="replay.php?id=<?php  echo $id;?>" method="post" name="frm"  onsubmit="return  replay();">
		<table border="0" cellpadding="5" cellspacing="0" width="0">
			<tbody><tr>
				<td width="20%">留言标题</td><td><input name="title" size="30" type="text" value="<?php echo $row['title']?>"  readonly="readonly"/></td>
			</tr>
			<tr>
				<td>用户网名</td><td><input name="username"  value="<?php echo $row['username']?>" size="30" type="text"  readonly/></td>
			</tr>
			<tr>
				<td>留言内容</td><td><textarea name="content" cols="42" rows="5" readonly><?php echo $row['content']?></textarea></td>
			</tr>
			
			
			<tr>
				<td>回复内容</td><td><textarea name="recontent" cols="42" rows="5"><?php echo $row['recontent'];?></textarea></td>
			</tr>
	
			
			<tr>
			    <td colspan="2" align="center">
					<input name="action" value="replay" type="hidden"/>
					<input value="提交 " class="button" type="submit"/>
				</td>
			</tr>
		</tbody>
		</table>
		</form>
		</fieldset>

	 

	</div>

	

	<div id="footer">&#169;&nbsp;2016&nbsp;www.houdunwang.com</div>

</div>

</body></html>
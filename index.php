<?php 
error_reporting(0);
header("content-type:text/html;charset=utf-8");

include 'connect.php';
session_start();
$pagesize=1;
$sql="SELECT  COUNT(*) from sw_message where deleted=0 ";
$re=mysql_query($sql);
$row=mysql_fetch_row($re);
$total=$row[0];
$page=ceil($total/$pagesize);

$currentpage=empty($_GET['page'])?1:$_GET['page'];
// if($_GET['page']>=$page)  $currentpage=$page;
// if(!is_numeric($_GET['page'])||$_GET['page']<1)  $currentpage=1;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>留言板</title> 
<link href="images/index.css" rel="stylesheet" type="text/css"/>
<script  type="text/javascript">
function test(){

	var  sum
	if (document.frm.title.value=='') 
	{
		alert("标题不能为空");
		return  false;
	}else
	{  
		sum=document.frm.title.value.length;
		if (sum<5 || sum>20) 
		{
			alert("标题长度在5-20之间");
			return false;
		}

	}
	if (document.frm.username.value=='')
	{
		alert("用户不能为空");
		return false;
	}else
	{  sum=document.frm.username.value.length;
		if (sum<2 || sum>10)
		 {
		 	alert("用户名称在2-10之间");
		 	return false;
		 }
	}
	if (document.frm.content.value=='')
	{
		alert("留言内容不能为空");
		return  false;
	}else
	{   sum=document.frm.content.value.length;
		if (sum<10)
		 {
		 	alert("留言内容在10个字符以上");
		 	return  false;
		 }
	}

}

function  islogin(){

	var  s;
	if(document.login.username.value=='')
	{
		alert("用户名不能为空");
		return  false;
	}else{
        s=document.login.username.value.length;
        if(s<5 ||s>20)
        {
        	alert("用户名长度在5-20之间");
        	return  false;
        }
	}
	if (document.login.password.value=='') 
	{
		alert("密码不能为空");
		return false;
	}else
		
	{  s=document.login.password.value.length;
		if(s<6 ||s>20)
		{
			alert("密码在6-20个字符之间");
			return  false;
		}
	}

	return  true;
}


</script>
</head>
 
 
<body>
    
<div id="main">
	<div id="header">
		<div id="logo"><h2 style="font-weight:bold;font-size:30px;">留言板</h2></div>
		<div id="search">
             <?php

             if($_SESSION['login']=='ok'){
             	echo '登录成功，欢迎回来';
             }else{

             

             ?>
               <form action="login.php" method="post" name="login" onsubmit="return islogin();">
		  		
				用户名<input name="username" size="12" type="text"/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               	  密   码<input name="password" size="12" type="password"/>
                <input type="hidden" value="login"  name="action"/>
                &nbsp;
				<input name="do"  value="登录 " class="button" type="submit"/>
			</form>
			<?php }?>
		
                   
		</div>
	</div>

	<div id="left" >
		<h3>共<?php echo $total?>条留言</h3>

			<?php
				$sql="SELECT * from  sw_message where deleted=0 LIMIT ".($currentpage-1)*$pagesize.",".$pagesize;
				$result=mysql_query($sql);
				while ($row=mysql_fetch_assoc($result)) {
					
			
		  echo '<p class="style0">'.$row['username'].'&nbsp;|&nbsp;'.$row['created'].'</p> <div class="content">'.$row['content'].'</div>';
		  if($row['replay']==1){
           echo '<div class="content" style="font-size:14px;color:red;font-weight:bold;">回复内容：'.$row['recontent'].'</div>';
		  }
		  if($_SESSION['login']=='ok'){
		  	echo '<a href="delete.php?id='.$row['id'].'">删除</a> &nbsp;&nbsp;<a href="edit.php?id='.$row['id'].'">回复</a><br/>';
		  }
		  
		   }
		  for($i=1;$i<=$page;$i++){
		  	    if($i==$currentpage){
		  	    	echo $i.'&nbsp;&nbsp;';
		  	    }else{
		  	    	echo '<a href="?page='.$i.'">'.$i.'</a>&nbsp;&nbsp;';
		  	    }
		  		
		  }
			?>
		<fieldset>
		<legend>发表留言</legend>
		<form action="result.php" method="post" name="frm"  onsubmit="return  test();">
		<table border="0" cellpadding="5" cellspacing="0" width="0">
			<tbody><tr>
				<td width="20%">留言标题</td><td><input name="title" size="30" type="text" /></td>
			</tr>
			<tr>
				<td>用户网名</td><td><input name="username"  value="" size="30" type="text" /></td>
			</tr>
			<tr>
				<td>内容</td><td><textarea name="content" cols="42" rows="5"></textarea></td>
			</tr>
			<tr>
			    <td colspan="2" align="center">
					<input name="action" value="insert" type="hidden"/>
					<input value="提交 " class="button" type="submit"/>
				</td>
			</tr>
		</tbody>
		</table>
		</form>
		</fieldset>

	 

	</div>

	

	<div id="footer">&#169;&nbsp;2011&nbsp;www.houdunwang.com</div>

</div>

</body></html>

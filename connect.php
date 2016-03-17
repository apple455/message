<?php

//连接数据库
mysql_connect('localhost','root','') or die('服务器链接失败') ;
mysql_select_db('message');
mysql_query('set names utf-8');
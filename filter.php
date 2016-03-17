<?php

//封装一个函数，过滤html内容
//封装一个类，过滤特殊符号
class  Filter{

function  magic($s){
    $s=trim($s);
    if (!get_magic_quotes_gpc()){
        $s=addslashes($s);
    }
    
   return  htmlspecialchars($s);
    
    
}

}
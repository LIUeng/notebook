<?php

$r_name=$_POST['r_name'];
$r_email=$_POST['r_email'];
$r_password=$_POST['r_password'];

header("Content-Type: text/html; charset=utf-8");

include ('SqlConn.php');

$sql_conn=new SqlConn();

$sql="insert into u_admin values(seq_u_admin.nextval,'{$r_name}','{$r_email}','{$r_password}','女',SYSDATE)";

$re=$sql_conn->executeDml($sql);

if($re==1){
    header("Location:view/login.blade.php");
}else{
    header("Location:view/login.blade.php");
}
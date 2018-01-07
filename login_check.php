<?php

header("Content-Type: text/html; charset=utf-8");

include ('SqlConn.php');

session_start();

$email=$_POST['u_email'];
$pass=$_POST['u_password'];

$sql_conn=new SqlConn();

$sql="select user_name,user_email,user_password from u_admin where USER_ID=2";

$rows=$sql_conn->executeSql($sql);

$u=$rows[0]['USER_NAME'];
$_SESSION['user_name']=$u;

$e=$rows[0]['USER_EMAIL'];
$p=$rows[0]['USER_PASSWORD'];

if($e==$email&&$p==$pass){
    header("Location:view/index.blade.php");
}else{
    header("Location:view/login.blade.php");
}




<?php


header("Content-Type: text/html; charset=utf-8");

include ('SqlConn.php');

$name=$_GET['user_name'];

$sql_conn=new SqlConn();

$sql="select * from u_admin where user_name='{$name}'";

$rows=$sql_conn->executeSql($sql);

echo json_encode($rows);

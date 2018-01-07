<?php


header("Content-Type: text/html; charset=utf-8");

include ('SqlConn.php');

$id=$_GET['id'];

$sql_conn=new SqlConn();

$sql="delete from u_admin where user_id={$id}";

$str=$sql_conn->executeDml($sql);

echo json_encode($str);


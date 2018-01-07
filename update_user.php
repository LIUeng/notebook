<?php


header("Content-Type: text/html; charset=utf-8");

include ('SqlConn.php');

$id=$_POST['id'];

$hello=$_POST['hello'];

$sql_conn=new SqlConn();

$sql="update u_admin set user_email='{$hello}',create_time=SYSDATE  where user_id={$id}";

$str=$sql_conn->executeDml($sql);

echo json_encode($str);

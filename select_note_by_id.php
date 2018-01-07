<?php


header("Content-Type: text/html; charset=utf-8");

include ('SqlConn.php');

$id=$_GET['id'];

$sql_conn=new SqlConn();

$sql="select * from u_notebook where notebook_id={$id}";

$rows=$sql_conn->executeSql($sql);

echo json_encode($rows);

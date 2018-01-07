<?php

header("Content-Type: text/html; charset=utf-8");

include ('SqlConn.php');

$sql_conn=new SqlConn();

$sql="select * from u_admin";

$sql1="select * from notice";

$sql2="select * from u_notebook";


$rows=$sql_conn->executeSql($sql);
$rows1=$sql_conn->executeSql($sql1);
$rows2=$sql_conn->executeSql($sql2);

$res=array('u'=>$rows,'n'=>$rows1,'t'=>$rows2);

echo json_encode($res);





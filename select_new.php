<?php

header("Content-Type: text/html; charset=utf-8");

include ('SqlConn.php');

$sql_conn=new SqlConn();

$sql="select title,text from notice order by create_time desc";

$rows=$sql_conn->executeSql($sql);

$res=array($rows);

echo json_encode($res);





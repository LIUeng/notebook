<?php


header("Content-Type: text/html; charset=utf-8");

include ('SqlConn.php');

$title=$_POST['title'];

$text=$_POST['text'];

$sql_conn=new SqlConn();

$sql="insert into notice values(seq_notice.nextval,'{$title}','{$text}',SYSDATE)";

$str=$sql_conn->executeDml($sql);

echo json_encode($str);

<?php


header("Content-Type: text/html; charset=utf-8");

include ('SqlConn.php');

$id=$_POST['id'];

$title=$_POST['title'];
$text=$_POST['text'];

$sql_conn=new SqlConn();

$sql="update u_notebook set n_title='{$title}',n_text='{$text}',create_time=SYSDATE where notebook_id={$id}";

$str=$sql_conn->executeDml($sql);

echo json_encode($str);

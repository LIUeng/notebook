<?php

/**
 * Created by PhpStorm.
 * User: 刘远栋
 * Date: 2018/1/2
 * Time: 10:35
 */

header("Content-Type: text/html; charset=utf-8");

class SqlConn
{
    public $conn;
    public $user="c##scott";
    public $pass="scott";
    public $db="";
    public $encode='utf8';

    public function __construct(){
        $this->conn=oci_connect($this->user,$this->pass,$this->db,$this->encode,OCI_DEFAULT);
        if(!$this->conn){
            die("连接失败".oci_error());
        }
    }

    public function executeSql($sql,$fetch_type=OCI_ASSOC){
        $rows=array();
        $stmt=oci_parse($this->conn,$sql);
        oci_execute($stmt);
        while($res=oci_fetch_array($stmt,$fetch_type)){
            $rows[]=$res;
        }
        return $rows;
    }

    public function executeDml($sql){
        $stmt=oci_parse($this->conn,$sql);
        if(oci_execute($stmt)){
            return 1;
        }else{
            return 0;
        }
    }

    public function updateDml($sql){
        $stmt=oci_parse($this->conn,$sql);
        if(oci_execute($stmt)){
            return 1;
        }else{
            return 0;
        }
    }

    public function close_conn(){
        if(!empty($this->conn)){
            oci_close($this->conn);
        }
    }
}
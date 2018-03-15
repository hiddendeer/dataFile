<?php
/**
 *
 * @author hiddendeer
 * @连接数据库操作
 * @date 2018-03-08
 */
// header("Content-type:text/html;charset=utf8");

//连接数据库操作
$host = "localhost";
$username = "root";
$password = "chen";
$dbname = "train";
$conn =mysqli_connect($host,$username,$password,$dbname);
if (!$conn) {
    echo "Can't connect to MySQL Server. Errorcode: %s\n". Mysqli_connect_error();
    exit;
}
$conn->query("SET NAMES 'utf8'");

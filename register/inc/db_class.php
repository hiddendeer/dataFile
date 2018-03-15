<?php
/**
 *数据库配置
 * @author:hiddendeer
 */

 class db_class
 {
   private $host = "localhost";
   private $username = 'root';
   private $password = 'chen';
   private $dbname = 'train';

   //初始化，构造函数
   function __construct ($host='',$username='',$password='',$dbname='') {
     $this->host = $host;
     $this->username = $username;
     $this->password = $password;
     $this->dbname = $dbname;
   }
   function con_link () {
     $this->con = new mysqli($this->host,$this->username,$this->password,$this->dbname);
     $this->con->query("set names utf8");
   }
   $conn = new mysqli($host,$username,$password,$dbname);
   if (!$conn) {
     echo "Can’t find db\n".Mysqli_connect_error();
     exit;
   }
   $conn->query("SET NAMES 'utf8'");

   public function queryGet ($sql) {
     $result = $conn -> query($sql);
   }

   public function queryRows () {

   }

   public function free ($res) {
     return mysqli_free_result($res);
   }














 }

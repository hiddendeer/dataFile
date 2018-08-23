<?php
/**
 *
 * @author hiddendeer
 * @连接数据库操作
 * @date 2018-03-08
 */
class MysqlClass
{
  //连接数据库
  public $link;
  //初始化构造函数
  public function __construct(){
    $this->conn();
  }
  public function conn(){
    $cfg = require_once(dirname(__DIR__).'/inc/config.php');
    $this->link = new mysqli($cfg['host'],$cfg['user'],$cfg['password'],$cfg['db']);
  }
  public function query($sql){
    return $this->link->query($sql);
  }
  public function getAll($sql){
    $res = $this->query($sql);
    $data = array();
    while ($rows = $res->fetch_assoc()) {
      $data[] = $rows;
    }
     return $data;
  }
  public function getRow($sql){
    $res = $this->query($sql);
    $rows = $res->fetch_assoc();
    return $rows;
  }
}

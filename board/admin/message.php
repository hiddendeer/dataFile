<?php
/**
 * author:hiddendeer
 * date:2018-3-12
 * 反馈信息接口
 */

 //字符集
header("Content-type:text/html;charset=utf8");
//引入DB类
require_once(dirname(__DIR__).'/admin/inc/myclass.php');
require_once(dirname(__DIR__).'/admin/function/function.php');

//初始化
$con = new MysqlClass();

if (isset($_POST)) {
  $email = trim($_POST['email']);
  $content = trim($_POST['content']);
  if (empty($email)||!preg_match('^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.[a-zA-Z0-9]{2,6}$',$email)) {
    call(-1,'注意邮箱格式');
  }


}

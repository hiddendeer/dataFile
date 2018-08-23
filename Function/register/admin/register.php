<?php
/**
 *
 * @author hiddendeer
 * @注册接口
 * @date 2018-03-08
 */
 // echo "成功啦";die();

error_reporting(E_ALL & ~E_NOTICE);

require_once(dirname(__DIR__).'/inc/mysql_class.php');
require_once(dirname(__DIR__).'/function/function.php');

header("Content-type:text/html;charset=utf8");

//实例化DB类
$conn = new MysqlClass();

if (isset($_POST)) {
  //接收表单提交过来的数据
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  $confirm = trim($_POST['confirm']);
  $email = trim($_POST['email']);
  $nickname = trim($_POST['nick']);
  $sex = trim($_POST['sex_name']);
  
  //用户名格式审查
  if (empty($username)||!preg_match('/^[A-Za-z0-9_\x{4e00}-\x{9fa5}]+$/u',$username)){
    call(-1,'注意用户名格式');
  }
  //密码格式审查
  if (empty($password)||!preg_match('/^[a-zA-Z\d_]{6,}$/',$password)) {
    call(-1,'注意密码格式');
  }
  //密码是否一致判断
  if (empty($confirm)||$password != $confirm) {
    call(-1,'密码不一致');
  }
  //邮箱格式审查
  if (empty($email)||!preg_match('/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i',$email)) {
    call(-1,'邮箱格式请注意');
  }

  //查询数据库是否有重复的用户名记录
  $username = addslashes($username);
  $sql1 = "select `username` from `member` where `username`='{$username}' limit 1";
  // $result1 = mysqli_query($conn,$sql1);
  $result1 = $conn->query($sql1);
  if (mysqli_num_rows($result1)==1) {
    call(-1,'用户名已经存在');
  }

  //查询数据库是否有重复的邮箱记录
  $email = addslashes($email);
  $sql2 = "select `username` from `member` where `email`='{$email}' limit 1";
  $result2 = mysqli_query($conn,$sql2);
  $result2 = $conn->query($sql2);
  if (mysqli_num_rows($result2)==1) {
    call(-1,'邮箱已经存在');
  }

  //数据库没有重复则插入数据
  $sql3 = "insert into `member`(`username`,`password`,`email`,`nickname`,`sex`) values('{$username}',
  '{$password}','{$email}','{$nickname}','{$sex}')";
  // $result3 = mysqli_query($conn,$sql3);
  $result3 = $conn->query($sql3);
  // print_r($result);die('debug');
  if ($result3==1) {
     $arr = array(
       'username'=>$username,
       'password'=>$password,
       'eamil'=>$email,
       'nickname'=>$nickname,
       'sex'=>$sex,
     );
     call(0,'success',$arr);

  }else{
    call(-1,"插入失败");
  }
}

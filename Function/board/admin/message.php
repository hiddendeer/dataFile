<?php
/**
* author:hiddendeer
* date:2018-3-12
* 反馈信息接口
*/
require_once(dirname(__DIR__).'/admin/inc/global.php');

ini_set('display_errors', 'off');
error_reporting(0);

date_default_timezone_set("Asia/Shanghai");

set_time_limit(0);

//引入邮箱类
// require_once(dirname(__FILE__).'/phpmail/class.phpmailer.php');
// require_once(dirname(__FILE__).'/phpmail/class.smtp.php');

//字符集
header("Content-type:text/html;charset=utf8");

//引入DB类
// require_once(dirname(__DIR__).'/admin/inc/myclass.php');
// require_once(dirname(__DIR__).'/admin/function/function.php');

//初始化DB类
$con = new MysqlClass();

//获取参数信息
if (isset($_POST)) {
  $email = trim($_POST['email']);
  $contents = trim($_POST['content']);
  $datetime = date("Y-m-d H:i:s");

  //检查邮箱的格式
  if (empty($email)||!preg_match('/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.[a-zA-Z0-9]{2,6}$/',$email)) {
    // echo call(-1,'注意邮箱格式');
    call(-1,'注意邮箱格式');
    // $data = json_decode($data);
    // var_dump($data);
    
  }
}

//获取的email、反馈信息、创建时间记录添加进数据库
$sql = "insert into `message`(`email`,`content`,`created`) values ('$email','$contents','$datetime') ";
$con->query($sql);

//？？？获取影响的行数
$mailto = '249704840@qq.com'; // 收件人
$mailcc = array('wangwei@corp-ci.com','chenyong@corp-ci.com'); // 抄送
$subject = '客户处理问题'; // 标题
$content = "客户邮件:".$email."<br/>"."反馈问题:".$contents."<br/>"."反馈时间:".$datetime;
$attachments = array(
  // './a.txt',
); // 附件，可选
$success = sendEmail($mailto, $mailcc, $subject, $content, $attachments);

// send email 注意{}中的内容是需要你自己手动替换的 自己去163申请个邮箱，使用163的邮箱服务器
function sendEmail($to, $cc = array(), $subject = "", $body = "", $attachments = array()) {
  $mail = new PHPMailer();
  $mail->CharSet = "UTF-8";
  $mail->IsSMTP();
  $mail->SMTPDebug = 1;
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = "ssl";
  $mail->Host = "smtp.163.com";
  $mail->Port = 465;
  $mail->Username = "merozp@163.com";
  $mail->Password = "haifeng123";
  $mail->SetFrom('merozp@163.com', '陈帅');
  $mail->AddReplyTo("merozp@163.com", "陈帅");
  $body = eregi_replace("[\]",'',$body);
  if (is_string($to)) {
    $to = array($to);
  }
  foreach ($to as $v) {
    $mail->AddAddress($v);
  }
  $mail->Subject  = $subject;
  $mail->AltBody  = "{提示}";
  $mail->MsgHTML($body);
  if (sizeof($attachments)) {
    foreach($attachments as $v) {
      $mail->AddAttachment($v);
    }
  }
  if(!$mail->Send()) {
    $success = false;
    echo "\nMailer Error: " . $mail->ErrorInfo . "\n";
  } else {
    $success = true;
  }
  $mail->ClearAllRecipients();
  return $success;
}

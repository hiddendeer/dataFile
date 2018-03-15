<?php
/**
 * @abstract php邮件类示例
 */
ini_set('display_errors', 'off');
error_reporting(0);

date_default_timezone_set("Asia/Shanghai");

set_time_limit(0);

include_once(dirname(__FILE__).'/class.phpmailer.php');
include_once(dirname(__FILE__).'/class.smtp.php');

// 示例
$mailto = '908074765@qq.com'; // 收件人
$mailcc = array('wangwei@corp-ci.com','chenyong@corp-ci.com'); // 抄送
$subject = '来自赛诚的一份邮件'; // 标题
$content = '当你打开这封邮件的时候，说明你已经会使用这个方法了'; // 正文，支持html
$attachments = array(
	'./a.txt',
); // 附件，可选
$success = sendEmail($mailto, $mailcc, $subject, $content, $attachments);
if ($success) {
	echo 'ok';
}

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
	$mail->SetFrom('merozp@163.com', '小陈');
	$mail->AddReplyTo("merozp@163.com", "小陈");
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
?>

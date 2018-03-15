<?php
header("Content-Type:text/html;charset=utf8");
$page =$_GET['p'];
$pageSize=5;//每页显示数据的个数
$showPage=5;//在页码区域要显示的个数

require_once(dirname(__DIR__).'/admin/inc/myclass.php');
$con = new MysqlClass();
$sql1 = "SELECT * FROM member LIMIT ".($page-1)*$pageSize .",$pageSize";                   //SQL查询语句
$result = $con->getAll($sql1);
foreach ($result as $v) {
  echo '<li>'.$v['email'].'</li>';
}
?>
<?php
$sql2 = "SELECT COUNT(*) FROM member";
$result2 = $con->getArray($sql2);
$total = $result2[0][0];//总数

//计算页数
$total_pages =ceil($total/$pageSize);

//计算偏移量
$pageoffset=($showPage-1)/2;
for($i=1;$i<=$total_pages;$i++){
  echo '<a href="http://localhost/board/dev/demo.php?page='.$i.'">'.$i.'</a> ';

}
?>

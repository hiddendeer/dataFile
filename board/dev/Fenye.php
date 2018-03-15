<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>layui</title>
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="../font/layui/css/layui.css">
<script src="../font/layui/layui.js"></script>
</head>
<body>

<?php
//以下php代码可封装调用，参数为pageNow


//链接数据库
mysql_connect('localhost','root','chen');
mysql_select_db('train');
mysql_query('set name utf8');

//获取总记录数
$rs = mysql_query('select count(*) from message');
$rows = mysql_fetch_row($rs);
$recordCount = $rows[0];

//每页显示多少条pageSize
$pageSize = 4;

//总页数 = 总记录/每页显示多少
$pageCount=ceil($recordCount/$pageSize);

//获取当前页  三元运算 若不存在pageNow则默认显示第1页
$pageNow = isset($_GET['pageNow'])? $_GET['pageNow']:1;

if ($pageNow < 1) {
    $pageNow = 1;
}elseif ($pageNow > $pageCount) {
    $pageNow = $pageCount;
}

//起始位置  每页从第几条数据显示
$pageStart = ($pageNow-1)*$pageSize;

//从哪条开始显示，限制每页显示几条
$sql = "select * from message order by id desc limit $pageStart,$pageSize";

//链接数据库
$rs = mysql_query($sql);

//以上php代码可封装调用，参数为pageNow  返回查询到的数据$rs

 ?>

 <table class="layui-table">
     <tr>
         <th>ID</th>
         <th>邮箱</th>
         <th>反馈内容</th>
         <th>反馈时间</th>
     </tr>
     <colgroup>
       <col width="150">
       <col width="200">
       <col>
     </colgroup>

<?php
//循环取出数据
// $rows = mysql_fetch_assoc($rs);
// var_dump($rows);die();
while ($rows = mysql_fetch_assoc($rs)) {
echo "
        <tr>
            <td>{$rows['id']}</td>
            <td>{$rows['email']}</td>
            <td>{$rows['content']}</td>
            <td>{$rows['created']}</td>
         </tr>
    ";
}
?>
 <tr>
     <td colspan='4'>
     <?php
         //分页页码  调用js中的showList()方法  此处$i=$pageNow
             for ($i=1; $i <= $pageCount; $i++) {
                 echo "<a href = 'javascript:void(0)' onclick = 'showList($i)'>{$i}</a> &nbsp;";
             }
     ?>
     </td>
 </tr>
 </table>

</body>
</html>

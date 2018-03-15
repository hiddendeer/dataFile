<?php
$host='localhost';
$user='root';
$pwd='chen';
$dbname='train';
$link = mysql_connect($host, $user, $pwd)or die("Could not connect: " . mysql_error());
mysql_select_db($dbname, $link) or die ('Can\'t use test : ' . mysql_error());
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");
//分页设置
$page=$_REQUEST['page']?$_REQUEST['page']:1;
//设置每页显示多好条记录
$page_size=2;
//设置limit偏量
$off=($page-1)*$page_size;
//获取总记录数
$sql_all="select * from member order by id desc";
$all_res=mysql_query($sql_all);
$total_all=mysql_num_rows($all_res);
//计算页面总数，注意键名,当然你也可以使用数字下标
$page_num=ceil($total_all/$page_size);
//读取当前页记录数
$sql_page="select * from member order by id desc limit $off,$page_size";
$page_res=mysql_query($sql_page);

while ($arr=mysql_fetch_array($page_res)){
 $ajax_arr['page_content'].= $arr['id'];
}

for($i=1;$i<=$page_num;$i++){
 if($i==$page){
 $ajax_arr['page_list'].='<a href=?#page='.$i.' onclick="url_go('.$i.')">[<font color=red>'.$i.'</font>]</a>';
 }else{
 $ajax_arr['page_list'].='<a href=?#page='.$i.' onclick="url_go('.$i.')">['.$i.']</a>';
 }
}
//对数组进行json编码，否则ajax无法获取数组形式的返回值
echo json_encode($ajax_arr);

?>

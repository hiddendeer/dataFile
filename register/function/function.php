<?php
/**
 *
 * @author hiddendeer
 * @函数集合
 * @date 2018-03-08
 */

//返回json参数函数方法
function call ($state,$message='',$data=array()) {
   $arr = array(
     'state'=>$state,
     'message'=>$message,
     'data'=>$data,
   );
   echo json_encode($arr);
   exit;
 }

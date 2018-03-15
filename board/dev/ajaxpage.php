<meta charset=’utf-8′>
<script src=”http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js” type=”text/javascript”/></script>
<script type=”text/javascript”>
//获取当前url地址，主要是获取page参数，为了不实现跳转在分页中采用了锚点连接的方式
var url=location.href;
uarr=url.indexOf(‘#’);
npage=url.substr(uarr+6);
if(!npage)npage=1;
jQuery(function(){
 $.ajax({
     type: “POST”,
     url: “ajax.php”,
     dataType:’json’,//由于ajax返回值是数组，所以在php脚本中经过json编码
     data: “page=”+npage,
     success: function(msg){
     $(‘#post_result’).html(msg.page_content);
     $(‘#navipage’).html(msg.page_list);
     }
  });
})

function url_go(page){
 $.ajax({
     type: “POST”,
     url: “ajax.php”,
     dataType:’json’,
     data: “page=”+page,
     success: function(msg){
     $(‘#post_result’).html(msg.page_content);
     $(‘#navipage’).html(msg.page_list);
     }
  });

}



</script>

<div id=post_result>
</div>
<div id=navipage>
</div>

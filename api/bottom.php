<?php
include_once "../base.php";

$bottom=find("bottom",1);

//取得表單傳送過來的bottom值
$new=$_POST['bottom'];

//更新資料陣列中bottom欄位的值
$bottom['bottom']=$new;

//利用save()函式將資料陣列寫回資料表
save("bottom",$bottom);

//利用to()函式跳回後台管理頁面
to("../admin.php?do=bottom");

?>
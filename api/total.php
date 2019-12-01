<?php
include_once "../base.php";

$total=find("total",1);

//取得表單傳送過來的total值
$new=$_POST['total'];

//更新資料陣列中total欄位的值
$total['total']=$new;

//更新session中的進站人數值
$_SESSION['total']=$new;

//利用save()函式將資料陣列寫回資料表
save("total",$total);

//利用to()函式跳回後台管理頁面
to("../admin.php?do=total");

?>
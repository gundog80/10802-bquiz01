<?php
include_once "../base.php";

//清除session來達到登出的效果
unset($_SESSION['login']);

//依據題目要求登出後前往管理登入頁
to("../index.php?do=login");
?>
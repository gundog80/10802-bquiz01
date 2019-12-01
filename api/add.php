<?php
include_once "../base.php";

//取得要編輯資料的資料表名稱
$table=$_POST['table'];

//判斷是否有成功上傳檔案，進行取得檔名及搬移檔案的動作
if(!empty($_FILES['file']['tmp_name'])){
    $data['file']=$_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'],"../img/".$data['file']);
}

//判斷是否有傳遞text欄位的資料，有的話就進行資料的取得
if(!empty($_POST['text'])){
    $data['text']=$_POST['text'];
}

  //利用save()函式將存在$data陣列中的資料寫入資料表中
  save($table,$data);  

to("../admin.php?do=$table");

?>
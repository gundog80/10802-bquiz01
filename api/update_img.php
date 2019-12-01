<?php
include_once "../base.php";

//取得要編輯資料的資料表名稱
$table=$_POST['table'];

//取得要編輯的資料id及資料內容
$id=$_POST['id'];
$data=find($table,$id);

//判斷是否有檔案上傳成功，進行檔案搬移及更新資料內容
if(!empty($_FILES['file']['tmp_name'])){
    $data['file']=$_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'],"../img/".$data['file']);

    //利用save()函式寫入資料表
    save($table,$data);
}

//返回功能頁面
to("../admin.php?do=$table");
?>
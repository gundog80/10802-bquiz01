<?php
include_once "../base.php";

//取得要編輯資料的資料表名稱
$table=$_POST['table'];

//利用迴圈來判斷資料要刪除還是更新內容
foreach($_POST['id'] as $key => $id){
    if(!empty($_POST['del']) && in_array($id,$_POST['del'])){
        del($table,$id);
    }else{

        //先取出該筆資料
        $data=find($table,$id);

        //將欄位內容更新成表單傳遞過來的內容
        $data['text']=$_POST['text'][$key];
        $data['sh']=($id==$_POST['sh'])?1:0;

        //利用save()函式將該筆資料寫回資料表
        save($table,$data);
    }
}

//返回功能頁面
to("../admin.php?do=$table");

?>
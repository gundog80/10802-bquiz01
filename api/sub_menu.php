<?php
include_once "../base.php";

//取得資料表名稱
$table=$_POST['table'];

//取得主選單id
$parent=$_POST['parent'];

//處理編輯資料
if(!empty($_POST['id'])){

    //利用迴圈處理每一筆資料
    foreach($_POST['id'] as $key => $id){
        if(!empty($_POST['del']) && in_array($id,$_POST['del'])){
            del($table,$id);
        }else{
            //先取出該筆資料
            $data=find($table,$id);

            //依照表單傳遞過來的資料進行更新
            $data['text']=$_POST['text'][$key];
            $data['href']=$_POST['href'][$key];

            //利用save()函式將資料寫回資料表
            save($table,$data);
        }
    }
}

//處理新增資料
if(!empty($_POST['text2'])){

    //利用迴圈處理每一筆新增的資料
    foreach($_POST['text2'] as $key => $text){

        //先判斷該筆資料是否有值，如果是空值則不做新增
        if(!empty($text)){

            //將表單傳送過來的資料先存入一個陣列
            $add['text']=$text;
            $add['href']=$_POST['href2'][$key];

            //記得要將主選單的id也寫入
            $add['parent']=$parent;

            //利用save()函式將資料寫入資料表
            save($table,$add);
        }
    }
}

to("../admin.php?do=$table");
?>
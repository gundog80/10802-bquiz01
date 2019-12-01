  <?php

    //判斷是否需要做帳密檢查
    if(!empty($_POST['check'])){
        $acc=$_POST['acc'];
        $pw=$_POST['pw'];

        //利用nums()函式來檢查帳密是否正確
        $chk=nums("admin",["acc"=>$acc,"pw"=>$pw]);
        if($chk>=1){
          
          //帳密正確則建立一個session來紀錄
          $_SESSION['login']=$acc;

          //帳密正確則導向後台admin.php
          to("admin.php");

        }else{

          //帳密錯誤則輸入js語法，用以產生提示訊息
          echo "<script>alert('帳號或密碼錯誤')</script>";
        }
    }
  ?>
  
  <div class="di"  style="height:540px; border:#999 1px solid; width:53.2%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
  <?php include "marquee.php";?>
    <div style="height:32px; display:block;"></div>
    <!--正中央-->
    <!--刪除target="back"，ps欄位改成pw以符合資料表的欄位名-->
    <form method="post" action="?do=login">
      <p class="t botli">管理員登入區</p>
      <p class="cent">帳號 ： <input name="acc" autofocus="" type="text"></p>
      <p class="cent">密碼 ： <input name="pw" type="password"></p>
      <p class="cent">
        <!--在submit中加上name欄位做為表單送出的識別值-->
        <input value="送出" name="check" type="submit">
        <input type="reset" value="清除">
      </p>
    </form>
  </div>
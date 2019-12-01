<div class="di"
  style="height:540px; border:#999 1px solid; width:53.2%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
  <?php include "marquee.php";?>
  <div style="height:32px; display:block;"></div>
  <!--正中央-->

  <div style="width:100%; padding:2px; height:290px;">
    <div id="mwww" loop="true" style="width:100%; height:100%;">
      <div style="width:99%; height:100%; position:relative;" class="cent">沒有資料</div>
    </div>
  </div>
  <!--把動畫的JS搬到動畫的區塊後面-->
  <script>
    var lin = new Array();
        //插入PHP程式碼，將可顯示的動畫檔案名放在陣列中
        lin =[<?php
                $mv=all("mvim",["sh"=>1]);
                foreach($mv as $m){
                  $tmp[]=$m['file'];
                }
                
                echo "'" . implode("','",$tmp) . "'";

              ;?>];
    var now = 0;

    //先執行一次ww()函式來讓第一張動畫放在畫面中
    ww();

    //判斷如果lin陣列中有素就執行動畫輪播
    if (lin.length > 1) {

      //設定為三秒後執行ww()函式
      setInterval("ww()", 3000);

      //將now變數改為1
      now = 1;
    }

    function ww() {

      //在#mwww區塊中放入動畫顯示的HTML碼，並將陣列中的檔名依照now的值來取出
      $("#mwww").html("<embed loop=true src='./img/" + lin[now] + "' style='width:99%; height:100%;'></embed>")
      //$("#mwww").attr("src",lin[now])

      //遞增now的值
      now++;

      //如果now的值超過lin陣列的個數，則重設now為0
      if (now >= lin.length)
        now = 0;
    }
  </script>
  <div
    style="width:95%; padding:2px; height:190px; margin-top:10px; padding:5px 10px 5px 10px; border:#0C3 dashed 3px; position:relative;">
    <span class="t botli">最新消息區
    <?php

      //利用nums()函式來計算最新消息筆數
      $chk=nums("news",["sh"=>1]);

      //如果筆數大於5筆，則輸出more的文字連結，直接使用行內樣式來控制<a>的顯示位置
      if($chk>5){
        echo "<a href='index.php?do=news' style='text-decoration:none;float:right;right:10px'>more...</a>";
      }

    ?>
    </span>
    <ul class="ssaa" style="list-style-type:decimal;">
    <?php

      //取出設定為顯示的前五筆資料
      $rows=all("news",["sh"=>1]," limit 5");

      //利用迴圈把資料印出來
      foreach($rows as $r){
        echo "<li>";
        echo mb_substr($r['text'],0,25,"utf8");  //用mb_substr()來截取字串
        
        //另外輸出一個子元素到li下面，將完整的消息內容放在子元素中，這個子元素要設為不顯示
        echo "<div class='all' style='display:none'>".$r['text']."</div>";
        echo "</li>";
      }
    ?>
    </ul>
    <div id="altt"
      style="position: absolute; width: 350px; min-height: 100px; background-color: rgb(255, 255, 204); top: 50px; left: 130px; z-index: 99; display: none; padding: 5px; border: 3px double rgb(255, 153, 0); background-position: initial initial; background-repeat: initial initial;">
    </div>
    <script>
      $(".ssaa li").hover(
        function () {
          $("#altt").html("<pre>" + $(this).children(".all").html() + "</pre>")
          $("#altt").show()
        }
      )
      $(".ssaa li").mouseout(
        function () {
          $("#altt").hide()
        }
      )
    </script>
  </div>
</div>
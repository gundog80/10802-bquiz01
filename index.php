<?php include_once "base.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0040)http://127.0.0.1/test/exercise/collage/? -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>卓越科技大學校園資訊系統</title>
<link href="./css/css.css" rel="stylesheet" type="text/css">
<script src="./js/jquery-1.9.1.min.js"></script>
<script src="./js/js.js"></script>
</head>

<body>
<div id="cover" style="display:none; ">
	<div id="coverr">
    	<a style="position:absolute; right:3px; top:4px; cursor:pointer; z-index:9999;" onclick="cl(&#39;#cover&#39;)">X</a>
        <div id="cvr" style="position:absolute; width:99%; height:100%; margin:auto; z-index:9898;"></div>
    </div>
</div>
<iframe style="display:none;" name="back" id="back"></iframe>
	<div id="main">
  <?php include "header.php"; ?>
            <div id="ms">
             	<div id="lf" style="float:left;">
            		<div id="menuput" class="dbor">
                    <!--主選單放此-->
                    	                            <span class="t botli">主選單區</span>
                                                </div>
                    <div class="dbor" style="margin:3px; width:95%; height:20%; line-height:100px;">
                    	<span class="t">進站總人數 :<?=$_SESSION['total'];?></span>
                    </div>
        		</div>
                <?php

                    //利用網址傳值的方式來取得$_GET['do']的值，這個值代表我們要include進來的檔案
                    $do=(!empty($_GET['do']))?$_GET['do']:"home";

                    //我們將所有要include進來的後台功能檔案都放在 ./admin 目錄下，因此根據GET的值來組合include檔的完整路徑
                    $path="./front/" . $do . ".php";

                    //判斷檔案是否存在來決定是要匯入檔案還是預設匯入title.php
                    if(file_exists($path)){
                      include $path;
                    }else{
                      include "./admin/home.php";
                    }
                       
                ?>

                        	<div class="di di ad" style="height:540px; width:23%; padding:0px; margin-left:22px; float:left; ">
                	<!--右邊-->
					<!--[可不做]依據session的有無來決定要顯示的按鈕文字及行為-->
					<?php

						if(empty($_SESSION['login'])){
					?>
                	<button style="width:100%; margin-left:auto; margin-right:auto; margin-top:2px; height:50px;" onclick="lo(&#39;?do=login&#39;)">管理登入</button>
					<?php
						}else{
					?>
                	<button style="width:100%; margin-left:auto; margin-right:auto; margin-top:2px; height:50px;" onclick="lo(&#39;admin.php&#39;)">返回管理</button>
					<?php
						}
					?>
                	<div style="width:89%; height:480px;" class="dbor">
                    	<span class="t botli">校園映象區</span>
						<!--以下插入圖片及控制按鈕-->
						<!--建立一個div用來放置向上按鈕圖-->
						<div class="cent">
							<img src="./icon/up.jpg" onclick="pp(1)">
						</div>
						<!--將顯示的圖片列表在中間-->
						<?php
							$rows=all("image",["sh"=>1]);
							foreach($rows as $k => $r){
								echo "<div class='im' id='ssaa$k'>";
								echo "<img src='./img/".$r['file']."'>";
								echo "</div>";
							}

						?>

						<!--建立一個div用來放置向下按鈕圖-->
						<div class="cent">
							<img src="./icon/dn.jpg" onclick="pp(2)">
						</div>
						<script>
							//在num變數中讀出目前可供前台顯示的圖片張數
                        	var nowpage=0,num=<?=nums("image",["sh"=>1]);?>;
							function pp(x)
							{
								var s,t;
								//判斷按下向上按鈕時要進行的動作
								if(x==1&&nowpage-1>=0)
								{
									//將nowpage變數減1
									nowpage--;
								}

								//判斷按下向下按鈕時要進行的動作
								if(x==2&&(nowpage+1)<=num-3)
								{
									//將nowpage變數加1
									nowpage++;
								}

								//先將所有class為im的dom都隱藏
								$(".im").hide()

								//利用迴圈來決定要顯示那三張圖片
								for(s=0;s<=2;s++)
								{
									//計算要顯示的圖片的id值
									t=s*1+nowpage*1;

									//將指定id的dom顯示出來
									$("#ssaa"+t).show()
								}
							}
							//在頁面載入完成時先執行一次向上按鈕，藉此先讓前三張圖片顯示，其它圖片隱藏
							pp(1)
                        </script>
                    </div>
                </div>
                            </div>
             	<div style="clear:both;"></div>
              <?php include "footer.php";?>
    </div>

</body></html>
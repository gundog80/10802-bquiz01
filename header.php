<?php

//取得顯示設定為1的資料
$ti=find("title",["sh"=>1]);

?>
<!--連結中的href要改成index.php，將資料中的text欄位寫入到a標籤的title屬性中-->
<a title="<?=$ti['text'];?>" href="index.php">

    <!--設定背景圖片路徑為./img/，然後將資料中的file欄位寫入到對應的位置去-->
    <div class="ti" style="background:url(&#39;./img/<?=$ti['file'];?>&#39;); background-size:cover;"></div>
    <!--標題-->
</a>
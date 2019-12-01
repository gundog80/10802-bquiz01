<marquee scrolldelay="120" direction="left" style="position:absolute; width:100%; height:40px;">
<?php
//取出所有顯示設為1的資料
$rows=all("ad",["sh"=>1]);

//用迴圈來顯示資料，並在每個字串後加上一些空白做為分隔
foreach($rows as $r){
  echo $r['text'] . "&nbsp;&nbsp;&nbsp;&nbsp;";
}
?>

</marquee>
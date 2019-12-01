<h3 class="cent">編輯次選單</h3>
<hr>
<form action="./api/sub_menu.php" method="post" enctype="multipart/form-data" style="width:60%;margin:auto">
<table  class="cent">
    <tr>
        <td>次選單名稱</td>
        <td>之選單連結網址</td>
        <td>刪除</td>
    </tr>
    <?php
        include_once "../base.php";
        $subs=all($_GET['table'],['parent'=>$_GET['id']]);
        if(!empty($subs)){
            foreach($subs as $s){
    ?>
    <tr>
        <td><input type="text" name="text[]" value="<?=$s['text'];?>"></td>
        <td><input type="text" name="href[]" value="<?=$s['href'];?>"></td>
        <td><input type="checkbox" name="del[]" value="<?=$s['id'];?>"></td>
        <input type="hidden" name="id[]" value="<?=$s['id'];?>">
    </tr>
    <?php
            }
        }
    ?>
    <tr id="lastRow">
        <td colspan="3">
            <input type="hidden" name="table" value="<?=$_GET['table'];?>">
            <input type="hidden" name="parent" value="<?=$_GET['id'];?>">
            <input type="submit" value="修改確定">
            <input type="reset" value="重置">
            <input type="button" value="更多次選單" id="moreSub">
        </td>
    </tr>
</table>
</form>
<script>
//當'更多次選單'按鈕被點擊時
let row=`<tr>
            <td><input type="text" name="text2[]" value=""></td>
            <td><input type="text" name="href2[]" value=""></td>
        </tr>`
$("#moreSub").on("click",function(){
    $("#lastRow").before(row)
})


</script>
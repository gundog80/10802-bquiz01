<h3 class="cent">新增標題區圖片</h3>
<hr>
<form action="./api/add.php" method="post" enctype="multipart/form-data" style="width:60%;margin:auto">
<table>
    <tr>
        <td>標題區圖片：</td>
        <td><input type="file" name="file" id="file"></td>
    </tr>
    <tr>
        <td>標題區替代文字：</td>
        <td><input type="text" name="text" id="text"></td>
    </tr>
    <tr>
        <td>
            <input type="hidden" name="table" value="<?=$_GET['table'];?>">
            <input type="submit" value="新增">
            <input type="reset" value="重置">
        </td>
        <td></td>
    </tr>
</table>
</form>
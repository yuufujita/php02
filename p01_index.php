<?php require'p00_header.php';?>

<!-- Main[Start] -->
<a href="p03_select.php">データ一覧</a>
<form method="post" action="p02_insert.php" enctype="multipart/form-data">
    <div>
        <label>1人旅におすすめな宿泊先：<input type="text" name="stay_nm"></label><br>
        <label>宿泊先URL：<input type="text" name="stay_url"></label><br>
        <label>公共交通機関：<input type="text" name="access"></label><br>
        <label>宿泊先メモ：<textArea name="stay_memo" rows="4" cols="40"></textArea></label><br>
        <label>画像アップロード：<input type="file" name="image"></label><br>
        <input type="submit" value="送信">
    </div>
</form>
<!-- Main[End] -->

<?php require'p99_footer.php';?>

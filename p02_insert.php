<?php require'p00_header.php';?>

<?php

//1. POSTデータ取得
$stay_nm=$_POST['stay_nm'];
$stay_url=$_POST['stay_url'];
$access=$_POST['access'];
$stay_memo=$_POST['stay_memo'];

//2. DB接続
try {
  //ID:'root', Password: xamppは 空白 ''
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

//3. 画像ファイルのアップロード処理
$upload_dir = 'upload/'; // 画像のアップロード先ディレクトリ

// アップロードされたファイルの情報を取得
$uploaded_file = $_FILES['image']['tmp_name'];
$filename = $_FILES['image']['name'];
$file_path = $upload_dir . $filename;

// ファイルを指定のディレクトリに移動
if (move_uploaded_file($uploaded_file, $file_path)) {
  // 移動成功した場合の処理
  echo 'ファイルの保存が成功しました。';
} else {
  // 移動失敗した場合の処理
  echo 'ファイルの保存が失敗しました。';
}

//４．データ登録SQL作成

//(1) SQL文を用意
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(id, stay_nm, stay_url, access, stay_memo, image, date)
 VALUES (NULL, :stay_nm, :stay_url, :access, :stay_memo, :image, sysdate())");

//(2) バインド変数を用意
// Integer 数値の場合 PDO::PARAM_INT
// String文字列の場合 PDO::PARAM_STR

$stmt->bindValue(':stay_nm', $stay_nm, PDO::PARAM_STR);
$stmt->bindValue(':stay_url', $stay_url, PDO::PARAM_STR);
$stmt->bindValue(':access', $access, PDO::PARAM_STR);
$stmt->bindValue(':stay_memo', $stay_memo, PDO::PARAM_STR);
$stmt->bindValue(':image', $file_path, PDO::PARAM_STR);

//５. 実行
$status = $stmt->execute();

//６．データ登録処理後
if($status === false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit('ErrorMessage:'.$error[2]);
}else{

//７．登録が成功した場合の処理、p01_index.phpへリダイレクト
//header('Location:p01_index.php');
echo '<a href="p03_select.php">データ一覧</a>';

}
?>

<?php require'p99_footer.php';?>

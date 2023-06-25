<?php require'p00_header.php';?>

<?php
//funcs.phpを読み込む
require_once('p99_funcs.php');

//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DBConnectError'.$e->getMessage());
}

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if ($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<div id ="post-data">'; //.=にすることで上書きでなく追加される
    $view .= '写真：<br>';
    $view .= '<img src="' . h($result['image']) . '" alt="写真"><br>';
    $view .= '投稿日付：'.h($result['date']).'<br>';
    $view .= '宿泊先：'.h($result['stay_nm']).'<br>';
    $view .= 'URL：<a href="'.h($result['stay_url']).'">'.h($result['stay_url']).'</a><br>';
    $view .= '公共交通機関：'.h($result['access']).'<br>'; 
    $view .= 'メモ：'.h($result['stay_memo']).'<br>'; 
    $view .= '</div>';
  }
}
?>

<!-- Main[Start] -->
<a class="navbar-brand" href="p01_index.php">データ登録</a>
<div id="post-all"><?= $view ?></div>
<!-- Main[End] -->

<?php require'p99_footer.php';?>
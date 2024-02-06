<?php
//0. SESSION開始！！
session_start();

//１．関数群の読み込み
include("funcs.php");//funcs.phpを読み込む（関数群）
sschk(); //ログインしないと見れないようにする

//LOGINチェック → funcs.phpへ関数化しましょう！
//if(!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"]!=session_id()){
//    exit("Login Error");
//}else{
//    session_regenerate_id(true);
//    $_SESSION["chk_ssid"] = session_id();
//}

//２．データ登録SQL作成
$pdo = db_conn();      //DB接続関数
$stmt   = $pdo->prepare("SELECT * FROM gs_bm_table"); //SQLをセット
$status = $stmt->execute(); //SQLを実行→エラーの場合falseを$statusに代入

//３．データ表示
$view=""; //HTML文字列作り、入れる変数
if($status==false) {
  //SQLエラーの場合
  sql_error($stmt);
}else{
  //SQL成功の場合
  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){ //データ取得数分繰り返す
    //以下でリンクの文字列を作成, $r["id"]でidをdetail.phpに渡しています
    $view .= '<a href="detail.php?id='.h($r["id"]).'">';
    $view .= h($r["id"])."|".h($r["bookname"])."|".h($r["url"]);
    $view .= '</a>';

    $view .= '<a href="delete.php?id='.h($r["id"]).'">';
    $view .= '[削除]</a><br>';
  }
}


// MENU表示関数を追加
function displayMenu(){
  $kanri_flg = getUserFlag();

  // include("menu.php"); // 共通のメニュー部分は表示

  if($kanri_flg == 1){ // ユーザー管理フラグが1の場合（管理者）
      // ここに管理者向けのメニューを追加
      echo '<a class="navbar-brand" href="user.php">ユーザー登録</a>';
      echo '<a class="navbar-brand" href="user_select.php">ユーザー表示</a>';
  }
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ブックマーク表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<?php include("menu.php"); ?>

<!-- <header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index01.php">データ登録</a>
      <a class="navbar-brand" href="logout.php">ログアウト</a>
      </div>
    </div>
  </nav>
</header> -->
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
<div class="container jumbotron" id="view"><?=$view?></div>
  </div>
<!-- Main[End] -->

</body>
</html>

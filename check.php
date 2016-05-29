<?php

//1. ログイン情報を受け取り、パスワード照合のSQL文を作成
$u = $_POST['uid'] ;  //ログイン画面より送信されたユーザID、例えば,'k12jk230';
$p = $_POST['upass'];  //ログイン画面より送信されたパスワード、例えば,'ar37';
$sql = "SELECT * FROM tb_user WHERE uid= '{$u}'  AND upass='{$p}'";
//echo $sql ;
//2. データベース検索

  include('db_inc.php');  // データベース接続
//SQL文をサーバーに送信し実行
$rs = mysql_query($sql, $conn);
if (!$rs) {
	die('エラー: ' . mysql_error());
}
//問合せ結果を1行受け取る
$row= mysql_fetch_array($rs);

//ページヘッドを出力。文字コードをUTF-8に指定（文字化け対策）
// echo '<html><head> <meta http-equiv="Content-TYPE" content="text/html; charset=UTF-8"></head><body>';

if ($row){ //問合せ結果がある場合、ログイン成功
	//    echo '<h2>ログイン成功！</h2>';
	//    echo '<h2>ようこそ！'. $row['uname'] . '</h2>';
	session_start();

	$_SESSION['uid']   = $row['uid'];
	//    $_SESSION['uname'] = $row['uname'];
	$_SESSION['urole'] = $row['urole'];
	//$url = 'http://www.is.kyusan-u.ac.jp/'; //転送先のURL
	if($row['urole']==1){
		$url = "customer.php";
	}else{
		$url = "company.php";
	}

	//    $url = 'index.php';//転送先のURL
	header('Location:' . $url); // 画面転送

}else{
	echo '<h2>ログイン失敗！</h2>';
	echo '<h2>ユーザIDもしくはパスワードが間違いました！</h2>';
	echo '<a href="login.html">戻る</a>';
}
echo '</body></html>';
?>
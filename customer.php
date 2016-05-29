<?php
session_start(); 
$urole = isset($_SESSION['urole']) ? $_SESSION['urole'] : -1 ;
if ($urole != 1){
	echo '<h2>この機能は顧客でないと利用できません</h2>';
	echo '<a href="index.php">ホームへ</a>';
	exit();
}
if (isset($_SESSION['uid'])){
	$uid = $_SESSION['uid'];
	$sql = "SELECT * FROM tb_customer WHERE uid='{$uid}'" ;
	//echo $sql;
	include('db_inc.php');  // データベース接続
	//SQL文をサーバーに送信し実行
	$rs = mysql_query($sql, $conn);
	if (!$rs) {
		die('エラー: ' . mysql_error());
	}
	//問合せ結果を1行受け取る
	$row= mysql_fetch_array($rs);
}


?>
<h2>顧客トップ</h2>
<a href="recipes.php?m=1&g=0">人気レシピで探す</a>
<br>
<br><a href="recipes.php?m=2&g=0">目的で探す</a>
<br>
<?php
//<br><a href="search.php">料理検索</a></br>
?>
<br><a href="preparation.php">注文状況確認</a>
<br>

<?php
	if($row){
		echo '<br><a href="customer_edit.php">マイプロフィール編集</a>';
	}else{
		echo '<br><a href="newcustomer.php">マイプロフィール登録</a>';
	}
?>
<br>
<br><a href="logout.php">ログアウト</a>
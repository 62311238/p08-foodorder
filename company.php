<?php
session_start();
if (isset($_SESSION['uid'])){
	$uid = $_SESSION['uid'];
	$sql = "SELECT * FROM tb_company WHERE uid='{$uid}'" ;
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
	<h2>会社トップ</h2>
<a href="order_receive.php">注文受付</a>
<br>
<?php
//<br><a href="order_list.php">注文一覧</a></br>
?>
<br><a href="preparation_edit.php">注文状況一覧・変更</a>
<br>
	<?php
	if($row){
		echo '<br><a href="company_edit.php">マイプロフィール編集</a>';
	}else{
		echo '<br><a href="newcompany.php">マイプロフィール登録</a></br>';
	}
	?>
<br>
<br><a href="logout.php">ログアウト</a>
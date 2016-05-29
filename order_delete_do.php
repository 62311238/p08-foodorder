<?php
include('db_inc.php');  // データベース接続
if (isset($_GET['oid'])){
	$oid = $_GET['oid'];
	$sql = "SELECT * FROM tb_order WHERE oid= '{$oid}' ";

	//2. データベース検索


	//SQL文をサーバーに送信し実行

	$rs = mysql_query($sql, $conn);
	if (!$rs) {
		die('エラー: ' . mysql_error());
	}
	//問合せ結果を1行受け取る
	$row= mysql_fetch_array($rs);


	if ($row){
		$oid=$row['oid'];
	}
	$sql = "DELETE FROM tb_order WHERE oid='{$oid}'";


	$rs = mysql_query($sql, $conn);
	$url = "company.php" ;//変更予定
	//echo $sql;
	header('Location:' . $url); // 画面転送
}
?>
<?php
include('db_inc.php');  // データベース接続

if (isset($_GET['oid'])){
  $oid = $_GET['oid'];
	$sql = "SELECT * FROM tb_order WHERE oid= '{$oid}' ";

	//SQL文をサーバーに送信し実行

	$rs = mysql_query($sql, $conn);
	if (!$rs) {
		die('エラー: ' . mysql_error());
	}
	//問合せ結果を1行受け取る
	$row= mysql_fetch_array($rs);



  echo '<h2>本当に削除しますか?</h2>';
  echo '<a href="order_delete_do.php?oid='. $oid . '">削除</a> | ';
  echo '<a href="preparation_edit.php">戻る</a>';
}
?>
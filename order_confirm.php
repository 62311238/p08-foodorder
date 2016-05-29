<?php
session_start();
include_once('db_inc.php');
if (isset($_GET['oid'])){
  $oid = $_GET['oid'];
    // SQL文を発行

	$sql = "SELECT * FROM vw_order where oid='{$oid}'";

$rs = mysql_query($sql, $conn);
	if (!$rs) {
		die('エラー: ' . mysql_error());
	}
	//問合せ結果を1行受け取る
	$row= mysql_fetch_array($rs);
	$oid= $row['oid'];

	echo '<h3>注文内容詳細</h3>';
    echo '<table border=1>';
	echo '<tr><th>料理名</th><th>単価</th><th>数量</th><th>金額</th></tr>';
	$total = 0;
	while ($row) {

		echo '<tr>';
		echo '<td>' . $row['title'] . '</td>';
		echo '<td>' . $row['price'] . '円</td>';
		echo '<td>' . $row['qty'] . '</td>';
		$money = $row['price']*$row['qty'];
		$total += $money;
		echo '<td>' . $money .'円</td>';
		$row = mysql_fetch_array($rs) ;
		echo '</tr>';
	}
	echo '<table>';
	echo '<h4>合計金額:'.$total.'円</h4>';
	echo '<form action="order_receive.php" method="post">';
	echo '<input type="hidden" name="oid" value="' .$oid. '">';
	echo '</table>';
	echo '<input type="submit" value="注文確定">　　';
	echo '<br>';
	echo '<br><a href="company.php">会社トップに戻る</a>　　';
	echo '<a href="order_receive.php">戻る</a>';
	echo '</form>';
}
?>

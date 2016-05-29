<?php

include('db_inc.php');  // データベース接続

if (isset($_GET['oid'])){
  $oid = $_GET['oid'];
    // SQL文を発行
	$sql = "SELECT * FROM vw_order_content WHERE oid= '{$oid}' ";

  echo '<tr><h3>注文情報詳細</h3></tr>';
  //SQL文実行
   $rs = mysql_query($sql, $conn);
   if (!$rs) {

    die ('エラー: ' . mysql_error());
}

$row = mysql_fetch_array($rs) ;

echo '<table border=1>';
echo '<tr><th>料理名</th><th>単価</th><th>数量</th><th>金額</th></tr>';

while ($row) {
	echo '<tr>';
    echo '<td>' . $row['title'] .  '</td>';
    echo '<td>' . $row['price'] .'円'. '</td>';
    echo '<td>' . $row['qty'] .  '</td>';
	$money = $row['price']*$row['qty'];
	$total += $money;
	echo '<td>' . $money .'円</td>';
	echo '</tr>';

	$row = mysql_fetch_array($rs) ;
}
}
	echo '<table>';
	echo '<h4>合計金額:'.$total.'円</h4>';
	echo '<br><a href="customer.php">顧客トップに戻る</a>　　';
	echo '<a href="preparation.php">戻る</a>';
	echo '</table>';
?>
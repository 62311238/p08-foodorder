<?php
session_start();
include_once('db_inc.php');
$uid = $_SESSION['uid'];
$oid = $_GET['oid'];
echo '<h2>注文確認</h2>';
$sql = "select * from vw_order where oid={$oid}";
$rs = mysql_query($sql, $conn);
if (!$rs) {
	die('エラー: ' . mysql_error());
}
//問合せ結果を1行受け取る
$row= mysql_fetch_array($rs);
$odatetime = $row['odatetime'];
$tm = strtotime($odatetime);
$weekday = array( "日", "月", "火", "水", "木", "金", "土" );
$w = date('w',$tm);
$wd = $weekday[$w];
echo date('Y年m月d日',$tm);
echo '('.$wd .')　　';
echo '<td>注文番号:　' . $row['oid'] .'</td>';


echo '<table border=1>';
echo '<tr><th>料理番号</th><th>料理名</th><th>単価</th><th>数量</th><th>金額</th></tr>';
$total = 0;
while ($row) {
	echo '<tr>';
	echo '<td>' . $row['rid'] .'</td>';
	echo '<td>' . $row['title'] .'</td>';
	echo '<td>' . $row['price'] .'円</td>';
	echo '<td>' . $row['qty'] .'</td>';
	$money = $row['price']*$row['qty'];
	$total += $money;
	echo '<td>' . $money .'円</td>';
	$row = mysql_fetch_array($rs) ;
	echo '</tr>';
}
echo '<table>';
echo '<h4>合計金額:'.$total.'円</h4>';
echo '<td>' . $row['oid'] .'</td>';


?>

<br><a href="customer.php">顧客トップに戻る</a>
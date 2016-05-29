<?php
session_start();
include('page_header.php');
include('db_inc.php');  // データベース接続
$urole = $_SESSION['urole'];
if ($urole != 2){
	echo '<h2>この機能は会社でないと利用できません</h2>';
	echo '<a href="login.html">戻る</a>';
	exit();
}
if (isset($_POST['oid'])){
	$oid = $_POST['oid'];
	$sql = "UPDATE tb_order SET sid=2 WHERE sid=1 and oid={$oid}";
	//echo $sql;
	$rs = mysql_query($sql, $conn); //SQL文を実行
}

if (isset($_SESSION['uid'])){
	$uid = $_SESSION['uid'];
	$sql = "SELECT * FROM vw_order_content where sid=1" ;
	//echo $sql;

	//SQL文をサーバーに送信し実行
	$rs = mysql_query($sql, $conn);
	if (!$rs) {
		die('エラー: ' . mysql_error());
	}
	//問合せ結果を1行受け取る
	$row= mysql_fetch_array($rs);
}
echo '<h3>注文受付</h3>';
echo '<table border=1>';
echo '<tr><th>注文番号</th><th>顧客名</th><th>電話番号</th><th>注文日時</th><th>数量</th><th>金額</th><th>備考</th><th>管理</th></tr>';
while ($row) {
	echo '<tr>';
	echo '<td >' . $row['oid'] .'</td>';
	echo '<td>' . $row['cname'] .'</td>';
	echo '<td>' . $row['otel'] .'</td>';
	echo '<td>' . $row['odatetime'] .'</td>';
	echo '<td>' . $row['qty'] .'</td>';
	echo '<td>' . $row['money'] .'円</td>';
	echo '<td>' . $row['omemo'] .'</td>';
	echo '<td><a href="order_confirm.php?oid='.$row['oid'] .'">詳細</a></td>';
	$row = mysql_fetch_array($rs) ;
	echo '</tr>';
}
	echo '<table>';
	echo '<br><a href="company.php">会社トップに戻る</a>';
	echo '</table>';
?>


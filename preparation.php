<?php

session_start();
include_once('db_inc.php');
$uid = $_SESSION['uid'];
$sql = "select * from tb_order where uid='{$uid}' and sid>1";

$rs = mysql_query($sql, $conn);
if (!$rs) {
	die('エラー: ' . mysql_error());
}else{

  echo '<tr><h3>準備状況確認</h3></tr>';

    $sql = "select * from vw_order_content where uid='{$uid}'";


  //SQL文実行
   $rs = mysql_query($sql, $conn);
   if (!$rs) {

    die ('エラー: ' . mysql_error());
}

$row = mysql_fetch_array($rs) ;

echo '<table border=1>';
echo '<tr><th>注文番号</th><th>注文日時</th><th>配達日時</th><th>配達場所</th><th>金額</th><th>備考</th><th>ご注文状況</th><th>注文内容</th>';   //<th colspan=2>管理</th>';

while ($row) {
	echo '<tr>';

	echo '<td>' . $row['oid'] . '</td>';
	echo '<td>' . $row['odatetime'] . '</td>';
	echo '<td>' . $row['ddate'] .'　　'. $row['dtime1'] .'～'. $row['dtime2'].'</td>';
	echo '<td>' . $row['oaddress'] . '</td>';
	echo '<td>' . $row['money'] . '円'. '</td>';
	echo '<td>' . $row['omemo'] . '</td>';
	echo '<td>' . $row['status'] . '</td>';
	echo '<td><a href="preparation_detail.php?oid='.$row['oid'] .'">詳細をみる</a></td>';
	      //<td><a href="order_delete.php?oid='.$row['oid'] .'">削除</a></td>';
	echo '</tr>';

	$row = mysql_fetch_array($rs) ;
}
}
	echo '<table>';
	echo '<br><a href="customer.php">顧客トップに戻る</a>';
	echo '</table>';
?>

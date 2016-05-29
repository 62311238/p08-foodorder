<?php
session_start();

include('db_inc.php');  // データベース接続
if ( !isset($_SESSION['urole']) || $_SESSION['urole']!=2) {
  // もし、ログインしていない, または、ユーザ種別は会社ではない場合
  //エラー表示
  echo 'エラー：この機能を利用する権限がありません';
  exit(); //処理中止
}else { // そうでなければ,準備状況確認

  echo '<a href="company.php">会社トップに戻る</a></td></tr>';
  echo '<tr><h3>注文状況一覧・変更</h3></tr>';

  // SQL文を発行
  $sql = "select * from vw_order_content where sid > 1 ";


  //SQL文実行
   $rs = mysql_query($sql, $conn);
   if (!$rs) {

    die ('エラー: ' . mysql_error());
}

$row = mysql_fetch_array($rs) ;

echo '<table border=1>';
echo '<tr><th>注文番号</th><th>顧客名</th><th>配達日時</th><th>場所</th><th>金額</th><th>備考</th><th>注文状況</th><th colspan=2>管理</th>';

while ($row) {
	echo '<tr>';

	echo '<td>' . $row['oid'] . '</td>';
	echo '<td>' . $row['cname'] . '</td>';
	echo '<td>' . $row['ddate'] .'　　'. $row['dtime1'] .'～'. $row['dtime2'].'</td>';
	echo '<td>' . $row['oaddress'] . '</td>';
	echo '<td>' . $row['money'] . '円</td>';
	echo '<td>' . $row['omemo'] . '</td>';
	echo '<td>' . $row['status'] . '</td>';
	echo '<td><a href="preparation_edit_change.php?oid='.$row['oid'] .'">注文状況更新</a></td>
	     <td><a href="preparation_detail_co.php?oid='.$row['oid'] .'">詳細</a></td>';
	echo '</tr>';

	$row = mysql_fetch_array($rs) ;
}
}
?>
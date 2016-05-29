<?php
session_start();
include_once('db_inc.php');
$uid = $_SESSION['uid'];
if (isset($_POST['confirm'])){
	//echo '<h2>以下の内容で注文を確定しました</h2>';
	$uid = $_POST['uid'];
	$oid = $_POST['oid'];
	$oaddress = $_POST['oaddress'];
	$otel = $_POST['otel'];
	$ddate = $_POST['ddate'];
	$dtime1 = $_POST['dtime1'];
	$dtime2 = $_POST['dtime2'];
	$omemo = $_POST['omemo'];
	/*
	 echo $oaddress . '<br>';
	 echo $otel . '<br>';
	 echo $ddate . '<br>';
	 echo $dtime1 . '<br>';
	 echo $dtime2 . '<br>';
	 echo $omemo . '<br>';
	 */
	$sql = "update tb_order set otel='{$otel}',oaddress='{$oaddress}',ddate='{$ddate}',";
	$sql .="dtime1='{$dtime1}',dtime2='{$dtime2}',omemo='{$omemo}',sid=1 ";
	$sql .= " where uid='{$uid}' and sid=0";
	$rs = mysql_query($sql, $conn);
	if (!$rs) {
		die('エラー: ' . mysql_error());
	}
	$url = "order_detail.php?oid=" . $oid;
	header('Location:'.$url);
}else{
	echo '<h2>注文内容確認</h2>';
	echo '<br>';
	$sql = "select * from vw_cart where uid='{$uid}'";
	$rs = mysql_query($sql, $conn);
	if (!$rs) {
		die('エラー: ' . mysql_error());
	}
	//問合せ結果を1行受け取る
	$row= mysql_fetch_array($rs);
	echo '<table border=1>';
	echo '<tr><th>料理番号</th><th>料理名</th><th>単価</th><th>数量</th><th>金額</th></tr>';
	$total = 0;
	$oid = 0;
	while ($row) {
		echo '<tr>';
		$oid = $row['oid'];
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
	echo '<form action="order.php" method="post">';
	echo '<input type="hidden" name="uid" value="' .$uid. '">';
	echo '<input type="hidden" name="oid" value="' .$oid. '">';
	echo '<input type="hidden" name="confirm" value="yes">';
	echo '<table border=0>';
	echo '<tr><td>住所</td><td><input type="text" name="oaddress"  size=60></td></tr>';
	echo '<tr><td>電話番号</td><td><input type="text" name="otel" value=""></td></tr>';
	echo '<tr><td>希望配達日</td><td><input type="text" name="ddate" value=""></td></tr>';
	echo '<tr><td>希望配達時間帯</td><td><input type="text" name="dtime1" size=10>';
	echo '～<input type="text" name="dtime2"  size=10></td></tr>';
	echo '<tr><td>備考</td><td><textarea name="omemo" rows="4" cols="40"></textarea></td></tr>';
	echo '</table>';
	echo '<br><input type="submit" value="注文確定"></br>';
	echo '</form>';
}
?>
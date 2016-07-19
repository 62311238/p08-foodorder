<?php
session_start();
include_once('db_inc.php');
$uid = $_SESSION['uid'];
$sql = "select * from tb_order where uid='{$uid}' and sid=0";

$rs = mysql_query($sql, $conn);
if (!$rs) {
	die('エラー: ' . mysql_error());
}
//問合せ結果を1行受け取る
$row= mysql_fetch_array($rs);
$cart_id = 0;
if ($row){
	$cart_id = $row['oid'];
}
/*
 echo "<pre>";
 var_dump($_POST);
 echo "</pre>";
 */




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ショッピングカート</title>


<body>
<br>
<a href="local_search.php">注文を続ける</a>｜
<a href="order.php">レジへ進む</a>

<?php
if(isset($_POST['rid'])){
	$rid = $_POST['rid'];
	$qty = $_POST['qty'];
	if ($cart_id  == 0){
		$sql = "insert into tb_order(uid) values('{$uid}')";
		$rs = mysql_query($sql, $conn);
		$cart_id = mysql_insert_id();
	}
	if ($cart_id > 0){
		if (isset($_POST['oid'])){//再計算
			$oid =  $_POST['oid'];
			$sql = "delete from tb_order_detail where oid={$oid} and rid='{$rid}'";
			$rs = mysql_query($sql, $conn);
		}
		if ($qty > 0){
			$sql ='insert into tb_order_detail(oid,rid,qty) values';
			$sql .= "(" .$cart_id .",'". $rid . "',".$qty.")";
			$rs = mysql_query($sql, $conn);
			if (!$rs) {
				die('エラー: ' . mysql_error());
			}
		}
		//登録完了
		echo '<h2>現在のショッピングカートの内容</h2>';
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
		while ($row) {
			echo '<tr>';
			echo '<td>' . $row['rid'] .'</td>';
			echo '<td>' . $row['title'] .'</td>';
			echo '<td>' . $row['price'] .'円</td>';
			echo '<td>' ;
			echo '<form action="cart.php" method="post">';
			echo '<input type="hidden" name="rid" value="' .$row['rid']. '">';
			echo '<input type="hidden" name="oid" value="' .$row['oid']. '">';
			echo changeQty(0,15, $row['qty']);
			echo '<input type="submit" value="再計算">';
			echo  '</form>';
			echo '</td>';
			$money = $row['price']*$row['qty'];
			$total += $money;
			echo '<td>' . $money .'円</td>';
			$row = mysql_fetch_array($rs) ;
			echo '</tr>';
		}
		echo '<table>';
		echo '<h4>合計金額:'.$total.'円</h4>';
	}
}

function changeQty($from, $to, $sel){
	$options = '<select name="qty">';
	for ($i=$from; $i<=$to; $i++){
		if ($i==$sel){
			$options .= '<option value="'. $i .'" selected>' . $i ;
		}else{
			$options .= '<option value="'. $i .'">' . $i ;
		}
	}
	return $options . '</select>';
}
?>

<a href="local_search.php">注文を続ける</a>｜
<a href="order.php">レジへ進む</a>
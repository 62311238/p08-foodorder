<?php
session_start();
if (isset($_SESSION['uid'])){
	$uid = $_SESSION['uid'];
}

if (isset($_POST['order'])){
	$order = $_POST['order'];

	$sid = $_POST['sid'];
	$osplace = $_POST['osplace'];
	$osdate = $_POST['osdate'];
	$ostime1 = $_POST['ostime1'];
	$ostime2 = $_POST['ostime2'];
	$oscontent = $_POST['oscontent'];



//	print_r($order);

	$sql = "INSERT INTO tb_order(oid,uid,odate,otime1,otime2,oplace,oprice,oscontent) VALUES ('{$uid}',{$sid},'{$osplace}','{$osdate}','{$ostime1}','{$ostime2}','{$oscontent}')";
	include('db_inc.php');  // データベース接続
	$rs = mysql_query($sql, $conn); //SQL文を実行

	$osid = mysql_insert_id($conn);
	// $order : array(2, 5, 10) => insert into tb_order_menu(osid,mid) values (1, 2),(1,5),(1,10)

	$sql='insert into tb_order_menu(osid,mid) values ';

	$values ='';
	$i = 0;
	foreach($order as $mid){
		if ($i > 0){
			$values .=',';
		}
		$values .= '(' . $osid . ',' . $mid. ')';
		$i++;
	}

	$sql .= $values;
	//echo $sql;

	$rs = mysql_query($sql, $conn); //SQL文を実行

	$url = "customer.php";

	header('Location:' . $url); // 画面転送

}
?>
<?php
if (isset($_POST['uid'])){
	$u = $_POST['uid'] ;
	$p = $_POST['upass'];
	$c = $_POST['confirm'];
	$r = $_POST['urole'];
	//     $cid  = $_POST[];//送信されたデータ（連想配列$_POST）のcid要素を$cidに代入
	$sql = "REPLACE INTO tb_user(uid,upass,urole) VALUES ('{$u}','{$p}',{$r})";
	include('db_inc.php');  // データベース接続
	$rs = mysql_query($sql, $conn); //SQL文を実行

//	if($u!="" && $p!="" && $m!="" && $c!=""){
		//	echo 'エラー';
		//}else{
/*		if($t==1){
		//	$url = "newcustomer.php";
			$url = "newcustomer.php?uid=" . $u;
		}else if($t==2){
			$url = "newstaff.php?uid=" . $u;
		}else{
			echo 'エラー1';
		}
		header('Location:' . $url); // 画面転送
	}else{
		echo 'エラー2';
	}*/
	    $url = 'login.html';//転送先のURL
	header('Location:' . $url); // 画面転送

}else{
	echo 'すべて入力してください';

}
?>
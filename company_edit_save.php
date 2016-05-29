<?php

if (isset($_POST['uid'])){
	$u = $_POST['uid'];
	$con = $_POST['coname'] ;
	$col = $_POST['coleader'];
	$cot= $_POST['cotel'];
	$coan = $_POST['coaddnum'];
	$coa = $_POST['coaddress'];
	$com = $_POST['comail'];
	if($con!="" && $col!="" &&  $cot!="" && $coan!="" && $coa!="" &&  $com!=""){
		$sql = "update tb_company SET
		coname='{$con}',coleader='{$col}',cotel='{$cot}',coaddnum='{$coan}',coaddress='{$coa}',comail='{$com}' WHERE uid='{$u}'";

		include('db_inc.php');  // データベース接続
		$rs = mysql_query($sql, $conn); //SQL文を実行

		//	echo '<h2>登録成功！</h2>';
		//	echo '<a href="login.html">ログイン画面</a>';
		$url = "company.php";//変更予定
		header('Location:' . $url); // 画面転送
	}else{
		echo 'すべて入力してください';
		echo '<a href = "company_edit.php">戻る</a>';
	}

}
?>
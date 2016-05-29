<?php
if (isset($_POST['uid'])){
	$u = $_POST['uid'];
	$cn = $_POST['cname'] ;
	$cs = $_POST['csex'] ;
	$cb = $_POST['cbirth'];
	$ct = $_POST['ctel'];
	$can = $_POST['caddnum'];
	$ca = $_POST['caddress'];
	$cm = $_POST['cmail'];

	if($cn!="" && $cs!="" &&  $cb!="" && $ct!="" && $can!="" && $ca!="" && $cm!=""){
		$sql = "INSERT INTO tb_customer(uid,cname,csex,cbirth,ctel,caddnum,caddress,cmail)
				VALUES ('{$u}','{$cn}','{$cs}','{$cb}','{$ct}','{$can}','{$ca}','{$cm}')";

		include('db_inc.php');  // データベース接続
		$rs = mysql_query($sql, $conn); //SQL文を実行

		//	echo '<h2>登録成功！</h2>';
		//	echo '<a href="login.html">ログイン画面</a>';
		$url = "customer.php";//変更予定
		header('Location:' . $url); // 画面転送
	}else{
		echo 'すべて入力してください';
		echo '<br>';
		echo '<br><a href = "newcustomer.php">入力画面に戻る</a>';
	}

}
?>
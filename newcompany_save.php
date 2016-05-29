<?php
if (isset($_POST['uid'])){
	$u = $_POST['uid'];
	$con = $_POST['coname'] ;
	$col = $_POST['coleader'] ;
	$cos = $_POST['cosex'];
	$cot = $_POST['cotel'];
	$coan = $_POST['coaddnum'];
	$coa = $_POST['coaddress'];
	$com = $_POST['comail'];

	if($con!=""&& $col!="" &&  $cos!="" && $cot!="" && $coan!="" &&  $coa!="" && $com!=""){
		$sql = "REPLACE INTO tb_company(uid,coname,coleader,cosex,cotel,coaddnum,coaddress,comail)
				VALUES ('{$u}','{$con}','{$col}','{$cos}','{$cot}','{$coan}','{$coa}','{$com}')";
		include('db_inc.php');  // データベース接続
		$rs = mysql_query($sql, $conn); //SQL文を実行

		//	echo '<h2>登録成功！</h2>';
		//	echo '<a href="login.html">ログイン画面</a>';
		$url = "company.php";//変更予定
		header('Location:' . $url); // 画面転送
	}else{
		echo 'すべて入力してください';
		echo '<br>';
		echo '<br><a href = "newcompany.php">入力画面に戻る</a>';
	}

}
?>
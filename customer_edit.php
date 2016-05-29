<?php
session_start();
if (isset($_SESSION['uid'])){
	$uid = $_SESSION['uid'];
}
$sql = "SELECT * FROM tb_customer WHERE uid= '{$uid}' ";

//2. データベース検索

include('db_inc.php');  // データベース接続
//SQL文をサーバーに送信し実行
$rs = mysql_query($sql, $conn);
if (!$rs) {
	die('エラー: ' . mysql_error());
}
//問合せ結果を1行受け取る
$row= mysql_fetch_array($rs);


if ($row){ //問合せ結果がある場合、ログイン成功
	$cname = $row['cname'];
	$cbirth= $row['cbirth'];
	$ctel = $row['ctel'];
	$caddnum = $row['caddnum'];
	$caddress = $row['caddress'];
	$cmail = $row['cmail'];

}
?>
<form action="customer_edit_save.php" method="post">
	<h3>マイプロフィール編集</h3>

	<table>
		<tr>
			<td>氏名</td>
			<td><input type="text" name="cname" value="<?php echo $cname?>" />
			</td>
		</tr>

		<tr>
			<td>生年月日</td>
			<td><input type="text" name="cbirth" value="<?php echo $cbirth?>" />
			</td>
		</tr>

		<tr>
			<td>電話番号</td>
			<td><input type="text" name="ctel" value="<?php echo $ctel?>" />
			</td>
		</tr>

		<tr>
			<td>郵便番号</td>
			<td><input type="text" name="caddnum" value="<?php echo $caddnum?>" />
			</td>
		</tr>

		<tr>
			<td>住所</td>
			<td><input type="text" name="caddress" value="<?php echo $caddress?>" />
			</td>
		</tr>

		<tr>
			<td>メールアドレス</td>
			<td><input type="text" name="cmail" value="<?php echo $cmail?>" />
			</td>
		</tr>

	</table>
	<input type="hidden" name="uid" value="<?php echo $uid; ?>" />
	<input type="submit" value="修正"><input type="reset" value="取消">
<br>
<br><a href="customer.php">顧客トップに戻る</a>
</form>
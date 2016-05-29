<?php
session_start();
if (isset($_SESSION['uid'])){
	$uid = $_SESSION['uid'];
}
$sql = "SELECT * FROM tb_company WHERE uid= '{$uid}' ";

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
	$coname = $row['coname'];
	$coleader= $row['coleader'];
	$cotel = $row['cotel'];
	$coaddnum = $row['coaddnum'];
	$coaddress = $row['coaddress'];
	$comail = $row['comail'];
}
?>
<form action="company_edit_save.php" method="post">
	<h3>マイプロフィール編集</h3>

	<table>
		<tr>
			<td>会社名</td>
			<td><input type="text" name="coname" value="<?php echo $coname?>" />
			</td>
		</tr>

		<tr>
			<td>代表者名</td>
			<td><input type="text" name="coleader" value="<?php echo $coleader?>" />
			</td>
		</tr>

		<tr>
			<td>電話番号</td>
			<td><input type="text" name="cotel" value="<?php echo $cotel?>" />
			</td>
		</tr>

		<tr>
			<td>郵便番号</td>
			<td><input type="text" name="coaddnum" value="<?php echo $coaddnum?>" />
			</td>
		</tr>

		<tr>
			<td>住所</td>
			<td><input type="text" name="coaddress" value="<?php echo $coaddress?>" />
			</td>
		</tr>

		<tr>
			<td>メールアドレス</td>
			<td><input type="text" name="comail" value="<?php echo $comail?>" />
			</td>
		</tr>
	</table>
	<input type="hidden" name="uid" value="<?php echo $uid; ?>" />
	<input type="submit" value="修正"><input type="reset" value="取消">
<br></br>
<br><a href="company.php">会社トップに戻る</a>
</form>
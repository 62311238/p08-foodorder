<?php
session_start();
if (isset($_SESSION['uid'])){
	$uid = $_SESSION['uid'];
}
?>
<form action="newcustomer_save.php" method="post">
	<h3>マイプロフィール登録</h3>

	<table>
		<tr>
			<td>氏名</td>
			<td><input type="text" name="cname" "value="" />
			</td>
		</tr>

		<tr>
			<td>性別</td>
			<td><input type="radio" name="csex" value="1" />男性</td>
			<td><input type="radio" name="csex" value="2" />女性</td>
		</tr>

		<tr>
			<td>生年月日</td>
			<td><input type="text" name="cbirth" "value="" />
			</td>
		</tr>

		<tr>
			<td>電話番号</td>
			<td><input type="text" name="ctel" "value="" />
			</td>
		</tr>

		<tr>
			<td>郵便番号</td>
			<td><input type="text" name="caddnum" "value="" />
			</td>
		</tr>

		<tr>
			<td>住所</td>
			<td><input type="text" name="caddress" "value="" />
			</td>
		</tr>

		<tr>
			<td>メールアドレス</td>
			<td><input type="text" name="cmail" "value=""/></td>
		</tr>
	</table>
<input type="hidden" name="uid" value="<?php echo $uid; ?>" />
<input type="submit" value="登録"><input type="reset" value="取消">
</form>
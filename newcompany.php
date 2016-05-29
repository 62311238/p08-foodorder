<?php
session_start();
include('page_header.php');
if (isset($_SESSION['uid'])){
	$uid = $_SESSION['uid'];
}
?>
<form action="newcompany_save.php" method="post">
	<h3>マイプロフィール登録</h3>

	<table>
		<tr>
			<td>会社名</td>
			<td><input type="text" name="coname" "value="" />
			</td>
		</tr>

		<tr>
			<td>代表者名</td>
			<td><input type="text" name="coleader" "value="" />
			</td>
		</tr>

		<tr>
			<td>性別</td>
			<td><input type="radio" name="cosex" value="1" />男性</td>
			<td><input type="radio" name="cosex" value="2" />女性</td>
		</tr>

		<tr>
			<td>電話番号</td>
			<td><input type="text" name="cotel" "value="" />
			</td>
		</tr>

		<tr>
			<td>郵便番号</td>
			<td><input type="text" name="coaddnum" "value="" />
			</td>
		</tr>

		<tr>
			<td>住所</td>
			<td><input type="text" name="coaddress" "value="" />
			</td>
		</tr>

		<tr>
			<td>メールアドレス</td>
			<td><input type="text" name="comail" "value=""/></td>
		</tr>
	</table>
<input type="hidden" name="uid" value="<?php echo $uid; ?>" />
<input type="submit" value="送信"><input type="reset" value="取消">
	</form>
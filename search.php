<a href="customer.php">顧客トップに戻る</a>
<title>料理検索</title>
<form action="search_result.php" method="post">
<h3>料理検索</h3>
	<table>
		<tr>
			<td>料理名：</td>
			<td><input type="text" name="title" value="" /></td>
		</tr>

		<tr>
			<td>食材：</td>
			<td><input type="text" name="name" value="" /></td>
		</tr>

		<tr>
			<td>カテゴリ：</td>
			<td><input type="text" name="category" value="" /></td>
		</tr>

</table>
<input type="submit" value="検索 "/>
</form>
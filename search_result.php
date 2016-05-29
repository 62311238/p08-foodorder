<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Insert title here</title>
</head>
<body>
<?php
include('db_inc.php');

$title = isset($_POST['title']) ? $_POST['title'] : '';


$sql = "SELECT * FROM recipes WHERE title LIKE '%{$title}%'";

//$sql = "SELECT * FROM recipes WHERE " . $where;
$rs = mysql_query($sql, $conn);
if (!$rs) {
	die('エラー: ' . mysql_error());
}
//問合せ結果を1行受け取る
$row= mysql_fetch_array($rs);

//echo '<h3>野菜のおかず</h3>';
//echo '<form action="cart.php" method="post">';
echo '<table border=1 width=100%>';
echo '<tr><th>料理</th><th>詳細</th><th>選択</th></tr>';

while ($row) {
	$id = $row['id'];
	$image = '<img src="images/' .$id . '.jpg" height="200">';
	echo '<tr>';
	echo '<td>' . $image.'</td>';
	echo '<td >';
	echo '<ul>';
	$items = array('title'=>'料理名','description'=>'説明','serving_for'=>'何人前','advice'=>'コツ・ポイント','price'=>'価格');
	foreach ( $items as $key=>$value){
		echo '<li>'. $value .' : '. $row[$key] . '</li>';
	}
	echo '</ul>';
	echo '</td>';
	echo '<td>';
	echo '<form action="cart.php" method="post">';
	echo '<input type="hidden" name="rid" value="' .$id. '">';
	echo '数量: <select name="qty">';
	for ($i=1; $i<6; $i++){
		echo '<option value="'. $i .'">' . $i ;
	}
	echo '</select><br>';
	echo '<input type="submit" value="カートに入れる">';
	//echo '<td><input type="checkbox" name = "order[]" value="'. $id . '"></td>';
	echo '</form>';
	echo '</td>';
	echo '</tr>';

	$row = mysql_fetch_array($rs) ;

}

echo '<table>';
//echo '<input type="submit" value="カートに入れる">';
//echo '<input type="reset" value="取消">';

//echo '</form>';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
</head>
<body>
<br><a href="customer.php">顧客トップに戻る</a>
<br>

<?php
include('db_inc.php');


$where = '1';
$menu = array(
 1 => '人気レシピ',
 2 => '目的で探す',
);
$m = 1;
if (isset($_GET['m']) and $_GET['m']<3){
	$m = $_GET['m'];
};

$menu_items = array(
 0=>'全て',
 1=>'野菜のおかず',
 2=>'お肉のおかず',
 3=>'魚介のおかず',
 4=>'シチュー・スープ・汁物',
 5=>'麺類',
 6=>'ごはんもの',
 7=>'パン',
 8=>'お菓子',
);

$wheres = array(
 0 => "1",
 1 => "(title LIKE '%菜%' or title LIKE '%サラダ%' or title LIKE '%きんぴら%' or title LIKE '%和え%')",
 2 => "(title LIKE '%肉%')",
 3 => "(title LIKE '%塩焼き' or title LIKE '%煮つけ%' or title LIKE '%魚%' or title LIKE '%フライ%' or title LIKE '%たたき%')",
 4 => "(title LIKE '%汁%' or title LIKE '%スープ%' or title LIKE '%しる%' or title LIKE '%シチュー%' or title LIKE '%お吸い物%')",
 5 => "(title LIKE '%麺%' or title LIKE '%メン%' or title LIKE '%うどん%' or title LIKE '%そば%')",
 6 => "(title LIKE '%ごはん%' or title LIKE '%ご飯%' or title LIKE '%ライス%' or title LIKE '%丼%' or title LIKE '%おかゆ%' or title LIKE '%雑炊%' or title LIKE '%パエリア%')",
 7 => "(title LIKE '%パン%' or title LIKE '%クロワッサン%')",
 8 => "(title LIKE '%クッキー%' or title LIKE '%菓子%' or title LIKE '%ケーキ%' or title LIKE '%ビスケット%' or title LIKE '%マフィン%' or title LIKE '%スコーン%')",

);

if ($m==2){
	$menu_items = array(
	 0=>'全て',
	 1=>'健康',
	 2=>'おつまみ',
	 3=>'パーティー',
	 4=>'おもてなし'
	);
	$wheres = array(
	 0 => "1",
	 1 => "(advice LIKE '%健康%' or advice LIKE '%ダイエット%' or advice LIKE '%菜%')",
	 2 => "(advice LIKE '%おつまみ%' or advice LIKE '%お酒%')",
     3 => "(advice LIKE '%パーティー%'or description LIKE '%パーティー%')",
     4 => "(advice LIKE '%おもてなし%' or description LIKE '%おもてなし%')",
	);

/*if ($m==3){
	$menu_items = array(
	 1=>'料理名',
	 2=>'食材',
	 3=>'カテゴリ',
	);
	$wheres = array(
	 0 => "1",
	 1 => "(advice LIKE '%健康%' or advice LIKE '%ダイエット%' or advice LIKE '%菜%')",
	 2 => "(advice LIKE '%おつまみ%' or advice LIKE '%お酒%')",
     3 => "(advice LIKE '%パーティー%'or description LIKE '%パーティー%')",
	);
*/
}
$g = 1;
if (isset($_GET['g']) and $_GET['g']< count($wheres)){
	$g = $_GET['g'];
}
$where = $wheres [$g];
echo '<h3>' . $menu[$m] . '</h3>';
echo '<h4>';
foreach ($menu_items as $key=>$value){
	if ($g == $key){
		echo $value. ' | ';
	}else{
		echo '<a href="index.php?m='.$m.'&g='.$key.'">'.$value.'</a> | ';
	}
}
echo '</h4>';
$sql = "SELECT * FROM recipes WHERE " . $where;


$rs = mysql_query($sql, $conn);
if (!$rs) {
	die('エラー: ' . mysql_error());
}
//問合せ結果を1行受け取る
$row= mysql_fetch_array($rs);

//echo '<h3>野菜のおかず</h3>';
//echo '<form action="cart.php" method="post">';
echo '<table border=1 width=80%>';
echo '<tr><th>料理</th><th>詳細</th><th>選択</th></tr>';

while ($row) {
	$id = $row['id'];
	$image = '<img src="images/' .$id . '.jpg" height="150">';
	echo '<tr>';
	echo '<td>' . $image.'</td>';
	echo '<td width="50%">';
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
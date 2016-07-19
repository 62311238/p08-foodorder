<?php
include('page_header.php');  //画面出力開始
require_once('db_inc.php');  //データベース接続

$a = 1;
if (isset($_GET['a'])){
	$a=$_GET['a'];
}
$b = 1;
if (isset($_GET['b'])){
	$b=$_GET['b'];
}
$menu1 = array(1=>'食材', 2=>'レシピ');
$c = 0;
if (isset($_GET['c'])){
	$c=$_GET['c'];
}
$menu2 = array('季節', '春', '夏', '秋', '冬');



echo "<h2>食材地域性の絞り込み検索</h2>";
$where = 'WHERE 1'; // 条件なしSQLのWHERE部分を作る
$sql = "SELECT * FROM tb_local " . $where;//検索条件を適用したSQL文を作成

$rs = mysql_query($sql, $conn);
if (!$rs) {
    die ('エラー: ' . mysql_error());
}

$row = mysql_fetch_array($rs) ;

echo '<ul class="list-inline">';
while ($row) {
// echo '<td>' . $row['lid'] . '</td>';
	$class = 'primary';
	if ($a==$row['lid']){
	 	$class='success';
	}
	$id = $row['lid'];
 echo '<li><a class="btn btn-'.$class.'" href="local_search.php?a='.$id. '&b='.$b.'&c='.$c.'">' . $row['lname']. '</a></li>';

 $row = mysql_fetch_array($rs) ;

}
echo '</ul>';


?>
<div class="row">
<div class="col-sm-2">
 <div class="dropdown">
  <button class="btn btn-warning dropdown-toggle btn-block" type="button" data-toggle="dropdown">
  <?=$menu1[$b]?>
  <span class="caret"></span></button>
  <ul class="dropdown-menu">
  <?php
    foreach ($menu1 as $id => $name){
    	echo '<li><a href="local_search.php?a='.$a.'&b='.$id.'&c='.$c.'">' . $name . '</a></li>';
    }

  ?>
  </ul>
</div>
</div>

<div class="col-sm-2">
 <div class="dropdown">
  <button class="btn btn-warning dropdown-toggle btn-block" type="button" data-toggle="dropdown">
   <?=$menu2[$c]?>
  <span class="caret"></span></button>
  <ul class="dropdown-menu">
  <?php
    foreach ($menu2 as $id => $name){
    	echo '<li><a href="local_search.php?a='.$a.'&b='.$b.'&c='.$id.'">' . $name . '</a></li>';
    }
  ?>
  </ul>
</div>
</div>
</div>

<?php

$where = "1";



$sql = "select distinct r.* from recipes r, tb_recipes p, tb_foodstuffs f " . 
    "where r.id=p.rid and p.fid=f.fid and f.lid=" . $a;


$rs = mysql_query($sql, $conn);
if (!$rs) {
  die('エラー: ' . mysql_error());
}
//問合せ結果を1行受け取る
$row= mysql_fetch_array($rs);

//echo '<h3>野菜のおかず</h3>';
//echo '<form action="cart.php" method="post">';
echo '<table class="table table-hover">';
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

include('page_footer.php');  //画面出力終了
?>
<?php
#######################################################################################
##
#  PHPカウンタープログラム(画像版)
#
#  IPアドレスで判定していますので、同一IPアドレスではカウントされませんが、
#  間にほかの人のアクセスがあればカウントします。ユニーク数というよりはセッション数になります。
#　インラインフレームでページに埋め込み、またはphpファイルに直接埋め込むことも可能です。
#  改造や改変は自己責任で行ってください。
#
#  著作権表記等は必要ありません。
#	
#  今のところ特に問題点はありませんが、不具合等がありましたら下記までご連絡ください。
#  MailAddress: info@php-factory.net
#  name: K.Numata
#  HP: http://www.php-factory.net/
##
#######################################################################################
header("Content-Type: text/html;charset=UTF-8");
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name='robots' content='noindex,nofollow'>
<title></title>
<style type="text/css">/*id、classは振ってあります。スタイルシートは自由に編集してください*/
#total,#count{text-align:center;color:#777;font-size:12px;}
#total,.count{font-size:14px;}
.count{color:#36C;vertical-align:middle;}
</style>
</head>
<body>
<?php

$keta = 5; //カウンタの最低桁数　※カウントがこの桁を超えても大丈夫（ちゃんと自動で桁が上がります）
$base_day = date("Y/m/d"); //日付の取得
$remoteAddr = $_SERVER['REMOTE_ADDR']; //IP取得
$filepath = "count.dat";
$fp = fopen($filepath,"r+");
flock ($fp,LOCK_EX);
$line = fgets($fp);
list($reg_day, $total, $today, $yesterday, $reg_remoteAddr) = explode(",", $line);
if ($base_day != $reg_day){
  $yesterday = $today;
  $today = 0;
}
if ($remoteAddr!=$reg_remoteAddr) {
$total++;
$today++;
ftruncate($fp,0);
rewind($fp);
fwrite($fp,"$base_day,$total,$today,$yesterday,$remoteAddr");
fclose($fp);
}
$format = '%0'.$keta.'d';
$total = sprintf($format, $total);
for ($i = 0 ; $i <= 9 ; $i++){
    $num = $i;
    $img_num = '<img src="img/'.$i.'.png" border="0">';
    $total = str_replace($num, $img_num, $total);
    $today = str_replace($num, $img_num, $today);
    $yesterday = str_replace($num, $img_num, $yesterday);
}
echo "<div id=\"total\">";
echo "{$total}";
echo "</div>";
echo "<div id=\"count\">";
echo "本日<span class=\"count\">{$today}</span>\n";
echo "&nbsp;昨日<span class=\"count\">{$yesterday}</span>";
echo "</div>";
?>
</body>
</html>
<?php
  //カウント数が記録してあるファイルを読み書きできるモードで開く
  $fp = fopen('count.dat', 'r+b');

  //カウント数の書き込みが重複しないようにファイルを排他ロックする
  flock($fp, LOCK_EX);

  //ファイルからカウント数を取得する
  $count = fgets($fp);

  //カウント数を1増やす
  $count++;

  //カウント数の分割
  $count_ary = str_split($count);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <h1>アクセスカウンタ</h1>
  <div class="counter-area">
    <!-- ファイルから取得したカウント数を表示する -->
    <ul class="access-count">
      <?php
        //ループ処理によりアクセス数の数字を1つずつli要素に入れていく
        for($i = 0; $i < count($count_ary); $i++) {
          echo '<li>' . $count_ary[$i]  . '</li>';
        }
      ?>
    </ul><!-- /.count -->
  </div><!-- /.counter-area -->
</body>
</html>

<?php
  //ポインターをファイルの先頭に戻す
  rewind($fp);

  //最新のアクセス数をファイルに書き込む
  fwrite($fp, $count);

  //ファイルのロックを解除する
  flock($fp, LOCK_UN);

  //ファイルを閉じる
  fclose($fp);
?>
<?php
  //カウント数が記録してあるファイルを読み書きできるモードで開く
  $fp = fopen('count.dat', 'r+b');

  //ファイルを排他ロックする
  flock($fp, LOCK_EX);

  //ファイルからカウント数を取得する
  $count = fgets($fp);

  //カウント数を1増やす
  $count++;
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>アクセスカウンター</title>
  </head>
  <body>
      <div class="counter-area">
        <!-- ファイルから取得したカウント数を表示する -->
        <span class="access-count">あなたは<?php echo $count;?>番目の訪問者です。</span>
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
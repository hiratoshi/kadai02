<?php
//1.  DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db37;charset=utf8;host=localhost','root','');
//注意：ホストは、サクラに繋いだらそれになる。ルート、そのあとのスペースは指定
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_gsdb_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
            $view .='<tr>';
    $view .= '<td class="text-success" width="20px">'.$result["school_num"].'</td>';
      $view .= '<td width="120px">'.$result["name"].'</td>';

          $view .= '<td width="30px">'.$result["age"].'</td>';
      $view .= '<td width="250px">'.$result["about_work"].'</td>';
      $view .= '<td width="300px">'.$result["info"].'</td>';
          $view .= '<td width="100px">'.$result["presen"].'</td>';
          $view .= '<td width="80px">                  <a href="gsdb_kadai_edit.php?school_num='.$result["school_num"].'">編集</a></td>';
      

      
      $view .='</tr>'; } } ?>

    <!DOCTYPE html>
    <html lang="ja">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DEVコースメンバー情報</title>
        <link rel="stylesheet" href="css/gsdb_kadai_select.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    </head>

    <body id="main">
        <!-- Head[Start] -->
        <header id="header">
            <img src="../img/gs_logo.png" alt="gs" width="200px" height="80px" id="logo">
            <div id="link">
                <a href="gsdb_kadai_index.php">
                    <p id="top1">新規メンバー情報入力</p>
                </a>

            </div>
        </header>


        <!-- Head[End] -->

        <!-- Main[Start] -->
        <div id="table">
            <table class="table table-striped table-bordere table-hover" border="solid 1px" id="tab">
                <div>
                    <?=$view?>

                </div>
            </table>
        </div>

        <!-- Main[End] -->

    </body>

    </html>

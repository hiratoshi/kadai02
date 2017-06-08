<?php
//1.  DB接続します
try {

  $pdo = new PDO('mysql:dbname=gs_db37;charset=utf8;host=localhost','root','');
//注意：ホストは、サクラに繋いだらそれになる。ルート、そのあとのスペースは指定
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

//２．データ登録SQL作成
       $id = $_GET['school_num'];
$stmt = $pdo->prepare("SELECT * FROM gs_gsdb_table WHERE school_num=$id");
$status = $stmt->execute();
//３．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる


}
 
?>

    <!DOCTYPE html>
    <html lang="ja">

    <head>
        <meta charset="UTF-8">
        <title>メンバー情報登録</title>
        <link href="css/gsdb_kadai_index.css" rel="stylesheet">

    </head>

    <body>

        <!-- Head[Start] -->
        <header id="header">
            <img src="../img/gs_logo.png" alt="gs" width="200px" height="80px" id="logo">
            <div id="link">
                <a href="gsdb_kadai_select.php">
                    <p id="top1">登録済メンバー情報</p>
                </a>
                <a href="gsdb_kadai_edit.php">
                    <p id="top2">登録済情報編集</p>
                </a>
            </div>

        </header>
        <!-- Head[End] -->

        <!-- Main[Start] -->
        <form method="post" action="gsdb_kadai_insert.php">
            <div class="touroku">
                <?php 
while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
    
?>

                <span style="background-color:#ccc" class="list" id="list1">学籍番号</span><br>
                <input type="text" name="school_num" class="form" id="f1" value='<?php echo $result["school_num"];?>'><br>

                <span style="background-color:#ccc" class="list">名前</span><br>
                <input type="text" name="name" class="form" id="f2" value='<?php echo $result["name"];?>'><br>
                <span style="background-color:#ccc" class="list">あだ名</span><br><input type="text" name="nickname" class="form" id="f3" value='<?php echo $result["nickname"];?>'><br>
                <span style="background-color:#ccc" class="list">年齢</span><br><input type="text" name="age" class="form" id="f4" value='<?php echo $result["age"];?>'><br>
                <span style="background-color:#ccc" class="list">勤務先情報</span><br><input type="text" name="about_work" class="form" id="f5" value='<?php echo $result["about_work"];?>'><br>
                <span style="background-color:#ccc" class="list">その他情報</span><br>
                <textArea name="info" rows="4" cols="40" class="form" id="f6" value=''><?php echo $result["info"];?></textArea><br>
                <span style="background-color:#ccc" class="list">発表授業</span><br><input type="text" name="presen" class="form" id="f7" value='<?php echo $result["presen"];?>'><br>
                <input type="submit" value="登録" class="button">
                <?php } ?>
            </div>

        </form>
        <!-- Main[End] -->


    </body>

    </html>

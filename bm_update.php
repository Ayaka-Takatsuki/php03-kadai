<?php
//1. POSTデータ取得
$bookname   = $_POST["bookname"];
$url  = $_POST["url"];
$comment = $_POST["comment"];
//$age    = $_POST["age"];   //課題では不要？
$id    = $_POST["id"];   //idを取得

//2. DB接続します
include("funcs.php");  //funcs.phpを読み込む（関数群）
$pdo = db_conn();      //DB接続関数


//３．データ登録SQL作成
//↓データを更新する文法事項。UPDATE。whereは全データが更新されないために必ず必要。
$sql = "UPDATE gs_bm_table SET bookname=:bookname, url=:url, comment=:comment WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':bookname',  $bookname,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', $url,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
//$stmt->bindValue(':age',   $age,    PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment',$comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id',$id,  PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect("select.php");
}

?>
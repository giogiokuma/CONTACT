<?php header("Content-Type:text/html;charset=utf-8") ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>マスコミ三社スペシャルマッチ　</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
　<style type="text/css">
    p.T2{
        font-size:120%;
        color:red;
    }
    a {
        font-size:120%;
        color:#5f8ee4;
        text-decoration: none;
    }
    a:hover {
        color:#2a56a7;
        text-decoration: underline;
    }
  </style>
</head>
<body>
<div class="well text-center">
<h2>マスコミ三社スペシャルマッチチケットプレゼント　</h2>
</div>

<div class="col-xs-12 col-sm-10 col-sm-offset-2">
<div class="form-group">
<?php 
// check [お名前]
if (!empty($_REQUEST['氏名'])) {
    $name = $_REQUEST['氏名'];
} else {
    $name = NULL;
    echo '<p class="error"> 「お名前」必須項目を記入してください。</p>' ;
}
 ?>
</div><!--form-group-->


<div class="form-group">
<?php 
// 年　齢
if (!empty($_REQUEST['年齢'])) {
    $age = $_REQUEST['年齢'];
} else {
    $age = NULL;
    echo '<p class="error">「年齢」必須項目を記入してください。</p> ';
}
 ?>
</div><!--form-group-->

<div class="form-group">
<?php 
// 郵便番号
if (!empty($_REQUEST['郵便番号'])) {
    $postcode = $_REQUEST['郵便番号'];
} else {
    $postcode = NULL;
    echo '<p class="error">「郵便番号」必須項目を記入してください。</p>';
}
 ?>
</div>

<div class="form-group">
<?php 
// 住所
if (!empty($_REQUEST['住所'])) {
  $address = $_REQUEST['住所'];
 }  else {
  $address = NULL;
  echo '<p class="error">「住所」必須項目を記入してください。</p>';
 }
 ?>  
</div>


<div class="form-group">
<?php 
// 電話番号
if (!empty($_REQUEST['電話番号'])) {
  $phone = $_REQUEST['電話番号'];
} else {
  $phone = NULL;
  echo '<p class="error">「電話番号」必須項目を記入してください。</p>';
}
 ?>
</div>


<div class="form-group">
<?php 
// メールアドレス
if (!empty($_REQUEST['メールアドレス'])) {
  $Email = $_REQUEST['メールアドレス'];
} else {
  $Email = NULL;
  echo '<p class="error">「メールアドレス」必須項目を記入してください。</p>';
}
 ?>
</div>

<div class="form-group">
<div class="row">
<div class="col col-xs-12 col-sm-6 col-md-6">
<?php 
// 希望枚数
if (!empty($_REQUEST['希望枚数'])) {
  $num_sheet = $_REQUEST['希望枚数'];
  } else {
  $num_sheet = NULL;
  echo '<p class="error">「希望枚数」必須項目を記入してください。</p>';
  }

if ($name && $age && $postcode && $address && $phone && $Email && $num_sheet) {
  echo '<p class="T2"><strong>' . $name . '</strong>様、<br />お申し込みありがとうございます。</p><br />';
  ini_set("mbstring.internal_encoding", "UTF-8");

  $subject = "ザスパクサツ群馬 VS ジュビロ磐田　メイン自由席チケットプレゼント";
  $to = "ohata@raijin.com";

  $header .= "MIME-Version: 1.0" . "\n";
  $header .= "Content-Type: text/plain; charset=ISO-2022-JP" . "\n";
  $header .= "Content-Transfer-Encoding: 7bit" . "\n";

  $header = 'From: ' . $_POST['メールアドレス'];
  $body = "" . "\n" . PHP_EOL;
  $body .= "「ザスパクサツ群馬 VS ジュビロ磐田チケットプレゼント」フォームから送信：" . "\n" . PHP_EOL;
  $body .= "" . "\n" . PHP_EOL;
  $body .= "お名前：{$_POST['氏名']}" . "\n" . PHP_EOL;
  $body .= "年 齢： {$_POST['年齢']}" . "\n" . PHP_EOL;
  $body .= "郵便番号：{$_POST['郵便番号']}" . "\n" . PHP_EOL;
  $body .= "住所： {$_POST['住所']}" . "\n" . PHP_EOL;
  $body .= "電話番号：{$_POST['電話番号']}" . "\n" . PHP_EOL;
  $body .= "メールアドレス: {$_POST['メールアドレス']}" . "\n" . PHP_EOL;
  $body .= "希望枚数：{$_POST['希望枚数']}" . "\n" . PHP_EOL;
  $body .= "希望者名1: {$_POST['希望者名1']}" . "\n" . PHP_EOL;
  $body .= "希望者名1年齢: {$_POST['希望者名1年齢']}" . "\n" . PHP_EOL;
  $body .= "希望者名2: {$_POST['希望者名2']}" . "\n" . PHP_EOL;
  $body .= "希望者名2年齢: {$_POST['希望者名2年齢']}" . "\n" . PHP_EOL;

  if (mb_send_mail($to,$subject,$body,$header)) {
    echo "&nbsp;&nbsp;&nbsp;「ザスパクサツ群馬 VS ジュビロ磐田チケットプレゼント」応募メールを自動送信しました。";
    echo "当選の発表は、賞品の発送をもってかえさせていただきます。<br /><br />";
    // echo '<div class="text-center"></div>';
  } else {
    "メール失敗しました。";
  }
} else {
  echo '<p class="error">必須項目に記入もれがあります。確認してもう一度送信してください。</p>';
  echo '<div class="text-center"><a href="javascript:history.back();" class="btn btn-primary" role="button">戻る</a> </div>';
}
   ?>
</div>
</div><!--row-->
</div><!--form-group-->

</div>
  
</body>
</html>
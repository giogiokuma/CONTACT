<?php header("Conatct-Type:text/html;charset=utf-8"); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initail-scale=1">
  <title>Test</title>
  <style type="text/css" media="all">
  body {
  background-color:#efefef;
  font-size:100%;
  }
  .logo {
    position:absolute;
    margin-left:105px;
    margin-top:65px;
    background-color:#fff;
    z-index:2;
  }
  .count {
    position:absolute;
    margin-top: 60px;
    margin-left: 100px;
    margin-bottom: 20px;
    padding-top: 40px;
    padding-left: 50px;
    padding-right: 50px;
    padding-bottom: 50px;
    line-height: 150%;
    border:1px solid #900;
    text-align: left;
    width:70%;
    color:#666;
    font-weight:bold;
    background-color: bold;
    z-index:1;
  }
  .errorT1 {
    margin-left:100px;
    margin-top: 100px;
    margin-bottom: 20px;
    padding-top: 50px;
    padding-left: 50px;
    padding-right: 50px;
    padding-bottom: 60px;
    line-height: 150%;
    border:1px solid #999;
    text-align: left;
    width:70%;
    color:#ff0000;
    font-weight:bold;
    background-color:#fff;
  }

  .error {
    color:#ff0000;
  }

  .T2 {
    font-size:120%;
    font-weight:bold;
    color:#ff0000;
  }
  .T3 {
    font-size:120%;
  }
  .T3 a:link, .T3 a:visited {
    font-size:150%;
    color:#333399;
  }
  .back {
    color:#333399;
    font-size:100%;
    text-align: right;
    padding-right:20px;
    padding-bottom: 30px;
    float:right;
  }

  .back a:link, a:visited {
    color:#333399;
    text-decoration: none;
    font-size:100%;
    text-align: right;
    padding-right: 20px;
    padding-bottom: 30px;
  }

  .back a:hover{
    text-decoration: underline;
    color:#70abf9;
  }
  </style>
</head>
<body>
<div data-role="page" id="home">
  
<div data-role="header">
</div><!--// header-->
<div data-role="content">
  <div class="logo"><img src="images/ttl_2.png" width="187" height="89" alt=""></div>
  <div class="count">
    <br />
    <br />
<?php 
if (!empty($_REQUEST['氏名'])) {
  $name = $_REQUEST['氏名'];
} else {
  $name = NULL;
  echo '<p class="error">「お名前」必須項目を記入してください。</p>';
}

// Validate the 「年齢」
if (!empty($_REQUEST['年齢'])) {
  $age = $_REQUEST['年齢'];
} else {
  $age = NULL;
  echo '<p class="error">「年齢」必須項目を記入してください。</p>';
}

// Validate the 「郵便番号」
if (!empty($_REQUEST['郵便番号'])) {
  $postCode = $_REQUEST['郵便番号'];
} else {
  $postCode = NULL;
  echo '<p class="error">「郵便番号」必須項目を記入してください。</p>';
}


// Validate the 「住所」
if (!empty($_REQUEST['住所'])) {
  $address = $_REQUEST['住所'];
} else {
  $address = NULL;
  echo '<p class="error">「住所」必須項目を記入してください。</p>';
}

// Validate the 電話番号
if (!empty($_REQUEST['電話番号'])) {
  $phone = $_REQUEST['電話番号'];
} else {
  $phone = NULL;
  echo '<p class="error">「電話番号」必須項目を記入してください。</p>';
}

// Validate the メールアドレス
if (!empty($_REQUEST['メールアドレス'])) {
  $email = $_REQUEST['メールアドレス'];
  if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email)) {
    echo "";
  } else {
    echo '<p class="error">正しいメールアドレスを記入してください。</p>';
    $email = NULL;
  }
} else {
  $email = NULL;
  echo '<p class="error">「E-mail」必須項目を記入してください。</p>';
}

// Validate the 希望枚数
if (!empty($_REQUEST['希望枚数'])) {
  $num_sheet = $_REQUEST['希望枚数'];
} else {
  $num_sheet = NULL;
  echo '<p class="error">「希望枚数」必須項目を記入してください。</p>';
}

if ($name && $age && $postCode && $address && $phone && $email && $num_sheet) {
  echo '<p class="T2"><strong>' . $name . '</strong>様、<br />お申し込みありがとうございます。</p><br />';
  ini_set("mbstring.internal_encoding", "UTF-8");



// タイトル
$mySbj = "上毛新聞購読申し込みについて";


// 差出人メールアドレス
$myMail = "misa@ohatadesign.com";

// 差出人名 internal_encodingからmbstring.languageで設定した文字コードへ変換
$myName = mb_encode_mimeheader("上毛新聞社");

// 日時取得
ini_set("date.timezone", "Asia/Tokyo");
$datetime = date('Y-n-j H:i:s');


// 本文用　会社名
$myCompanyName = "上毛新聞社";

$message = "\n" . "\n" . PHP_EOL;
$message .= "添付ファイル送信のテストです。\n" . PHP_EOL;

// 添付ファイル
$files = array('img/test.gif');

$mySbj = mb_convert_encoding($mySbj, 'JIS', 'UTF-8');
$message = mb_convert_encoding($message, 'JIS', 'UTF-8');

$mySbj = '=?iso-2022-jp?B?' . base64_encode($mySbj) . '?=';

if (empty($files)) {
  $boundary = null;
} else {
  $boundary = md5(uniqid(rand(), true));
}

// メールボディ

if (empty($files)) {
  $body = $message;
} else {
  $body  = "--$boundary\n";
  $body .= "Content-Type: text/plain; charset=\"iso-2022-jp\"\n";
  $body .= "Content-Transfer-Encoding: 7bit\n";
  $body .= "\n";
  $body .= "$message\n";

  foreach($files as $file) {
    if (!file_exists($file)){
      continue;
    }
   // $info = pathifo($file);
    $content = $mime_content_types[$info['extension']];

    $filename = basename($file);

    $body .= "\n";
    $body .= "--$boundary\n";
    $body .= "Content-Type: $content; name=\"$filename\"\n";
    $body .= "Content-Disposition: attachment; filename=\"$filename\"\n";
    $body .= "Content-Transfer-Encoding: base64\n";
    $body .= "\n";
    $body .= chunk_split(base64_encode(file_get_contents($file))) . "\n";
  }

  $body .= '--' . $boundary . '--';
}

$header = "X-Mailer: PHP5\n";
$header .= "From: $myMail\n";
$header .= "  MIME-Version: 1.0\n";
if (empty($files)){
  $header .= "Content-Type: text/plain; charset=\"iso-2022-jp\"\n";
} else {
  $header .= "Content-Type: nultipart/mixed; boundary=\"$boundary\"\n";
}
$header .= "Content-Transfer-Encoding: 7bit";

if (mail($email, $mySbj, $body, $header)) {
  echo 'メールが送信されました';
} else {
  echo 'メールの送信に失敗しました';
}

} else {
  '<p class="error">必須項目に記入もれがあります。確認してもう一度送信してください。</p>';
}
 ?>

 <br />
<span class="back">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javaScript:history.back();">&raquo;１つ前へ戻る</a></span>
<br /><br /> 
  </div>
</div>
</div>
  
</body>
</html>
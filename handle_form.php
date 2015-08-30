<?php header("Conatct-Type:text/html;charset=utf-8"); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initail-scale=1">
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,700,300">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
  <title>Test</title>
  <style type="text/css" media="all">
  body {
  background-color:#fff;
  font-size:100%;
  font-family: Roboto:300;
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
  <div class="logo"><img src="img/ttl_2.png" width="187" height="89" alt=""></div>
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
  echo '<p><br /></p>';
  echo '<p><br /></p>';
  echo '<p class="T2"><strong>' . $name . '</strong>様、<br />お申し込みありがとうございます。</p><br />';
  echo '<p class="T2">ご記入になったチケットプレゼント応募申し込みは送信されました。当選者の発表は賞品の発送をもって代えさせていただきます。</p>';
  ini_set("mbstring.internal_encoding", "UTF-8");



// タイトル
$mySbj = mb_encode_mimeheader("ザスパクサツ群馬 VS ジュビロ磐田チケットプレゼント申し込み");

$myName = mb_encode_mimeheader($name);

// 宛先メールアドレス
$toMail = "misa@ohatadesign.com";

// 宛先会社名 internal_encodingからmbstring.languageで設定した文字コードへ変換
$toName = mb_encode_mimeheader("上毛新聞社");

// 日時取得
ini_set("date.timezone", "Asia/Tokyo");
$datetime = date('Y-n-j H:i:s');


// 本文用　会社名
$myCompanyName = "上毛新聞社";

$message = "\n" . "\n" . PHP_EOL;
$message .= "添付ファイル送信のテストです。\n" . PHP_EOL;

// 添付ファイル

$cr = "\n";
$data = "項目" . ", " . "データ" . $cr;
$data .= "お名前" . ", " . $name . $cr;
$data .= "年 齢" . ", " . $age . $cr;
$data .= "郵便番号" . ", " . $postCode . $cr;
$data .= "住 所" . ", " . $address . $cr;
$data .= "電話番号" . ", " . $phone . $cr;
$data .= "メールアドレス" . ", " . $email . $cr;
$data .= "希望枚数" . ", " . $num_sheet . $cr;
$data .= "希望者名1" . ", " . $_REQUEST["希望者名1"] . $cr;
$data .= "希望者名1年齢" . ", " . $_REQUEST["希望者名1年齢"] . $cr;
$data .= "希望者名2" . ", " . $_REQUEST["希望者名1"] . $cr;
$data .= "希望者名1年齢" . ", " . $_REQUEST["希望者名1年齢"] . $cr;


$fp = fopen('form_sub.csv', 'a');
fwrite($fp,$data);
fclose($fp);

$attachments[] = Array(
  'data' => $data,
  'name' => 'form_sub',
  'type' => 'application/vnd.ms-excel'
  );

// 文字列
$semi_rand = md5(time());
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

// ヘッダーに添付ファイルを足す
$header = "MIME-Version: 1.0\n".
          "From: {$myName}<{$email}>\n" . 
          "Content-Type: multipart/mixed;\n" .
          " boundary=\"{$mime_boundary}\"";

// マルチパート　上の文字列の上部
 $message = "This is a multi-part message in MIME format.\n\n" .
                      "--{$mime_boundary}\n" .
                      "Content-Type: text/html; charset=\"iso-8859-1\"\n" .
                      "Content-Transfer-Encoding: 7bit\n\n" .
                      $text . "\n\n";
// 変数
foreach($attachments as $attachment) {
  $data = chunk_split(base64_encode($attachment['data']));
  $name = $attachment['name'];
  $type = $attachment['type'];

  $message .= "--{$mime_boundary}\n" .
              "Content-Type: {$type};\n" .
              " name=\"{$name}\"\n" .
              "Content-Transfer-Encoding: base64\n\n" .
              $data . "\n\n" ;
}

$message .= "--{$mime_boundary}--\n";





if (mail($toMail, $mySbj, $message, $header)) {
  echo '';

} else {
  echo 'メール失敗しました';
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
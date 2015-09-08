<?php header("Conatct-Type:text/html;charset=utf-8"); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
<style>
body {
    background-color: #efefef;
    font-size: 100%;
}

.error {
    color:#ff0000;
    font-size:105%;
}
.T2 {
    font-size:120%;
    font-weight: bold;
    color:#ff0000;
}
.T3  {
    font-size:120%;
}

.T3 a:link, .T3 a:visited {
    font-size:150%;
    color:#333399;
}
.back {
    color:#333399;
    font-size:105%;
    text-align: right;
    padding-right: 20px;
    padding-bottom:30px;
    float:right;
}

.back a:link , a:visited {
    color:#333399;
    text-decoration: none;
    font-size:105%;
    text-align: right;
    padding-right: 20px;
    padding-bottom: 30px;
}

.back a:hover {
    text-decoration: underline;
    color:#70abf9;
}
.top_img img{
    float:left;
    width:100%;
    height: auto;
}

</style>
</head>
<body>
<div style="max-width:500px;margin:0 auto;padding:0 5px;">

<div class="top_img">
<img src="img/logo.gif" class="img-responsive" alt="">
</div>

<div class="container">
<div class="row">
<div class="col-xs-12 col-sm-12">
<p>&nbsp;&nbsp;<br /></p>
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
    if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email )) {
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
    echo '<p class="T2">ご記入になったチケットプレゼント応募申し込みは送信されました。当選者の発表は賞品の発送をもって代えさせていただきます。</p>';
    ini_set("mbstring.internal_encoding", "UTF-8");

// タイトル
$mySbj = "ザスパクサツ観戦チケットプレゼント申し込み";


// 氏名
$myName = mb_encode_mimeheader($name);

// 宛先メールアドレス
$toMail = "mhatori@raijin.com";


// 差出人名   internal_encodingからmbstring.languageで設定した文字コードへ変換
$myName = mb_encode_mimeheader($name);


// 日時取得
ini_set("date.timezone", "Asia/Tokyo");
$datetime =  date('Y-n-j H:i:s');

// 本文用 会社名
$myCompanyName = "上毛新聞社";


$body = "\n" . "\n" . PHP_EOL;
$body .= $name . ", " . $age . ", " . $postCode . ", " . $address . ", " . $phone . ", " . $email . ", " . $num_sheet . ", " . $_REQUEST['希望者名1'] . ", " . $_REQUEST['希望者名1年齢'] . ", " . $_REQUEST['希望者名2'] . ", " . $_REQUEST['希望者名2年齢'];

/*$body2 = "\n" . "\n" . PHP_EOL;
$body2 .= $name . "様" . "\n" . PHP_EOL;
$body2 .= "この度は上毛新聞をご購読の申し込みをいただきまして, 誠にありがとうございます。" . "\n" . PHP_EOL;
$body2 .= $myCompanyName . "<" . $myMail . ">" . "\n" . PHP_EOL;
$body2 .= $datetime. "\n" . PHP_EOL;*/

$head .= "MIME-Version: 1.0" . "\n";
$head .= "Content-Type: text/plain; charset=ISO-2022-JP" . "\n";
$head .= "Content-Transfer-Encoding: 7bit" . "\n";

$head = "From: " . $myName . "<" . $email . ">" . "\r\n";


if (mb_send_mail($toMail, $mySbj, $body, $head)) {
    echo "";
} else {
    echo "自働送信メール失敗しました";
}
} else {
    echo '<p class="error">必須項目に記入もれがあります。確認してもう一度送信してください。</p>';
    
}

 ?>

<br />

<span class="back">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javaScript:history.back();">&raquo;１つ前へ戻る</a></span>
<br /><br /> 

</div>
</div>
</div>

</div>
</body>
</html>


<?php 


$to = 'misa@ohatadesign.com';

$from = 'misa@ohatadesign.com';

$subject = '添付ファイルのテスト';

$message = "テストメール。\n";
$message .= "添付ファイル送信のテストです。\n";

$files = array('images/test.gif');

$subject = mb_convert_encoding($subject, 'JIS', 'UTF-8');
$message = mb_convert_encoding($message, 'JIS', 'UTF-8');

$subject = '=?iso-2022-jp?B?' . base64_encode($subject) . '?=';


if (empty($files)) {
  $boundary = null;
} else {
  $boundary = md5(uniqid(rand(), true));
}


if (empty($files)){
  $body = $message;
} else {
  $body = "--$boundary\n";
  $body .= "Content-Type: text/plain; charset=\"iso--2022-jp\"\n";
  $body .= "Content-Transfer-Encoding: 7bit\n";
  $body .= "\n";
  $body .= "$message\n";


foreach($files as $file){
  if (!file_exists($file)) {
    continue;
  }

  $info = pathinfo($file);
  $content = $mime_content_type[$info['extension']];

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
$header .= "From: $from\n";
$header .= "MIME-Version: 1.0\n";
if (empty($files)) {
  $header .= "text/plain: charset=\"iso-2022-jp\"\n";

} else {
  $header .= "Content-Transfer-Encoding: 7bit";

  if (mail($to, $subject, $body, $header))  {
    echo 'メールが送信されました。';

  } else {
    'メールの送信に失敗しました。';
  
}

 ?>


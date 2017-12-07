<?php
require_once 'vendor/autoload.php';

$to = 'shobekhan@yahoo.com';
$subject = 'Email from website';

$message = '
<html>
<head>
    <title></title>
</head>
<body>
<p>Email from website</p>
<table>
    ';

foreach ($_POST as $key => $item) {
    $message .= '<tr><td>' . ucfirst($key) . '</td>';
    if (is_array($item)) {
        $message .= '<td>';
        foreach ($item as $value) {
            $message .= $value;
        }
        $message .= '</td></tr>';
    } else {
        $message .= '<td>' . $item . '</td></tr>';
    }
}

$message .= '
</table>
</body>
</html>';

$transport = new Swift_SendmailTransport('/usr/sbin/sendmail -bs');

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

// Create a message
$messageObj = (new Swift_Message('Email von webseite'))
    ->setFrom($_POST['email'])
    ->setTo([$to])
    ->setBody($message);

$targetDir = "uploads/";
if (isset($_FILES["file1"])) {
    $fileName = basename($_FILES["file1"]["name"]);
    $targetFile = __DIR__ . '/' . $targetDir . $fileName;
    $fileUploadStatus = move_uploaded_file($_FILES["file1"]["tmp_name"], $targetFile);
    //chmod($targetFile, 0777);
    $messageObj->attach(Swift_Attachment::fromPath($targetFile));
}
if (isset($_FILES["file2"])) {
    $fileName = basename($_FILES["file2"]["name"]);
    $targetFile =  __DIR__ . '/' . $targetDir . $fileName;
    $fileUploadStatus = move_uploaded_file($_FILES["file2"]["tmp_name"], $targetFile);
    //chmod($targetFile, 0777);
    $messageObj->attach(Swift_Attachment::fromPath($targetFile));
}

try {
    $result = $mailer->send($messageObj);
    echo 'done';
} catch (Exception $e) {
    echo $e->getMessage();
}

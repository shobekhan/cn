<?php
// Multiple recipients
$to = 'shobekhan@yahoo.com'; // note the comma

// Subject
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
    $message .= '<td>' . $item . '</td></tr>';
}

$message .= '
  </table>
</body>
</html>';

// To send HTML mail, the Content-type header must be set
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=UTF-8';

// Additional headers
$headers[] = 'To: ' . $to;
$headers[] = 'From: ' . $_POST['email'];

// Mail it
mail($to, $subject, $message, implode("\r\n", $headers));

//echo $_FILES["file1"]["name"] . $message;
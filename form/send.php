<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") { http_response_code(403); exit; }

$secret = "YOUR_SECRET_KEY";
$response = $_POST['g-recaptcha-response'];
$verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response");
$captcha_success = json_decode($verify);

if (!$captcha_success->success) { die("Captcha failed."); }

$name = strip_tags($_POST['name']);
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$message = strip_tags($_POST['message']);

if(!$email){ die("Invalid email"); }

$to = "info@godfirstdigital.com";
$subject = "New Ministry Contact Form Message";
$headers = "From: $name <$email>\r\nReply-To: $email";
$body = "Name: $name\nEmail: $email\nMessage:\n$message";

mail($to,$subject,$body,$headers);
echo "Message sent successfully.";
?>

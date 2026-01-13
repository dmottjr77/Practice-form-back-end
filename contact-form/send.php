<?php
// Verify reCAPTCHA v2
$secret = "6LdwTUksAAAAAFClVc3b8TGznuwntRwYxExEAbpG";
$response = $_POST['g-recaptcha-response'];
$verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response");
$captcha_success = json_decode($verify);

if (!$captcha_success->success) { die("Captcha failed."); }

$name = strip_tags($_POST['name']);
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$message = strip_tags($_POST['message']);

if(!$email){ die("Invalid email"); }

$to = "info@godfirstdigital.com";
$bcc = "srfoundation@godfirstdigital.com"; // Add your BCC email here
$subject = "New Solid Rock Foundation Ministry Contact Form Message";
$headers = "From: noreply@godfirstdigital.com\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Bcc: $bcc\r\n";
$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
$body = "Name: $name\nEmail: $email\nMessage:\n$message";

mail($to,$subject,$body,$headers);
echo "Message sent successfully.";
?>

<?php

use App\service\ContactService;
use App\service\MailService;

require_once __DIR__ . '/src/service/ContactService.php';
require_once __DIR__ . '/src/service/MailService.php';
require_once __DIR__ . '/src/service/Helper.php';
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$contact_service = new ContactService();

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$comment = $_POST['comment'];
$send_mail = $_POST['sendMail'] ?? null;

if (isset($firstName) && isset($lastName) && isset($email) && isset($comment)) {

    $reCaptchaToken = $_POST['recaptcha_token'];
    $google_recaptcha_secret_key = $_ENV['GOOGLE_RECAPTCHA_SECRET_KEY'];
    $postArray = array(
        'secret' => $google_recaptcha_secret_key,
        'response' => $reCaptchaToken
    );

    $postJSON = http_build_query($postArray);

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $postJSON);
    $response = curl_exec($curl);
    curl_close($curl);
    $curlResponseArray = json_decode($response, true);

    if ($curlResponseArray["success"] === true && !empty($curlResponseArray["action"]) && $curlResponseArray["score"] >= 0.5) {

        $contact = $contact_service->createContact($firstName, $lastName, $email, $comment, $send_mail);
        session_start();
        if ($contact) {
            if (isset($send_mail)) {
                new MailService($email, $comment);
            }
            $_SESSION['post_message'] = true;
            header('Location: index.php');

        } else {
            echo '<script>alert("Error while sending your message")</script>';
        }
    } else {
        echo '<script>alert("Sorry")</script>';
    }
}


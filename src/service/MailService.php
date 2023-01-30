<?php

namespace App\service;

require_once(__DIR__ . '/../../vendor/autoload.php');

use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;
use Dotenv;

class MailService
{
    public function __construct($to, $comment)
    {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        $transport = Transport::fromDsn('smtp://' . $_ENV['FROM'] . ':' . $_ENV['PASS'] . '@' . $_ENV['SMTP']);
        // Create a Mailer object
        $mailer = new Mailer($transport);
        // Create an Email object
        $email = (new Email());
        // Set the "From address"
        $email->from('contact@jonathan-manes.be');
        // Set the "From address"
        $email->to($to);
        // Set a "subject"
        $email->subject('Hackers Poulette has sent you a mail!');
        // Set the plain-text "Body"
        $email->text($comment);
        // Set HTML "Body"
        $email->html($comment);
        // Add an "Attachment"
        //$email->attachFromPath('/path/to/example.txt');
        // Add an "Image"
        //$email->embed(fopen('/path/to/mailor.jpg', 'r'), 'nature');
        // Send the message
        $mailer->send($email);
    }
}

<?php
namespace App\service;

use App\model\Contact;

class ContactService
{
    public function createContact($firstName, $lastName, $email, $comment, $sendByEmail)
    {
        $firstName = $this->sanitizeInput($firstName);
        $lastName = $this->sanitizeInput($lastName);
        $email = $this->sanitizeInput($email);
        $comment = $this->sanitizeInput($comment);

        if (!$this->validateInput($firstName) || !$this->validateInput($lastName) || !$this->validateEmail($email) || !$this->validateInput($comment)) {
            return false;
        }

        $contact = new Contact($firstName, $lastName, $email, $comment, $sendByEmail);

        return true;
    }

    private function sanitizeInput($input)
    {
        return trim(htmlspecialchars($input));
    }

    private function validateInput($input)
    {
        return !empty($input);
    }

    private function validateEmail($email)
    {
        $regex = '/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/';
        return preg_match($regex, $email);
    }


    private function saveToDatabase($contact)
    {

    }
}

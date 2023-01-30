<?php

namespace App\model;

class Contact
{
    private $firstName;
    private $lastName;
    private $email;
    private $comment;
    private $sendByEmail;

    public function __construct($firstName, $lastName, $email, $comment, $sendByEmail)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->comment = $comment;
        $this->sendByEmail = $sendByEmail;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    public function getSendByEmail()
    {
        return $this->sendByEmail;
    }

    public function setSendByEmail($sendByEmail)
    {
        $this->sendByEmail = $sendByEmail;
    }
}

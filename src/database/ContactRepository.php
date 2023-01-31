<?php

namespace App\database;

use App\model\Contact;
use PDO;

class ContactRepository
{

    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create(Contact $contact)
    {
        $query = 'INSERT INTO hackers_poulette (firstName, lastName, email, comment, sendByEmail) 
                    VALUES (:firstName, :lastName, :email, :comment, :sendByEmail)';
        $stmt = $this->db->prepare($query);
        $firstName = $contact->getFirstName();
        $lastName = $contact->getLastName();
        $email = $contact->getEmail();
        $comment = $contact->getComment();
        $sendByEmail = $contact->getSendByEmail();

        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':comment', $comment);
        $stmt->bindParam(':sendByEmail', $sendByEmail);

        return $stmt->execute();
    }

}
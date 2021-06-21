<?php

namespace App\Services;

use App\Contact;
use App\Connections\DBConnection;
use App\Models\ContactModel;

class ContactService
{
    private $model;
    function __construct(ConnectionInterface $connection) {
        $this->model = new ContactModel($connection);
    }

    public function findByName(String $name): Contact
    {
        $results = $this->model->findByName($name);
        if ($results) {
            return new Contact($results[0]['number'], $results[0]['name']);
        }

        return null;
    }

    public function validateNumber(string $number): bool
    {
        // logic to validate numbers
        return true;
    }
}
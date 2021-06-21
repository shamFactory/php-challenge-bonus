<?php

namespace App\Services;

use App\Contact;
use App\Models\ContactModel;

class ContactService
{
    private $model;
    function __construct($connection) {
        $this->model = new ContactModel($connection);
    }

    public function findByName(String $name): ?Contact
    {
        $results = $this->model->findByName($name);
        if ($results && count($results) > 0) {
            return new Contact($results[0]['mobile'], $results[0]['name']);
        }

        return null;
    }

    public static function validateNumber(string $number): bool
    {
        return (bool) preg_match('/^[0-9]{9}$/', (int) $number);
    }
}
<?php

namespace App\Models;

class ContactModel
{
    protected $db;

	function __construct($db) {
        $this->db = $db;
    }

	public function findByName(String $name)
	{
        // TODO: clean $name

        $this->db->query("SELECT number, name FROM contacts WHERE name = ${name}");
		return $this->db->resultSet();
	}
}
<?php

namespace App\Interfaces;

interface ConnectionInterface
{
	public function query(String $query);
	public function resultSet(): Array;
}
<?php

namespace App\Connections;

use App\Interfaces\ConnectionInterface;

class DBConnection implements ConnectionInterface
{
    public function __construct(){
      // creating connection
    }

    public function query(String $sql){
        // creating query
    }

    public function resultSet(): Array {
        return [];
    }
}
<?php
require_once('../includes/autoloader.php');

class User
{
    public $id;
    public $email;
    public $password;
    public $db;

    public function __construct() {
      $this->db = new DbConnection;
    }
    // function to log user to his intended dashboard
    public function login($email, $password)
    {
        
    }
}
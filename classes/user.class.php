<?php
require_once('./includes/autoloader.php');

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
      // $this->regUser($email, $password);
      $sql = "SELECT id, role FROM adminusers WHERE email = '$email' AND password = '$password'";
      $stmt = $this->db->connect()->query($sql);
      $user = $stmt->fetch();
      $_SESSION['user'] = $user['id'];
      $count = $stmt->rowCount();
      if ($count == 1) {
          if ($user['role'] == 'admin') {
            header("location: dashboard.php");
          }
      } else {
          header('location: index.php');
      }
    }
}
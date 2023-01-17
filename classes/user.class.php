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

    public function regUser($email, $password)
    {
      //regular expression validation
      if (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email)) {
        // $_SESSION['message'] = "Email Address is invalid!!";
        header('location: index.php');
        exit();
      }
      if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $password)) {
        // $_SESSION['message'] = "Password must be at least 8 characters long contains 1 uppercase, 1 lowercase, 1 number and 1 special character!!";
        header('location: index.php');
        exit();
      }
      $sqlMail = "SELECT email FROM adminusers";
      $stmt = $this->db->connect()->query($sqlMail);
      while ($row = $stmt->fetch()) 
      {
        if ($email == $row["email"])
        {
            // $_SESSION['message'] = "Email Already Exists!!";
            header('location: index.php');
            exit();
        }
      }
    }

    // function to log user to his intended dashboard
    public function login($email, $password)
    {
      $this->regUser($email, $password);
      $sql = "SELECT id FROM adminusers WHERE email = '$email' AND password = '$password'";
      $stmt = $this->db->connect()->query($sql);
      $user = mysqli_fetch_assoc($stmt);
      $_SESSION['user'] = $user['id'];
      $count = mysqli_num_rows($stmt);
      if ($count == 1) {
          header("location: dashboard.php");
      } else {
          // $_SESSION['message'] = "Wrong Credentials!!";
          header('location: index.php');
      }
    }
}
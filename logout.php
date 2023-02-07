<?php
// Initializing Session
session_start();

// Free all session variables
session_unset();

// Destroying Session
session_destroy();
header('location: index.php');
?>
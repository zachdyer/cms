<?php 
require("/var/www/zachdyer.com/functions.php");
session_start();

// Logout
if(isset($_GET['logout'])) {
  session_destroy();
}

//HTML output
include_file("/header.php"); 
public_content();
include_file("/footer.php");  

?>
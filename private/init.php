<?php
// Directory Path Constants
define("ROOTPATH", "/var/www/zachdyer.com");
define("DATABASE",    ROOTPATH . "/database");
define("INCLUDES",    ROOTPATH . "/includes");
define("PAGES",       ROOTPATH . "/includes/pages");
define("ADMINPAGES",  ROOTPATH . "/includes/admin/pages");
define("PUBLICPATH",  ROOTPATH . "/public");
define("PRIVATEPATH", ROOTPATH . "/private");
define("UPLOADS",     ROOTPATH . "/public/uploads");
define("CLASSES",     ROOTPATH . "/classes");
define("VIEWS",       ROOTPATH . "/views");
define("CONTROLLERS", ROOTPATH . "/controllers");

//Turn on sessions
session_start();

//If user clicks logout destroy the session
if(isset($_GET['logout'])) {
  session_destroy();
  header("Location: /admin");
}

require(ROOTPATH . "/vendor/autoload.php");
require(PRIVATEPATH . "/functions.php");
require(PRIVATEPATH . "/routes.php");

<?php // Admin Area
require '../../vendor/autoload.php';
require "../../functions.php";
session_start();
//If user clicks logout
if(isset($_GET['logout'])) {
  session_destroy();
  header("Location: /admin");
}
echo render_view("/admin/header.pug", array(
  'company'         => getSettings()->company,
  'email'  => isset($_SESSION['email']) ? $_SESSION['email'] : false
));
admin_content();
echo render_view("/admin/footer.pug", array());

?>
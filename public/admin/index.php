<?php // Admin Area
define("ROOTPATH", "/var/www/zachdyer.com");

require(ROOTPATH . "/init.php");

$pug = new Pug();

echo $pug->render(INCLUDES . "/admin/header.pug", array(
  'company'         => getSettings()->company,
  'email'  => isset($_SESSION['email']) ? $_SESSION['email'] : false
));

echo $pug->render(VIEWS . "/admin/index.pug", array());

echo $pug->render(INCLUDES . "/admin/footer.pug", array());

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= getSettings()->company ?></title>

    <!-- Bootstrap core CSS -->
    <?php if(getData("theme", "settings.json")) : ?>
    <link href="/css/themes/<?= getData("theme", "settings.json")?>" rel="stylesheet">
    <?php else : ?>
    <link href="/css/themes/default.css" rel="stylesheet">
    <?php endif; ?>
    
    <!-- fontawesome -->
    <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/style.css" rel="stylesheet">

  </head>

  <body>
    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg text-mono">
      <div class="container">
        <a class="navbar-brand" href="/">
        <?php if(getSettings()->displaylogo) : ?>
          <img src="/uploads/<?= getSettings()->logofile ?>" alt="<?= getSettings()->company . " logo"?>" />
        <?php else : ?>
          <?= getSettings()->company ?>
        <?php endif; ?>
        </a>
        
        <!--         
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item<?= is_active('products'); ?>">
              <a class="nav-link" href="/?page=products">Products</a>
            </li>
            <li class="nav-item<?= is_active('company'); ?>">
              <a class="nav-link" href="/?page=company">Company</a>
            </li>
            <li class="nav-item<?= is_active('pricing'); ?>">
              <a class="nav-link" href="/?page=pricing">Pricing</a>
            </li>
            <li class="nav-item<?= is_active('support'); ?>">
              <a class="nav-link" href="/?page=support">Support</a>
            </li>
            <li class="nav-item<?= is_active('login'); ?>">
              <a class="nav-link" href="/?page=sign-up&plan=free">Try it free</a>
            </li>
            <li class="nav-item<?= is_active('login'); ?>">
              <a class="nav-link" href="/?page=login">Sign In</a>
            </li>
          </ul>
        </div>
        -->
      </div>
    </nav>
    

    
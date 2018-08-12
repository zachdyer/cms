<?php
$site = new stdClass();
$site->id = isset($_GET['id']) ? $_GET['id'] : uniqid();
$site->subdomain = getData("subdomain", "sites.json");
$site->company = getData("company", "sites.json");
$site->email = getData("email", "sites.json");
$site->password = getData("password", "sites.json");
$site->plan = getData("plan", "sites.json");

?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
      <h1 class="h2"><?= isset($_GET['id']) ? "Update Site" : "New Site" ?></h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
          <a class="btn btn-sm btn-outline-secondary" href="/admin/?page=sites">Back</a>
          <a class="btn btn-sm btn-outline-secondary" href="/admin/?page=sites&delete=<?= $site->id ?>" onclick="return confirm('Are you sure you want to delete this site?');">Delete</a>
        </div>
      </div>
      <?php 
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //Lesson: htmlspecialchars keeps the json from getting screwed up and protects from html injections.
        saveSite($site);
      }
      ?>
  </div>
  <form action="/admin/?page=site&id=<?= $site->id ?>" method="post">
    <div class="form-group row">
      <label for="company" class="col-sm-2 col-form-label">Company</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" placeholder="Site title" name="company" value="<?= $site->company ?>" readonly>
      </div>
    </div>
    <div class="form-group row">
      <label for="subdomain" class="col-sm-2 col-form-label">Subdomain</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" placeholder="Domain" name="subdomain" value="<?= $site->subdomain ?>" readonly>
      </div>
    </div>
    <div class="form-group row">
      <label for="domain" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" placeholder="Email" name="email" value="<?= $site->email ?>" readonly>
      </div>
    </div>
    <div class="form-group row">
      <label for="plan" class="col-sm-2 col-form-label">Plan</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" placeholder="Email" name="plan" value="<?= $site->plan ?>" readonly>
      </div>
    </div>
    <div class="form-group row">
      <label for="domain" class="col-sm-2 col-form-label">Password</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" placeholder="Password" name="password" value="<?= $site->password ?>">
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Save Site</button>
  </form>
</main>
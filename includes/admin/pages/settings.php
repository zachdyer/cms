<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
      <h1 class="h2">Settings</h1>
  </div>
  <?php 
  $settings = new stdClass();
  $settings->dirname = getData('dirname', 'settings.json');
  $settings->company = getData('company', 'settings.json');
  $settings->email  = getData('email', 'settings.json');
  $settings->password  = getData('password', 'settings.json');
  $settings->displaylogo = isset($_POST['displaylogo']) ? getData('displaylogo', 'settings.json') : false;
  $settings->logofile = uploadImage('logofile', 'settings.json');
  $settings->theme = getData('theme', 'settings.json');
  $settings->theme_style = getData('theme_style', 'settings.json');
  
  if($_SERVER['REQUEST_METHOD'] == "POST") {
    if(saveJSON($settings, DATABASE . "/settings.json")) {
      echo alert("success", "Your settings have been successfully saved!");
    } else {
      echo alert("danger", "Something went wrong and your settings could not be saved.");
    }
  }
  ?>
  <form action="/admin/?page=settings" method="post" enctype="multipart/form-data">

   <div class="form-group row">
    <label for="title" class="col-sm-2 col-form-label">Logo Upload</label>
    <div class="col-sm-10">
      <input type="file" name="logofile">
      <?php if(isset($settings->logofile)) : ?>
        <img src="/uploads/<?= $settings->logofile ?>" alt="<?= $settings->title ?> logo preview" 
             title="<?= $settings->title ?> logo preview" class="img-thumbnail" style="height: 50px;">
        <input type="checkbox" name="displaylogo" <?php if($settings->displaylogo) : ?>checked<?php endif; ?> value="true">
        <label for="display-logo">Display logo</label>
      <?php endif; ?>
    </div>
  </div>

  <div class="form-group row">
    <label for="title" class="col-sm-2 col-form-label">Subdomain</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" placeholder="Site domain" name="domain" value="<?= $settings->dirname ?>.autodealermanager.com" readonly>
    </div>
  </div>

  <div class="form-group row">
    <label for="company" class="col-sm-2 col-form-label">Company</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" placeholder="Site title" name="company" value="<?= $settings->company ?>">
    </div>
  </div>

  <div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" placeholder="Email" name="email" value="<?= $settings->email ?>">
    </div>
  </div>

  <div class="form-group row">
    <label for="theme" class="col-sm-2 col-form-label">Theme</label>
    <div class="col-sm-10">  
      <select name="theme" class="custom-select" id="theme" value="<?= $settings->theme ?>">
         <?= themeOptions() ?>
      </select>
    </div>
  </div>

   <div class="form-group row">
    <label for="theme_style" class="col-sm-2 col-form-label">Theme Style</label>
    <div class="col-sm-10">  
      <select name="theme_style" class="custom-select" id="theme_style" value="">
         <option value="primary"<?= $settings->theme_style == 'primary' ? "selected" : "" ?>>Primary</option>
         <option value="light"<?= $settings->theme_style == 'light' ? "selected" : "" ?>>Light</option>
         <option value="dark"<?= $settings->theme_style == 'dark' ? "selected" : "" ?>>Dark</option>
      </select>
    </div>
  </div>

  <button type="submit" class="btn btn-primary" name="save-settings">Save Settings</button>
</form>
</main>


    <!-- Page Content -->
    <div id="page-content-wrapper">
      <div class="container-fluid">

        <h1 class="my-4 text-center text-lg-left">Settings</h1>
        <?php 
        $settings = new stdClass();
        $settings->domain = getData('domain', 'settings.json');
        $settings->title = getData('title', 'settings.json');
        $settings->email  = getData('email', 'settings.json');
        $settings->password  = getData('password', 'settings.json');
        $settings->displaylogo = isset($_POST['displaylogo']) ? getData('displaylogo', 'settings.json') : false;
        $settings->logofile = uploadImage('logofile', 'settings.json');
        $settings->theme = getData('theme', 'settings.json');
        
        if(saveJSON($settings, "settings.json")) {
          echo alert("success", "Your settings have been successfully saved!");
        } else {
          echo alert("danger", "Something went wrong and your settings could not be saved.");
        }
        
        ?>
        <div class="row">
          <div class="col-sm-10">
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
                <label for="title" class="col-sm-2 col-form-label">Domain</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="Site domain" name="domain" value="<?= $settings->domain ?>">
                </div>
              </div>

              <div class="form-group row">
                <label for="title" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="Site title" name="title" value="<?= $settings->title ?>">
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

              <button type="submit" class="btn btn-primary" name="save-settings">Save Settings</button>
            </form>
          </div>
          
          <div class="col-sm-2">
          <?php if($settings->logofile) : ?>
            <h4>Logo Preview</h4>
            <img src="/uploads/<?= $settings->logofile ?>" alt="<?= $settings->title ?> logo preview" class="img-thumbnail">
          <?php endif; ?>
          </div>
         
        </div>
       

      </div>
    </div>
    <!-- /.container -->
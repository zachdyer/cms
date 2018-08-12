<?php 
if(empty($_GET['id'])) {
   $site = new stdClass();
   $site->id = uniqid();
   $site->domain = '';
   $site->title = '';
   $site->email = '';
   $site->password = '';
   $title = "New Site";
} else {
  $site = getSiteById($_GET['id']); 
  $title = "Update Site";
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  //Lesson: htmlspecialchars keeps the json from getting screwed up and protects from html injections.
  $site->id    = $_GET['id'];
  $site->title = htmlspecialchars($_POST['title']);
  $site->domain = htmlspecialchars($_POST['domain']);
  $site->email = htmlspecialchars($_POST['email']);
  $site->password = htmlspecialchars($_POST['password']);
  saveSite($site);
  $title = "Update Site";
}
?>
    <!-- Page Content -->
    <div id="page-content-wrapper">
      <div class="container-fluid">

        <h1 class="my-4 text-center text-lg-left"><?= $title ?></h1>

        <form action="/admin/?page=site&id=<?= $site->id ?>" method="post">

          <div class="form-group row">
            <label for="domain" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Site title" name="title" value="<?= $site->title ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="domain" class="col-sm-2 col-form-label">Site</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Domain" name="domain" value="<?= $site->domain ?>" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="domain" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" placeholder="Email" name="email" value="<?= $site->email ?>" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="domain" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" placeholder="Password" name="password" value="<?= $site->password ?>" required>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Save Site</button>
        </form>

      </div>
    </div>
    <!-- /.container -->
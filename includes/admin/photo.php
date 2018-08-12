<?php 
if(empty($_GET['id'])) {
   $photo = new stdClass();
   $photo->date = '';
   $photo->id = uniqid();
   $photo->title = '';
   $photo->drive_url = '';
   $photo->image_url = '';
   $title = "New Photo";
} else {
  $photo = getPhotoById($_GET['id']); 
  if(!$photo) {
    $photo = new stdClass();
    $photo->id = $_GET['id'];
  }
  $title = "Update Photo";
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  //Lesson: htmlspecialchars keeps the json from getting screwed up and protects from html injections.
  $photo->date  = htmlspecialchars($_POST['date']);
  $photo->title = htmlspecialchars($_POST['title']);
  $photo->drive_url  = htmlspecialchars($_POST['drive_url']);
  $photo->image_url = convertDriveURL($photo->drive_url);
  savePhoto($photo);
  $title = "Update Photo";
}
?>
    <!-- Page Content -->
    <div id="page-content-wrapper">
      <div class="container-fluid">

        <h1 class="my-4 text-center text-lg-left"><?= $title ?></h1>

        <form action="/admin/?page=photo&id=<?= $photo->id ?>" method="post">
          <?php if($title == "Update Photo") : ?>
          <div class="form-group row">  
            <label for="id" class="col-sm-2 col-form-label">Photo Preview</label>
            <div class="col-sm-10">
              <div style="position:relative;height:0;padding-bottom:56.21%">
                <img src="<?= $photo->image_url ?>" style="position:absolute;width:100%;height:100%;left:0" width="750" height="500"  />
              </div>
            </div>
          </div>
          <?php endif; ?>
          <div class="form-group row">
            <label for="date" class="col-sm-2 col-form-label">Date</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" placeholder="Photo date" name="date" value="<?= $photo->date ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Photo title" name="title" value="<?= $photo->title ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="drive_url" class="col-sm-2 col-form-label">Public Drive URL</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Drive share url" name="drive_url" value="<?= $photo->drive_url ?>">
            </div>
          </div>
          <?php if($photo->image_url) : ?>
          <div class="form-group row">
            <label for="image_url" class="col-sm-2 col-form-label">Direct File URL</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="image_url" placeholder="Direct file url" name="image_url" value="<?= $photo->image_url ?>" readonly>
            </div>
            <div class="col-sm-2">
              <button class="btn btn-secondary btn-block" onclick="copyURL(event, 'image_url')" type="button"><i class="far fa-copy"></i> Copy URL</button>
            </div>
          </div>
          <?php endif; ?>
          

          <button type="submit" class="btn btn-primary">Save Photo</button>
        </form>

      </div>
    </div>
    <!-- /.container -->
<?php 
if(empty($_GET['id'])) {
   $manual = new stdClass();
   $manual->id    = '';
   $manual->title = '';
   $manual->link  = '';
   $manual->desc  = '';
   $manual->date  = '';
   $title = "New Manual";
} else {
  $manual = getManualById($_GET['id']); 
  $title = "Update Manual";
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  //Lesson: htmlspecialchars keeps the json from getting screwed up and protects from html injections.
  $manual->id    = $manual->id ? $manual->id : uniqid();
  $manual->title = htmlspecialchars($_POST['title']);
  $manual->link  = htmlspecialchars($_POST['link']);
  $manual->desc  = htmlspecialchars($_POST['desc']);
  $manual->date  = htmlspecialchars($_POST['date']);
  saveManual($manual);
  $title = "Update Manual";
}
?>
    <!-- Page Content -->
    <div id="page-content-wrapper">
      <div class="container-fluid">

        <h1 class="my-4 text-center text-lg-left"><?= $title ?></h1>

        <form action="/admin/?page=manual&id=<?= $manual->id ?>" method="post">

          <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Manual title" name="title" value="<?= $manual->title ?>">
            </div>
          </div>
          
          <div class="form-group row">
            <label for="desc" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
              <textarea type="text" class="form-control" placeholder="Manual description" name="desc" rows="10"><?= $manual->desc ?></textarea>
            </div>
          </div>
          
          <div class="form-group row">
            <label for="link" class="col-sm-2 col-form-label">Sharing URL</label>
            <div class="col-sm-10">
              <input type="url" class="form-control" placeholder="Manual url" name="link" value="<?= $manual->link ?>">
            </div>
          </div>

          <div class="form-group row">
            <label for="date" class="col-sm-2 col-form-label">Date</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" placeholder="Manual date" name="date" value="<?= $manual->date ?>">
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Save Video</button>
        </form>

      </div>
    </div>
    <!-- /.container -->
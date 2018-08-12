<?php 
if(empty($_GET['id'])) {
   $video = new stdClass();
   $video->id = '';
   $video->title = 'New Video';
   $video->desc = '';
   $video->date = '';
   $title = "New Video";
} else {
  $video = getVideoById($_GET['id']); 
  $title = "Update Video";
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  //Lesson: htmlspecialchars keeps the json from getting screwed up and protects from html injections.
  $video->id    = htmlspecialchars($_POST['id']);
  $video->title = htmlspecialchars($_POST['title']);
  $video->desc  = htmlspecialchars($_POST['desc']);
  $video->date  = htmlspecialchars($_POST['date']);
  saveVideo($video);
  $title = "Update Video";
}
?>
    <!-- Page Content -->
    <div id="page-content-wrapper">
      <div class="container-fluid">

        <h1 class="my-4 text-center text-lg-left"><?= $title ?></h1>

        <form action="/admin/?page=video&id=<?= $video->id ?>" method="post">
          <?php if($title == "Update Video") : ?>
          <div class="form-group row">  
            <label for="id" class="col-sm-2 col-form-label">Youtube Preview</label>
            <div class="col-sm-10">
              <div style="position:relative;height:0;padding-bottom:56.21%">
                <iframe src="https://www.youtube.com/embed/<?= $video->id ?>?ecver=2" style="position:absolute;width:100%;height:100%;left:0" width="750" height="500" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
              </div>
            </div>
          </div>
          <?php endif; ?>
          <div class="form-group row">  
            <label for="id" class="col-sm-2 col-form-label">Youtube ID</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Video ID" name="id" value="<?= $video->id ?>">
            </div>
          </div>

          <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Video title" name="title" value="<?= $video->title ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="desc" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
              <textarea type="text" class="form-control" placeholder="Video description" name="desc" rows="10"><?= $video->desc ?></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="date" class="col-sm-2 col-form-label">Date</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" placeholder="Video date" name="date" value="<?= $video->date ?>">
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Save Video</button>
        </form>

      </div>
    </div>
    <!-- /.container -->
<!-- Page Content -->
<div id="page-content-wrapper">
  <div class="container-fluid">

    <h1 class="my-4 text-center text-lg-left">Home page</h1>
    <?php 
    $home = getJSON("home.json"); 

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      //Lesson: htmlspecialchars keeps the json from getting screwed up and protects from html injections.
      $home->slide1 = uploadImage("slide1");
      $home->slide2 = uploadImage("slide2");
      $home->slide3 = uploadImage("slide3");
      
      saveSettings($home, "home.json");
    }
    
    ?>
    <form action="/admin/?page=home" method="post" enctype="multipart/form-data">
      <div class="form-group row">
        <label for="title" class="col-sm-2 col-form-label">Slide One</label>
        <div class="col-sm-10">
          <input type="file" name="slide1">
          <?php if(getData("slide1", "home.json")) : ?>
            <img src="/uploads/<?= getData("slide1", "home.json") ?>" alt="" 
                 title="Slide one" class="img-thumbnail" style="height: 50px;">
          <?= getData("slide1", "home.json") ?>
          <?php endif; ?>
        </div>
      </div>
      <div class="form-group row">
        <label for="title" class="col-sm-2 col-form-label">Slide Two</label>
        <div class="col-sm-10">
          <input type="file" name="slide2">
          <?php if(getData("slide1", "home.json")) : ?>
            <img src="/uploads/<?= getData("slide2", "home.json") ?>" alt="" 
                 title="Slide one" class="img-thumbnail" style="height: 50px;">
          <?= getData("slide2", "home.json") ?>
          <?php endif; ?>
        </div>
      </div>
      <div class="form-group row">
        <label for="title" class="col-sm-2 col-form-label">Slide Three</label>
        <div class="col-sm-10">
          <input type="file" name="slide3">
          <?php if(getData("slide1", "home.json")) : ?>
            <img src="/uploads/<?= getData("slide3", "home.json") ?>" alt="" 
                 title="Slide one" class="img-thumbnail" style="height: 50px;">
          <?= getData("slide3", "home.json") ?>
          <?php endif; ?>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Upload Slides</button>
    </form>

  </div>
</div>
<!-- /.container -->
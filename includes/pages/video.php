<?php 
  $video = getVideoById($_GET['id']);
  $othervideos = array_rand(getVideoData(), 4);

?>

<!-- Page Content -->
    <div class="container">

      <!-- Portfolio Item Heading -->
      <h1 class="my-4">Video
        <small><?= $video->title ?></small>
      </h1>

      <!-- Portfolio Item Row -->
      <div class="row">

        <div class="col-md-8">
          <div style="position:relative;height:0;padding-bottom:56.21%">
            <iframe src="https://www.youtube.com/embed/<?= $video->id ?>?ecver=2" style="position:absolute;width:100%;height:100%;left:0" width="750" height="500" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
          </div>
        </div>

        <div class="col-md-4">
          <h3 class="my-3">Video Description</h3>
          <p><?= nl2br($video->desc) ?></p>
        </div>

      </div>
      <!-- /.row -->

      <!-- Related Projects Row -->
      <h3 class="my-4">Other Videos</h3>

      <div class="row">
        
        <?php for($i = 0; $i < count($othervideos); $i++) : 
          $video =  getVideoData()[$othervideos[$i]];
        ?>
        <div class="col-md-3 col-sm-6 mb-4" video="<?= $othervideos[$i] ?>">
          <a href="?page=video&id=<?= $video->id ?>" title="<?= $video->title ?>">
            <img class="img-fluid" src="https://img.youtube.com/vi/<?= $video->id ?>/0.jpg" alt="<?= $video->title ?>">
          </a>
        </div>
        <?php endfor; ?>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->
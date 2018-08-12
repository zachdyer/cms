<!-- Page Content -->
    <div class="container margin-top">

      <h1 class="my-4 text-center text-lg-left">Video Gallery</h1>

      <div class="row">
        <?php foreach(getVideoData() as $key => $video) : ?>
        <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
          <div class="card h-100">
            <a href="?page=video&id=<?= $video->id ?>"><img class="card-img-top" src="https://img.youtube.com/vi/<?= $video->id ?>/0.jpg" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="?page=video&id=<?= $video->id ?>"><?= $video->title ? substr($video->title, 0, 30) . "..." : "Untitled" ?></a>
              </h4>
              <p class="card-text"><?= $video->desc ? substr($video->desc, 0, 50) . "..." : "No description" ?></p>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

    </div>
    <!-- /.container -->
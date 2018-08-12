<!-- Page Content -->
    <div class="container margin-top">

      <h1 class="my-4 text-center text-lg-left">Photo Gallery</h1>

      <div class="row">
        <?php foreach(getPhotoData() as $key => $photo) : ?>
        <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
          <div class="card h-100">
            <a href="?page=photo&id=<?= $photo->id ?>"><img class="card-img-top" src="<?= $photo->image_url ?>" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="?page=photo&id=<?= $photo->id ?>"><?= $photo->title ? substr($photo->title, 0, 30) . "..." : "Untitled" ?></a>
              </h4>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

    </div>
    <!-- /.container -->
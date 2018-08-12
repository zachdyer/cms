<!-- Page Content -->
    <div class="container margin-top">

      <h1 class="my-4 text-center text-lg-left">Manual List</h1>

      <div class="row">
        <?php foreach(getManualData() as $key => $manual) : ?>
        <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
          <div class="card h-100">
            <h1 class="card-header text-center bg-primary display-1">
              <a href="<?= $manual->link ?>" target="_blank" title="<?= $manual->title ?>" class="text-white">
                <i class="far fa-file-pdf"></i>
              </a>
            </h1>
            <div class="card-body">
              <h4 class="card-title">
                <a href="<?= $manual->link ?>" target="_blank"><?= $manual->title ? $manual->title : "Untitled" ?></a>
              </h4>
              <p class="card-text"><?= $manual->desc ? $manual->desc : "No description" ?></p>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

    </div>
    <!-- /.container -->
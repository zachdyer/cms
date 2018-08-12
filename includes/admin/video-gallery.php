<?php
  if(!empty($_GET['delete'])) {
    deleteVideoById($_GET['delete']);
  }
?>

<!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <h1 class="float-left">Video Gallery</h1>
                <a class="btn btn-primary float-right" href="?page=video">New Video</a>
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">Edit</th>
                      <th scope="col">Title</th>
                      <th scope="col">Date</th>
                      <th scope="col">Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach(getVideoData() as $key => $video) : ?>
                    <tr>
                      <th scope="row"><a href="/admin/?page=video&id=<?= $video->id; ?>"><i class="fas fa-edit"></i></a></th>
                      <td><?= $video->title ? $video->title : "Untitled"; ?></td>
                      <td><?= $video->date; ?></td>
                      <td><a href="/admin/?page=video-gallery&delete=<?= $video->id ?>"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
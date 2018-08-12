<?php
  if(!empty($_GET['delete'])) {
    deleteVideoById($_GET['delete']);
    deleteRecordById($_GET['delete'], "pages.json");
  }
?>

<!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <h1 class="float-left">Pages</h1>
                <a class="btn btn-primary float-right" href="?page=page">New Page</a>
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">Edit</th>
                      <th scope="col">Title</th>
                      <th scope="col">Layout</th>
                      <th scope="col">Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach(getJSON("pages.json") as $key => $page) : ?>
                    <tr>
                      <th scope="row"><a href="/admin/?page=page&id=<?= $page->id ?>"><i class="fas fa-edit"></i></a></th>
                      <td><?= $page->title ?></td>
                      <td><?= $page->layout ?></td>
                      <td><a href="/admin/?page=pages&delete=<?= $page->id ?>"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
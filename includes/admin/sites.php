<?php
  $page = "site";
  if(!empty($_GET['disable'])) {
    disableSiteById($_GET['disable']);
  }
?>

<!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <h1 class="float-left">Sites</h1>
                <a class="btn btn-primary float-right" href="?page=<?= $page ?>">New Site</a>
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">Edit</th>
                      <th scope="col">Domain</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach(getSitesData() as $key => $site) : ?>
                    <tr>
                      <td scope="row"><a href="/admin/?page=<?= $page ?>&id=<?= $site->id; ?>"><i class="fas fa-edit"></i></a></td>
                      <td><?= $site->domain ? $site->domain : "Untitled"; ?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
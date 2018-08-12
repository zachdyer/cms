<?php
if(!empty($_GET['delete'])) {
  deleteManualById($_GET['delete']);
}
?>
<!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <h1 class="float-left">Manuals</h1>
              <a class="btn btn-primary float-right" href="?page=manual">New Manual</a>
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">Edit</th>
                      <th scope="col">Title</th>
                      <th scope="col">Link</th>
                      <th scope="col">Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach(getManualData() as $key => $manual) : ?>
                    <tr>
                      <th scope="row"><a href="/admin/?page=manual&id=<?= $manual->id; ?>"><i class="fas fa-edit"></i></a></th>
                      <td><?= $manual->title ? $manual->title : "Untitled"; ?></td>
                      <td><?php if($manual->link) : ?>
                        <a href="<?= $manual->link ?>" target="blank"><?= $manual->link ?></a>
                        <?php else : ?>No URL available<?php endif; ?>
                      </td>
                      <td><a href="/admin/?page=manual-list&delete=<?= $manual->id ?>"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
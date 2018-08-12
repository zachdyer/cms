<?php
  if(!empty($_GET['delete'])) {
    deleteJSON($_GET['delete']);
  }
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
      <h1 class="h2">Database</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
          <a class="btn btn-sm btn-outline-secondary" href="/admin/?page=json">New JSON</a>
        </div>
      </div>
  </div>
  <div class="table-responsive">
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>Edit</th>
          <th>JSON</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach(getDatabase() as $key => $db) : ?>
        <tr>
          <th scope="row"><a href="/admin/?page=json&name=<?= $db; ?>"><span data-feather="edit"></span></a></th>
          <td><?= $db ?></td>
          <td><a href="/admin/?page=database&delete=<?= $db ?>"><span data-feather="trash"></span></a></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</main>


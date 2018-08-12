<?php
  if(!empty($_GET['delete'])) {
    deleteRecordById($_GET['delete'], "users.json");
  }
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
      <h1 class="h2">Users</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
          <a class="btn btn-sm btn-outline-secondary" href="/admin/?page=user">New User</a>
        </div>
      </div>
  </div>
  <div class="table-responsive">
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th scope="col">Edit</th>
          <th scope="col">Email</th>
          <th scope="col">Role</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach(getJSON("users.json") as $key => $user) : ?>
        <tr>
          <th scope="row"><a href="/admin/?page=user&id=<?= $user->id; ?>"><span data-feather="edit"></span></a></th>
          <td><?= $user->email ?></td>
          <td><?= $user->role; ?></td>
          <td><a href="/admin/?page=users&delete=<?= $user->id ?>"><span data-feather="trash"></span></a></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</main>
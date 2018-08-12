<?php
  if(!empty($_GET['delete'])) {
    deleteRecordById($_GET['delete'], "pages.json");
  }
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
      <h1 class="h2">Pages</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
          <a class="btn btn-sm btn-outline-secondary" href="/admin/?page=page">New Page</a>
        </div>
      </div>
      <?php
        if(isset($_GET['delete'])) {
          $id = $_GET['delete'];
          $slug = getDataById($id, "slug", "pages.json");
          if(deleteRecordById($id, "pages.json") && deletePage($slug)) {
            echo alert("success", "Page has been successfully deleted.");
          } else {
            echo alert("danger", "I was not able to delete the page.");
          }
        }
      ?>
  </div>
  <div class="table-responsive">
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>Edit</th>
          <th>Title</th>
          <th>Slug</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach(getJSON("pages.json") as $page) : ?>
        <tr>
          <td><a href="/admin/?page=page&id=<?= $page->id ?>"><span data-feather="edit"></span></a></td>
          <td><?= $page->title ?></td>
          <td><?= $page->slug ?></td>
          <td><a href="/admin/?page=pages&delete=<?= $page->id ?>"><span data-feather="trash"></span></a></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</main>


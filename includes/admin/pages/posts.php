<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
      <h1 class="h2"><?= empty($_GET['id']) ? "New Post" : "Update Post" ?></h1>
  </div>
  <a class="btn btn-primary float-right" href="?page=post">New Post</a>
  <?php
    if(isset($_GET['delete'])) {
      $id = $_GET['delete'];
      if(deleteRecordById($id, "posts.json")) {
        echo alert("success", "Post has been successfully deleted.");
      } else {
        echo alert("danger", "I was not able to delete the post.");
      }
    }
  ?>
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">Edit</th>
        <th scope="col">Title</th>
        <th scope="col">Slug</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach(getJSON("posts.json") as $post): ?>
      <tr>
        <th scope="row"><a href="/admin/?posts=page&id=<?= $post->id ?>"><i class="fas fa-edit"></i></a></th>
        <td><?= $post->title ?></td>
        <td><?= $post->slug ?></td>
        <td><a href="/admin/?page=posts&delete=<?= $post->id ?>"><i class="fas fa-trash-alt"></i></a></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</main>




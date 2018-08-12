<?php
  if(!empty($_GET['delete'])) {
    deletePhotoById($_GET['delete']);
  }
?>

<!-- Page Content -->
<div id="page-content-wrapper">
  <div class="container-fluid">
    <h1 class="float-left">Photo Gallery</h1>
    <a class="btn btn-primary float-right" href="?page=photo">New Photo</a>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">Edit</th>
          <th scope="col">Date</th>
          <th scope="col">Title</th>
          <th scope="col">Copy</th>
          <th scope="col">Direct File URL</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach(getPhotoData() as $key => $photo) : ?>
        <tr>
          <th scope="row"><a href="/admin/?page=photo&id=<?= $photo->id; ?>"><i class="fas fa-edit"></i></a></th>
          <td><?= $photo->date; ?></td>
          <td><?= $photo->title ? $photo->title : "Untitled"; ?></td>
          <td><a href="#" onclick="copyURL(event, 'photo-<?= $photo->id; ?>')"><i class="far fa-copy"></i></a></td>
          <td><input class="form-control" type="text" id="photo-<?= $photo->id; ?>" value="<?= $photo->image_url ?>" readonly /></td>
          <td><a href="/admin/?page=photo-gallery&delete=<?= $photo->id ?>"><i class="fas fa-trash-alt"></i></a></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->
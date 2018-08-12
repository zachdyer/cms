<?php
  if(!empty($_GET['delete'])) {
    deleteRecordById($_GET['delete'], "cars.json");
  }
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
      <h1 class="h2">Lot Inventory</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
          <a class="btn btn-sm btn-outline-secondary" href="/admin/?page=car">New Car</a>
        </div>
      </div>
  </div>
  <div class="table-responsive">
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>Edit</th>
          <th>Title</th>
          <th>Desc</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach(getJSON("cars.json") as $key => $car) : ?>
        <tr>
          <th scope="row"><a href="/admin/?page=car&id=<?= $car->id; ?>"><span data-feather="edit"></span></a></th>
          <td><?= $car->title ?></td>
          <td><?= $car->desc; ?></td>
          <td><a href="/admin/?page=cars&delete=<?= $car->id ?>"><span data-feather="trash"></span></a></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</main>
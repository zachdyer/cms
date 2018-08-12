<?php
  if(!empty($_GET['delete'])) {
    deleteRecordById($_GET['delete'], "cars.json");
  }
?>

<!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <h1 class="float-left">Car Inventory</h1>
            <a class="btn btn-primary float-right" href="?page=car">New Car</a>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">Edit</th>
                  <th scope="col">Title</th>
                  <th scope="col">Desc</th>
                  <th scope="col">Delete</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach(getJSON("cars.json") as $key => $car) : ?>
                <tr>
                  <th scope="row"><a href="/admin/?page=car&id=<?= $car->id; ?>"><i class="fas fa-edit"></i></a></th>
                  <td><?= $car->title ?></td>
                  <td><?= $car->desc; ?></td>
                  <td><a href="/admin/?page=cars&delete=<?= $car->id ?>"><i class="fas fa-trash-alt"></i></a></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->
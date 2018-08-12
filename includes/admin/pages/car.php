<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
      <h1 class="h2"><?= empty($_GET['id']) ? "New Car" : "Update Car" ?></h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
          <a class="btn btn-sm btn-outline-secondary" href="/admin/?page=cars">Back</a>
          <a class="btn btn-sm btn-outline-secondary" href="/admin/?page=car">New Car</a>
        </div>
      </div>
  </div>
  <?php 

  //Setting values for the data
  $car              = new stdClass();
  $car->id          = getData("id", "cars.json");
  $car->uploadimage = uploadImage("uploadimage", "cars.json");
  $car->color       = getData("color", "cars.json");
  $car->title       = getData("title", "cars.json");
  $car->desc        = getData("desc", "cars.json");
  $car->price       = getData("price", "cars.json");
  $car->make        = getData("make", "cars.json");
  $car->make_id     = getData("make_id", "cars.json");
  $car->model       = getData("model", "cars.json");
  $car->modelid     = getData("modelid", "cars.json");
  $car->year        = getData("year", "cars.json");

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(saveDataById($_GET['id'], $car, "cars.json")) {
      echo alert("success", "I saved the car to your car database.");
    } else {
      echo alert("danger", "Sorry I wasn't able to save the car to your car database.");
    }
  }
  ?>
  <form action="/admin/?page=car&id=<?= $car->id ?>" method="post" enctype="multipart/form-data">
          
    <div class="form-group row">
      <label for="title" class="col-sm-2 col-form-label">Image Upload</label>
      <div class="col-sm-10">
        <input type="file" name="uploadimage">
        <?php if(!empty($car->uploadimage)) : ?>
          <img src="/uploads/<?= $car->uploadimage ?>" alt="<?= $car->title ?> image preview" 
               title="<?= $car->title ?> image preview" class="img-thumbnail" style="height: 50px;">
        <?php endif; ?>
      </div>
    </div>

    <div class="form-group row">
      <label for="title" class="col-sm-2 col-form-label">Title</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" placeholder="Car title" name="title" value="<?= $car->title ?>">
      </div>
    </div>
    <div class="form-group row">
      <label for="desc" class="col-sm-2 col-form-label">Description</label>
      <div class="col-sm-10">
        <textarea class="form-control" placeholder="Car description" name="desc" rows="10"><?= $car->desc ?></textarea>
      </div>
    </div>
    <div class="form-group row">
      <label for="date" class="col-sm-2 col-form-label">Price</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" placeholder="Car price" name="price" value="<?= $car->price ? $car->price : "" ?>">
      </div>
    </div>


    <div class="form-group row">
      <label for="make" class="col-sm-2 col-form-label">Make</label>
      <div class="col-sm-10">  
        <select name="make" class="custom-select" onchange="inventory.update.make()" id="make" value="<?= $car->make ?>">
            <option value="">Select Make</option>
        </select>
        <input type="hidden" name="make_id" id="make_id" value="<?= $car->make_id ?>">
      </div>
    </div>
    <div class="form-group row">
      <label for="model" class="col-sm-2 col-form-label">Model</label>
      <div class="col-sm-10">
        <select name="model" class="btn-primary form-control" id="model" disabled="true" value="<?= $car->model ?>" onchange="inventory.update.model()">
          <option selected="" class="medium" value="">
              Select model
          </option>
          <input type="hidden" name="modelid" id="modelid" value="<?= $car->modelid ?>">
        </select>
      </div>
    </div>
    <div class="form-group row">
      <label for="year"  class="col-sm-2 col-form-label">Year</label>
      <div class="col-sm-10">
        <select id="year" name="year" class="btn-primary form-control">
          <option value="<?= $car->year ?>">Select year</option>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <label for="color" class="col-sm-2 col-form-label">Color</label>
      <div class="col-sm-10">
        <select name="color" class="btn-primary form-control" id="color">
          <option value="">Select Color</option>
          <option value="grey"<?= $car->color == "grey" ? " selected" : "" ?>>Grey</option>
          <option value="silver"<?= $car->color == "silver" ? " selected" : "" ?>>Silver</option>
          <option value="white"<?= $car->color == "white" ? " selected" : "" ?>>White</option>
          <option value="red"<?= $car->color == "red" ? " selected" : "" ?>>Red</option>
        </select>
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Save Car</button>
  </form>
</main>
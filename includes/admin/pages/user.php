<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
      <h1 class="h2"><?= empty($_GET['id']) ? "New User" : "Update User" ?></h1>
  </div>
  <?php 
  //Setting values for the data
  $user              = new stdClass();
  $user->id          = getData("id", "users.json");
  $user->username    = getData("username", "users.json");
  $user->password    = getData("password", "users.json");
  $user->role       = getData("role", "users.json");


  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(saveDataById($_GET['id'], $user, "users.json")) {
      echo alert("success", "I saved the user to your user database.");
    } else {
      echo alert("danger", "Sorry I wasn't able to save the user to your user database.");
    }
  }
  ?>
  <form action="/admin/?page=user&id=<?= $user->id ?>" method="post" enctype="multipart/form-data">

    <div class="form-group row">
      <label for="username" class="col-sm-2 col-form-label">Username</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" placeholder="Username" name="username" value="<?= $user->username ?>">
      </div>
    </div>
    <div class="form-group row">
      <label for="password" class="col-sm-2 col-form-label">Password</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" placeholder="Password" name="password" value="<?= $user->password ?>">
      </div>
    </div>
    <div class="form-group row">
      <label for="role" class="col-sm-2 col-form-label">Role</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" placeholder="Role" name="role" value="<?= $user->role ?>">
      </div>
    </div>


    <button type="submit" class="btn btn-primary">Save User</button>
  </form>
</main>


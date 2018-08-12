<div class="container pt-5 pb-5">
    <div class="card mx-auto" style="max-width: 23rem;">
      <div class="card-header text-white bg-primary">
        Login
      </div>
      <div class="card-body">
        <?php
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
          if(login($_POST['email'], $_POST['password'])) {
            header("Location: /admin?" . $_SERVER['QUERY_STRING'] );
          } else {
            echo alert("danger", "Username or password is incorrect! Please try again.");
          }
        }
        ?>
        <form action="/admin/index.php?<?= $_SERVER['QUERY_STRING'] ?>" method="post">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" placeholder="Email" name="email">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password" name="password">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
</div><!-- /container -->
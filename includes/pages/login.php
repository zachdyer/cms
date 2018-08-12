<div class="container">
    <div class="card mt-5 mb-5 mx-auto" style="max-width: 500px;">
      <div class="card-header text-white bg-primary">
        Login with your autodealermanager.com url
      </div>
      <div class="card-body">
        <?php
        //Check for login so the customer can redirect
          if($_SERVER['REQUEST_METHOD'] == "POST") {
            if(isSubdomain($_POST['subdomain'])) {
              header("Location: http://" . $_POST['subdomain'] . ".autodealermanager.com/admin");
            } else {
              echo alert("danger", $_POST['subdomain'] . ".autodealermanager.com is an invalide subdomain.");
            }
          }
        ?>
        <form action="/?page=login" method="post">
          <div class="form-group">
            
            <input type="text" class="form-control text-right" placeholder="your-website-url" name="subdomain" style="display: inline-block; width: auto">
            <label for="subdomain">.autodealermanager.com</label>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
</div><!-- /container -->
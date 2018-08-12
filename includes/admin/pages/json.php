<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
      <h1 class="h2"><?= empty($_GET['name']) ? "New JSON" : "Update JSON" ?></h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
          <a class="btn btn-sm btn-outline-secondary" href="/admin/?page=database">Back</a>
          <a class="btn btn-sm btn-outline-secondary" href="/admin/?page=json">New JSON</a>
        </div>
      </div>
      <?php 
         
        //Setting values for the data
        $name = isset($_GET['name']) ? $_GET['name'] : "";
        if($name) {
          $json = json_encode(getJSON($name));
        } else {
          $json = "";
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          
          $name = $_POST['filename'];
          $json = json_decode($_POST['json']);
          
          if(saveJSON($json,$name)) {
            echo alert("success", "I saved the json file to your database.");
          } else {
            echo alert("danger", "Sorry I wasn't able to save the json file to your database.");
          }
          
          $json = $_POST['json'];
        }
      ?>
  </div>
  <form action="/admin/?page=json&name=<?= $name ?>" method="post">
      
      <div class="form-group row">
        <label for="filename" class="col-sm-2 col-form-label">File Name</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="" name="filename" value="<?= $name ?>">
        </div>
      </div>
      
      <div class="form-group row">
        <label for="json" class="col-sm-2 col-form-label">JSON Data</label>
        <div class="col-sm-10">
          <textarea name="json" placeholder="Enter JSON code for data import" class="form-control" rows="9"><?= $json ?></textarea>
        </div>
      </div>

      <button type="submit" class="btn btn-primary">Save JSON File</button>
          
    </form>
</main>

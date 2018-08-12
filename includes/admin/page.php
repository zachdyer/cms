<?php 

require(ROOTPATH . "/classes/Page.class.php");
$page = new Page();
$title = "New Page";
if(!empty($_GET['id'])) {
  $page = getDataById($_GET['id'], "pages.json"); 
  $title = "Update Page";
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  //Lesson: htmlspecialchars keeps the json from getting screwed up and protects from html injections.
  $page->title = htmlspecialchars($_POST['title']);
  $page->content = htmlspecialchars($_POST['content']);
  $page->layout = $_POST['layout'];
  saveData($page, "pages.json");
  $title = "Update Page";
}

?>
    <!-- Page Content -->
    <div id="page-content-wrapper">
      <div class="container-fluid">

        <h1 class="my-4 text-center text-lg-left"><?= $title ?></h1>

        <form action="/admin/?page=page&id=<?= $page->id ?>" method="post">

          <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Photo title" name="title" value="<?= $page->title ?>">
            </div>
          </div>
          
          <div class="form-group row">
            <label for="content" class="col-sm-2 col-form-label">Content</label>
            <div class="col-sm-10">
              <textarea class="form-control" placeholder="Page content..." name="content" rows="10"><?= $page->content ?></textarea>
            </div>
          </div>
          
          <div class="form-group row">
            <label for="layout" class="col-sm-2 col-form-label">Layout</label>
            <div class="col-sm-10">
              <select class="form-control" name="layout">
                <option>Youtube Gallery</option>
                <option>Google Drive Photo Gallery</option>
                <option>Drive PDF List</option>
                <option>Product Gallery</option>
              </select>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Save Page</button>
        </form>

      </div>
    </div>
    <!-- /.container -->
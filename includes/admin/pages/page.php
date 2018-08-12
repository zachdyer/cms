<?php 
$title = "New Page";
$page = new stdClass();
$page->id = isset($_GET['id']) ? $_GET['id'] : uniqid();
$page->menu_title = getData('menu_title', "pages.json");
$page->title = getData("title", "pages.json");;
$page->slug = getData("slug", "pages.json");
$page->published = getData("published", "pages.json");
$filepath = INCLUDES . "/pages/" . $page->slug . ".php";
$content = file_exists($filepath) ? file_get_contents($filepath) : "";

if(isset($_GET['id'])) {
  $title = "Update Page";
}
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
      <h1 class="h2"><?= $title ?></h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
          <a class="btn btn-sm btn-outline-secondary" href="/admin/?page=pages">Back</a>
          <a class="btn btn-sm btn-outline-secondary" href="/admin/?page=page">New Page</a>
        </div>
      </div>
      <?php 
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //Lesson: htmlspecialchars keeps the json from getting screwed up and protects from html injections.
        $page->menu_title = htmlspecialchars($_POST['menu_title']);
        $page->title = htmlspecialchars($_POST['pagetitle']);
        $page->slug = $_POST['slug'];
        $content = $_POST['content'];
        $page->published = isset($_POST['published']) ? true : false;
        if(savePage($page, $content)) {
          echo alert("success", "I have saved $page->slug for your page html.");
        } else {
          echo alert("danger", "I was not able to save the page.");
        }
      }
      ?>
  </div>
  <form action="/admin/?page=page&id=<?= $page->id ?>" method="post">
      
      <div class="form-group row">
        <label for="menu_title" class="col-sm-2 col-form-label">Menu Title</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="Menu title" name="menu_title" value="<?= $page->menu_title ?>">
        </div>
      </div>
      
      <div class="form-group row">
        <label for="pagetitle" class="col-sm-2 col-form-label">Page Title</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="Page title" name="pagetitle" value="<?= $page->title ?>">
        </div>
      </div>
      
      <div class="form-group row">
        <label for="slug" class="col-sm-2 col-form-label">Slug</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="Page file name" name="slug" value="<?= $page->slug ?>">
        </div>
      </div>
      
      <div class="form-group row">
        <label for="pagefile" class="col-sm-2 col-form-label">Published</label>
        <div class="col-sm-10">
          <div class="checkbox">
            <label><input type="checkbox" value="true" name="published" <?= $page->published ? "checked" : "" ?>>Publish</label>
          </div>
        </div>
      </div>
      
      <input type="hidden" value="<?= str_replace(".php", "", $page->file) ?>" name="permalink">

      <div class="form-group row">
        <label for="content" class="col-sm-2 col-form-label">Content</label>
        <div class="col-sm-10">
          <textarea class="form-control" placeholder="Page content..." name="content" rows="10"><?= htmlentities($content) ?></textarea>
        </div>
      </div>

      <button type="submit" class="btn btn-primary">Save Page</button>
    </form>
</main>


<!-- Page Content -->
<div id="page-content-wrapper">
  <div class="container-fluid">
    <?php 
    $title = "New Post";
    
    if(isset($_GET['id'])) {
      $title = "Update Post";
    }
    ?>
    <div class="row">
      <div class="col-md">
        <a href="/admin/?page=posts" class="btn btn-secondary float-left">Back</a>
        <a class="btn btn-primary float-right" href="?page=post">New Page</a>
      </div>
    </div>
    <div class="row">
      <div class="col-md">
        <h1 class="float-left"><?= $title ?></h1>
      </div>
    </div>
    
    <?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      //Lesson: htmlspecialchars keeps the json from getting screwed up and protects from html injections.
      $post = new stdClass();
      $post->id = getID();
      $post->title = getData("title", "posts.json");
      $post->published = getData("published", "posts.json");
      $post->content = getData("content", "posts.json");
      $post->featured_image = uploadImage("featured_image", "posts.json");
      $post->display_featured_image = getData("display_featured_image", "posts.json");
      $post->title = htmlspecialchars($_POST['title']);
      $post->published = isset($_POST['published']) ? true : false;
      if(saveDataById($post->id, $post, "posts.json")) {
        echo alert("success", "I have saved $post->title for your page html.");
      } else {
        echo alert("danger", "I was not able to save the page.");
      }
    }
    ?>
    <form action="/admin/?page=post&id=<?= $post->id ?>" method="post" enctype="multipart/form-data">
      
    <div class="form-group row">
      <label for="title" class="col-sm-2 col-form-label">Featured Image</label>
      <div class="col-sm-10">
        <input type="file" name="featured_image">
        <?php if(isset($post->featured_image)) : ?>
          <img src="/uploads/<?= $post->featured_image ?>" alt="<?= $post->title ?> logo preview" 
               title="<?= $post->title ?> logo preview" class="img-thumbnail" style="height: 50px;">
          <input type="checkbox" name="display_featured_image" <?php if(isset($post->display_featured_image)) : ?>checked<?php endif; ?> value="true">
          <label for="display-logo">Display Featured Image</label>
        <?php endif; ?>
      </div> 
     </div>
      
      <div class="form-group row">
        <label for="pagetitle" class="col-sm-2 col-form-label">Post Title</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="Post title" name="title" value="<?= $post->title ?>">
        </div>
      </div>
      
      <div class="form-group row">
        <label for="pagefile" class="col-sm-2 col-form-label">Published</label>
        <div class="col-sm-10">
          <div class="checkbox">
            <label><input type="checkbox" value="true" name="published" <?= $post->published ? "checked" : "" ?>>Publish</label>
          </div>
        </div>
      </div>

      <div class="form-group row">
        <label for="content" class="col-sm-2 col-form-label">Content</label>
        <div class="col-sm-10">
          <textarea class="form-control" placeholder="Page content..." name="content" rows="10"><?= htmlentities($post->content) ?></textarea>
        </div>
      </div>

      <button type="submit" class="btn btn-primary">Save Page</button>
    </form>

  </div>
</div>
<!-- /.container -->
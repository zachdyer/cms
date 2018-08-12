<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
      <h1 class="h2">Sites</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
          <a class="btn btn-sm btn-outline-secondary" href="/admin/?page=site">New Site</a>
        </div>
      </div>
  </div>
  <?php
    if(isset($_GET['delete'])) {
      $id = $_GET['delete'];
      if(deleteSite($id)) {
        echo alert("success", "Site $id has been successfully deleted.");
      }
    }
  ?>
  <div class="table-responsive">
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>Company</th>
          <th>Subdomin</th>
          <th>Email</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach(getJSON("sites.json") as $site) : ?>
        <tr>
          <td><a href="/admin/?page=site&id=<?= $site->id ?>"><span data-feather="edit"></span></a></td>
          <td><a href="http://<?= $site->subdomain ?>.autodealermanager.com" target="_blank"><?= $site->subdomain ?></a></td>
          <td><?= $site->email ?></td>
          <td><a href="/admin/?page=sites&delete=<?= $site->id ?>" onclick="return confirm('Are you sure you want to delete this site?');"><span data-feather="trash"></span></a></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</main>


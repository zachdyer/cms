<div class="container mt-5 mb-5">
  <?php
  
  
    //Check for a plan
     $plan = isset($_GET['plan']) ? $_GET['plan'] : "free"; 
     if($plan == "adm_business") {
       $plan_id = "plan_DGAXdRtdrHSf28";
       $plan_name = "ADM Business Plan";
       $plan_description = "A monthly subscription for small car lots.";
       $price = 4900;
     } else if ($plan == "adm_enterprise") {
       $plan_id = "prod_DGZBYxcLdM40aw";
       $plan_name = "ADM Enterprise Plan";
       $plan_description = "A monthly subscription for large car lots.";
       $price = 9900;
     }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $allset = true;
      //Check required fields
      if(empty($_POST['company'])) {
        echo alert("danger", "You must enter a company name");
        $allset = false;
      }
      if(empty($_POST['password'])) {
        echo alert("danger", "You must enter a password");
        $allset = false;
      }
      if(empty($_POST['stripeEmail'])) {
        echo alert("danger", "You must enter an email");
        $allset = false;
      }
      
      //Check if password matches
      if($_POST['password'] != $_POST['confirm_password']) {
        echo alert("danger", "Your password doesn't match.");
        $allset = false;
      }
      
      //Check if email has already registered
      foreach(getJSON("sites.json") as $user) { 
        if($user->email == $_POST['stripeEmail']) {
          echo alert("danger", "Someone has already registered with that email. Please use another email.");
          $allset = false;  
        }
      }
      
      if($allset) {
        
        $user = new stdClass();
        $user->id = uniqid();
        $user->display_name = $_POST['display_name'];
        $user->company = $_POST['company'];
        $user->subdomain = $_POST['subdomain'];
        $user->email = $_POST['stripeEmail'];
        $user->password = $_POST['password'];
        $user->plan = $plan;

        if(!saveDataById($user->id, $user, "sites.json")) {
          echo alert("danger", "I was not able to save your data to our database.");
          $allset = false;
        }

        if(!createSite($user)) {
          echo alert("danger", "Sorry I was not able to create your site.");
          $allset = false;
        }
        
        if($plan == "adm_business" || $plan == "adm_enterprise") {
          try {
            require_once(ROOTPATH . '/vendor/stripe-php-6.10.4/init.php');

            // Be sure to replace this with your actual test API key
            // (switch to the live key later)
            \Stripe\Stripe::setApiKey("sk_test_FUBp6ldL08vKSczhkbnxlWie");

            $customer = \Stripe\Customer::create(array(
              'email' => $_POST['stripeEmail'],
              'source'  => $_POST['stripeToken'],
            ));
            
            $user->id = $customer->id;
            
            $subscription = \Stripe\Subscription::create(array(
              'customer' => $customer->id,
              'items' => array(array('plan' => $plan_id)),
            ));
          } catch(Exception $e) {
            echo alert("danger", "Sorry I wasn't able to create subscription your account. error:" . $e->getMessage());
            $allset = false;
          }
        }

        if($allset) {
          $redirect = "http://" . $user->subdomain . ".autodealermanager.com/admin?first-time=1";
          echo alert("info", $redirect);
          header("Location: " . $redirect);
        } 
      }
    }
  ?>
  <form action="/?page=sign-up&plan=<?= $plan ?>" method="post">
    <div class="form-group">
      <label for="display_name">Your name</label>
      <input type="text" class="form-control" name="display_name" placeholder="Enter your name">
    </div>
    <div class="form-group">
      <label for="company">Company name</label>
      <input type="text" class="form-control" name="company" placeholder="Enter company name">
    </div>
    <div class="form-group">
      <label for="subdomain">Subdomain</label>
      <input type="text" class="form-control" name="subdomain" placeholder="example: your-company-name">
      <small id="subdomain-help" class="form-text text-muted">This is for your new website your-company-name.autodealermanager.com</small>
    </div>
    <?php if($plan == "free") : ?>
    <div class="form-group">
      <label for="stripeEmail">Email</label>
      <input type="email" class="form-control" name="stripeEmail" placeholder="Enter email address">
    </div>
    <?php endif; ?>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" name="password" placeholder="Enter password">
    </div>
    <div class="form-group">
      <label for="confirm_password">Confirm Password</label>
      <input type="password" class="form-control" name="confirm_password" placeholder="Confirm password">
    </div>
    <button type="submit" class="btn btn-primary">Sign Up!</button>
    <?php if($price) : ?>
    <!--Hiding the stripe button because there is no way to style it. dumb -->
    <style>.stripe-button-el { display: none }</style>
    <script
      src="https://checkout.stripe.com/checkout.js" class="stripe-button"
      data-key="pk_test_z6kl2zjAGcTFv1IyBwCKk5Ju"
      data-image="/img/car-lot.jpg"
      data-name="<?= $plan_name ?>"
      data-description="<?= $plan_description ?>"
      data-amount="<?= $price ?>"
      data-label="Sign Me Up!"
      >
    </script>
    <?php endif; ?>
  </form>
</div>
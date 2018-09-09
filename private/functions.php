<?php
// Lesson: you can't have dashes in your object key because it won't work and you won't know why it doesn't work. 
// However if you wrap it in curly braces and quotations it will work.
// Lesson: Don't add a comma at the end of the list or it won't decode and you won't know why
// Lesson: Don't add comments to the json file because it will consider it invalid json and return null.
function getJSON($file) {
  $path = DATABASE . "/" . $file;
  if(!file_exists($path)) {
    createJSON($file);
  }
  $json = file_get_contents($path);
  return json_decode($json);
}

function deleteJSON($filename) {
  $path = DATABASE . "/" . $filename;
  if(file_exists($path)) {
     return unlink($path);
  } else {
    return false;
  }
}

function createJSON($file, $data = null) {
  if(is_null($data)) {
    $data = array();
  }
  $data = json_encode($data, JSON_PRETTY_PRINT);
  if(!file_exists(DATABASE)) {
    mkdir(DATABASE);
  }
  return file_put_contents (DATABASE . "/" . $file, $data);
}

function saveJSON($data, $path) {
  $jsonString = json_encode($data, JSON_PRETTY_PRINT);
  return file_put_contents($path, $jsonString);
}

//Lesson: make sure to use return if you want to get back what another function returns. If you don't return you will get back NULL and not know why.
function login($email, $password) {
  foreach(getJSON("users.json") as $user) {
    if($email == $user->email && $password == $user->password) {
      $_SESSION['email'] = $user->email;
      return true;
    }
  }
  return false;
}

function getPassword() {
  $config = getJSON("settings.json");
  return $config->password;
}

function getSettings() {
  $settings_json = DATABASE."/settings.json";
  if(!file_exists($settings_json)) {
    //Create the settings json using the settings from the config file
    global $settings;
    saveJSON($settings, $settings_json);
    return $settings;
  }
  return getJSON("settings.json");
}

function include_file($path) {
  if(file_exists(ROOTPATH . "/includes" . $path)) {
    include(ROOTPATH . "/includes" . $path);
  } else {
    include(INCLUDES . $path);
  }
}

function controller() {
  switch($_GET['page']) {
    case "database":
      return array("databases" => getDatabase());
    case "json":
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
      return array("name"=>$name, "json" => $json);
  }
}

function render_view($path, $options) {
  $path = ROOTPATH . "/includes" . $path;
  if(file_exists($path)) {
    $pug = new Pug();
    return $pug->render($path, $options);
  } else {
    return false;
  }
}

function content($pages_path) {
  $default_home = ROOTPATH . $pages_path . "/default.php";
  $default_pug = ROOTPATH . $pages_path . "/default.pug";
  $pug = new Pug();
  if(empty($_GET['page'])) {
    if(file_exists($default_pug)) {
      return $pug->render($default_pug, array());
    } else {
      return (include $default_home);
    }
  } else {
    $php_path = ROOTPATH . $pages_path . "/" . $_GET['page'] . ".php";
    $pug_path = ROOTPATH . $pages_path . "/" . $_GET['page'] . ".pug";
    if(file_exists($pug_path)) {
      $controller = controller();
      return $pug->render($pug_path, $controller);
    } elseif(file_exists($php_path)) {
      return (include $php_path);
    } else {
      return (include $default_home);
    }
  }
}

function public_content() {
  content("/includes/pages");
}

function admin_content() {
  if(isset($_SESSION['email'])) { 
    echo render_view("/admin/nav.pug", array()); 
    echo content("/includes/admin/pages");
  } else {
    // Login
    $message = "";
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
      if(login($_POST['email'], $_POST['password'])) {
        header("Location: /admin?" . $_SERVER['QUERY_STRING'] );
      } else {
        $message = alert("danger", "Username or password is incorrect! Please try again.");
      }
    }
    echo render_view("/admin/login.pug", array(
      "query" => $_SERVER['QUERY_STRING'],
      "message" => $message
    ));
  }
}

function getData($property, $file) {
  //Update data if posting the data
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST[$property])) { 
    return htmlspecialchars($_POST[$property]);
  }
  
  //Get existing data for values with ids
  $json_data = getJSON($file);
  if(isset($_GET['id'])) {
    $id = $_GET['id'];
    foreach($json_data as $data) {
      if($id == $data->id && isset($data->{$property})) {
        return $data->{$property};
      }
    }
  }
  
  //Try to get values without ids for example settings data
  if(isset($json_data->$property)) {
    return $json_data->$property;
  }
  
  //Set new unique ids if one has not been set
  if($property == "id") {
    return uniqid();
  }
  
  //Set default value to null
  return null;
}

function getDataById($id, $property, $file) {
  $json_data = getJSON($file);
  if(isset($id)) {
    foreach($json_data as $data) {
      if($id == $data->id && isset($data->{$property})) {
        return $data->{$property};
      }
    }
    return false;
  }
  return false;
}

function getVideoById($id) {
  foreach(getVideoData() as $key => $video) {
    if($video->id == $id) {
      return $video;
    }
  }
  return false;
}

function getPhotoById($id) {
  foreach(getPhotoData() as $key => $photo) {
    if($photo->id == $id) {
      return $photo;
    }
  }
  return false;
}

function deleteRecordById($id, $file) {
  $data = getJSON($file);
  foreach($data as $key => $value) {
    if($value->id == $id) {
      unset($data[$key]);
      $newJsonString = json_encode(array_values($data), JSON_PRETTY_PRINT);
      return file_put_contents(DATABASE . "/" . $file, $newJsonString);
    }
  }
  return false;
}

function saveDataById($id, $data, $file) {
  
  $json = getJSON($file);
  $new = true;
  foreach($json as $key => $value) {
    if($value->id == $id) {
      $json[$key] = $data;
      $new = false;
    }
  }
  if($new) {
    array_push($json, $data);
  }
  return saveJSON($json, DATABASE . "/" . $file);  
}

function savePage($data, $content) {
  $path = ROOTPATH . "/includes/pages/" . $data->slug . ".php";
  $file_saved = file_put_contents($path, $content);
  $data_saved = saveDataById($data->id, $data, "pages.json");
  if($file_saved && $data_saved) {
    return true;
  } else {
    return false;
  }
}

function deletePage($file) {
  $path = INCLUDES . "/pages/" . $file;
  return unlink($path); 
}

function themeOptions() {
  $theme_dir = PUBLICPATH . "/css/themes";
  $html = "";
  $current_theme = getData("theme", "settings.json");
  if(file_exists($theme_dir)) {
    foreach(scandir($theme_dir) as $dir) {
      if($current_theme == $dir) {
        $selected = " selected";
      } else {
        $selected = "";
      }
      if($dir != "." && $dir != "..") {
        $html .= "<option value='$dir'$selected>$dir</option>";
      }
    }
    return $html;
  }
    return false;
}

function getFileNames($dir) {
  if(file_exists($dir)) {
    $filenames = array();
    foreach(scandir($dir) as $file) {
      if($file != "." && $file != "..") {
        array_push($filenames, $file);
      }
    }
    return $filenames;
  } else {
    return false;
  }
  
}

function is_active($page) {
  if($_GET['page'] == $page) {
    return " active";
  }
}

function install() { 
  mkdir (DATABASE, 0744);
  
  $config           = new stdClass();
  $config->title    = $_POST['title'];
  $config->email    = $_POST['email'];
  $config->password = $_POST['password'];
  
  createJSON("settings.json", $config);
  
  header('Location: /admin');
}

function alert($type, $message) {
  return "<div class=\"alert alert-$type\" role=\"alert\">" . $message . "</div>";
}

function uploadImage($name, $json) {
  if(isset($_FILES[$name])) {
    if(file_exists($_FILES[$name]['tmp_name'])) {
      $file_name =  basename($_FILES[$name]["name"]);
      $target_file = UPLOADS . "/" . $file_name;
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      // Check if image file is a actual image or fake image

      $check = getimagesize($_FILES[$name]["tmp_name"]);
      if($check !== false) {
          $uploadOk = 1;
      } else {
          echo alert("danger", "File is not an image.");
          $uploadOk = 0;
          return null;
      }
      // Check file size
      if ($_FILES[$name]["size"] > 500000) {
          echo alert("danger", "Sorry, your file is too large.");
          $uploadOk = 0;
          return null;
      }
      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) {
          echo alert("warning", "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
          $uploadOk = 0;
        return null;
      }
      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
          echo alert("warning", "Sorry, your file was not uploaded.");
        return null;
      // if everything is ok, try to upload file
      } else {
        //I'm making sure the public uploads directory is available
        //If it's not created by hand it will not have the correct permissions for php to move the image to it
        if(!file_exists(UPLOADS)) {
          mkdir(UPLOADS);
        }
        if (move_uploaded_file($_FILES[$name]["tmp_name"], $target_file)) {
          echo alert("success", "The file ". $file_name. " has been uploaded.");
          return $file_name;
        } else {
            echo alert("danger", "Sorry, there was an error uploading your file.");
          return null;
        }
      }
    }
  }
  return getData($name, $json);  
}

function getDatabase() {
  $dir = scandir(DATABASE);
  $files = array();
  foreach($dir as $file) {
    if($file != "." && $file != "..") {
      array_push($files, $file);
    }
  }
  return $files;
}

function getSitesData() {
  return getJSON("sites.json");
}

function getSiteById($id) {
  return getDataById($id, "sites.json") ;
}

function install_copy($target_path, $file_path) {
  if(!copy(ROOTPATH . $file_path, $target_path . $file_path)) {
    die($file_path . " File could not be copied.");
  }
}

function recurse_copy($src,$dst) { 
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
                recurse_copy($src . '/' . $file,$dst . '/' . $file); 
            } 
            else { 
                copy($src . '/' . $file,$dst . '/' . $file); 
            } 
        } 
    } 
    closedir($dir); 
} 

function getTemplateFiles() {
  $files = array();
  $pages = scandir(PAGES);
  foreach($pages as $page) {
    if($page != "." && $page != "..") {
      $files[] = $page;
    }
  }
  return $files;
}

function getID() { 
   if(isset($_GET['id'])) {
     return $_GET['id'];
   } else {
     return uniqid();
   }
}
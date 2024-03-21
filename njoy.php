<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
$target_dir = "upload/";
// echo "<pre>";
// print_r($_FILES);
// exit;
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
// echo "<pre>";
// print_r($target_file);
// exit;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $target_file = $target_dir . uniqid() . '.' . $imageFileType;
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//   echo "<pre>";
// print_r($check);
// exit;
  if($check !== false) {
    
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
//   echo "<pre>";
//  print_r($check);
// exit;
  }
  
   else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}


// Check if file already exists
// if (file_exists($target_file)) {
//   echo "Sorry, file already exists.";
//   $uploadOk = 0;
// echo "<pre>";
// print_r($target_file);
// exit;
// }

// Check file size
if ($_FILES["fileToUpload"]["size"] > 50000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "webp"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, wbep,PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else
{
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    echo "<img src='$target_file' alt='Uploaded Image'>";
  }
   else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>
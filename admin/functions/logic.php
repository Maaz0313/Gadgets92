<?php
if (!isset($_SESSION['ADMIN_LOGIN'])) {
    $_SESSION['fail_msg'] = "Please login first to access Admin Dashboard";
    header('location:login.php');
    exit(0);
}

function sanitize_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function hasTransparency($imagePath) {

  $imageInfo = getimagesize($imagePath);
  $imageType = $imageInfo[2]; 

  // Load the image based on its type
  switch ($imageType) {
      case IMAGETYPE_PNG:
          $image = imagecreatefrompng($imagePath);
          break;
      case IMAGETYPE_GIF:
          $image = imagecreatefromgif($imagePath); 
          break;
      case IMAGETYPE_WEBP:
          $image = imagecreatefromwebp($imagePath);
          break;
      default:
          return false; // Unsupported image type 
  }

  // Check for transparency
  for ($x = 0; $x < imagesx($image); $x++) {
      for ($y = 0; $y < imagesy($image); $y++) {
          $pixelColor = imagecolorat($image, $x, $y);
          $alpha = ($pixelColor >> 24) & 0xFF; 

          if ($alpha < 127) { // Adjust the threshold (127) if needed
              imagedestroy($image);
              return true; // Found a transparent pixel 
          }
      }
  }

  imagedestroy($image);
  return false; // No transparent pixels found
}
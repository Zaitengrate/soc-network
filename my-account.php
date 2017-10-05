<?php
include 'classes/DB.php';
include 'classes/Login.php';

if (Login::isLoggedIn()) {
  $userid = Login::isLoggedIn();
} else {
  die('Not logged in');
}

if (isset($_POST['uploadprofileimg'])) {

  Image::uploadImage('profileimg', "UPDATE users SET profileimg=:profileimg WHERE id=:userid", array(':userid'=>$userid));

}

 ?>

<h1>My account</h1>
<form action="my-account.php" method="post" enctype="multipart/form-data">
  Upload a profile image:
  <input type="file" name="profileimg">
  <button type="submit" name="uploadprofileimg">Upload image</button>
</form>

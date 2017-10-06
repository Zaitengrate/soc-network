<?php
include 'classes/DB.php';
include 'classes/Mail.php';

if (isset($_POST['resetpassword'])) {
  $cstrong = true;
  $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
  $email = $_POST['email'];
  $user_id = DB::query('SELECT id FROM users WHERE email=:email', array(':email'=>$email))[0]['id'];
  DB::query('INSERT INTO password_tokens VALUES (\'\', :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));
  Mail::sendMail('Forgot password', "<a href='http://localhost/php/social-network/change-password.php?token=$token'>Reset your password</a>", $email);
  echo "Email sent";

}


 ?>
<h1>Forgot Password</h1>
<form action="forgot-password.php" method="post">
  <input type="text" name="email" value="" placeholder="Email"><p />
  <button type="submit" name="resetpassword">Reset Password</button>
</form>

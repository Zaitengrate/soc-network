<?php
include 'classes/DB.php';

if (isset($_POST['createaccount'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];

  if (!DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))) {

    if (strlen($username) >= 3 && strlen($username) <= 32) {

      if (preg_match('/[a-zA-Z0-9_]+/', $username)) {

        if (strlen($password) >= 3 && strlen($password) <=60) {

          if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            if (!DB::query('SELECT email FROM users WHERE email=:email', array(':email'=>$email))) {

              DB::query('INSERT INTO users VALUES (\'\',:username, :password, :email, \'0\', \'\')', array(':username'=>$username,
                        ':password'=>password_hash($password, PASSWORD_BCRYPT),':email'=>$email));
                        echo "Success!";
            } else {
              echo "Email is already taken";
            }
          } else {
            echo "Invalid email";
          }
        } else {
          echo "Password is too short or long";
        }
      } else {
        echo "Invalid charachters in username";
      }
    } else {
      echo "Username is too short or long";
    }
  } else {
    echo "User already exist";
  }
}
?>

<h1>Register</h1>
<form action="create-account.php" method="post">
  <input type="text" name="username" value="" placeholder="Username"><p />
  <input type="password" name="password" value=""placeholder="Password"><p />
  <input type="text" name="email" value="" placeholder="Email"><p />
  <button type="submit" name="createaccount" value="Create Account">Create Account</button><p />
</form>

<?php

include('../../app.php');

if (isset($_POST['email']) && isset($_POST['password'])) {

  if ($user->sign_in($_POST['email'], $_POST['password'])) {
      //echo json_encode('You are loggged in!');
      header('Location: http://ec2-54-88-87-181.compute-1.amazonaws.com');
  } else {
      echo json_encode('Email or password is incorrect!');
  }
}

?>

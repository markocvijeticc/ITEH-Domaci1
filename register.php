<?php

require 'dbBroker.php';
require 'model/ucenik.php';
require 'model/ucitelj.php';

if (isset($_POST['submit'])) {

  $user = mysqli_real_escape_string($conn, $_POST['username']);
  $ime = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $password1 = mysqli_real_escape_string($conn, $_POST['confirm_password']);

  if ($password == $password1) {

    $result = Ucenik::check($user, $conn);
    $resultUcitelj = Ucitelj::check($user, $conn);

    if (mysqli_num_rows($result) != 0) {
      echo "<script>alert('Korisnicko ime je zauzeto');</script>";
    } else {
      if (mysqli_num_rows($resultUcitelj) != 0) {
        echo "<script>alert('Korisnicko ime je zauzeto');</script>";

      } else {

        Ucenik::add($ime, $email, $user, $password, $conn);
        header("location: login.php");
      }
    }
  } else {

    echo "<script>alert('Sifre se ne poklapaju');</script>";
  }

}

?>


<!DOCTYPE html>
<html>

<head>
  <title>Registruj se</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <style>
    form {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"] {
      margin: 8px 0;
      width: 20%;
      height: 5%;
      font-size: 1.8em;
      color: black;
      background-color: white;
    }

    label {
      font-size: 1.6em;
      font-weight: bold;
      font-family: Arial, Helvetica, sans-serif;
      color: #024C7D;
    }

    input[type="submit"] {
      font-size: 1.4em;
      width: 250px;
      color: white;
      background-color: #024C7D;
    }

    body {
      background-color: white;
    }
  </style>
</head>

<body>
  <form method="POST">
    <label for="name">Ime:</label>
    <input type="text" id="name" name="name">
    <label for="username">Korisnicko ime:</label>
    <input type="text" id="username" name="username">
    <label for="password">Lozinka:</label>
    <input type="password" id="password" name="password">
    <label for="confirm_password">Potvrdite lozinku:</label>
    <input type="password" id="confirm_password" name="confirm_password">
    <label for="email">E-Mail:</label>
    <input type="email" id="email" name="email">
    <input type="submit" name="submit" value="REGISTUJ SE">
  </form>

  <div class="card-footer" style="text-align: center; color:#024C7D;">
    <div class="d-flex justify-content-center links">
     Vec registovani? <a href="login.php" style="color: #024C7D" >Prijavite se!</a>
    </div>

  </div>

</body>

</html>
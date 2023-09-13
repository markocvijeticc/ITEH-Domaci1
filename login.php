<?php

require "dbBroker.php";
require "model/ucitelj.php";
require "model/ucenik.php";
require "model/cas.php";



session_start();


if (isset($_POST['submit'])) {

  $u = $_POST['username'];
  $p = $_POST['password'];

  Cas::ocisti($conn);

  $result = Ucitelj::login($u, $p, $conn);

  if ($result->num_rows != 0) {
    echo "<script>alert('Uspesno ste se prijavili kao profesor!');</script>";
    $_SESSION['ucitelj'] = $u;
    header("Location: homeUcitelj.php");
    exit();

  } else {
    $result = Ucenik::login($u, $p, $conn);

    if ($result->num_rows != 0) {
      echo "<script>alert('Uspesno ste se prijavili kao student!');</script>";
      $_SESSION['ucenik'] = $u;
      $_SESSION['ime'] = Ucenik::vratiIme($u, $conn);
      header("Location: index.php");
      exit();
    } else {
      echo "<script>alert('Netacno ime ili lozinka');</script>";

    }

  }


}

?>

<!DOCTYPE html>

<html>

<head>
  <title>FON Konsultacije</title>
  <style>
    body {
      background-color: white;
      font-family: Helvetica;
    }

    

    .form-group {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
    }

    .form-group label {
      width: 120px;
      margin-right: 10px;
    }

    .form-group button {
      margin-left: auto;
    }


    .login-container {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
      position: relative;
      top: 20%;
    }


    form {
      display: flex;
      align-items: center;
    }

    input[type="text"],
    input[type="password"],
    button {
      padding: 12px 20px;
      margin: 8px 0;
      width: 200px;
      display: inline-block;
      border: none;
      box-sizing: border-box;
      background-color: #024C7D;
      color: white;
    }

    img {
      width: 50%;
      display: block;
      margin: 0 auto;
      margin-top: 20px;
    }

    label {
      color: #174075;
    }
  </style>
</head>

<body>
  <div class="login-container">
    <img src="img/FakultetLogo.jpg" alt="logo">
    <form method="POST">
      
      <div class="form-container">
        <div class="form-group">
          <label for="username">Korisničko ime:</label>
          <input type="text" id="username" name="username">
        </div>
        <div class="form-group">
          <label for="password">Lozinka:</label>
          <input type="password" id="password" name="password">
        </div>
        <div class="form-group">
          <button name="submit" type="submit">Prijavite se</button>
        </div>
      </div>
    </form>
   
    <div class="card-footer" style="text-align: center; color:white;">
      <div class="d-flex justify-content-center links">
       <a href="register.php" style="color: blue">Registujte se</a>
      </div>

    </div>
</body>

</html>
<?php

require "dbBroker.php";
require "model/cas.php";
require "model/ucenik.php";
require "model/ucitelj.php";

session_start();

if (empty($_SESSION['ucenik']) || $_SESSION['ucenik'] == '') {
  header("Location: login.php");
  die();
}

$ucn = $_SESSION['ucenik'];
$result = Cas::sledeciCas($_SESSION['ucenik'], $conn);

if (!$result) {
  echo "<script>alert('Greska kod upita');</script>";
}

if ($result->num_rows == 0) {
  // echo "<script>alert('Niste zakazali cas');</script>";
  // die();
}

$ucitelji = Ucitelj::getAll($conn);

if (!$ucitelji) {
  echo "<script>alert('Greska kod upita');</script>";
}

if ($ucitelji->num_rows == 0) {
  echo "<script>alert('Nema ucitelja');</script>";
}


?>

<!DOCTYPE html>
<html>

<head>
  <title>FON Konsultacije</title>
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <style>
    
    body {
      background-color: white;
    }

    .container {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
      position: relative;
      top: 20%;
    }

    
    img {
      width: 10%;
      
      display: block;
      margin: 0 auto;
      
      align-self: flex-start;
      
    }

    
    .text-block {
      background-color: #014B7B;
      color: white;
      padding: 20px;
      margin: 20px;
      width: 60%;
    }
  </style>
</head>

<body>
  <div class="container">
    <img src="img/FonMaliLogo.jpg" alt="logo">
    <div class="text-block">
      <p>
        <?php echo date('Y-m-d H:i:s'); ?><br>Dobrodošli
        <?php echo $ucn; ?>!<br>Dobrodošli na zvanični sajt Fakulteta organizacionih nauka za zakazivanje konsultacija sa profesorima! Ovaj sajt vam omogućava da lako i brzo zakažete konsultacije sa profesorima iz različitih oblasti.

Da biste zakazali konsultaciju, potrebno je da odaberete profesora i datum i vreme konsultacije.
      </p>
      <table>
        <tr>
          <th>Datum</th>
          <th>Vreme</th>
          <th>Profesor</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td>
              <?php echo $row['datum']; ?>
            </td>
            <td>
              <?php echo $row['vreme']; ?>
            </td>
            <td>
              <?php echo $row['ime']; ?>
            </td>
          </tr>
          <?php
        }
        ?>
      </table>
      <div class="btns">
        <form action="zakaziCas.php" method="get">
          <input type="submit" value="Zakaži čas">
        </form>
        <form action="listaucitelja.php" method="get">
          <input type="submit" value="Lista učitelja">
        </form>
      </div>
    </div>
    <style>
      table {
        width: 80%;
        margin: 0 auto;
        border-collapse: collapse;
      }

      th {
        background-color: #343541;
        color: white;
        padding: 10px;
        text-align: left;
      }

      td {
        background-color: #444654;
        color: white;
        padding: 10px;
      }

      button {
        background-color: #343541;
        color: white;
        padding: 10px 20px;
        margin: 10px 0;
        border: none;
        cursor: pointer;
      }

      button:hover {
        background-color: #444654;
      }

      .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
      }

      
      p {
        font-family:  Helvetica;
        font-size: 1.6em;
        text-align: center;
        margin: 20px 0;
        
      }

      / .btns {
        display: flex;
        justify-content: center;
        background-color: white;
      }

      .btns a {
        color: black;
      }
    </style>
    <div class="card-footer" style="text-align: center; color:white;">
      <div class="d-flex justify-content-center links">
        <a href="logout.php" style="color: black">IZLOGUJTE SE</a>
      </div>

</body>

</html>
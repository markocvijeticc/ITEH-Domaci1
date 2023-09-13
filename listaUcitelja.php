<?php
require "dbBroker.php";
require "model/ucitelj.php";

$ucitelji = Ucitelj::getAll($conn);

?>

<!DOCTYPE html>
<html>

<head>
  <title>Lista profesora</title>
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <style>
   
    table {
      margin: 0 auto;
      width: 50%;
      border-collapse: collapse;
      background-color: #343541;
      color: white;
    }

    
    th {
      border-bottom: 1px solid white;
      padding: 10px;
      font-size: 1.2em;
      background-color: #014B7B;
    }

   
    td {
      border-bottom: 1px solid white;
      padding: 10px;
      font-size: 1.2em;
      background-color: #014B7B;
    }

    tr {
      text-align: center;
    }

    
    .button {
      background-color: #343541;
      color: white;
      padding: 12px 20px;
      margin: 8px 0;
      width: 200px;
      display: inline-block;
      border: none;
      
      box-sizing: border-box;
    }
  </style>
</head>

<body>
  <h1>Lista profesora</h1>
  <table>
    <thead>
      <tr>
        <th>Ime</th>
        <th>Iskustvo</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($ucitelj = $ucitelji->fetch_assoc()): ?>
        <tr>
          <td>
            <?php echo $ucitelj['ime']; ?>
          </td>
          <td>
            <?php echo $ucitelj['iskustvo']; ?>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <div class="card-footer" style="position: fixed; bottom: 20px; left: 0; right: 0; text-align: center; color: white;">
    <div class="d-flex justify-content-center links">
      POVRATAK <a href="index.php" style="color: white">NAZAD</a>
    </div>
  </div>

</body>

</html>
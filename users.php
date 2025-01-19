<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="app.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
  </head>
  <body>
<header>
      <div class="left-header"><h3>Library SMK</h3></div>
      <div class="center-buttons">
        <button onclick="booksredirect()">Ksiegozbior</button> <button onclick="rentalsredirect()">Wypozyczenia</button><button onclick="usersredirect()">Uzytkownicy</button>
      </div>
      <div class="right-header">
        <img src="" alt="Profile logo" srcset="" />
      </div>
    </header>
    <main>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library_system";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Połączenie z bazą danych nie powiodło się: " . $conn->connect_error);
}

$readers = $conn->query("SELECT * FROM czytelnicy");
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Users</title>
</head>
<body>
    <h1>Baza użytkowników</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nazwisko</th>
            <th>Email</th>
        </tr>
        <?php while ($row = $readers->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["nazwisko"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
<?php $conn->close(); ?>
<footer>
  <div class="left-footer">
  W stopce nic nie ma pozdrawiamy
  </div>
  <div class="right-footer">
    <p>Mateusz<a href="https://github.com/mxtysboss">Github</a></p>
    <p>Andrzej</p>
    <p>Michał</p>
  </div>
</footer>
</body>
<script src="closePopup.js"></script>
<script src="redirects.js"></script>
</html>


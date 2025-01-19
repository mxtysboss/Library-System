<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Połączenie z bazą danych nie powiodło się: " . $conn->connect_error);
}

$user_email = $_POST["user-email"];
$user_password = $_POST["user-password"];
$user_role = $_POST["user-role"];

setcookie("user_email", $user_email, time() + 3600);
setcookie("user_role", $user_role, time() + 3600);

$logged = "wrongpass";
if ($user_role == "czytelnik") {
    $sql = "SELECT email, haslo FROM Czytelnicy WHERE email = '$user_email'";
} elseif ($user_role == "bibliotekarz") {
    $sql = "SELECT email, haslo FROM Bibliotekarze WHERE email = '$user_email'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    //  hasła
    if ($row["haslo"] == $user_password) {
        $logged = "zalogowano";
    } else {
    }
} else {
}

echo '<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="app.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>' .
    $user_role .
    ' Dashboard</title>
</head>
<body class="' .
    $logged .
    '">';
if ($logged == "zalogowano") {
    if ($user_role == "czytelnik") {
        echo '
        <header>
      <div class="left-header"><h3>Library SMK</h3></div>
      <div class="center-buttons">
        <button onclick="rentredirect()">Wypożycz</button><button onclick="givebackredirect()">Do oddania</button>
      </div>
      <div class="right-header">
        <img src="" alt="Profile logo" srcset="" />
      </div>
    </header>
    <main id="index">
      <section>
        <div class="hero-user">Witaj ' .
            $user_email .
            " jestes zalogowany jako " .
            $user_role .
            '</div>
      </section>
    </main>
    <footer>
      <div class="left-footer">
        W stopce nic nie ma pozdrawiamy
      </div>
      <div class="right-footer">
        <p>Mateusz<a href="https://github.com/mxtysboss">Github</a></p>
        <p>Andrzej</p>
        <p>Michał</p>
      </div>
    </footer>';
    } elseif ($user_role == "bibliotekarz") {
        echo '        <header>
      <div class="left-header"><h3>Library SMK</h3></div>
      <div class="center-buttons">
        <button onclick="booksredirect()">Ksiegozbior</button> <button onclick="rentalsredirect()">Wypozyczenia</button><button onclick="usersredirect()">Uzytkownicy</button>
      </div>
      <div class="right-header">
        <img src="" alt="Profile logo" srcset="" />
      </div>
    </header>
    <main id="index">
      <section>
        <div class="hero-user">Witaj ' .
            $user_email .
            " jestes zalogowany jako " .
            $user_role .
            '</div>
      </section>
    </main>
    <footer>
      <div class="left-footer">
       W stopce nic nie ma pozdrawiamy
      </div>
      <div class="right-footer">
        <p>Mateusz<a href="https://github.com/mxtysboss">Github</a></p>
        <p>Andrzej</p>
        <p>Michał</p>
      </div>
    </footer>';
    }
} else {
    echo '        <header>
        <div class="left-header"><h3>Library SMK</h3></div>

        <div class="right-header">
          <img src="" alt="Profile logo" srcset="" />
        </div>
      </header>
      <main id="index"> 
        <section>
          <div class="hero-user">Powrot do strony logowania</div>
          <button class="back-login-btn" onclick="wroc()">Wróć</button>
        </section>
      </main>
      <footer>
        <div class="left-footer">
          W stopce nic nie ma pozdrawiamy
        </div>
        <div class="right-footer">
          <p>Mateusz<a href="https://github.com/mxtysboss">Github</a></p>
          <p>Andrzej</p>
          <p>Michał</p>
        </div>
      </footer>';
}

echo '
<script src="popup.js"></script>
<script src="redirects.js"></script>
</body>
</html>
';

$conn->close();

?>

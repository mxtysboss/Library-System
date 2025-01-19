<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="app.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Do oddania</title>
  </head>
  <body>
  <header>
      <div class="left-header" ><h3>Library SMK</h3></div>
      <div class="center-buttons">
        <button onclick="rentredirect()">Wypożycz</button><button onclick="givebackredirect()">Do oddania</button>
      </div>
      <div class="right-header">
        <img src="" alt="Profile logo" srcset="" />
      </div>
    </header>
    <main id="index">

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Połączenie z bazą danych nie powiodło się: " . $conn->connect_error);
}

$user_email = $_COOKIE["user_email"];
$user_role = $_COOKIE["user_role"];

$useridsql = "SELECT id FROM czytelnicy WHERE email='$user_email'";
$result = $conn->query($useridsql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_id = $row["id"];

    $listsql =
        "SELECT id, tytul_ksiazki, id_ksiazki, data_terminu_oddania FROM wypozyczenia WHERE id_osoby = ? AND status = 'nie'";

    if ($stmt = $conn->prepare($listsql)) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='books'>
                        Tytuł książki: " .
                    $row["tytul_ksiazki"] .
                    " | Termin oddania: " .
                    $row["data_terminu_oddania"] .
                    "
                        <form method='POST'>
                            <input type='hidden' name='book_id' value='" .
                    $row["id_ksiazki"] .
                    "'>
                            <button type='submit' name='submit_button' value='" .
                    $row["id"] .
                    "'>Oddaj książkę</button>
                        </form>
                    </div>";
            }
        } else {
            echo "Brak wypożyczonych książek do oddania.";
        }

        $stmt->close();
    }
}

if (isset($_POST["submit_button"])) {
    $return_id = $_POST["submit_button"];
    $book_id = $_POST["book_id"];
    returnBook($conn, $return_id, $book_id);
}

function returnBook($conn, $return_id, $book_id)
{
    $updatesql = "UPDATE wypozyczenia SET status = 'oddana' WHERE id = ?";

    if ($stmt = $conn->prepare($updatesql)) {
        $stmt->bind_param("i", $return_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $updateBookQty =
                "UPDATE ksiazka SET ilosc = ilosc + 1 WHERE id = ?";
            if ($bookStmt = $conn->prepare($updateBookQty)) {
                $bookStmt->bind_param("i", $book_id);
                $bookStmt->execute();
                $bookStmt->close();
            }

            echo "<p id='returnBookInfo'>Twoja książka została pomyślnie oddana! <button onclick='closePopup()'>X</button></p>";
        }

        $stmt->close();
    }
}

$conn->close();
?>    
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
</footer>
</body>
<script src="closePopup.js"></script>
<script src="redirects.js"></script>
</html>

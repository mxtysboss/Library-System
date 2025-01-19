<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="app.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wypożycz</title>
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

if (isset($_COOKIE["user_email"]) && isset($_COOKIE["user_role"])) {
    $user_email = $_COOKIE["user_email"];
    $user_role = $_COOKIE["user_role"];

    if ($stmt = $conn->prepare("SELECT id FROM czytelnicy WHERE email = ?")) {
        $stmt->bind_param("s", $user_email); 
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row["id"];

            $listsql = "SELECT id, tytul, autor FROM ksiazka WHERE ilosc > 0";

            if ($stmt = $conn->prepare($listsql)) {
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='books'>
                                Tytuł książki: " .
                            $row["tytul"] .
                            " | Autor: " .
                            $row["autor"] .
                            "
                                <form method='POST'>
                                    <button type='submit' name='submit_button' value='" .
                            $row["id"] .
                            "'>Wypożycz książkę</button>
                                </form>
                              </div>";
                    }
                } else {
                    echo "Brak dostępnych książek.";
                }
                $stmt->close();
            }
        } else {
            echo "Nie znaleziono użytkownika.";
        }
    } else {
        echo "Błąd zapytania do bazy danych.";
    }
} else {
    echo "Brak wymaganych danych użytkownika.";
}

if (isset($_POST["submit_button"])) {
    $book_id = $_POST["submit_button"];
    rentBook($conn, $book_id, $user_id);
}

function rentBook($conn, $book_id, $user_id)
{
    $book_sql = "SELECT tytul FROM ksiazka WHERE id = ?";
    if ($stmt = $conn->prepare($book_sql)) {
        $stmt->bind_param("i", $book_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $book_title = $row["tytul"];

        $current_date = date("Y-m-d");

        $return_date = date("Y-m-d", strtotime("+7 days"));

        $insert_sql = "INSERT INTO wypozyczenia (id_osoby, tytul_ksiazki, id_ksiazki, data_wypozyczenia, data_terminu_oddania, status) 
                       VALUES (?, ?, ?, ?, ?, 'nie')";
        if ($stmt = $conn->prepare($insert_sql)) {
            $stmt->bind_param(
                "issss",
                $user_id,
                $book_title,
                $book_id,
                $current_date,
                $return_date
            );
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $updateBookQty =
                    "UPDATE ksiazka SET ilosc = ilosc - 1 WHERE id = ? AND ilosc > 0";
                if ($bookStmt = $conn->prepare($updateBookQty)) {
                    $bookStmt->bind_param("i", $book_id);
                    $bookStmt->execute();
                    $bookStmt->close();
                }

                echo "<p id='returnBookInfo'>Twoja książka została pomyślnie wypożyczona! <button onclick='closePopup()'>X</button></p>";
            } else {
                echo "<p>Wystąpił błąd podczas wypożyczania książki.</p>";
            }

            $stmt->close();
        }
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

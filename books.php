<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="app.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Księgozbiór</title>
  </head>
  <body>
    <header>
      <div class="left-header" ><h3>Library SMK</h3></div>
      <div class="center-buttons">
        <button onclick="booksredirect()">Ksiegozbior</button> 
        <button onclick="rentalsredirect()">Wypozyczenia</button>
        <button onclick="usersredirect()">Uzytkownicy</button>
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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["add_book"])) {
        $title = $_POST["title"];
        $author = $_POST["author"];
        $quantity = $_POST["quantity"];

        $stmt = $conn->prepare(
            "INSERT INTO ksiazka (tytul, autor, ilosc) VALUES (?, ?, ?)"
        );
        $stmt->bind_param("ssi", $title, $author, $quantity);
        $stmt->execute();
        $stmt->close();
    }

    if (isset($_POST["delete_book"])) {
        $book_id = $_POST["book_id"];
        $stmt = $conn->prepare("DELETE FROM ksiazka WHERE id = ?");
        $stmt->bind_param("i", $book_id);
        $stmt->execute();
        $stmt->close();
    }

    if (isset($_POST["increase_quantity"])) {
        $book_id = $_POST["book_id"];
        $stmt = $conn->prepare(
            "UPDATE ksiazka SET ilosc = ilosc + 1 WHERE id = ?"
        );
        $stmt->bind_param("i", $book_id);
        $stmt->execute();
        $stmt->close();
    }

    if (isset($_POST["decrease_quantity"])) {
        $book_id = $_POST["book_id"];
        $stmt = $conn->prepare(
            "UPDATE ksiazka SET ilosc = ilosc - 1 WHERE id = ? AND ilosc > 0"
        );
        $stmt->bind_param("i", $book_id);
        $stmt->execute();
        $stmt->close();
    }
}

$result = $conn->query("SELECT * FROM ksiazka");
?>

    <h1>Księgozbiór</h1>
    <form method="POST">
        <h2>Dodaj książkę</h2>
        <input type="text" name="title" placeholder="Tytuł książki" required>
        <input type="text" name="author" placeholder="Autor" required>
        <input type="number" name="quantity" placeholder="Ilość" required>
        <button type="submit" name="add_book">Dodaj</button>
    </form>
    <h2>Lista książek</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Tytuł</th>
            <th>Autor</th>
            <th>Ilość</th>
            <th>Akcja</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["tytul"]; ?></td>
                <td><?php echo $row["autor"]; ?></td>
                <td><?php echo $row["ilosc"]; ?></td>
                <td>
                    <form method="POST" style="display: inline;">
                        <input type="hidden" name="book_id" value="<?php echo $row[
                            "id"
                        ]; ?>">
                        <button type="submit" name="increase_quantity">+</button>
                    </form>
                    <form method="POST" style="display: inline;">
                        <input type="hidden" name="book_id" value="<?php echo $row[
                            "id"
                        ]; ?>">
                        <button type="submit" name="decrease_quantity">-</button>
                    </form>
                    <form method="POST" style="display: inline;">
                        <input type="hidden" name="book_id" value="<?php echo $row[
                            "id"
                        ]; ?>">
                        <button type="submit" name="delete_book">Usuń</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>

<?php $conn->close(); ?>
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

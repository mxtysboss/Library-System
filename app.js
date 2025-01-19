document
  .querySelector("#login-form-btn")
  .addEventListener("click", function () {
    document.querySelector("#index").innerHTML =
      '<section><form action="dashboard.php" method="POST"> <h3></h3>Email:<input type="email" name="user-email"><br>Haslo: <input type="password" name="user-password"><br>Wybierz rolę:<select name="user-role" required><option value="czytelnik">Czytelnik</option><option value="bibliotekarz">Bibliotekarz</option></select><br><button class="login-button" id="login-btn">LOG IN</button></form></section>';
  });

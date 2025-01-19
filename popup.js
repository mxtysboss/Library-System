window.addEventListener("load", (event) => {
  let popup = document.createElement("div");
  popup.className = "popup";

  if (document.body.className == "zalogowano") {
    popup.innerHTML = "Zalogowano pomyślnie!";
  } else {
    popup.innerHTML = "Nieudana próba zalogowania!";
  }

  document.body.appendChild(popup);

  setTimeout(() => {
    popup.remove();
  }, 5000);
});





const mood = sessionStorage.getItem("userMood");
  fetch("recommend.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ mood: mood })
  })
  
  .then(res => res.json())
  .then(data => {
    const bookResults = document.getElementById("bookResults");
    data.books.forEach(book => {
    const card = document.createElement("div");
    card.className = "book-card";
    card.innerHTML = `
    <span class="fav-icon" onclick="saveFavorite(event, this, ${book.book_id})" title="Add to Favorites">&#10084;</span>
    <img src="${book.cover_image_url}" onclick="showDetail(${book.book_id})">
    <h3>${book.title}</h3>
    <p>${book.author}</p>
  `;
  bookResults.appendChild(card);
  });
  });

  function showDetail(bookId) {
    fetch("book_detail.php?book_id=" + bookId)
      .then(res => res.text())
      .then(html => {
        document.getElementById("modalContent").innerHTML = html;
        document.getElementById("modal").style.display = "flex";
      });
  }

  function saveFavorite(event, icon, bookId) {
    event.stopPropagation();
    fetch("save_favourites.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ book_id: bookId })
    })
    .then(res => res.json())
    .then(data => {
      alert(data.message || "Book saved!");
      icon.classList.add("saved");
    });
  }

  window.onclick = function(event) {
    const modal = document.getElementById("modal");
    if (event.target === modal) {
      modal.style.display = "none";
    }
  }
  
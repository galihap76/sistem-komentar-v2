document.addEventListener("DOMContentLoaded", function () {
  loadComments();

  let name = document.getElementById("name");
  let textarea = document.getElementById("comment");
  let btnSubmit = document.getElementById("btnSubmit");
  let btnEdit = document.getElementById("btnEdit");
  let btnCancel = document.getElementById("btnCancel");
  let parent_id = document.getElementById("parent_id");

  document.addEventListener("click", function (e) {
    if (e.target && e.target.classList.contains("edit")) {
      let id = e.target.getAttribute("data-id");

      btnSubmit.style.display = "none";
      btnEdit.style.display = "block";
      btnCancel.style.display = "block";

      btnCancel.addEventListener("click", function () {
        btnSubmit.style.display = "block";
        btnEdit.style.display = "none";
        btnCancel.style.display = "none";
      });

      btnEdit.addEventListener("click", function () {
        let newName = document.getElementById("name").value; // Mengambil nilai dari input dengan ID "name"
        let newComment = document.getElementById("comment").value; // Mengambil nilai dari textarea dengan ID "comment"

        fetch("update_comment.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: "id=" + id + "&name=" + newName + "&comment=" + newComment,
        })
          .then((response) => {
            if (response.status === 200) {
              name.value = "";
              textarea.value = "";
              btnSubmit.style.display = "block";
              btnEdit.style.display = "none";
              btnCancel.style.display = "none";
              loadComments();
            }
          })
          .catch((error) => {
            console.error("Error:", error);
          });
      });
    }
  });

  document.addEventListener("click", function (e) {
    if (e.target && e.target.classList.contains("delete")) {
      let id = e.target.getAttribute("data-id");
      if (confirm("Anda yakin ingin menghapus komentar ini?")) {
        fetch("delete_comment.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: "id=" + id,
        })
          .then((response) => {
            if (response.status === 200) {
              // Reload komentar setelah menghapus
              loadComments();
            }
          })
          .catch((error) => {
            console.error("Error:", error);
          });
      }
    }
  });

  btnSubmit.addEventListener("click", function () {
    let formData = new FormData(document.getElementById("comment_form"));

    fetch("add_comment.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
        loadComments();
        name.value = "";
        textarea.value = "";
        parent_id.value = "0";
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });

  document.addEventListener("click", function (e) {
    if (e.target && e.target.classList.contains("reply")) {
      var id = e.target.getAttribute("id");
      parent_id.value = id;
      name.focus();
    }
  });

  function loadComments() {
    let userComments = document.getElementById("userComments");

    fetch("display_comments.php")
      .then((response) => response.text())
      .then((data) => {
        userComments.innerHTML = data;
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }
});

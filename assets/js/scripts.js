// Update Model variables
const updateTitle = document.getElementById("newTitle");
const updateAuthor = document.getElementById("newAuthor");
const updateContent = document.getElementById("newContent");
const updateCategory = document.getElementById("newCategory");
const updateDatePub = document.getElementById("newPubDate");
const articleId = document.getElementById("articleId");

// initializeBook function fills the update book model inputs
function initArt(index) {
  let dataInfo = document.getElementById(index).getAttribute("data-info");
  let arr = dataInfo.split(",");
  updateTitle.value = arr[0];
  updateAuthor.value = arr[1];
  updateContent.value = arr[2];
  updateCategory.value = arr[3];
  updateDatePub.value = arr[4];
  articleId.value = index;
}

// resetBookForm Function resets the forms inputs
function resetArticleForm() {
    document.getElementById("form-article").reset();
  }
  // wrapside function to control the show & hide of sidebar
  function wrapside() {
    let side = document.querySelector("#wrapper");
    side.classList.toggle("toggled");
  }
  
  $(document).ready(function () {
    $('#data-table').DataTable();
  });
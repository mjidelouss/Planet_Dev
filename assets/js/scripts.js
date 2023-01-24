// Update Model variables
const updateTitle = document.getElementById("newTitle");
const updateAuthor = document.getElementById("newAuthor");
const updateCategory = document.getElementById("newCategory");
const articleId = document.getElementById("articleId");

// initializeBook function fills the update book model inputs
function initArt(index) {
  let dataInfo = document.getElementById(index).getAttribute("data-info");
  let arr = dataInfo.split(",");
  updateTitle.value = arr[0];
  updateAuthor.value = arr[1];
  CKEDITOR.instances['newContent'].setData(arr[2]);
  updateCategory.value = arr[3];
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

$(document).ready(function() {
    $(document).on('click', '.delete-article', function() {
        $(this).closest('.dynamic-form').remove();
    });
});

var count = 0;
function addArticleForm(){
    var form = `<div class="dynamic-form">
    <input type="text" placeholder="Title" class="form-control mb-2" name="title[]" required>
    <input type="text" placeholder="Author" class="form-control mb-2" name="author[]" required />
    <select class="form-control mb-2" name="category[]" required>
        <option disabled selected>Category</option>
        <option value="1">FrontEnd</option>
        <option value="2">BackEnd</option>
        <option value="3">Network</option>
        <option value="4">Cloud</option>
        <option value="5">DevOps</option>
        <option value="6">Big Data</option>
        <option value="7">UI & UX</option>
        <option value="8">Web</option>
        <option value="9">Cyber Security</option>
    </select>
    <textarea type="text" placeholder="Content" class="form-control ckeditor" row="3" name="content[]"></textarea>
    <input type="button" value="Delete Article" class="form-control btn btn-danger mt-2 p-3 delete-article">
</div>`;
    $("#form-container").append(form);
    var textareas = document.querySelectorAll("textarea[name='content[]']");
    CKEDITOR.replace(textareas[count]);
    count++;
}
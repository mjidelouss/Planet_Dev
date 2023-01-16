// resetBookForm Function resets the forms inputs
function resetBookForm() {
    document.getElementById("form-book").reset();
  }
  // wrapside function to control the show & hide of sidebar
  function wrapside() {
    let side = document.querySelector("#wrapper");
    side.classList.toggle("toggled");
  }
  
  $(document).ready(function () {
    $('#data-table').DataTable();
  });
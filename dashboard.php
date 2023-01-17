<?php
include "includes/autoloader.php";
session_start();
// if (!isset($_SESSION['connected'])) {
//     header("location: sign_in.php");
// }
$admin = new Admin;
if (isset($_POST['save'])) {
    $admin->add_article($_POST['title'], $_POST['author'], $_POST['category'], $_POST['content'], $_POST['pubDate']);
}
if (isset($_POST['delid'])) {
    $admin->delete_article($_POST['delid']);
}
if (isset($_POST['update'])) {
    $admin->update_article($_POST['newTitle'], $_POST['newAuthor'], $_POST['newContent'], $_POST['newCategory'], $_POST['newPubDate']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard</title>
    <!-- ================== BEGIN core-css ================== -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="assets/css/default/app.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" />
    <!-- ================== END core-css ================== -->
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading ms-2 py-4 text-black fs-4 fw-bold text-uppercase border-bottom"><i
                    class=""></i>Planet <span style="color: hsl(218, 81%, 75%)">DEV</span>
            </div>
            <div class="list-group list-group-flush my-3">
                <a href="#" class="list-group-item list-group-item-action bg-transparent active"><i
                        class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text text-black fw-bold"
                    onclick="resetArticleForm()" data-bs-toggle="modal" data-bs-target="#modal-article"><i
                        class="fa fa-plus me-2 text-black"></i>Add Article</a>
                <a href="./logout.php"
                    class="list-group-item list-group-item-action bg-transparent second-text fw-bold text-danger"><i
                        class="fas fa-power-off me-2 text-danger"></i>Logout</a>
            </div>
        </div>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-bars primary-text fs-4 me-3" style="color: black; cursor: pointer;"
                        id="controlPanel" onclick="wrapside()"></i>
                    <h2 class="fs-2 m-0 text-black">Dashboard</h2>
                </div>
            </nav>
            <!-- Welcome user Message -->
            <div class="container-fluid px-4">
                <div class="row g-3 my-2">
                    <div class="col-lg-2 col-md-4 col-sm-5">
                        <div class="p-2 bg-white d-flex justify-content-around align-items-center rounded">
                            <div>
                                <p class="fs-5 text-black">Total Articles</p>
                            </div>
                            <i class="fas fa-newspaper fs-1 text-info border rounded-full p-3 ms-1" style="background-color: white;"></i>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-5">
                        <div class="p-2 bg-white d-flex justify-content-around align-items-center rounded">
                            <div>
                                <p class="fs-5 text-black">Total Users</p>
                            </div>
                            <i class="fas fa-users fs-1 text-info border rounded-full p-3 ms-1" style="background-color: white;"></i>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-5">
                        <div class="p-2 bg-white d-flex justify-content-around align-items-center rounded">
                            <div>
                                <p class="fs-5 text-black">Total Authors</p>
                            </div>
                            <i class="fas fa-cubes fs-1 text-info border rounded-full p-3 ms-1" style="background-color: white;"></i>
                        </div>
                    </div>
                </div>
                <div class="row my-5">
                    <h3 class="fs-4 text-black">Available Articles</h3>
                </div>
                    <div class="col table-responsive">
                        <table id="data-table" class="table table-bordered bg-white rounded shadow-sm table-hover">
                            <thead>
                                <tr>
                                    <th scope="col"># Id</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Published Date</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody id="book-table">
                            <?php
                                $article = new Article;
                                $article->display_articles();
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        <!-- Article MODAL -->
        <div class="modal fade" id="modal-article">
            <div class="modal-dialog">
                <div class="modal-content" style="background-image: url(./assets/img/book.jpg);">
                    <form action="" method="POST" id="form-article">
                        <div class="modal-header d-flex justify-content-center" style="border: none;">
                            <img src="./assets/img/article.png" width="120" height="100" alt="">
                        </div>
                        <div class="modal-body">
                            <div class="" id="">
                                <label class="col-form-label text-black">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required />
                            </div>
                            <div class="" id="">
                                <label class="col-form-label text-black">Author</label>
                                <input type="text" class="form-control" id="author" name="author" required />
                            </div>
                            <div class="">
                                <label class="col-form-label text-black">Category</label>
                                <select class="form-select" id="category" name="category" required>
                                    <option disabled selected>Please select</option>
                                    <option value="1">FrontEnd</option>
                                    <option value="2">BackEnd</option>
                                    <option value="3">Network</option>
                                    <option value="4">Cloud</option>
                                    <option value="5">DevOps</option>
                                    <option value="6">Big Data</option>
                                    <option value="7">UI & UX</option>
                                    <option value="8">WEB</option>
                                    <option value="9">Cyber Security</option>
                                </select>
                            </div>
                            <div class="">
                                <label class="col-form-label text-black">Published Date</label>
                                <input type="date" class="form-control" id="pubDate" name="pubDate" required />
                            </div>
                            <div class="">
                                <label class="col-form-label text-black">Content</label>
                                <textarea name="content" class="form-control" id="content" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer" style="border: none">
                            <button type="button" class="btn btn-primary border rounded-pill" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-danger rounded-pill text-white" name="save" id="save">
                                Save
                            </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- UPDATE & DELETE BOOK MODAL -->
    <div class="modal fade" id="modal-updateArt">
        <div class="modal-dialog">
            <div class="modal-content" style="background-image: url(./assets/img/book.jpg);">
                <form action="" method="POST">
                    <div class="modal-header d-flex justify-content-center" style="
              border: none;
            ">
                        <img src="./assets/img/upart.png" width="90" height="100" alt="">
                    </div>
                    <div class="modal-body">
                        <div class="" id="">
                            <input type="text" id="articleId" name="articleId" style="display: none">
                            <label class="col-form-label text-black">Title</label>
                            <input type="text" class="form-control" id="newTitle" name="newTitle" />
                        </div>
                        <div class="" id="">
                            <label class="col-form-label text-black">Author</label>
                            <input type="text" class="form-control" id="newAuthor" name="newAuthor" />
                        </div>
                        <div class="">
                            <label class="col-form-label text-black">Category</label>
                            <select class="form-select" id="newCategory" name="newCategory">
                                <option disabled selected>Please select</option>
                                <option value="1">FrontEnd</option>
                                <option value="2">BackEnd</option>
                                <option value="3">Network</option>
                                <option value="4">Cloud</option>
                                <option value="5">DevOps</option>
                                <option value="6">Big Data</option>
                                <option value="7">UI & UX</option>
                                <option value="8">WEB</option>
                                <option value="9">Cyber Security</option>
                            </select>
                        </div>
                        <div class="">
                            <label class="col-form-label text-black">Published Date</label>
                            <input type="date" class="form-control" id="newPubDate" name="newPubDate" />
                        </div>
                        <div class="">
                                <label class="col-form-label text-black">Content</label>
                                <textarea name="content" class="form-control" id="newContent" required></textarea>
                            </div>
                    </div>
                    <div class="modal-footer" style="border: none">
                        <button type="button" class="btn btn-primary border rounded-pill" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" id="update" name="update" class="btn btn-success rounded-pill text-white">
                            Update
                        </button>
                </form>
            </div>
        </div>
    </div>
    </div>
</body>
<!-- ================== BEGIN core-js ================== -->
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="assets/js/scripts.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<!-- ================== END core-js ================== -->

</html>
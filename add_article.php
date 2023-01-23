<?php
include "includes/autoloader.php";
session_start();
if (!isset($_SESSION['user'])) {
    header("location: index.php");
}
$admin = new Admin;
if (isset($_POST['save'])) {
    $titles = $_POST['title'];
    $authors = $_POST['author'];
    $categories = $_POST['category'];
    $dates = $_POST['pubDate'];
    $contents = $_POST['content'];
    for($i = 0; $i < count($titles); $i++) {
        $admin->add_article($titles[$i], $authors[$i], $categories[$i], $contents[$i], $dates[$i]);
    }
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
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="assets/css/default/app.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
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
                <a href="./dashboard.php" class="list-group-item list-group-item-action bg-transparent active"><i
                        class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                <a href="./add_article.php" class="list-group-item list-group-item-action bg-transparent second-text text-black fw-bold"
                    onclick="resetArticleForm()" data-bs-toggle="modal" data-bs-target="#modal-article"><i
                        class="fa fa-plus me-2 text-black"></i>Add Article</a>
                <a href="./logout.php"
                    class="list-group-item list-group-item-action bg-transparent second-text fw-bold text-danger"><i
                        class="fas fa-power-off me-2 text-danger"></i>Logout</a>
            </div>
        </div>
        <!-- Page Content -->
        <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg bg-transparent py-4 px-4 d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <i class="fas fa-bars primary-text fs-4 me-3" style="color: black; cursor: pointer;"
                        id="controlPanel" onclick="wrapside()"></i>
                    <h2 class="fs-2 m-0 text-black">Add Article</h2>
                </div>
                <div class="d-flex">
                <div class="">
                <p class="" style="margin-top: 0.3rem;">Today's Date</p>
                <?php echo '<h4 class="fw-bold" style="margin-top: -1rem;">'.date("Y-m-d").'</h4>'?>
                 </div>
                 <div><img class="rounded p-2 border border-secondary ms-2" src="./assets/img/calendar.svg" alt=""></div>
               </div>
            </nav>
            <!-- Start -->
            <div class="conatiner-fluid blog">
                <form action="" method="POST">
                <div id="form-container" style="margin-bottom: 1rem;"></div>
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
                    <input type="date" placeholder="Published Date" class="form-control mb-2" name="pubDate[]" required />
                    <textarea type="text" placeholder="Content" class="form-control" row="3" name="content[]"></textarea>
                    <script>
                        CKEDITOR.replace( 'content[]' );
                    </script>
                    <div class="d-flex">
                    <input type="submit" id="save-article" name="save" value="Save" class="form-control btn btn-danger mt-2 p-3" name="add_article">
                    <input type="submit" value="Add Article" class="form-control btn btn-success mt-2 p-3" name="add_article" onclick="addArticleForm()">
                    <div>
                </form>
            </div>
        </div>
</body>
<!-- ================== BEGIN core-js ================== -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="assets/js/scripts.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<!-- ================== END core-js ================== -->

</html>
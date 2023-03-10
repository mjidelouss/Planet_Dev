<?php
include "includes/autoloader.php";

if (!isset($_SESSION['user'])) {
    header("location: index.php");
}

$admin = new Admin;
if (isset($_POST['save'])) {
    $admin->add_article($_POST['title'], $_POST['author'], $_POST['category'], $_POST['content']);
}
if (isset($_POST['update'])) {
    $admin->update_article($_POST['articleId'], $_POST['newTitle'], $_POST['newAuthor'], $_POST['newContent'], $_POST['newCategory']);
}
if (isset($_POST['remove'])) {
    $admin->delete_article($_POST['removee']);
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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
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
                    onclick="resetArticleForm()"><i
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
                    <h2 class="fs-2 m-0 text-black">Dashboard</h2>
                </div>
                <div class="d-flex">
                <div class="">
                <p class="" style="margin-top: 0.3rem;">Today's Date</p>
                <?php echo '<h4 class="fw-bold" style="margin-top: -1rem;">'.date("Y-m-d").'</h4>'?>
                 </div>
                 <div><img class="rounded p-2 border border-secondary ms-2" src="./assets/img/calendar.svg" alt=""></div>
               </div>
            </nav>
            <!-- Welcome user Message -->
            <div class="container-fluid px-4">
                <div class="row g-3 my-2">
                    <div class="col-lg-2 col-md-4 col-sm-5">
                        <div class="p-2 bg-white d-flex justify-content-around align-items-center rounded">
                            <div>
                            <?php
                            $article = new Article;
                                $totalArticles = $article->article_status();
                                echo '<h3 class="fs-2">'.$totalArticles.'</h3>';
                            ?>
                                <p class="fs-5 text-black">Articles</p>
                            </div>
                            <i class="fas fa-newspaper fs-1 text-info border rounded-full p-3 ms-1" style="background-color: white;"></i>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-5">
                        <div class="p-2 bg-white d-flex justify-content-around align-items-center rounded">
                            <div>
                            <?php
                                $totalUsers = $article->users_status();
                                echo '<h3 class="fs-2">'.$totalUsers.'</h3>';
                            ?>
                            <p class="fs-5 text-black">Users</p>
                            </div>
                            <i class="fas fa-users fs-1 text-info border rounded-full p-3 ms-1" style="background-color: white;"></i>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-5">
                        <div class="p-2 bg-white d-flex justify-content-around align-items-center rounded">
                            <div>
                            <?php
                                $totalAuthors = $article->authors_status();
                                echo '<h3 class="fs-2">'.$totalAuthors.'</h3>';
                            ?>
                            <p class="fs-5 text-black">Authors</p>
                            </div>
                            <i class="fa fa-people-group fs-1 text-info border rounded-full p-3 ms-1" style="background-color: white;"></i>
                        </div>
                    </div>
                </div>
                <div class="row my-4">
                    <h3 class="fs-4 text-black">Available Articles</h3>
                </div>
                <div class="mb-3">
                <form action="" method="POST">
                <div class="input-group d-flex">
                    <div class="form-outline">
                        <select class="form-control" id="filter" name="filter" style="width: 12rem;">
                        <option value="0">All Categories</option>
                        <?php
                            $article = new Article;
                            $stmt = $article->display_categories();
                            $i = 1;
                            while ($row = $stmt->fetch()) 
                            {    
                                if ($_POST['filter'] == $i) {
                                    echo '<option value="'.$i.'" selected>'.$row['category'].'</option>';
                                } else {
                                    echo '<option value="'.$i.'">'.$row['category'].'</option>';
                                }
                                $i++;
                            }
                        ?>
                        </select>
                    </div>
                    <button type="submit" name="search" class="btn btn-primary rounded ms-2">
                        <i class="fas fa-search"></i>
                    </button>
                  </form>
                </div>
                </div>
                    <div class="col table-responsive mb-2">
                        <table id="data-table" class="table bg-white rounded shadow-sm table-hover">
                            <thead>
                                <tr>
                                    <th scope="col"># Id</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Published Date</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody id="book-table">
                            <?php
                                $article = new Article;
                                if (isset($_POST['search'])) {
                                    if (!isset($_POST['filter'])) {
                                        $_POST['filter'] = 0;
                                    }
                                    $stmt = $article->display_articles_category($_POST['filter']);
                                } else {
                                    $stmt = $article->display_articles();
                                }
                                while ($row = $stmt->fetch()) 
                                {
                                    $article->id = $row["id"];
                                    $article->title = $row["title"];
                                    $article->author = $row["author"];
                                    $article->content = $row["content"];
                                    $article->category = $row["category"];
                                    $article->date = $row["published_date"];
                                    ?>
                                        <tr>
                                        <th scope="row"><?=$article->id?></th>
                                        <td><?=$article->title?></td>
                                        <td><?=$article->author?></td>
                                        <td><?=$article->category?></td>
                                        <td><?=$article->date?></td>
                                        <td><button class="rounded" data-bs-toggle="modal" data-bs-target="#modal-updateArt" id="<?=$article->id?>" onclick="initArt(<?=$article->id?>, `<?=$article->title?>`,`<?=$article->author?>`,`<?=htmlentities($article->content)?>`,`<?=$article->category?>`)"><i class="bi bi-pencil-square" style="color: green;"></i></button></td>
                                        <form method="POST" action="">
                                        <input type="hidden" name="removee" value="<?=$article->id?>">
                                        <td><button name="remove" type="submit" class="rounded"><i class="bi bi-trash-fill" style="color: red;"></i></button></td>
                                        </form>
                                        </tr>
                                    <?php
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    <!-- UPDATE & DELETE BOOK MODAL -->
    <div class="modal fade" id="modal-updateArt">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="" method="POST">
                    <div class="modal-header d-flex justify-content-center" style="
              border: none;
            ">
                    </div>
                    <div class="modal-body">
                        <div class="" id="">
                            <input type="text" id="articleId" name="articleId" style="display: none">
                            <label class="col-form-label text-black">Title</label>
                            <input type="text" class="form-control mb-2" id="newTitle" name="newTitle" />
                        </div>
                        <div class="" id="">
                            <label class="col-form-label text-black">Author</label>
                            <input type="text" class="form-control mb-2" id="newAuthor" name="newAuthor" />
                        </div>
                        <div class="">
                            <label class="col-form-label text-black">Category</label>
                            <select class="form-control mb-2" id="newCategory" name="newCategory">
                                <option disabled selected>Please select</option>
                                <option value="FrontEnd">FrontEnd</option>
                                <option value="BackEnd">BackEnd</option>
                                <option value="Network">Network</option>
                                <option value="Cloud">Cloud</option>
                                <option value="DevOps">DevOps</option>
                                <option value="Big Data">Big Data</option>
                                <option value="UI & UX">UI & UX</option>
                                <option value="Web">Web</option>
                                <option value="Cyber Security">Cyber Security</option>
                            </select>
                        </div>
                        <div class="">
                            <textarea class="form-control" id="newContent" name="newContent"></textarea>
                            <script>
                                CKEDITOR.replace( 'newContent' );
                            </script>
                        </div>
                        </div>
                            <div class="modal-footer" style="border: none">
                            <button type="button" class="btn btn-primary border rounded-pill" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="update" name="update" class="btn btn-success rounded-pill text-white">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- ================== BEGIN core-js ================== -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="assets/js/scripts.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<!-- ================== END core-js ================== -->

</html>
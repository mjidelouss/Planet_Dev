<?php
require_once('includes/autoloader.php');
session_start();
$user = new User;
if (isset($_POST['login'])) {
  $user->login($_POST['email'], $_POST['password']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8"/>
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
   <meta name="description" content=""/>
   <meta name="author" content=""/>
   <title>Planet | Dev</title>
   <!-- ================== BEGIN core-css ================== -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
   <link href="assets/css/default/app.min.css" rel="stylesheet"/>
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"/>
   <link rel="stylesheet" href="assets/css/style.css">
   <!-- ================== END core-css ================== -->
</head>
<body>
<!-- Section: Design Block -->
<section class="background-radial-gradient overflow-hidden" style="min-height: calc(100% - 100px);">
 <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
   <div class="row gx-lg-5 align-items-center mb-5">
     <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
       <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
         PLANET
         <span style="color: hsl(218, 81%, 75%)">DEV</span>
       </h1>
       <p class="mb-2 opacity-70" style="color: hsl(218, 81%, 85%)">
       Welcome to Planet.DEV, the premier community for developers who are passionate about staying on top of the latest trends and advancements in the world of development. Our community is built around the belief that by sharing knowledge and working together. That's why we offer a variety of resources and opportunities to help our members, including:
  <p class="mb-1 opacity-70" style="color: hsl(218, 81%, 85%)">✨ A lively forum where you can discuss the latest developments in your field and get feedback from other developers</p>
  <p class="mb-1 opacity-70" style="color: hsl(218, 81%, 85%)">✨ A calendar of upcoming events, including meetups, conferences, and webinars</p>
  <p class="mb-1 opacity-70" style="color: hsl(218, 81%, 85%)">✨ A blog featuring articles and tutorials on a wide range of development topics</p>
  <p class="mb-1 opacity-70" style="color: hsl(218, 81%, 85%)">✨ Opportunities to connect with other developers in your area and around the world</p>
<p class="mb-1 opacity-70" style="color: hsl(218, 81%, 85%)">We're excited to have you join our community and we look forward to helping you grow as a developer. Thanks for visiting Planet.DEV!</p>
       </p>
     </div>

     <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
       <div class="card bg-glass">
         <div class="card-body px-4 py-5 px-md-5">
           <form action="" method="POST">
           <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-cubes fa-2x me-3 fs-1" style="color: #a2d2ff;"></i>
                    <span class="h1 fw-bold mb-0">Planet Dev</span>
            </div>
             <!-- Email input -->
             <div class="form-outline mb-4">
               <input type="email" name="email" class="form-control" required/>
               <label class="form-label" style="margin-top: 0.3rem;">Email address</label>
             </div>

             <!-- Password input -->
             <div class="form-outline mb-4">
               <input type="password" name="password" class="form-control" required/>
               <label class="form-label" style="margin-top: 0.3rem;">Password</label>
             </div>

             <!-- Submit button -->
             <div class="d-flex justify-content-center">
             <button type="submit" name="login" class="btn btn-primary btn-block mb-4 w-25">
               Login
             </button>
            </div>
           </form>
         </div>
       </div>
     </div>
   </div>
 </div>
</section>
<!-- Footer-->
<footer class="bg-black text-center py-4">
            <div class="container">
                <div class="text-white-50 small">
                    <div class="mb-2">&copy; Planet Dev 2023. All Rights Reserved.</div>
                    <a href="#" class="foot-item">Privacy</a>
                    <span class="mx-1">&middot;</span>
                    <a href="#" class="foot-item">Terms</a>
                    <span class="mx-1">&middot;</span>
                    <a href="#" class="foot-item">FAQ</a>
                </div>
            </div>
        </footer>
</body>
<!-- ================== BEGIN core-js ================== -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
       integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
       crossorigin="anonymous"></script>
<script src="assets/js/scripts.js"></script>
<!-- ================== END core-js ================== -->
</html>
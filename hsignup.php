<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Register</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body>
    <?php
    include('php/query.php');
    ?>
            <div class="container d-flex justify-content-center bg-white">
                <div class="h-login-page">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/icon/vaccine-logo.png" height="70px" width="70px" alt="">
                                <h2 class="d-flex  mt-3">Vaccine Center</h2>
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="" class="row d-flex justify-content-center " method="post" enctype="multipart/form-data">
                                <div class="form-group col-12" >
                                    <h3 class="text-warning fw-bold text-center">Hospital Sign Up Only</h3>
                                </div>
                                <div class="form-group col-6">
                                    <label>Hospital Name</label>
                                    <input class="au-input au-input--full" type="text" name="name" placeholder="Name" required>
                                </div>
                                <div class="form-group col-6">
                                    <label>Hospital Number</label>
                                    <input class="au-input au-input--full" type="number" name="contact" placeholder="Name" required>
                                </div>
                                <div class="form-group col-6">
                                    <label>Hospital Email</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email" required>
                                </div>
                                <div class="form-group col-6">
                                    <label>Create Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password" required>
                                </div>
                                <div class="form-group col-4">
                                    <label for="">City</label>
                                    <select  name="city">
                                      <option selected>Select Any City.....</option>
                                      <option>Abbottabad</option>
                                      <option>Bahawalpur</option>
                                      <option>Faisalabad</option>
                                      <option>Gujranwala</option>
                                      <option>Hyderabad</option>
                                      <option>Islamabad</option>
                                      <option>Karachi</option>
                                      <option>Lahore</option>
                                      <option>Multan</option>
                                      <option>Peshawar</option>
                                      <option>Quetta</option>
                                      <option>Rawalpindi</option>
                                      <option>Sialkot</option>
                                    </select>
                                </div>
                                <div class="form-group col-8">
                                    <label>Hospital Image</label>
                                    <input class="au-input au-input--full" type="file" name="image" required>
                                </div>
                                <div class="form-group col-12">
                                    <label>Hospital Address</label>
                                    <input class="au-input au-input--full" type="text" name="address" placeholder="Address" required>
                                </div>
                                <button class="col-8 btn au-btn--block btn-orange" type="submit" name="Hsignup">register</button>
                                <div class="social-button col-12">
                                    <div class="register-link text-dark">
                                        <p>Already have account ? <a class="ml-2 text-light" href="hlogin.php"> Sign In</a></p>
                                    </div>
                                </div>
                                <button class="col-8 mt-4 btn au-btn--block btn-orange"><a href="signup.php" class=" text-decoration-none text-white">Patient signup</a></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
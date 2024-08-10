<?php
include("php/query.php")
?>
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
    <title>Vaccine Center</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/icon/vaccine-logo.png">

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/solid.min.css" integrity="sha512-pZlKGs7nEqF4zoG0egeK167l6yovsuL8ap30d07kA5AJUq+WysFlQ02DLXAmN3n0+H3JVz5ni8SJZnrOaYXWBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="css/theme.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
    

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo d-flex text-decoration-none" href="#">
                            <img src="images/icon/vaccine-logo.png" height="40px" width="40px">
                            <h4 class="text-light d-flex align-items-center mt-1 ml-1">Vaccine Center</h4>
                        </a>
                        <div class="d-flex justify-content-end">
                            <?php
                            if(isset($_SESSION["UserRole"]) || isset($_SESSION["HospitalRole"])) {
                                if(isset($_SESSION["UserRole"]) && $_SESSION["UserRole"] == "Admin"){
                                    ?>
                                    <div class="noti__item js-item-menu">
                                        <i class="fa-solid fa-bell"></i>
                                        <span class="quantity"><?php echo $totalAppointmentsRequest; ?></span>
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__title">
                                                <p>You have <?php echo $totalAppointmentsRequest; ?>  Notifications</p>
                                            </div>
                                            <!-- Loop through requests and display them -->
                                            <?php
                                            // Fetch appointments that are pending (not yet accepted or rejected)
                                            $query = $pdo->query("SELECT `appointment`.*, `hospital`.`h_name` AS h_name, `vaccine`.`v_name` AS v_name
                                            FROM `appointment` 
                                            INNER JOIN `hospital` ON `appointment`.`h_id` = `hospital`.`id`
                                            INNER JOIN `vaccine` ON `appointment`.`v_id` = `vaccine`.`id`
                                            WHERE `appointment`.`status` NOT IN ('Accepted', 'Rejected', 'Vaccined') 
                                            ORDER BY `appointment`.`current_dt` DESC LIMIT 3");
                                            $requests = $query->fetchAll(PDO::FETCH_ASSOC);
                                            ?>
                                            <a class="text-decoration-none" href="appointment-request.php">
                                                <div class="notifi__item d-block">
                                                    <?php foreach ($requests as $request) { ?>
                                                        <div class="content border-bottom">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <h6 class="d-inline">Appointment ID :</h6>
                                                                    <p class="d-inline p-0 ml-1"><?php echo $request["id"] ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <h6 class="d-inline">Patient :</h6>
                                                                    <p class=" d-inline p-0 ml-1"><?php echo $request["name"] ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <h6 class="">Vaccine :</h6>
                                                                    <p class=" p-0 ml-1"><?php echo $request["v_name"] ?></p>
                                                                </div>
                                                            </div>
                                                            <span class="date"><?php echo $request["date"] . ' ' . $request["time"] ?></span>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                
                                            </a>
                                            <div class="notifi__footer">
                                                <a href="appointment-request.php">All notifications</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }elseif(isset($_SESSION["UserRole"]) && $_SESSION["UserRole"] == "User"){
        
                                }elseif(isset($_SESSION["HospitalRole"]) && $_SESSION["HospitalRole"] == "Hospital User"){
                                    
                                }
                            }?>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                        </div>
                        
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                    <?php
                    if(isset($_SESSION["UserRole"]) || isset($_SESSION["HospitalRole"])) {
                        if(isset($_SESSION["UserRole"]) && $_SESSION["UserRole"] == "Admin"){
                            ?>
                            <!-- <a href="profile.php" class="text-decoration-none">
                                </a> -->
                        <li class="active-list has-sub">
                            <a class=" js-arrow" href="profile.php">
                                <i class="zmdi zmdi-account"></i>My Profile
                            </a>
                        </li>
                        <li class="active-list has-sub">
                            <a class=" js-arrow" href="index.php">
                                <i class="fas fa-tachometer-alt"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="active-list">
                            <a href="patient.php">
                            <i class="fa-solid fa-users"></i>Patient</a>
                        </li>
                        <li class="has-sub active-list">
                            <a class="js-arrow" href="#">
                            <i class="fa-solid fa-syringe"></i>Vaccine</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="add-vaccine.php" class="pl-4">Add Vaccine</a>
                                </li>
                                <li>
                                    <a href="vaccine-list.php" class="pl-4">List of Vaccine</a>
                                </li>
                                <li>
                                    <a href="vaccine-report.php" class="pl-4">Report Of Vaccine</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub active-list">
                            <a class="js-arrow" href="#">
                            <i class="fa-solid fa-hospital"></i>Hospitals</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="add-hospital.php" class="pl-4">Add Hospital</a>
                                </li>
                                <li>
                                    <a href="hospital-list.php" class="pl-4">List of Hospitals</a>
                                </li>
                                <li>
                                    <a href="update-hospital.php" class="pl-4">Update/Delete Hospital</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub active-list">
                            <a class="js-arrow" href="#">
                            <i class="fa-solid fa-calendar-check"></i>Appointments</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="appointment-request.php" class="pl-4">Appointments Request</a>
                                </li>
                                <li>
                                    <a href="booking-details.php" class="pl-4">Appointments List</a>
                                </li>
                            </ul>
                        </li>
                        <li class="active-list">
                            <a href="booking-details.php">
                                <i class="fa-solid fa-calendar-days"></i>Booking Details</a>
                        </li>
                        <li class="active-list">
                            <a href="logout.php">
                            <i class="fa-solid fa-right-from-bracket"></i>Log Out</a>
                        </li>
                            <?php
                        }elseif(isset($_SESSION["UserRole"]) && $_SESSION["UserRole"] == "User"){
                            ?>
                        <li class="active-list has-sub">
                            <a class=" js-arrow" href="profile.php">
                                <i class="fa-solid fa-user"></i>My Profile
                            </a>
                        </li>
                        <li class="active-list has-sub">
                            <a class=" js-arrow" href="index.php">
                                <i class="fas fa-tachometer-alt"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="active-list">
                            <a href="patient.php">
                            <i class="fa-solid fa-users"></i>Patient</a>
                        </li>
                        <li class="active-list">
                            <a href="appointment.php">
                            <i class="fa-solid fa-calendar-check"></i>Book Appointment</a>
                        </li>
                        <li class="active-list">
                            <a href="booking-details.php">
                                <i class="fa-solid fa-calendar-days"></i>Booking Details</a>
                        </li>
                        <li class="active-list">
                            <a href="logout.php">
                            <i class="fa-solid fa-right-from-bracket"></i>Log Out</a>
                        </li>
                            <?php
                        }elseif(isset($_SESSION["HospitalRole"]) && $_SESSION["HospitalRole"] == "Hospital User"){
                            ?>
                        <li class="active-list has-sub">
                            <a class=" js-arrow" href="profile.php">
                                <i class="fa-solid fa-user"></i>My Profile
                            </a>
                        </li>
                        <li class="active-list has-sub">
                            <a class=" js-arrow" href="index.php">
                                <i class="fas fa-tachometer-alt"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="has-sub active-list">
                            <a class="js-arrow" href="#">
                            <i class="fa-solid fa-syringe"></i>Vaccine</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="add-vaccine.php" class="pl-4">Add Vaccine</a>
                                </li>
                                <li>
                                    <a href="vaccine-list.php" class="pl-4">List of Vaccine</a>
                                </li>
                                <li>
                                    <a href="vaccine-report.php" class="pl-4">Report Of Vaccine</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub active-list">
                            <a class="js-arrow" href="#">
                            <i class="fa-solid fa-hospital"></i>Hospitals</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="add-hospital.php" class="pl-4">Add Hospital</a>
                                </li>
                                <li>
                                    <a href="hospital-list.php" class="pl-4">List of Hospitals</a>
                                </li>
                                <li>
                                    <a href="update-hospital.php" class="pl-4">Update/Delete Hospital</a>
                                </li>
                            </ul>
                        </li>
                        <li class="active-list">
                            <a href="booking-details.php">
                                <i class="fa-solid fa-calendar-days"></i>Booking Details</a>
                        </li>
                        <li class="active-list">
                            <a href="logout.php">
                            <i class="fa-solid fa-right-from-bracket"></i>Log Out</a>
                        </li>
                            <?php
                        }
                    }else{
                        echo "user role not set";
                    }
                        ?>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="headerr  menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar ">
                    <ul class="list-unstyled navbar__list ">
                        <a href="#" class="ml-2 mt-2 d-flex text-decoration-none">
                            <img src="images/icon/vaccine-logo.png" height="50px" width="50px" alt="">
                            <h4 class="text-light d-flex align-items-center mt-1 ml-2">Vaccine Center</h4>
                        </a>
                        <?php
                    if(isset($_SESSION["UserRole"]) || isset($_SESSION["HospitalRole"])) {
                        if(isset($_SESSION["UserRole"]) && $_SESSION["UserRole"] == "Admin"){
                            ?>
                        <li class="active-list has-sub pt-4">
                            <a class=" js-arrow" href="index.php">
                                <i class="fas fa-tachometer-alt"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="active-list">
                            <a href="patient.php">
                            <i class="fa-solid fa-users"></i>Patient</a>
                        </li>
                        <li class="has-sub active-list">
                            <a class="js-arrow" href="#">
                            <i class="fa-solid fa-syringe"></i>Vaccine</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <!-- <li>
                                    <a href="add-vaccine.php" class="pl-4">Add Vaccine</a>
                                </li> -->
                                <li>
                                    <a href="vaccine-list.php" class="pl-4">List of Vaccine</a>
                                </li>
                                <li>
                                    <a href="vaccine-report.php" class="pl-4">Report Of Vaccine</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub active-list">
                            <a class="js-arrow" href="#">
                            <i class="fa-solid fa-hospital"></i>Hospitals</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="add-hospital.php" class="pl-4">Add Hospital</a>
                                </li>
                                <li>
                                    <a href="hospital-list.php" class="pl-4">List of Hospitals</a>
                                </li>
                                <li>
                                    <a href="update-hospital.php" class="pl-4">Update/Delete Hospital</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub active-list">
                            <a class="js-arrow" href="#">
                            <i class="fa-solid fa-calendar-check"></i>Appointments</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="appointment-request.php" class="pl-4">Appointments Request</a>
                                </li>
                                <li>
                                    <a href="booking-details.php" class="pl-4">Appointments List</a>
                                </li>
                            </ul>
                        </li>
                        <li class="active-list">
                            <a href="booking-details.php">
                                <i class="fa-solid fa-calendar-days"></i>Booking Details</a>
                        </li>
                        <li class="active-list">
                            <a href="logout.php">
                            <i class="fa-solid fa-right-from-bracket"></i>Log Out</a>
                        </li>
                            <?php
                        }elseif(isset($_SESSION["UserRole"]) && $_SESSION["UserRole"] == "User"){
                            ?>
                        <li class="active-list has-sub pt-4">
                            <a class=" js-arrow" href="dashboard.php">
                                <i class="fas fa-tachometer-alt"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="active-list">
                            <a href="patient.php">
                            <i class="fa-solid fa-users"></i>Patient</a>
                        </li>
                        <li class="active-list">
                            <a href="appointment.php">
                            <i class="fa-solid fa-calendar-check"></i>Book Appointment</a>
                        </li>
                        <li class="active-list">
                            <a href="booking-details.php">
                            <i class="fa-solid fa-calendar-days"></i>Booking Details</a>
                        </li>
                        <li class="active-list">
                            <a href="vaccine-report.php">
                            <i class="fa-solid fa-syringe"></i>Report Of Vaccine</a>
                        </li>
                        <li class="active-list">
                            <a href="logout.php">
                            <i class="fa-solid fa-right-from-bracket"></i>Log Out</a>
                        </li>
                            <?php
                        }elseif(isset($_SESSION["HospitalRole"]) && $_SESSION["HospitalRole"] == "Hospital User"){
                            ?>
                        <li class="active-list has-sub pt-4">
                            <a class=" js-arrow" href="dashboard.php">
                                <i class="fas fa-tachometer-alt"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="has-sub active-list">
                            <a class="js-arrow" href="#">
                            <i class="fa-solid fa-syringe"></i>Vaccine</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="add-vaccine.php" class="pl-4">Add Vaccine</a>
                                </li>
                                <li>
                                    <a href="vaccine-list.php" class="pl-4">List of Vaccine</a>
                                </li>
                                <li>
                                    <a href="vaccine-report.php" class="pl-4">Report Of Vaccine</a>
                                </li>
                            </ul>
                        </li>
                        <li class="active-list">
                            <a href="update-hospital.php">
                                <i class="fa-solid fa-hospital"></i>My Hospital Details</a>
                        </li>
                        <li class="active-list">
                            <a href="booking-details.php">
                                <i class="fa-solid fa-calendar-days"></i>Booking Details</a>
                        </li>
                        <li class="active-list">
                            <a href="logout.php">
                            <i class="fa-solid fa-right-from-bracket"></i>Log Out</a>
                        </li>
                            <?php
                        }
                    }else{
                        echo "user role not set";
                    }
                        ?>
                        
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container bg-white">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop d-flex flex-end">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap d-flex justify-content-end">
                            <!-- <i class="fs-4 pr-3 py-2 mr-4 border-right fa-solid fa-bell" style="color: #ffffff;"></i> -->
                            <?php

                    if(isset($_SESSION["UserRole"]) || isset($_SESSION["HospitalRole"])) {
                        if(isset($_SESSION["UserRole"]) && $_SESSION["UserRole"] == "Admin"){
                            ?>
                            <div class="noti__item js-item-menu">
                                <i class="fa-solid fa-bell"></i>
                                <span class="quantity"><?php echo $totalAppointmentsRequest; ?></span>
                                <div class="notifi-dropdown js-dropdown">
                                    <div class="notifi__title">
                                        <p>You have <?php echo $totalAppointmentsRequest; ?>  Notifications</p>
                                    </div>
                                    <!-- Loop through requests and display them -->
                                    <?php
                                    // Fetch appointments that are pending (not yet accepted or rejected)
                                    $query = $pdo->query("SELECT `appointment`.*, `hospital`.`h_name` AS h_name, `vaccine`.`v_name` AS v_name
                                    FROM `appointment` 
                                    INNER JOIN `hospital` ON `appointment`.`h_id` = `hospital`.`id`
                                    INNER JOIN `vaccine` ON `appointment`.`v_id` = `vaccine`.`id`
                                    WHERE `appointment`.`status` NOT IN ('Accepted', 'Rejected', 'Vaccined') 
                                    ORDER BY `appointment`.`current_dt` DESC LIMIT 3");
                                    $requests = $query->fetchAll(PDO::FETCH_ASSOC);
                                    ?>
                                    <a class="text-decoration-none" href="appointment-request.php">
                                        <div class="notifi__item d-block">
                                            <?php foreach ($requests as $request) { ?>
                                                <div class="content border-bottom">
                                                    <div class="row">
                                                        <div class="col">
                                                            <h6 class="d-inline">Appointment ID :</h6>
                                                            <p class="d-inline p-0 ml-1"><?php echo $request["id"] ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <h6 class="d-inline">Patient :</h6>
                                                            <p class=" d-inline p-0 ml-1"><?php echo $request["name"] ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <h6 class="">Vaccine :</h6>
                                                            <p class=" p-0 ml-1"><?php echo $request["v_name"] ?></p>
                                                        </div>
                                                    </div>
                                                    <span class="date"><?php echo $request["date"] . ' ' . $request["time"] ?></span>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        
                                    </a>
                                    <div class="notifi__footer">
                                        <a href="appointment-request.php">All notifications</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }elseif(isset($_SESSION["UserRole"]) && $_SESSION["UserRole"] == "User"){

                        }elseif(isset($_SESSION["HospitalRole"]) && $_SESSION["HospitalRole"] == "Hospital User"){
                            
                        }
                    }?>
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <?php
                                                        if(isset($_SESSION['HospitalRole'])){
                                                        ?>
                                                            <img class="rounded-circle customer-img" src="images/hospital/<?php echo $_SESSION['HospitalImage'] ? $_SESSION['HospitalImage'] : "";?>" alt="" style="width: 43px; height: 43px;">
                                                        <?php
                                                        }
                                                        else{
                                                            $defaultImagePath = "images/icon/user2.png";
                                                            ?>
                                                            <img class="rounded-circle customer-img" src="<?php echo $defaultImagePath; ?>" alt="">
                                                            <?php
                                                        }
                                                        ?>
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn text-decoration-none" href="#"><?php echo isset($_SESSION["UserName"]) ? $_SESSION["UserName"] : (isset($_SESSION["HospitalName"]) ? $_SESSION["HospitalName"] : ''); ?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <?php
                                                        if(isset($_SESSION['HospitalRole'])){
                                                        ?>
                                                            <img class="rounded-circle customer-img" src="images/hospital/<?php echo $_SESSION['HospitalImage'] ? $_SESSION['HospitalImage'] : "";?>" alt="" style="width: 50px; height: 50px;">
                                                        <?php
                                                        }
                                                        else{
                                                            $defaultImagePath = "images/icon/user1.png";
                                                            ?>
                                                            <img class="rounded-circle customer-img" src="<?php echo $defaultImagePath; ?>" alt="" style="">
                                                            <?php
                                                        }
                                                        ?>
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#" class="text-decoration-none"><?php echo isset($_SESSION["UserName"]) ? $_SESSION["UserName"] : (isset($_SESSION["HospitalName"]) ? $_SESSION["HospitalName"] : ''); ?></a>
                                                    </h5>
                                                    <span class="email"><?php echo isset($_SESSION["UserEmail"]) ? $_SESSION["UserEmail"] : (isset($_SESSION["HospitalEmail"]) ? $_SESSION["HospitalEmail"] : ''); ?></span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="profile.php" class="text-decoration-none">
                                                        <i class="zmdi zmdi-account"></i>My Profile</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                <a href="logout.php" class="text-decoration-none">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->
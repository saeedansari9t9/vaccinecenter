<?php
include('includes/header.php');
if(!isset($_SESSION["UserEmail"]) &&  !isset($_SESSION["HospitalEmail"])){
    echo "<script> location.assign('login.php') </script>";
}

// Assuming you've already established a PDO database connection
try {
    $pdo = new PDO('mysql:host=localhost;dbname=vaccine_center', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch counts from the database
    $totalPatientsQuery = "SELECT COUNT(*) as total FROM patient";
    $totalVaccinesQuery = "SELECT COUNT(*) as total FROM vaccine";
    $totalHospitalsQuery = "SELECT COUNT(*) as total FROM hospital";

    // Prepare and execute queries
    $stmtPatients = $pdo->query($totalPatientsQuery);
    $stmtVaccines = $pdo->query($totalVaccinesQuery);
    $stmtHospitals = $pdo->query($totalHospitalsQuery);

    // Fetch counts from result sets
    $totalPatients = $stmtPatients->fetchColumn();
    $totalVaccines = $stmtVaccines->fetchColumn();
    $totalHospitals = $stmtHospitals->fetchColumn();
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


if($_SESSION["UserRole"] == "Admin"){
    ?>

    <!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1 mb-4 font-weight-bold">Dashboard</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                            <!-- Total Patient-->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="d-card card h-100 py-2">
                                    <a href="patient.php">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                                Total Patients</div>
                                                <div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo $totalPatients; ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fa-solid mr-3 fa-users fa-xl text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                </div>
                            </div>
                            
                                <!-- Total Vaccine-->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class=" d-card card h-100 py-2">
                                    <a href="vaccine-list.php">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                                Total Vaccines</div>
                                                <div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo $totalVaccines; ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fa-solid fa-syringe mr-3 fa-xl text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                </div>
                            </div>
                            
                            <!-- Total Hospitals-->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class=" d-card card h-100 py-2">
                                    <a href="hospital-list.php">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                                Total Hospitals</div>
                                                <div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo $totalHospitals; ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fa-solid fa-hospital mr-3 fa-lg text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                </div>
                            </div>
            </div>
        </div>
    </div>
    <div class="mx-3">
                    <?php
                    $admin = (isset($_SESSION["UserRole"]) && $_SESSION["UserRole"] == "Admin");
                    
                    ?>
                    
                    <div class=" bg-white ">
                        <table class="table">
                            <thead>
                                <tr class="bg-orange">
                                    <th scope="col">Booking Id</th>
                                    <th scope="col">Patient Name</th>
                                    <th scope="col">Hospital Name</th>
                                    <th scope="col">Vaccine Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $row = $query->fetchAll(PDO::FETCH_ASSOC);
                                foreach($row as $appointment) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $appointment["id"] ?></th>
                                    <td><?php echo $appointment["name"] ?></td>
                                    <td><?php echo $appointment["h_name"] ?></td>
                                    <td><?php echo $appointment["v_name"] ?></td>
                                    <td><?php echo $appointment["date"] ?></td>
                                    <td><?php echo $appointment["time"] ?></td>
                                    <td>
                                        <span class="status-btn" style="background-color: <?php echo StatusColor($appointment['status']); ?>">
                                            <?php echo $appointment["status"] ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php
                        }
                        if($admin){
                            $query = $pdo->prepare("SELECT `appointment`.*, `hospital`.`h_name` AS h_name, `vaccine`.`v_name` AS v_name
                            FROM `appointment` 
                            INNER JOIN `hospital` ON `appointment`.`h_id` = `hospital`.`id`
                            INNER JOIN `vaccine` ON `appointment`.`v_id` = `vaccine`.`id`");
                    $query->execute();
                            $row = $query->fetchAll(PDO::FETCH_ASSOC);
                                foreach($row as $appointment) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $appointment["id"] ?></th>
                                    <td><?php echo $appointment["name"] ?></td>
                                    <td><?php echo $appointment["h_name"] ?></td>
                                    <td><?php echo $appointment["v_name"] ?></td>
                                    <td><?php echo $appointment["date"] ?></td>
                                    <td><?php echo $appointment["time"] ?></td>
                                    <td>
                                        <span class="status-btn" style="background-color: <?php echo StatusColor($appointment['status']); ?>">
                                            <?php echo $appointment["status"] ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php
                        }
                    
                        }
                            ?>
                            </tbody>
                        </table>
                    </div>
    </div>
</div>

    <?php
}
else{}



?>





<?php
include('includes/footer.php');
?>
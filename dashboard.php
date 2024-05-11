<?php
include('includes/header.php');
if(!isset($_SESSION["UserEmail"]) &&  !isset($_SESSION["HospitalEmail"])){
    echo "<script> location.assign('login.php') </script>";
}

if(isset($_SESSION["UserEmail"])) {
    $userEmail = $_SESSION["UserEmail"];
    $query = $pdo->prepare("SELECT `appointment`.*, `hospital`.`h_name` AS h_name, `vaccine`.`v_name` AS v_name
                        FROM `appointment` 
                        INNER JOIN `hospital` ON `appointment`.`h_id` = `hospital`.`id`
                        INNER JOIN `vaccine` ON `appointment`.`v_id` = `vaccine`.`id`
                        INNER JOIN `patient` ON `appointment`.`name` = `patient`.`name`
                        WHERE `patient`.`email` = ?");
$query->execute([$userEmail]);
} elseif(isset($_SESSION["HospitalEmail"])) {
    $hospitalEmail = $_SESSION["HospitalEmail"];

    $query = $pdo->prepare("SELECT `appointment`.*, `hospital`.`h_name` AS h_name, `vaccine`.`v_name` AS v_name
                            FROM `appointment` 
                            INNER JOIN `hospital` ON `appointment`.`h_id` = `hospital`.`id`
                            INNER JOIN `vaccine` ON `appointment`.`v_id` = `vaccine`.`id`
                            WHERE `hospital`.`email` = ?");
    $query->execute([$hospitalEmail]);
}

$currentDate = date('Y-m-d'); // Current date in MySQL date format
$weekAheadDate = date('Y-m-d', strtotime('+7 days')); // Date 1 week ahead in MySQL date format

?>

    <!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h1 class="title-1 mb-4 font-weight-bold">Dashboard</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pd-ltr-20 welcome-d">
			<div class="card-box pd-20 height-100-p mb-30">
				<div class="row align-items-center">
					<div class="welcome-column col-md-4">
						<img src="images/welcome-image.jpg" class="w-image" alt="">
					</div>
					<div class="welcome-column2 col-md-8">
						<h2 class="font-20 weight-500 mb-10 text-capitalize fw-bolder">
							Welcome back<div class="weight-600 font-30 text-blue"><?php echo isset($_SESSION["UserName"]) ? $_SESSION["UserName"] : (isset($_SESSION["HospitalName"]) ? $_SESSION["HospitalName"] : ''); ?></div>
						</h2>
						<p class="font-18 my-3 max-width-600">Welcome to our Vaccination Management System portal! Your journey begins here, where we are ready to assist and provide convenience. Stay safe as you navigate through our services.</p>
					</div>
				</div>
			</div>
		</div>
    <div class="mx-3">
                    <div class=" bg-white">
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
                    foreach ($row as $appointment) {
                        // Check if appointment date is within the next week
                        $appointmentDate = strtotime($appointment["date"]);
                        if ($appointmentDate >= strtotime($currentDate) && $appointmentDate <= strtotime($weekAheadDate)) {
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



?>





<?php
include('includes/footer.php');
?>
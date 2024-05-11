<?php
include("includes/header.php");

// Redirect to login page if user is not logged in
if(!isset($_SESSION["UserEmail"]) && !isset($_SESSION["HospitalEmail"])){
    echo "<script> location.assign('login.php') </script>";
}

// Check if the logged-in user is an admin
$admin = (isset($_SESSION["UserRole"]) && $_SESSION["UserRole"] == "Admin");

// Prepare SQL query based on user type
if(isset($_SESSION["UserEmail"])) {
    $userEmail = $_SESSION["UserEmail"];
    $query = $pdo->prepare("SELECT `appointment`.*, `hospital`.`h_name` AS h_name, `vaccine`.`v_name` AS v_name
                        FROM `appointment` 
                        INNER JOIN `hospital` ON `appointment`.`h_id` = `hospital`.`id`
                        INNER JOIN `vaccine` ON `appointment`.`v_id` = `vaccine`.`id`
                        INNER JOIN `patient` ON `appointment`.`name` = `patient`.`name`
                        WHERE `patient`.`email` = ? AND `appointment`.`status` = 'Vaccined'");
    $query->execute([$userEmail]);
} elseif(isset($_SESSION["HospitalEmail"])) {
    $hospitalEmail = $_SESSION["HospitalEmail"];

    $query = $pdo->prepare("SELECT `appointment`.*, `hospital`.`h_name` AS h_name, `vaccine`.`v_name` AS v_name
                            FROM `appointment` 
                            INNER JOIN `hospital` ON `appointment`.`h_id` = `hospital`.`id`
                            INNER JOIN `vaccine` ON `appointment`.`v_id` = `vaccine`.`id`
                            WHERE `hospital`.`email` = ? AND `appointment`.`status` = 'Vaccined'");
    $query->execute([$hospitalEmail]);
}

?>

<div class="rounded border bg-white h-100 p-4" style="margin-top: 70px">
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
    // Display appointments for admin
    if($admin){
        $query = $pdo->prepare("SELECT `appointment`.*, `hospital`.`h_name` AS h_name, `vaccine`.`v_name` AS v_name
        FROM `appointment` 
        INNER JOIN `hospital` ON `appointment`.`h_id` = `hospital`.`id`
        INNER JOIN `vaccine` ON `appointment`.`v_id` = `vaccine`.`id`
        WHERE `appointment`.`status` = 'Vaccined'");
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

<?php
include("includes/footer.php")
?>

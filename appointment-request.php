<?php
include("includes/header.php");
if(!isset($_SESSION["UserEmail"]) &&  !isset($_SESSION["HospitalEmail"])){
    echo "<script> location.assign('login.php') </script>";
}

?>

<div class="rounded border bg-white  h-100 p-4" style="margin-top: 70px">
    <table class="table">
        <thead>
            <tr class="bg-orange">
                <th scope="col">Booking Id</th>
                <th scope="col">Patient Name</th>
                <th scope="col">Hospital Name</th>
                <th scope="col">Vaccine Name</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col" colspan="2">Request</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Fetch appointments that are pending (not yet accepted or rejected)
            $query = $pdo->query("SELECT `appointment`.*, `hospital`.`h_name` AS h_name, `vaccine`.`v_name` AS v_name
            FROM `appointment` 
                INNER JOIN `hospital` ON `appointment`.`h_id` = `hospital`.`id`
                INNER JOIN `vaccine` ON `appointment`.`v_id` = `vaccine`.`id`
            WHERE `appointment`.`status` NOT IN ('Accepted', 'Rejected', 'Vaccined');");
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach($row as $AllAppointments){
                ?>

                <tr>
                    <th scope="row"><?php echo $AllAppointments["id"] ?></th>
                    <td><?php echo $AllAppointments["name"] ?></td>
                    <td><?php echo $AllAppointments["h_name"] ?></td>
                    <td><?php echo $AllAppointments["v_name"] ?></td>
                    <td><?php echo $AllAppointments["date"] ?></td>
                    <td><?php echo $AllAppointments["time"] ?></td>
                    <td><a href="?acceptAppointment=<?php echo $AllAppointments['id'] ?>" class="btn btn-success">Accept</a></td>
                    <td><a href="?rejectAppointment=<?php echo $AllAppointments['id'] ?>" class="btn btn-danger">Reject</a></td>
                </tr>

                <?php
            }
            ?>
        </tbody>
    </table>
</div>


<?php
include("includes/footer.php")
?>
<?php
include("includes/header.php");
if(!isset($_SESSION["UserEmail"]) &&  !isset($_SESSION["HospitalEmail"])){
    echo "<script> location.assign('login.php') </script>";
}

$admin = (isset($_SESSION["UserRole"]) && $_SESSION["UserRole"] == "Admin");
?>

<div class="rounded border bg-white h-100 p-4" style="margin-top: 70px">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Hospital Name</th>
                <th scope="col">Vaccine Name</th>
                <th scope="col">Status</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php

            if(isset($_SESSION["HospitalId"])) {
                $hospitalID = $_SESSION["HospitalId"];
                $query = $pdo->prepare("SELECT vaccine.*, hospital.h_name
                                        FROM vaccine 
                                        INNER JOIN hospital ON vaccine.h_id = hospital.id
                                        WHERE vaccine.h_id = :hid");
                $query->bindParam(":hid", $hospitalID);
                $query->execute();
                $row = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach($row as $AllVaccine){
                    ?>
                    <tr>
                        <th scope="row"><?php echo $AllVaccine["id"] ?></th>
                        <td> <?php echo $AllVaccine["h_name"] ?> </td>
                        <td> <?php echo $AllVaccine["v_name"] ?> </td>
                        <td><a href="#" class="status-btn">Available</a></td>
                        <td><a href="edit-vaccine.php?edit_vaccine_id=<?php echo $AllVaccine['id'] ?>" class="itemm"><i class="edit1 fa-solid fa-pen-to-square"></i></a></td>
                        <td><a href="?del_vaccine_id=<?php echo $AllVaccine['id'] ?>" class="itemm"><i class="delete1 fa-solid fa-trash"></i></a></td>
                    </tr>
                    <?php
                }
            }

            if($admin) {
                $query = $pdo->query("SELECT vaccine.*, hospital.h_name
                FROM vaccine 
                    INNER JOIN hospital ON vaccine.h_id = hospital.id;");
                $row = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach($row as $AllVaccine){
                    ?>
                    <tr>
                        <th scope="row"><?php echo $AllVaccine["id"] ?></th>
                        <td> <?php echo $AllVaccine["h_name"] ?> </td>
                        <td> <?php echo $AllVaccine["v_name"] ?> </td>
                        <td><a href="#" class="status-btn">Available</a></td>
                        <td><a href="edit-vaccine.php?edit_vaccine_id=<?php echo $AllVaccine['id'] ?>" class="itemm"><i class="edit1 fa-solid fa-pen-to-square"></i></a></td>
                        <td><a href="?del_vaccine_id=<?php echo $AllVaccine['id'] ?>" class="itemm"><i class="delete1 fa-solid fa-trash"></i></a></td>
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

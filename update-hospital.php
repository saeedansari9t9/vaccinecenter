<?php
include("includes/header.php");
if(!isset($_SESSION["UserEmail"]) &&  !isset($_SESSION["HospitalEmail"])){
    echo "<script> location.assign('login.php') </script>";
}

$admin = (isset($_SESSION["UserRole"]) && $_SESSION["UserRole"] == "Admin");

?>

<div class="rounded border bg-white  h-100 p-4" style="margin-top: 70px">
    <table class="table">
        <thead>
            <tr class="bg-orange">
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Number</th>
                <th scope="col">City</th>
                <th scope="col">Address</th>
                <th scope="col">Image</th>
                <th scope="col">Email</th>
                <th scope="col">Edit</th>
                <?php if(isset($_SESSION["UserRole"]) && $_SESSION["UserRole"] === "Admin"): ?>
                    <th scope="col">Delete</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
        <?php
        if(isset($_SESSION["HospitalId"])) {
            $H_email = $_SESSION["HospitalEmail"];
            $query = $pdo->prepare("select * from hospital where email = ?");
            $query->execute([$H_email]);
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach($row as $AllHospital){
                ?>

                <tr>
                    <th scope="row"><?php echo $AllHospital["id"] ?></th>
                    <td> <?php echo $AllHospital["h_name"] ?> </td>
                    <td> <?php echo $AllHospital["contact"] ?> </td>
                    <td> <?php echo $AllHospital["city"] ?> </td>
                    <td> <?php echo $AllHospital["address"] ?> </td>
                    <td> <img src="images/hospital/<?php echo $AllHospital["image"] ?>" width="50" alt=""> </td>
                    <td> <?php echo $AllHospital["email"] ?> </td>
                    <td><a href="edit-hospital.php?edit_hospital_id=<?php echo $AllHospital['id'] ?>" class="itemm"><i class="edit1 fa-solid fa-pen-to-square"></i></a></td>
                </tr>

                <?php
            }
        }
        if($admin){
            $query = $pdo->query("select * from hospital");
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach($row as $AllHospital){
                ?>

                <tr>
                    <th scope="row"><?php echo $AllHospital["id"] ?></th>
                    <td> <?php echo $AllHospital["h_name"] ?> </td>
                    <td> <?php echo $AllHospital["contact"] ?> </td>
                    <td> <?php echo $AllHospital["city"] ?> </td>
                    <td> <?php echo $AllHospital["address"] ?> </td>
                    <td> <img src="images/hospital/<?php echo $AllHospital["image"] ?>" width="50" alt=""> </td>
                    <td> <?php echo $AllHospital["email"] ?> </td>
                    <td><a href="edit-hospital.php?edit_hospital_id=<?php echo $AllHospital['id'] ?>" class="itemm"><i class="edit1 fa-solid fa-pen-to-square"></i></a></td>
                    <td><a href="?del_hospital_id=<?php echo $AllHospital['id'] ?>" class="itemm"><i class="delete1 fa-solid fa-trash"></i></a></td>
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
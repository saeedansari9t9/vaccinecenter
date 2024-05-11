<?php
include("includes/header.php");
if(!isset($_SESSION["UserEmail"]) &&  !isset($_SESSION["HospitalEmail"])){
    echo "<script> location.assign('login.php') </script>";
}

// Check if any type of user is logged in
if(isset($_SESSION["UserRole"])) {
    $userRole = $_SESSION["UserRole"];
    
    if($userRole === "User") {
        
        $userEmail = $_SESSION["UserEmail"];
        $query = $pdo->prepare("SELECT * FROM patient WHERE email = ?");
        $query->execute([$userEmail]);
    
    }elseif($userRole === "Admin") {
        $query = $pdo->query("SELECT * FROM patient");
    }

} else {
    echo "<script> location.assign('login.php') </script>";
}


?>

<div class="rounded border  h-100 p-4" style="margin-top: 70px">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">contact</th>
                <th scope="col">Email</th>
                <?php if(isset($_SESSION["UserRole"]) && $_SESSION["UserRole"] === "Admin"): ?>
                    <th scope="col">Password</th>
                <?php endif; ?>
                <th scope="col">Gender</th>
                <th scope="col">Address</th>
                <?php if(isset($_SESSION["UserRole"]) && $_SESSION["UserRole"] === "Admin"): ?>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
        <?php

            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach($row as $AllUserData){
                ?>

                <tr>
                    <th scope="row"><?php echo $AllUserData["id"] ?></th>
                    <td> <?php echo $AllUserData["name"] ?> </td>
                    <td> <?php echo $AllUserData["contact"] ?> </td>
                    <td> <?php echo $AllUserData["email"] ?> </td>
                    <?php if(isset($_SESSION["UserRole"]) && $_SESSION["UserRole"] === "Admin"): ?>
                        <td> <?php echo $AllUserData["password"] ?> </td>
                    <?php endif; ?>
                    <td> <?php echo $AllUserData["gender"] ?> </td>
                    <td> <?php echo $AllUserData["address"] ?> </td>
                    <?php if(isset($_SESSION["UserRole"]) && $_SESSION["UserRole"] === "Admin"): ?>
                        <td><a href="edit-profile.php?edit_patient_id=<?php echo $AllUserData['id'] ?>" class="itemm"><i class="edit1 fa-solid fa-pen-to-square"></i></a></td>
                        <td><a href="?del_patient_id=<?php echo $AllUserData['id'] ?>" class="itemm"><i class="delete1 fa-solid fa-trash"></i></a></td>
                    <?php endif; ?>
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
<?php
include("includes/header.php");
if(!isset($_SESSION["UserEmail"]) &&  !isset($_SESSION["HospitalEmail"])){
    echo "<script> location.assign('login.php') </script>";
}
?>

<form class="row g-3 m-5 pt-5 " method="post">
    <h3 class="mb-2 text-orange">Add Vaccine</h3>

    <div class="inputGroup">
        <input type="text" name="name" required>
        <label>Vaccine Name</label>
    </div>

    <div class="col-12">
        <button type="submit" class="btn hbtn btn-orange" name="AddVaccine">Add Vaccine</button>
    </div>
</form>

<?php 
include("includes/footer.php")
?>
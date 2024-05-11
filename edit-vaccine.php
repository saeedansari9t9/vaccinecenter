<?php
include("includes/header.php");
if(!isset($_SESSION["UserEmail"]) &&  !isset($_SESSION["HospitalEmail"])){
    echo "<script> location.assign('login.php') </script>";
}

if(isset($_GET['edit_vaccine_id'])){
    $vaccine_id = $_GET["edit_vaccine_id"];
    $query = $pdo->prepare("select * from vaccine where id = :vid");
    $query->bindParam("vid",$vaccine_id);
    $query->execute();
    $vaccine_data = $query->fetch(PDO::FETCH_ASSOC);
}
?>

<form class="row g-3 m-5 pt-5 " method="post">
    <h3 class="mb-2 text-orange">Add Vaccine</h3>

    <input type="hidden" name="id" value="<?php echo $vaccine_data['id'] ?>">

    <div class="inputGroup">
        <input type="text" name="name" required value="<?php echo $vaccine_data['v_name'] ?>">
        <label>Vaccine Name</label>
    </div>

    <div class="col-12">
        <button type="submit" class="btn hbtn btn-orange" name="EditVaccine">Edit Vaccine</button>
    </div>
</form>

<?php 
include("includes/footer.php")
?>
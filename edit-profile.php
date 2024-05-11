<?php
include("includes/header.php");
if(!isset($_SESSION["UserEmail"]) &&  !isset($_SESSION["HospitalEmail"])){
    echo "<script> location.assign('login.php') </script>";
}

if(isset($_GET['edit_patient_id'])){
    $patient_id = $_GET["edit_patient_id"];
    $query = $pdo->prepare("select * from patient where id = :pid");
    $query->bindParam("pid",$patient_id);
    $query->execute();
    $patient_data = $query->fetch(PDO::FETCH_ASSOC);
}
?>

<form class="row g-3 m-5 pt-5 bg-white" method="post">
    <h3 class="mb-2 text-orange">Edit Details</h3>
    <input type="hidden" name="id" value="<?php echo $patient_data['id'] ?>">
    <div class="inputGroup">
        <input type="text" name="name" required value="<?php echo $patient_data['name'] ?>">
        <label>Name</label>
    </div>
    
    <div class="inputGroup">
        <input type="number" name="contact" required value="<?php echo $patient_data['contact'] ?>">
        <label>Number</label>
    </div>

    <div class="inputGroup">
        <select class="" name="gender">
            <option selected>Select Gender</option>
            <option>Male</option>
            <option>Female</option>
        </select>
    </div>

    <div class="inputGroup">
        <input type="email" name="email" required value="<?php echo $patient_data['email'] ?>">
        <label>Email</label>
    </div>

    <div class="inputGroup">
        <input type="password" name="password" required value="<?php echo $patient_data['password'] ?>">
        <label>Password</label>
    </div>

    <div class="inputGroup">
        <input type="text" name="address" required value="<?php echo $patient_data['address'] ?>">
        <label>Address</label>
    </div>

    
    
    <div class="col-12">
        <button type="submit" class="btn hbtn btn-orange" name="EditPatient">Submit</button>
    </div>
</form>

<?php 
include("includes/footer.php")
?>
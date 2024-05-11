<?php
include("includes/header.php");
if(!isset($_SESSION["UserEmail"]) &&  !isset($_SESSION["HospitalEmail"])){
    echo "<script> location.assign('login.php') </script>";
}

if(isset($_GET['edit_hospital_id'])){
    $hospital_id = $_GET["edit_hospital_id"];
    $query = $pdo->prepare("select * from hospital where id = :hid");
    $query->bindParam("hid",$hospital_id);
    $query->execute();
    $hospital_data = $query->fetch(PDO::FETCH_ASSOC);
}
?>

<form class="row g-3 m-5 pt-5 bg-white" method="post" enctype="multipart/form-data">
    <h3 class="mb-2 text-orange">Edit Hospital Details</h3>
    <input type="hidden" name="id" value="<?php echo $hospital_data['id'] ?>">
    <div class="inputGroup">
        <input type="text" name="name" required value="<?php echo $hospital_data['h_name'] ?>">
        <label>Enter Hospital Name</label>
    </div>
    
    <div class="inputGroup">
        <input type="number" name="contact" required value="<?php echo $hospital_data['contact'] ?>">
        <label>Enter Hospital Number</label>
    </div>

    <div class="inputGroup">
        <select class="" name="city">
            <option selected>Select Any City</option>
            <option>Abbottabad</option>
            <option>Bahawalpur</option>
            <option>Faisalabad</option>
            <option>Gujranwala</option>
            <option>Hyderabad</option>
            <option>Islamabad</option>
            <option>Karachi</option>
            <option>Lahore</option>
            <option>Multan</option>
            <option>Peshawar</option>
            <option>Quetta</option>
            <option>Rawalpindi</option>
            <option>Sialkot</option>
        </select>
    </div>

    <div class="inputGroup">
        <input type="file" class="file-btn" name="image">
        <img src="images/hospital/<?php echo $hospital_data['image'] ?>" width="50px">
        <!-- <label>Enter Hospital Email</label> -->
    </div>

    <div class="inputGroup">
        <input type="email" name="email" required value="<?php echo $hospital_data['email'] ?>">
        <label>Enter Hospital Email</label>
    </div>

    <div class="inputGroup">
        <input type="password" name="password" required value="<?php echo $hospital_data['password'] ?>">
        <label>Enter Hospital Password</label>
    </div>

    <div class="inputGroup">
        <input type="text" name="address" required value="<?php echo $hospital_data['address'] ?>">
        <label>Enter Hospital Address</label>
    </div>

    
    
    <div class="col-12">
        <button type="submit" class="btn hbtn btn-orange" name="EditHospital">Register</button>
    </div>
</form>

<?php 
include("includes/footer.php")
?>
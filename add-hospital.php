<?php
include("includes/header.php");
if(!isset($_SESSION["UserEmail"]) &&  !isset($_SESSION["HospitalEmail"])){
    echo "<script> location.assign('login.php') </script>";
}
?>

<form class="row g-3 m-5 pt-5 bg-white" method="post" enctype="multipart/form-data">
    <h3 class="mb-2 text-orange">Register Hospital</h3>

    <div class="inputGroup">
        <input type="text" name="name" required>
        <label>Enter Hospital Name</label>
    </div>
    
    <div class="inputGroup">
        <input type="number" name="contact" required>
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
        <input type="file" class="file-btn" name="image" required>
        <!-- <label>Enter Hospital Email</label> -->
    </div>

    <div class="inputGroup">
        <input type="email" name="email" required>
        <label>Enter Hospital Email</label>
    </div>

    <div class="inputGroup">
        <input type="password" name="password" required>
        <label>Enter Hospital Password</label>
    </div>

    <div class="inputGroup">
        <input type="text" name="address" required>
        <label>Enter Hospital Address</label>
    </div>

    
    
    <div class="col-12">
        <button type="submit" class="btn hbtn btn-orange" name="AddHospital">Register</button>
    </div>
</form>

<?php 
include("includes/footer.php")
?>
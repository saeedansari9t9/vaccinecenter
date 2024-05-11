<?php
include("includes/header.php");

if(!isset($_SESSION["UserEmail"]) && !isset($_SESSION["HospitalEmail"])) {
    echo "<script> location.assign('login.php') </script>";
}

if(isset($_SESSION["UserRole"])) {
    // User is logged in
    $query = $pdo->prepare("SELECT * FROM patient WHERE email = ?");
    $query->execute([$_SESSION["UserEmail"]]);
    $userDetails = $query->fetch(PDO::FETCH_ASSOC);
    $role = "User";
} elseif(isset($_SESSION["HospitalRole"])) {
    // Hospital is logged in
    $query = $pdo->prepare("SELECT * FROM hospital WHERE email = ?");
    $query->execute([$_SESSION["HospitalEmail"]]);
    $userDetails = $query->fetch(PDO::FETCH_ASSOC);
    $role = "Hospital";
}

?>

<section class="vh-100" style="background-color: #f4f5f7;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-start align-items-center h-100">
      <div class="col col-lg-12  bg-lightt mb-4 mb-lg-0">
        <div class="card profile-card mt-5" style="border-radius: .5rem;">
          <div class="row h-100 g-0">
            <div class="col-md-5 gradient-custom text-center text-white" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
              <?php 
              if(isset($_SESSION['HospitalRole'])){
                ?>
                  <img src="images/hospital/<?php echo $_SESSION['HospitalImage'] ? $_SESSION['HospitalImage'] : "";?>" alt="Avatar" class="img-fluid rounded-circle my-5" style="width: 180px; height: 180px;" />
                <?php
                }
                else{
                    $defaultImagePath = "images/icon/user.png";
                    ?>
                    <img src="<?php echo $defaultImagePath; ?>" alt="Avatar" class="img-fluid my-5" style="width: 170px;"/>
                    <img class="rounded-circle customer-img" src="" alt="" style="">
                    <?php
                }
              ?>
              
                <?php if($role === "User"): ?>
                  <h2><?php echo $userDetails['name']; ?></h2>
                <?php else: ?>
                  <h2><?php echo $userDetails['h_name']; ?></h2>
                <?php endif; ?>
              <h4 class="mt-3"><?php echo $userDetails['email']; ?></h4>
            </div>
            <div class="col-md-7">
              <div class="card-body h-100 p-4">
                <div class="row pt-1">
                  <div class="pro-details col-12 mb-3">
                    <?php if($role === "User"): ?>
                      <h5>Name</h5>
                      <p class="text-muted"><?php echo $userDetails['name']; ?></p>
                    <?php else: ?>
                      <h5>Name</h5>
                      <p class="text-muted"><?php echo $userDetails['h_name']; ?></p>
                    <?php endif; ?>

                    <h5>Email</h5>
                    <p class="text-muted"><?php echo $userDetails['email']; ?></p>

                    <h5>Contact</h5>
                    <p class="text-muted"><?php echo $userDetails['contact']; ?></p>

                    <?php if($role === "User"): ?>
                    <h5>Gender</h5>
                    <p class="text-muted"><?php echo $userDetails['gender']; ?></p>
                    
                    <?php else: ?>
                    <h5>City</h5>
                    <p class="text-muted"><?php echo $userDetails['city']; ?></p>
                    
                    <?php endif; ?>
                    <h5>Address</h5>
                    <p class="text-muted"><?php echo $userDetails['address']; ?></p>
                    <div></div>
                    <a href="edit-profile.php?edit_patient_id=<?php echo $userDetails['id'] ?>" class="text-decoration-none"><button type="submit" class="btn  hbtn btn-orange" name="EditVaccine">Edit Profile</button></a>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
include("includes/footer.php")
?>

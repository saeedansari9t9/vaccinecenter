<?php
include("includes/header.php");
if(!isset($_SESSION["UserName"])) {
    echo "<script> location.assign('login.php') </script>";
}
?>

<?php

$hospitalId = $_POST["hospital_id"];
$query = $pdo->prepare("SELECT * FROM vaccine WHERE h_id = :hospitalId");
$query->bindParam(":hospitalId", $hospitalId);
$query->execute();
$vaccines = $query->fetchAll(PDO::FETCH_ASSOC);

foreach($vaccines as $vaccine){
    ?>
    <option value="<?php echo $vaccine["id"]; ?>"><?php echo $vaccine["v_name"]; ?></option>
    <?php
}
?>

<?php 
include("includes/footer.php")
?>
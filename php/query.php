<?php
session_start();
// session_unset();
include("connection.php");


//Sign Up
if(isset($_POST['signup'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contact = $_POST['number'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $query = $pdo->prepare('insert into patient (name,email,password,contact,gender,address)  values(:pn,:pe,:pp,:pc,:pg,:pa)');
    
    $query->bindParam("pn",$name); 
    $query->bindParam("pe",$email); 
    $query->bindParam("pp",$password); 
    $query->bindParam("pc",$contact); 
    $query->bindParam("pg",$gender); 
    $query->bindParam("pa",$address); 
    $query->execute();

    echo "<script> alert('Sign Up Successfully....');
    location.assign('login.php') </script>"; 

}

//Sign In
if(isset($_POST["signin"])){

    $email = $_POST['email']; 
    $password = $_POST['password'];
    $query = $pdo->prepare("select * from patient WHERE email = :pe and password = :pp");
    $query->bindParam(":pe", $email); 
    $query->bindParam(":pp", $password);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);

    if($row){

        $_SESSION["UserId"] = $row["id"];
        $_SESSION["UserName"] = $row["name"];
        $_SESSION["UserEmail"] = $row["email"];
        $_SESSION["UserPassword"] = $row["password"];
        $_SESSION["UserContact"] = $row["contact"];
        $_SESSION["UserGender"] = $row["gender"];
        $_SESSION["UserAddress"] = $row["address"];
        $_SESSION["UserRole"] = $row["role"];

        if ($row["role"] == "Admin") {
            echo "<script>alert('Admin logged in successfully.'); location.assign('index.php');</script>";
        } else {
            echo "<script> location.assign('dashboard.php');</script>";
        }
    } else {
        echo "<script>alert('Invalid email or password.');</script>";
    }
}

//Edit Patient
if(isset($_POST["EditPatient"])){
    
    $patient_id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $query = $pdo->prepare('update patient set name = :pn, contact = :pc, email = :pe, password = :pp, gender = :pg, address = :pa where id = :pid');
    
    $query->bindParam(":pn", $name); 
    $query->bindParam(":pe", $email);
    $query->bindParam(":pp", $password);
    $query->bindParam(":pc", $contact); 
    $query->bindParam(":pg", $gender); 
    $query->bindParam(":pa", $address);
    $query->bindParam(":pid", $patient_id);
    $query->execute();

    echo "<script> alert('Profile Details Updated Successfully....');
    location.assign('profile.php') </script>"; 
}

// Delete Patient
if(isset($_GET['del_patient_id'])){
    $delete_patient = $_GET['del_patient_id'];
    
    // Show confirmation dialog box
    echo '<script>';
    echo 'if(confirm("Are you sure you want to delete this patient?")) {';
    echo 'window.location.href = "patient.php?delete-patient=true&patient_id='.$delete_patient.'";';
    echo '} else {';
    echo 'window.location.href = "patient.php";';
    echo '}';
    echo '</script>';
}

// After user confirms deletion
if(isset($_GET['delete-patient']) && $_GET['delete-patient'] === 'true') {
    $patient_id = $_GET['patient_id'];
    $query = $pdo->prepare("DELETE FROM patient WHERE id = :pid");
    $query->bindParam(":pid", $patient_id);
    $query->execute();
    echo "<script> alert('Patient Deleted') </script>";
}

//Hospital Sign Up

if(isset($_POST['Hsignup'])){

    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $image = $_FILES["image"]["name"];
    $tmp_name = $_FILES["image"]["tmp_name"];
    $extension = pathinfo($image, PATHINFO_EXTENSION);
    $designation = "images/hospital/" .$image;
    if($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "webp"){
        if(move_uploaded_file($tmp_name,$designation)){
            $query = $pdo->prepare("insert into hospital (h_name,contact,city,address,image,email,password)  values(:pn,:pc,:pci,:pa,:pi,:pe,:pp)");
            $query->bindParam("pn",$name); 
            $query->bindParam("pc",$contact); 
            $query->bindParam("pci",$city); 
            $query->bindParam("pa",$address); 
            $query->bindParam("pi",$image); 
            $query->bindParam("pe",$email); 
            $query->bindParam("pp",$password); 
            $query->execute();
            
            echo "<script> alert('Sign Up Successfully....');
            location.assign('hlogin.php') </script>";
        
        }
        else{
            echo "<script> alert('File Format Error...'); </script>";
        }
    }
    else{
        echo "<script> alert('Invalid file format.'); </script>";
    } 

}

//Hospital Sign In

if(isset($_POST["hsignin"])){

    $email = $_POST['email']; 
    $password = $_POST['password'];
    $query = $pdo->prepare("select * from hospital where email = :pe && password = :pp");
    $query->bindParam("pe",$email); 
    $query->bindParam("pp",$password);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);

    if($row){

        $_SESSION["HospitalId"]=$row["id"];
        $_SESSION["HospitalName"]=$row["h_name"];
        $_SESSION["HospitalContact"]=$row["contact"];
        $_SESSION["HospitalCity"]=$row["city"];
        $_SESSION["HospitalAddress"]=$row["address"];
        $_SESSION["HospitalImage"]=$row["image"];
        $_SESSION["HospitalEmail"]=$row["email"];
        $_SESSION["HospitalPassword"]=$row["password"];
        $_SESSION["HospitalRole"]=$row["role"];
        echo "<script> alert('Log In Successfully.....');
        location.assign('dashboard.php') </script>";
    } else {
        echo "<script>alert('Invalid email or password.');</script>";
    }
}

//Add Hospital
if(isset($_POST['AddHospital'])){

    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $image = $_FILES["image"]["name"];
    $tmp_name = $_FILES["image"]["tmp_name"];
    $extension = pathinfo($image, PATHINFO_EXTENSION);
    $designation = "images/hospital/" .$image;
    if($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "webp"){
        if(move_uploaded_file($tmp_name,$designation)){
            $query = $pdo->prepare("insert into hospital (h_name,contact,city,address,image,email,password)  values(:pn,:pc,:pci,:pa,:pi,:pe,:pp)");
            $query->bindParam("pn",$name); 
            $query->bindParam("pc",$contact); 
            $query->bindParam("pci",$city); 
            $query->bindParam("pa",$address); 
            $query->bindParam("pi",$image); 
            $query->bindParam("pe",$email); 
            $query->bindParam("pp",$password); 
            $query->execute();
            
            echo "<script> alert('Hospital Added Successfully....');
            location.assign('hospital-list.php') </script>";
        
        }
        else{
            echo "<script> alert('File Format Error...'); </script>";
        }
    }
    else{
        echo "<script> alert('Invalid file format.'); </script>";
    } 

}

//Edit Hospital
if(isset($_POST["EditHospital"])){
    $hospital_id = $_POST["id"];
    $hospital_name = $_POST["name"];
    $hospital_contact = $_POST["contact"];
    $hospital_city = $_POST["city"];
    $hospital_email = $_POST["email"];
    $hospital_password = $_POST["password"];
    $hospital_address = $_POST["address"];
    if(!empty($_FILES["image"]["name"])){
        $hospital_image = $_FILES["image"]["name"];
        $hospital_tmp_name = $_FILES["image"]["tmp_name"];
        $extension = pathinfo($hospital_image, PATHINFO_EXTENSION);
        $designation = "images/hospital/" .$hospital_image;
        if($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "webp"){
        if(move_uploaded_file($hospital_tmp_name,$designation)){
            $query = $pdo->prepare("update hospital set h_name = :pn , contact = :pcon , city = :pc , email = :pe , image = :pi , password = :pp , address = :pa where id = :pid");
            $query->bindParam("pid",$hospital_id);
            $query->bindParam("pn",$hospital_name);
            $query->bindParam("pcon",$hospital_contact);
            $query->bindParam("pc",$hospital_city);
            $query->bindParam("pe",$hospital_email);
            $query->bindParam("pi",$hospital_image);
            $query->bindParam("pp",$hospital_password);
            $query->bindParam("pa",$hospital_address);
            $query->execute();
            echo "<script> alert('Hospital Details Edited Successfully...');
            location.assign('hospital-list.php')</script>";
        
            }
        }else{
            echo "<script> alert('Not Acceptable') </script>";
        }
    }else{
        $query = $pdo->prepare("update hospital set h_name = :pn , contact = :pcon , city = :pc , email = :pe , image = :pi , password = :pp , address = :pa where id = :pid");
            $query->bindParam("pid",$hospital_id);
            $query->bindParam("pn",$hospital_name);
            $query->bindParam("pcon",$hospital_contact);
            $query->bindParam("pc",$hospital_city);
            $query->bindParam("pe",$hospital_email);
            $query->bindParam("pi",$hospital_image);
            $query->bindParam("pp",$hospital_password);
            $query->bindParam("pa",$hospital_address);
            $query->execute();
            echo "<script> alert('Hospital Details Edited Successfully...');
            location.assign('hospital-list.php')</script>";
    }
}

//Delete Hospital
if(isset($_GET['del_hospital_id'])){
    $delete_hospital = $_GET['del_hospital_id'];
    $query = $pdo->prepare("delete from hospital where id = :pid");
    $query->bindParam("pid",$delete_hospital);
    $query->execute();
    echo '<script>';
    echo 'if(confirm("Are you sure you want to delete this hospital?")) {';
    echo 'window.location.href = "hospital-list.php?hospital-delete=true&hospital_id='.$delete_hospital.'";';
    echo '} else {';
    echo 'window.location.href = "hospital-list.php";';
    echo '}';
    echo '</script>';
}
// After user confirms deletion
if(isset($_GET['hospital-delete']) && $_GET['hospital-delete'] === 'true') {
    $hospital_id = $_GET['hospital_id'];
    $query = $pdo->prepare("DELETE FROM hospital WHERE id = :id");
    $query->bindParam("id", $hospital_id);
    $query->execute();
    echo "<script> alert('Hospital Deleted') </script>";
}

//Add Vaccine
if(isset($_POST['AddVaccine'])){
    if(isset($_SESSION["HospitalEmail"])) {

        $hospitalID = $_SESSION["HospitalId"];

        $name = $_POST["name"];
        $query = $pdo->prepare('INSERT INTO vaccine (v_name, h_id) VALUES (:pn, :hid)');
        $query->bindParam(":pn", $name);
        $query->bindParam(":hid", $hospitalID);
        $query->execute();

        echo "<script> alert('Vaccine added successfully.');
        location.assign('vaccine-list.php')</script>";
    }
}

//Edit Vaccine
if(isset($_POST["EditVaccine"])){
    $vaccine_id = $_POST["id"];
    $vaccine_name = $_POST["name"];
    $query = $pdo->prepare("update vaccine set v_name = :pn where id = :pid");
    $query->bindParam("pid",$vaccine_id);
    $query->bindParam("pn",$vaccine_name);
    $query->execute();
    echo "<script> alert('Vaccine Edited Successfully...');
    location.assign('vaccine-list.php')</script>";        
}

// Delete Vaccine
if(isset($_GET['del_vaccine_id'])){
    $delete_vaccine = $_GET['del_vaccine_id'];
    
    // Show confirmation dialog box
    echo '<script>';
    echo 'if(confirm("Are you sure you want to delete this vaccine?")) {';
    echo 'window.location.href = "vaccine-list.php?confirm=true&vaccine_id='.$delete_vaccine.'";';
    echo '} else {';
    echo 'window.location.href = "vaccine-list.php";';
    echo '}';
    echo '</script>';
}

// After user confirms deletion
if(isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
    $vaccine_id = $_GET['vaccine_id'];
    $query = $pdo->prepare("DELETE FROM vaccine WHERE id = :vaccine_id");
    $query->bindParam(":vaccine_id", $vaccine_id);
    $query->execute();
    echo "<script> alert('Vaccine Deleted') </script>";
}

//Appointment Booking
if(isset($_POST['bookAppointment'])){

    if(isset($_SESSION['UserName'])){

        $pName = $_SESSION['UserName'];
        $hName = $_POST["hospitalName"];
        $date = $_POST["date"];
        $time = $_POST["time"];
        $vName = $_POST["vaccineName"];

        $query = $pdo->prepare('insert into  appointment (name, h_id, date, time, v_id) values (:pn, :phid, :pd, :pt, :pvid)');
        $query->bindParam("pn",$pName);
        $query->bindParam("phid",$hName);
        $query->bindParam("pd",$date);
        $query->bindParam("pt",$time);
        $query->bindParam("pvid",$vName);
        $query->execute();

        echo "<script> alert('Appointment Request Sended');
        location.assign('booking-details.php')</script>";
    }

}

// Appointment Accept button
if(isset($_GET['acceptAppointment'])){
    $accept_appointment_id = $_GET['acceptAppointment'];
    $query = $pdo->prepare("update appointment SET status = 'Accepted' WHERE id = :pid");
    $query->bindParam(":pid", $accept_appointment_id);
    $query->execute();

    echo "<script> alert('Appointment Accepted'); </script>";
}


// Appointment Reject button
if(isset($_GET['rejectAppointment'])) {
    $appointmentId = $_GET['rejectAppointment'];
    $query = $pdo->prepare("update appointment SET status = 'Rejected' WHERE id = :pid");
    $query->bindParam(":pid", $appointmentId);
    $query->execute();

    echo "<script> alert('Appointment Rejected'); </script>";
}






//Notification Count
try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch count from the database
    $query = "SELECT COUNT(*) as total
            FROM `appointment` 
            WHERE `status` NOT IN ('Accepted', 'Rejected', 'Vaccined')";
    $stmt = $pdo->query($query);

    // Fetch count from the result set
    $totalAppointmentsRequest = $stmt->fetchColumn();
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


function StatusColor($status) {
    switch ($status) {
        case 'Pending':
            return '#e9d903';
        case 'Accepted':
            return '#169400';
        case 'Rejected':
            return '#cf1000 ';
        default:
            return 'blue'; // Default color for unknown statuses
    }
}
?>
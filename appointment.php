<?php
include("includes/header.php");
if(!isset($_SESSION["UserName"])) {
    echo "<script> location.assign('login.php') </script>";
}
?>

<form class="row g-3 m-5 pt-5 bg-white" method="post" onsubmit="return validateDateTime()">
    <h3 class="mb-2 col-12 text-orange">Appointment</h3>

    <div class="inputGroup">
        <select class="" name="hospitalName" id="hospitalName">
            <option selected>Select Hospital</option>
            <?php
                $query = $pdo->query("select * from hospital");
                $all_data = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach($all_data as $hospital_data){
                    ?>
                        <option value="<?php echo $hospital_data['id'] ?>"><?php echo $hospital_data['h_name'] ?></option>
                    <?php
                }
            ?>
        </select>
    </div>

    <div class="inputGroup">
        <select class="" name="vaccineName" id="vaccineName">
            <option  hidden>Select Vaccine</option>
            <script>
                $(document).ready(function(){
                    // Load vaccines based on selected hospital
                    $("#hospitalName").on('change', function(){
                        let hospitalId = $(this).val();
                        $.ajax({
                            url: "get-vaccine.php",
                            type: "post",
                            data: {
                                "hospital_id": hospitalId
                            },
                            success: function(data){
                                $("#vaccineName").html(data);
                            }
                        });
                    });
                });
            </script>
        </select>
    </div>

    <div class="inputGroup">
        <input type="date" name="date" id="appointmentDate" required>
        <label></label>
    </div>

    <div class="inputGroup">
        <input type="time" name="time" id="appointmentTime" required>
        <label></label>
    </div>

    <div class="col-12">
            <button type="submit" class="btn hbtn btn-orange" name="bookAppointment">Register</button>
    </div>
</form>

<script>
    function validateDateTime() {
        var selectedDate = new Date(document.getElementById("appointmentDate").value);
        var selectedTime = document.getElementById("appointmentTime").value;
        var currentDate = new Date();
        var currentTime = currentDate.getHours() + ":" + currentDate.getMinutes();

        if (selectedDate < currentDate || (selectedDate.toDateString() === currentDate.toDateString() && selectedTime < currentTime)) {
            alert("Please select a future date and time for the appointment.");
            return false;
        }

        return true;
    }


    
</script>

<?php 
include("includes/footer.php")
?>
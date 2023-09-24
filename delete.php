
  <!-- MT TRY -->
<!-- <?php
include("connection.php");

error_reporting(0);
$reg = $_GET['rn'];
$query = "DELETE FROM LOST WHERE regno='$reg'";

$data= mysqli_query($conn,$query);

if($data){
    echo "<script>Record deleted sucessfully!</script>";
    ?>
    
    <META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/lnf/lost.php#lostlist">
    <?php
}
else{
    echo "<font color='red'>Failed to delete record!";
}
?> -->


<!-- GPT: -->

<?php
if (isset($_POST['regno'])) {
    $regno = $_POST['regno'];

    // Your database connection details here
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lostnfound"; // Replace with your actual database name

    $conn = mysqli_connect($server, $username, $password, $dbname);

    if (!$conn) {
        die("unsuccessful lost connection: " . mysqli_connect_error());
    }

    // Use prepared statement to prevent SQL injection
    $sql = "DELETE FROM `lost` WHERE `regno` = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $regno);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // Close the database connection
        mysqli_close($conn);

        // Respond to the AJAX request
        echo "success";
    } else {
        // Failed to prepare the statement
        echo "error";
    }
}
?>

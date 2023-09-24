<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Found items</title>

  <link rel="stylesheet" href="style2.css">
</head>
<body>
  
<div class="foundnav">
<nav>
        <ul>
            <li><a href="found.php">Found</a></li>
            <li><a href="lost.php">Lost</a></li>
            <li><a href="index.html">Home</a></li>
        </ul>
    </nav>

</div>


<div class="lostpage">
    <img src="images/found3.jpg" style="width:560px;height:550px; margin:30px" >
    <div class="losttextsection">

      <h2>Found a lost item?</h2>
      <p>Help out our friends as soon as possible! </p>
      <a href="#foundreport"><input type="submit" value="Report a found item" style="float:left; margin:5px" ></a>
      <a href="#foundlist"><input type="submit" value="View found items" style="float:left; margin:5px"></a>

    </div>
</div>


<div  id="foundreport" class="lostformheading">
  <h3>REPORT</h3>

    


    <div class="report_container">


<form name='form' id='form' action='' method="post">      
<!-- <form name=loginForm id='login' action='' method='post'></form> -->

    <!-- <p>Please select your report type: </p>
    <input type="radio" id="lost" name="reporttype" required>
    <label for="age1">Lost</label><br>
    <input type="radio" id="found" name="reporttype" required>
    <label for="age2">Found</label><br>   -->

    


<p>Item Details:</p>
<div class="row">        
<div class="col-25">
<label for="iname">Item Name</label>
</div>
<div class="col-75">
<input type="text" id="iname" name="iname" required>
</div>
</div>


<div class="row">
<div class="col-25">
<label for="desc">Description</label>
</div>
<div class="col-75">
<textarea id="desc" name="desc" placeholder="color, model, shape, size etc." style="height:100px" required></textarea>
</div>
</div>

<p>Reporter Details:</p>

<div class="row">
      <div class="col-25">
        <label for="name">Registration No.</label>
      </div>
      <div class="col-75">
        <input type="text" id="rgno" name="rgno" required>
       
      </div>
    </div>

<div class="row">
<div class="col-25">
<label for="name">Name</label>
</div>
<div class="col-75">
<input type="text" id="name" name="name" required>

</div>
</div>

<div class="row">
<div class="col-25">
<label for="phone">Phone Number</label>
</div>
<div class="col-75">
<input type="tel" id="phone" name="phone" pattern="[0-9]{10}" required>

</div>
</div>

<div class="row">
<div class="col-25">
<label for="email">email</label>
</div>
<div class="col-75">
<input type="email" id="email" name="email" required>

</div>
</div>

<div class="row">
<div class="col-25">
<label for="notes">extranotes</label>
</div>
<div class="col-75">
<textarea id="notes" name="notes" placeholder="optional.." style="height:100px"></textarea>
</div>
</div>

<br>
<div class="row">
<input type="submit" value="Submit">
</div>

</form>
</div>



</div>
<!-- 

INSERT INTO `found` (`srno`, `itemName`, `itemDesc`, `name`, `phoneNo`, `email`, `notes`, `datetime`) VALUES ('1', 'id card', 'name on card - naveesha', 'xyz', '99999999', 'navi@navi.com', '', current_timestamp()); -->


<?php
if(isset($_POST['iname'])){
    $server="localhost";
    $username="root";
    $password="";
    // $dbname="lostnfound";

    $conn=mysqli_connect($server,$username,$password);

    if(!$conn){
        die("unsuccessful found connection: ".mysqli_connect_error());
    }
    else{
        echo "";
    }

    $fregno=$_POST['rgno'];
    $finame=$_POST['iname'];   ////solved the found issue. It was directing to lost.php by default. By changing the variable names for both lost and found made it distinctive. i.e say lphone and fphone.
    $fdesc=$_POST['desc'];
    $fname=$_POST['name'];
    $fphone=$_POST['phone'];
    $femail=$_POST['email'];
    $fnotes=$_POST['notes'];

    $sql="INSERT INTO `lostnfound`.`found` (`regno`,`itemName`, `itemDesc`, `name`, `phoneNo`, `email`, `notes`, `datetime`) VALUES ('$fregno', '$finame', '$fdesc', '$fname', '$fphone', '$femail', '$fnotes', current_timestamp());";
   
    
if ($conn->query($sql) === TRUE) {
    echo "New record added successfully";

  } 

  
  else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  mysqli_close($conn);
  
}

?> 


<div id="foundlist" class="reportedlostitems">
  <h3>REPORTED FOUND ITEMS: </h3>



<?php
include('connection.php');
$query="select * from found";
$result=mysqli_query($conn,$query);
?>


<table id="lostTable">
  <th>Reg. no.</th>
  <th>Item name</th>
  <th>Item Description</th>
  <th>Name</th>
  <th>Phone no.</th>
  <th>Email</th>
  <th>Extra notes</th>
  <th>Date and time</th>
  <th>Edit</th>

  <?php
   while($rows=mysqli_fetch_assoc($result)){
     ?>
     <tr>
   
     <td><?php echo $rows['regno']; ?></td>
     <td><?php echo $rows['itemName']; ?></td>
     <td><?php echo $rows['itemDesc']; ?></td>
     <td><?php echo $rows['name']; ?></td>
     <td><?php echo $rows['phoneNo']; ?></td>
     <td><?php echo $rows['email']; ?></td>
     <td><?php echo $rows['notes']; ?></td>
     <td><?php echo $rows['datetime']; ?></td>
     <td><a href="delete.php?rn=$rows[regno]"><input type="image" src="images/dustbin2.png" style="width:20px; height:20px" onclick="return SomeDeleteRowFunction()"></td>

   </tr>
   <?php
   }
   ?>

  </div>
  
</table>

</body>
</html>
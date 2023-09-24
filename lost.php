<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lost items</title>

  <link rel="stylesheet" href="style2.css">

  <script src="script.js"></script>
 


</head>
<body>
  
<div class="lostnav">
<nav>
        <ul>
          
            <li><a href="found.php">Found</a></li>
            <li><a href="lost.php">Lost</a></li>
            <li><a href="index.html">Home</a></li>
        </ul>
    </nav>

</div>

<div class="lostpage">
    <img src="images/lost4.jpg" style="width:500px;height:550px; margin:30px" >
    <div class="losttextsection">

      <h2>Displaced your things in hustle?</h2>
      <p>Don't worry at all! </p>
      <a href="#lostreport"><input type="submit" value="Report a lost item" style="float:left; margin:5px" ></a>
      <a href="#lostlist"><input type="submit" value="View lost items" style="float:left; margin:5px"></a>

    </div>
</div>


<div  id="lostreport" class="lostformheading">
  <h3>REPORT</h3>


  
    <div class="report_container">


          <form name='form' id='form' action='lost.php' method="post">      
  <!-- <form name=loginForm id='login' action='' method='post'></form> --> 

              

        
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
    


<?php
if(isset($_POST['iname'])){     //THIS SOLVED ONE PROBLEM
    $server="localhost";
    $username="root";
    $password="";
    // $dbname="lostnfound";

    $conn=mysqli_connect($server,$username,$password);

    if(!$conn){
        die("unsuccessful lost connection: ".mysqli_connect_error());
    }
    else{
        echo "";
    }

    $lregno=$_POST['rgno'];
    $liname=$_POST['iname'];    //solved the found issue. It was directing to lost.php by default. By changing the variable names for both lost and found made it distinctive. i.e say lphone and fphone.
    $ldesc=$_POST['desc'];
    $lname=$_POST['name'];
    $lphone=$_POST['phone'];
    $lemail=$_POST['email'];
    $lnotes=$_POST['notes'];

    $sql="INSERT INTO `lostnfound`.`lost` (`regno`,`itemName`, `itemDesc`, `name`, `phoneNo`, `email`, `notes`, `datetime`) VALUES ('$lregno', '$liname', '$ldesc', '$lname', '$lphone', '$lemail', '$lnotes', current_timestamp());";
   
    
if ($conn->query($sql) === TRUE) {
    echo "";

  } 

//   <script>
//   alert("Record entered successfully!");
// </script>
  
  else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  mysqli_close($conn);

}

?> 

<div id="lostlist" class="reportedlostitems">
  <h3>REPORTED LOST ITEMS: </h3>



<?php
include('connection.php');
$query="select * from lost";
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


<!-- // gpt: -->

<td><?php echo $rows['datetime']; ?></td>
<td><input type="image" src="images/dustbin2.png" style="width:20px; height:20px" onclick="deleteRow(<?php echo $rows['regno']; ?>)"></td>



<!-- comment the 1st and 3rd line below(original, before gpt) -->
     <!-- <td><input type="button" value="Delete" onclick="SomeDeleteRowFunction(this)"></td>  
     <td><a href="delete.php?rn=$rows[regno]"><input type="image" src="images/dustbin2.png" style="width:20px; height:20px" onclick="return SomeDeleteRowFunction()"></td>
     <td><a href='' onclick="return SomeDeleteRowFunction()">Delete</td>  -->

   </tr>
   <?php
   }
   ?>

  </div>
  
</table>

</body>
</html>


<!-- 
INSERT INTO `lost` (`srno`, `itemName`, `itemDesc`, `name`, `phoneNo`, `email`, `notes`, `datetime`) VALUES ('2', 'paint', 'red', 'nano', '99999999', 'navi@navi.com', '', current_timestamp()); -->



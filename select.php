<!DOCTYPE html>
<html lang="en">
<head>
<script>
    setInterval(function() {
        location.reload();
    }, 1021000); // refresh every 5 seconds
</script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    
</body>
</html>
<?php
$host="localhost";
$username="root";
$pass="";
$db="school_project";
$con=mysqli_connect("localhost","root","","school_project");
$select=mysqli_query($con,"select * from sensor_data");
if(mysqli_num_rows($select)>0){
    ?>
    <p><h1> <u>DHTT DASHBOARD</u></h1></p>
    <table border="1">
    <tr><td>ID</td><td>TEMPERATURE</td><td>HUMIDITY</td><td>TIME</td></tr>
    <?php
    while($data=mysqli_fetch_array($select)){
        ?>
      <tr><td><?php echo $data["ID"];?></td><td><?php echo $data["TEMPERATURE"];?>
    </td><td><?php echo $data["HUMIDITY"];?></td><td><?php echo $data["TIME"]?></td>

      <?php

    }
    ?>
    </table>
    <?php

}

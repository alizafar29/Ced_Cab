<?php
if(($_COOKIE["user_id"] == " ") && ($_COOKIE["user"] == " ")){
    header("Location: ../loginForm.php");
  }
  
  if(($_COOKIE["user_id"] != " ") && ($_COOKIE["user"] != " ") && ($_COOKIE["admin"] == 0)){
    header("Location: ../user_dashboard.php");
  }
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Records</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
</head>
<body>
<?php

include "adminHeader.php";

$id =$_GET["id"];

$Is_block = " ";
$color = " ";
$count = 0;

$con = mysqli_connect('localhost','root','','CedCabDb');
    if($con){
    ?>
    <table id='myTable' class='display'>
    <thead><tr>
    <th>User_Id</th>
    <th>User_Email</th>
    <th>Name</th>
    <th>Date of Signup</th>
    <th>Mobile</th>
    <th>Status</th>
    <th>Action</th>
    </tr></thead>
    <?php
    
            $query = "SELECT * FROM `tbl_user`";
    
            $execute = mysqli_query($con,$query);
            if($execute){
                echo "<tbody>";
                while($data = mysqli_fetch_assoc($execute)){
                    if($count != 0){
                        if($data['is_block'] == 1 && $id == 1){
                            $Is_block = "Blocked";
                            $color = "text-danger";
                            
                echo "
                <form action='update.php' method='GET'>
                <tr>
                <td>".$data["user_id"]."</td>
                <td>".$data["user_email"]."</td>
                <td>".$data["name"]."</td>
                <td>".$data["dateofsignup"]."</td>
                <td>".$data["mobile"]."</td>
                <td class='$color'>$Is_block</td>";
            ?>
            <td><a href="block_unblock.php?user_id=<?php echo $data["user_id"] ?>&status=0"><button style='background-color:red;color:white;border:1px solid red;padding:5%;border-radius:5px'>Unblock</button></a></td>
          </tr></form>
       <?php 
        }
        if($data['is_block'] == 0 && $id == 0){
            $Is_block = "Active";
            $color = "text-success";
            echo "
            <form action='update.php' method='GET'>
            <tr>
            <td>".$data["user_id"]."</td>
            <td>".$data["user_email"]."</td>
            <td>".$data["name"]."</td>
            <td>".$data["dateofsignup"]."</td>
            <td>".$data["mobile"]."</td>
            <td class='$color'>$Is_block</td>";
        ?>
        <td><a class="mt-5" href="block_unblock.php?user_id=<?php echo $data["user_id"] ?>&status=1"><button style='background-color:red;color:white;border:1px solid red;padding:5%;border-radius:5px'>Block</button></a></td>
      </tr></form>
      <?php
        }
    }
        $count++;
    }

        echo "</tbody></table>";
        ?>
    <?php
    }
    else{
        echo "Error ",mysqli_error($con);
    }
}
else{
    echo "Connection Failed :",mysqli_connect_error($con);
}

// include "../footer.php";

?>

<script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {
    $('#myTable').DataTable({
        'scrollX': false
    });

} );

</script>
</body>
</html>
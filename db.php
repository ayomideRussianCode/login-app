<?php

$con = mysqli_connect("localhost", "root", "", "login_ap");

if ($con){
    echo "Connected"; 
   echo '<br>';
    echo 'wow'; 
} else {
    echo "Not connected" . mysqli_connect_error($con);
}

<?php

$conn = mysqli_connect("localhost", "root", "", "login_app");

if ($conn){
   echo "Connected" ;
} else {
    echo "Not Connected" .  mysqli_connect_error($conn);
}

function check_query ($result){
    global $conn;
    if (!$result ){
        return "Error". mysqli_error($conn);
    }
    return true;
}

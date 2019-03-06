<?php
 $conn = mysqli_connect('localhost', 'admin', 'admin4321', 'BUDGET');

// CHeck Connection

if (!$conn) {
    echo "Connection Error:  " . mysqli_connect_error();}

 ?>
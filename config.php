<?php

  $SERVER="localhost";
  $USERNAME="root";
  $PASSWORD="tabletime";
  $DATABASE_NAME="AppLogin";

  $db=mysqli_connect($SERVER,$USERNAME,$PASSWORD,$DATABASE_NAME);

  if($db===false){
    die("ERROR: Could not connect.".mysqli_connect_error());
  }

?>

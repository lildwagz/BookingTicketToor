<?php
    $HOSTING_SERVER = "localhost";
    $HOSTING_USERNAME = "";
    $HOSTING_PASSWORD = "";
    $HOSTING_DATABASE = "";

    $AUTH = mysqli_connect($HOSTING_SERVER, $HOSTING_USERNAME, $HOSTING_PASSWORD, $HOSTING_DATABASE);

    if ($AUTH) {
        //echo "Berhasil terhubung ke server database 
        //<b>$HOSTING_DATABASE</b> hosting.";
    }
?>
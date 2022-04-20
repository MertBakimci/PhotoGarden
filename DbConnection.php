<?php

$serverName = "sql112.byetcluster.com";
$dBUsername = "epiz_31545992";
$dBPassword = "QxAGUhGiLyVtX";
$dBName = "epiz_31545992_PGarden";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

else {
    echo "Connected successfully";
}

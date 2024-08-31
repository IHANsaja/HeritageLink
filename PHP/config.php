<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "heritagelink"; 

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die('<div class="db-offline" id="db-status" title="Database is offline"><i class="ri-checkbox-circle-fill"></i><p>Offline</p></div>');
}
echo '<div class="db-online" id="db-status" title="Database is online"><i class="ri-checkbox-circle-fill"></i><p>Online</p></div>';
?>

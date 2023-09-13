<?php
session_start();
$host = "localhost"; /* Host name */
$user = "root"; /* User */
$password = ""; /* Password */
$dbname = "kentucky_db"; /* Database name */
if (!isset($_SESSION["English"])){
    $_SESSION["English"] = "true";  
} 
if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    if (isset($_REQUEST['English'])){
        $_SESSION["English"] = $_REQUEST['English'];
        print_r($_SESSION["English"]);
    }
}
$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}
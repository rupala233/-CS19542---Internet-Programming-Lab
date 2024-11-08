<?php
$cid = $_POST["cid"];
$cname = $_POST["cname"];
$atype = $_POST["atype"];
$balance = $_POST["balance"];

$servername = "localhost:3307"; 
$username = "root";
$password = "";
$db = "bank"; 

$conn = new mysqli($servername, $username, $password, $db);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql_customer = "INSERT INTO CUSTOMER (CID, CNAME) VALUES ('$cid', '$cname')";
if ($conn->query($sql_customer) === TRUE) {
    echo "Customer insertion successful.<br>";
} else {
    echo "Error inserting customer: " . $conn->error . "<br>";
}


$sql_account = "INSERT INTO ACCOUNT (ANO, ATYPE, BALANCE, CID) VALUES ('$cid', '$atype', '$balance', '$cid')";
if ($conn->query($sql_account) === TRUE) {
    echo "Account insertion successful.<br>";
} else {
    echo "Error inserting account: " . $conn->error . "<br>";
}

$conn->close();
?>

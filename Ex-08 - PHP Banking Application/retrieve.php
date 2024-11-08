<?php
$cid = $_POST["cid"];
$servername = "localhost:3307"; 
$username = "root";
$password = "";
$db = "bank"; 

$conn = new mysqli($servername, $username, $password, $db);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql_customer = "SELECT * FROM CUSTOMER WHERE CID='$cid'";
$result_customer = $conn->query($sql_customer);

if ($result_customer->num_rows > 0) {
    while ($row = $result_customer->fetch_assoc()) {
        echo "CUSTOMER NAME: " . $row['CNAME'] . "<br>";
    }
} else {
    echo "No customer found.<br>";
}


$sql_account = "SELECT * FROM ACCOUNT WHERE CID='$cid'";
$result_account = $conn->query($sql_account);

if ($result_account->num_rows > 0) {
    echo "<h3>Account Details:</h3>";
    while ($row = $result_account->fetch_assoc()) {
        echo "ACCOUNT TYPE: " . $row['ATYPE'] . "<br>";
        echo "BALANCE: " . $row['BALANCE'] . "<br>";
    }
} else {
    echo "No accounts found for this customer.";
}

$conn->close();
?>

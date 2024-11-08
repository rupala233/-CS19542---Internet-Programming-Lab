<?php
$ano = $_POST["ano"];
$ttype = $_POST["ttype"];
$tamount = $_POST["tamount"];
$servername = "localhost:3307"; // Adjust the port if needed (e.g., "localhost:3307")
$username = "root";
$password = "";
$db = "bank"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the current balance for the account
$sql_balance = "SELECT BALANCE FROM ACCOUNT WHERE ANO='$ano'";
$result_balance = $conn->query($sql_balance);
$row = $result_balance->fetch_assoc();
$current_balance = $row['BALANCE'];

// Handle transaction
if ($ttype === 'D') {
    // Deposit
    $new_balance = $current_balance + $tamount;
} else {
    // Withdrawal
    if ($current_balance < $tamount) {
        die("Insufficient funds for withdrawal.");
    }
    $new_balance = $current_balance - $tamount;
}

// Update the account balance
$sql_update = "UPDATE ACCOUNT SET BALANCE='$new_balance' WHERE ANO='$ano'";
if ($conn->query($sql_update) === TRUE) {
    // Log the transaction
    $sql_transaction = "INSERT INTO TRANSACTION (ANO, TTYPE, TDATE, TAMOUNT) VALUES ('$ano', '$ttype', NOW(), '$tamount')";
    if ($conn->query($sql_transaction) === TRUE) {
        echo "Transaction successful. New balance: " . $new_balance;
    } else {
        echo "Error logging transaction: " . $conn->error;
    }
} else {
    echo "Error updating balance: " . $conn->error;
}

$conn->close();
?>

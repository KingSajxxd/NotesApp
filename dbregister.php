<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Succesfully Registered!</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');
        .success{
            text-align: center;
            color: black;
            margin-top: 100px;
            font-size: 2em;
            letter-spacing: .03em;
            font-family: 'Poppins', sans-serif;
}
    </style>
</head>
<body>
    
</body>
</html>


<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Establish a connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aiphp";


// Generate a random password
function generatePassword($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';

    for ($i = 0; $i < $length; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $password .= $characters[$index];
    }

    return $password;
}

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " );
}

// Retrieve data submitted by the form
$email = $_POST['email'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$gender = $_POST['gender'];
$phone = $_POST['phone'];
$salary = $_POST['salary'];
$dateOfBirth = $_POST['dateOfBirth'];
$password = generatePassword();

// Prepare and execute the SQL query to insert the data into the Employee table
$sql = "INSERT INTO Employee (email, firstName, lastName, gender, phone, salary, dateOfBirth, password) VALUES ('$email', '$firstName', '$lastName', '$gender', '$phone', '$salary', '$dateOfBirth', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "<p class='success'>You Have successfully registered. Please await an email with your temporary password.</p>";
} else {
    echo "<p class='success'>Oops... Something went wrong. Please try again.</p>" . "<br>" . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();

?>
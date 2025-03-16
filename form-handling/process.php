<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $confirm_password = htmlspecialchars($_POST['confirm_password']);

    if ($password != $confirm_password){
        echo "<h2>Password not match!!</h2>";
    }else {
        if (!empty($name) && !empty($email)) {
            echo "<h2>Form Submitted Successfully!</h2>";
            echo "<p><strong>Name:</strong> $name</p>";
            echo "<p><strong>Email:</strong> $email</p>";
            echo "<p><strong>Password:</strong>$password</p>";
        } else {
            echo "<h2>Error: All fields are required.</h2>";
        }
    }
    
} else {
    echo "<h2>Invalid Request</h2>";
}

?>

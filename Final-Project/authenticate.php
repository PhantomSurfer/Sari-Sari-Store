<?php
include("DB_Conn.php");
date_default_timezone_set("Asia/Manila");
session_start();
// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['employeeID'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the employeeID and password fields!');
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT id, password FROM account WHERE employee_id = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['employeeID']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        // Account exists, now we verify the password.
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        if ($_POST['password'] === $password) {
            // Verification success! User has logged-in!
            // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['employeeID'];
            $_SESSION['id'] = $id;

            //This is where we left off
            header('Location: employee-dashboard.php');
        } else {
            // Incorrect password
	    echo '<script>alert("Incorrect username and/or password!")</script>';
	    header('Location: index.html');
        }
    } else {
        // Incorrect username
        echo '<script>alert("Incorrect username and/or password!")</script>';
	header('Location: index.html');
    }

	$stmt->close();
}
?>

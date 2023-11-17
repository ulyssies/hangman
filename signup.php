<?php
include "header.php";

// ALl the body parts
$bodyParts = ["0", "1", "2", "3", "4", "5", "6"];

function getCurrentPicture($part){
    return "./images/hangman_" . $part . ".png";
}

// Get all the hangman Parts
function getParts(){
    global $bodyParts;
    return isset($_SESSION["parts"]) ? $_SESSION["parts"] : $bodyParts;
}

// add part to the Hangman
function addPart(){
    $parts = getParts();
    array_shift($parts);
    $_SESSION["parts"] = $parts;
}

// get Current Hangman Body part
function getCurrentPart(){
    $parts = getParts();
    return $parts[0];
}

// Your registration logic
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    // Perform user registration here
    // Example: Save username and password to a database
    $username = $_POST['username'];
    $password = $_POST['password'];

    // You should use a secure hashing method for storing passwords in a real-world scenario
    // For example, using password_hash() and password_verify()
    // For this example, we'll use a simple approach, but DO NOT use this in production
    $hashedPassword = md5($password);

    // Save the user information to a database or another storage method
    // Example: $database->insertUser($username, $hashedPassword);

    // Redirect to the login page after registration
    header("Location: login.php");
    exit();
}

?>

<div class="container">
    <h2>Register</h2>
    <form method="post" action="">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" name="register" class="btn btn-primary">Register</button>
    </form>
</div>

<?php include "footer.php"; ?>
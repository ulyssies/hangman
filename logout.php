<?php
// logout.php

include "authentication.php";

if (isUserLoggedIn()) {
    logoutUser();
}

header("Location: index.php"); // Redirect to your desired page after logout
exit();
?>
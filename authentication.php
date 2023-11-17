<?php
// authentication.php

session_start();

// Hardcoded values for testing (replace these with your actual values)
$users = [
    "uly" => [
        "password" => password_hash("p1", PASSWORD_DEFAULT),
        "scoreboard" => ["gamesWon" => 11, "gamesLost" => 12],
    ],
    "dave" => [
        "password" => password_hash("p2", PASSWORD_DEFAULT),
        "scoreboard" => ["gamesWon" => 0, "gamesLost" => 0],
    ],
    "sean" => [
        "password" => password_hash("p3", PASSWORD_DEFAULT),
        "scoreboard" => ["gamesWon" => 0, "gamesLost" => 0],
    ],
];

function authenticateUser($username, $password) {
    // Hardcoded user accounts with their respective passwords
    $userAccounts = [
        'uly' => 'password',
        'dave' => 'p2',
        'sean' => 'p3',
    ];

    if (array_key_exists($username, $userAccounts) && $userAccounts[$username] === $password) {
        $_SESSION['username'] = $username;

        // Initialize user-specific data if not set
        if (!isset($_SESSION['users'][$username])) {
            $_SESSION['users'][$username] = [
                'gamesWon' => 0,
                'gamesLost' => 0,
            ];
        }

        return true;
    }

    return false;
}

function isUserLoggedIn() {
    return isset($_SESSION['username']);
}

function logoutUser() {
    session_unset();
    session_destroy();
}
?>
<?php

session_start();
// function test_input($data) {
//     $data = trim($data);
//     $data = stripslashes($data);
//     $data = htmlspecialchars($data);
//     return $data;
//   }

// $username_err = $password_err = $password_confirmation_err = "";
// $username = $password = $password_confirmation = "";

// // Задача 1
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $username = test_input($_POST['username']);
//     $password = test_input($_POST['password']);
//     $password_confirmation = test_input($_POST['password_confirmation']);

//     if (strlen($username) > 10 || strlen($username) < 5 || empty($username)) {
//         $username_err = "Потребителското име не е между 5 и 10 символа дълго!";
//         echo $username_err . "<br>";
//     }
//     if (strlen($password) < 6 || empty($password) || !preg_match("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$")) {
//         $password_err = "Паролата е с по-малко от 6 символа или не спазва даденият критерий!";
//         echo $password_err . "<br>";
//     }
//     if ($password !== $password_confirmation) {
//         $password_confirmation_err = "Паролите не съвпадат!";
//         echo $password_confirmation_err . "<br>";
//     }
    
//     if ($username_err === "" && $password_err === "" && $password_confirmation_err === "") {
//         $_SESSION['username'] = $username;
//         $_SESSION['password'] = $password;
//     }

//     echo "Data: ";
//     print_r($_SESSION);
// }

// Задача 2
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "SUCCESS\n";

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $username = $data['username'];
    $password = $data['password'];
    $password_confirmation = $data['password_confirmation'];

    echo $username . "\n" . $password . "\n" . $password_confirmation;
}

?>
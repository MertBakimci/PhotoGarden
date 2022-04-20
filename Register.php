<?php

if (isset($_POST["Submit"])) {

    $userName = $_POST["userName"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["passwordRepeat"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $uimage = $_FILES["uimage"]["name"];

    require_once 'DbConnection.php';
    require_once 'Functions.php';

    if (emptyInputSignup($name, $email, $userName, $password, $passwordRepeat) !== false) {

        header("Location: ../Register.php?error=emptyInput");
        exit();


        if (invalidUid($userName) !== false) {

            header("Location: ../Register.php?error=invalidUid");
            exit();
        }
        if (invalidEmail($email) !== false) {

            header("Location: ../Register.php?error=invalidEmail");
            exit();
        }

        if (invalidPassword($password, $passwordRepeat) !== false) {

            header("Location: ../Register.php?error=invalidPassword");
            exit();
        }

        if (uidExists($conn, $userName) !== false) {

            header("Location: ../Register.php?error=uidExists");
            exit();
        }

        createUser($conn, $userName, $password, $name, $surname, $uimage);
    }
} else {
    header("Location: Register.php");
}

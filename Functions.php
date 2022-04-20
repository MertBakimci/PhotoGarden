<?php

function emptyInputSignup($name, $email, $userName, $password, $passwordRepeat)
{
    $result = false;

    if (empty($name) || empty($email) || empty($userName) || empty($password) || empty($passwordRepeat)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}


function invalidUid($userName)
{
    $result = false;

    if (!preg_match("/^[a-zA-Z0-9]*$/", $userName)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function invalidEmail($email)
{
    $result = false;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function invalidPassword($password, $passwordRepeat)
{
    $result = false;

    if ($password !== $passwordRepeat) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function uidExists($conn, $userName)
{

    $sql = "SELECT * FROM User WHERE UserName='$userName'";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../Register.php?error=sqlfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $userName);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {

        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}


function createUser($conn, $UserName, $password, $name, $surname, $uimage)
{
    $sql = "INSERT INTO users (userName, Password, Name, Surname, Uimage) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../Register.php?error=sqlfailed");
        exit();
    }

    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssss", $userName, $hashedPwd, $name, $surname, $uimage);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ../Register.php?signup=success");
    exit();
}
<?php

require_once('db.php');

session_start();

if (isset($_POST['submit'])) {

    $conn = connectToDB();

    $name = $_POST['name'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    $insert = $conn->query(sprintf("INSERT INTO students (name,age, address, phone) VALUES ('%s', '%s', '%s', '%s')", $name, $age, $address, $phone));

    if ($insert) {
        $_SESSION['alert'] = 'sukses insert data';
    } else {
        $_SESSION['alert'] = 'error insert data';
    }

    $conn->close();
    header('Location: index.php');
}

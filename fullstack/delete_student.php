<?php
require_once('db.php');

session_start();

$conn = connectToDB();

$id = $_GET['id'];

$data = $conn->query(sprintf("SELECT * FROM students WHERE id = %s", $id));

if ($data->num_rows == 0) {
    $conn->close();

    $_SESSION['alert'] = 'data tidak ditemukan';
    header('Location: index.php');
}

$delete = $conn->query(sprintf("DELETE FROM students WHERE id = %s", $id));
if ($delete) {
    $conn->close();

    $_SESSION['alert'] = 'sukses hapus data';
    header('Location: index.php');
}

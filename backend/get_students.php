<?php

require_once('db.php');

function getStudents() {
    $conn = connectToDB();

    $data = $conn->query("SELECT * FROM students");

    $students = [];

    if ($data->num_rows > 0) {
        while($row = $data->fetch_assoc()) {
            $students[] = $row;
        }
    } else {
       return [];
    }

    $conn->close();

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($students);
}

getStudents();

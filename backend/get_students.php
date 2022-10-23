<?php

require_once('db.php');

function getStudents() {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $conn = connectToDB();

        $data = $conn->query("SELECT * FROM students");

        $students = [];

        if ($data->num_rows > 0) {
            while($row = $data->fetch_assoc()) {
                $row['id'] = (int) $row['id'];
                $row['age'] = (int) $row['age'];
                $students[] = $row;
            }
        } else {
            return [];
        }

        $conn->close();

        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($students);
    } else {
        $response['message'] = 'method not allowed';
        http_response_code(405);
        echo json_encode($response);
    }
}

getStudents();

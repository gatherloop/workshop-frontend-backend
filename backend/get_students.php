<?php

require_once('db.php');
require_once('cors.php');

function getStudents() {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers:  *');
    header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
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

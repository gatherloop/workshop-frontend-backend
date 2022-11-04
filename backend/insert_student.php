<?php

require_once('db.php');
require_once('cors.php');

function insertStudent() {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers:  *');
    header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $conn = connectToDB();

        // php://input, to read raw data from the request body
        // file_get_contents, this function in PHP is used to read a file into a string
        $json = file_get_contents('php://input');

        // json_decode, this function takes a JSON string and
        // converts it into a PHP variable that may be an array or an object
        $data = json_decode($json);

        $name = $data->name;
        $age = $data->age;
        $address = $data->address;
        $phone = $data->phone;

        $insert = $conn->query(sprintf("INSERT INTO students (name,age, address, phone) VALUES ('%s', '%s', '%s', '%s')", $name, $age, $address, $phone));

        $response = [];
        if ($insert) {
            $response['message'] = 'success insert student data';
        } else {
            $response['message'] = 'error insert student data - '. $conn->error;
        }

        $conn->close();

        http_response_code(201);
    } else {
        $response['message'] = 'method not allowed';
        http_response_code(405);
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

insertStudent();
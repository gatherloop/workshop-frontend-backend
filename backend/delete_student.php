<?php

require_once('db.php');

function deleteStudent() {
    if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
        $id = $_GET['id'];
        if ($id == "") {
            $response['message'] = 'id is required';
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode($response);
            return;
        }

        $conn = connectToDB();

        $data = $conn->query(sprintf("SELECT * FROM students WHERE id = %s", $id));

        if ($data->num_rows == 0) {
            $conn->close();

            $response['message'] = 'data not found';
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode($response);
            return;
        }

        $delete = $conn->query(sprintf("DELETE FROM students WHERE id = %s", $id));
        if ($delete) {
            $response['message'] = 'success delete data';
        } else {
            $response['message'] = 'error delete data - '. $conn->error;
        }

        $conn->close();

        http_response_code(200);
    } else {
        $response['message'] = 'method not allowed';
        http_response_code(405);
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

deleteStudent();

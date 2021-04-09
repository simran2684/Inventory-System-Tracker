<?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Employee.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Instantiate employee object
    $employee = new Employee($db);

    // Get employee query
    $result = $employee->readEmployee();
    // Get row count
    $num = $result->rowCount();

    // Check if any employees
    if ($num > 0) {
        $employee_arr = array();
        $employee_arr['data'] = array;

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $employee_item = array(
                'id' => $id,
                'name' => $name,
                'country' => $country,
                'city' => $city,
                'postal_code' => $postal_code,
                'street_name' => $street_name,
                'store_num' => $store_num;
            );

            // Push to "data"
            array_push($employee_arr['data'], $employee_item);
        }

        // Turn to JSON and Output
        echo json_encode($posts_arr);
    } else {
        // No employees
        echo json_encode(
            array('message' => 'No Employees Found');
        )
    }
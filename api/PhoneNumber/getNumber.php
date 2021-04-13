<?php 

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/PhoneNumber.php';

    // Connect database
    $database = new Database();
    $db = $database->connect();

    //Instantiate p_number object
    $p_number = new PhoneNumber($db);


    //Get p_number query
    $result = $p_number->getNumber();

    //Get row count
    $num = $result->rowCount();

    // Check if any supplires
    if ($num > 0) {
        $p_number_array = array();
        $p_number_array['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            
            $p_number_item = array(
                'employeeId' => $employeeId,
                'phoneNum' => $phoneNum
            );
            
            // Push to "data"
            array_push($p_number_array['data'], $p_number_item);
        }
    

        //Turn to JSON format
        echo json_encode($p_number_array);
    } else {
        echo json_encode(array('message' => 'No Phone Numbers Found'));
    }
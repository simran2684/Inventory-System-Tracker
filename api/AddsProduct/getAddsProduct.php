<?php 

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/AddsProduct.php';

    // Connect database
    $database = new Database();
    $db = $database->connect();

    //Instantiate updates_p object
    $adds_p = new AddsProduct($db);


    //Get updates_p query
    $result = $adds_p->getAll();

    //Get row count
    $num = $result->rowCount();

    // Check if any entries
    if ($num > 0) {
        $adds_p_array = array();
        $adds_p_array['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            
            $adds_p_item = array(
                'mgrSSN' => $mgrSSN,
                'productNum' => $productNum
            );
            
            // Push to "data"
            array_push($adds_p_array['data'], $adds_p_item);
        }
        //Turn to JSON format
        echo json_encode($adds_p_array);
    } else {
        echo json_encode(array('message' => 'No Data Found'));
    }
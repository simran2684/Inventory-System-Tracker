<?php 

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/SetsPrice.php';

    // Connect database
    $database = new Database();
    $db = $database->connect();

    //Instantiate set_p object
    $set_p = new SetsPrice($db);


    //Get set_p query
    $result = $set_p->getAll();

    //Get row count
    $num = $result->rowCount();

    // Check if any supplires
    if ($num > 0) {
        $set_p_array = array();
        $set_p_array['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            
            $set_item = array(
                'productNum' => $productNum,
                'adminSSN' => $adminSSN,
                'price' => $price
            );
            
            // Push to "data"
            array_push($set_p_array['data'], $set_item);
        }
    

        //Turn to JSON format
        echo json_encode($set_p_array);
    } else {
        echo json_encode(array('message' => 'No Data Found'));
    }
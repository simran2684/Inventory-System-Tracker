<?php 

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/UpdatesProduct.php';

    // Connect database
    $database = new Database();
    $db = $database->connect();

    //Instantiate updates_p object
    $updates_p = new UpdatesProduct($db);


    //Get updates_p query
    $result = $updates_p->getAll();

    //Get row count
    $num = $result->rowCount();

    // Check if any entries
    if ($num > 0) {
        $updates_p_array = array();
        $updates_p_array['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            
            $updates_item = array(
                'mgrSSN' => $mgrSSN,
                'productNum' => $productNum
            );
            
            // Push to "data"
            array_push($updates_p_array['data'], $updates_item);
        }
    

        //Turn to JSON format
        echo json_encode($updates_p_array);
    } else {
        echo json_encode(array('message' => 'No Data Found'));
    }
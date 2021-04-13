<?php 

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Supplier.php';

    // Connect database
    $database = new Database();
    $db = $database->connect();

    //Instantiate supplier object
    $supplier = new Supplier($db);


    //Get supplier query
    $result = $supplier->getSupplier();

    //Get row count
    $num = $result->rowCount();

    // Check if any supplires
    if ($num > 0) {
        $supplier_array = array();
        $supplier_array['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            
            $supplier_item = array(
                'id' => $id,
                'name' => $name,
                'phoneNumber' => $phoneNumber,
                'streetName' => $streetName,
                'country' => $country,
                'city' => $city,
                'postalCode' => $postalCode
            );
            
            // Push to "data"
            array_push($supplier_array['data'], $supplier_item);
        }
    

        //Turn to JSON format
        echo json_encode($supplier_array);
    } else {
        echo json_encode(array('message' => 'No Suppliers Found'));
    }

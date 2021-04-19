
    <?php
    
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

    include_once '../../config/Database.php';
    include_once '../../models/Product.php';
    
    //Connect the Database
    $database = new Database();
    $db = $database->connect();

    // Create new deliveries object
    $product = new Product($db);

    // Get the raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $product->productNum = $data->productNum;
    $product->name = $data->name;
    $product->brand = $data->brand;
    $product->category = $data->category;
    $product->quantity = $data->quantity;
    $product->weight = $data->weight;
    $product->inventoryNum = $data->inventoryNum;
    $product->location = $data->location;
    $product->storageTemp = $data->storageTemp;


    //Create the product
    if ($product->createProduct()) {
        echo json_encode(
            array('message' => 'Product Created')
        );
    } else {
        echo json_encode(
            array('message' => 'Unable to create Product')
        );
    }
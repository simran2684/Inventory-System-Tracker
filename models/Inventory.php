<?php  
    Class Inventory {
        private $connect;
        private $table = 'inventory';


        //Inventory properties/attributes
        public $inventoryNum;
        public $storeNum;
        public $capacity;

        //Constructor for the database
        public function __construct($db) {
            $this->connect = $db;
        }

        //Get all inventories
        public function getInventory() {
            // Create query
            $query = 'SELECT
                i.inventoryNum,
                i.storeNum,
                i.capacity
            FROM
                ' . $this->table . ' i';

            //Prepare statement
            $stmt = $this->connect->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        //Get single inventory
        public function getSingleInventory() {
            $query = 'SELECT
                i.inventoryNum,
                i.storeNum,
                i.capacity
            FROM
                ' . $this->table . ' i
            WHERE
                i.inventoryNum = ?
            LIMIT 0,1';

            // Prepare statment
            $stmt = $this->connect->prepare($query);

            // Bind id
            $stmt->bindParam(1, $this->inventoryNum);

            // Execute Query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //Set properties
            $this->inventoryNum = $row['inventoryNum'];
            $this->storeNum = $row['storeNum'];
            $this->capacity = $row['capacity'];
        }

        // Create an inventory
        public function createInventory() {
            $query = 'INSERT INTO ' . $this->table . '
                SET
                    inventoryNum = :inventoryNum,
                    storeNum = :storeNum,
                    capacity = :capacity';

            // Prepare the statement
            $stmt = $this->connect->prepare($query);

            // Bind data to store
            $stmt->bindParam('inventoryNum', $this->inventoryNum);
            $stmt->bindParam('storeNum', $this->storeNum);
            $stmt->bindParam('capacity', $this->capacity);

            // Execute the query
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        //Update an inventory
        public function updateInventory() {
            $query = 'UPDATE ' . $this->table . '
                SET
                    storeNum = :storeNum,
                    capacity = :capacity
                WHERE
                    inventoryNum = :inventoryNum';

            // Prepare the statement
            $stmt = $this->connect->prepare($query);

            //Bind data
            $stmt->bindParam('inventoryNum', $this->inventoryNum);
            $stmt->bindParam('storeNum', $this->storeNum);
            $stmt->bindParam('capacity', $this->capacity);

            // Execute the query
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }


        //Delete an inventory
        public function deleteInventory() {
            $query = 'DELETE FROM ' . $this->table . ' WHERE inventoryNum = :inventoryNum';

            // Prepare statement
            $stmt = $this->connect->prepare($query);

            // "Clean" data
            $this->inventoryNum = htmlspecialchars(strip_tags($this->inventoryNum));

            // Bind data
            $stmt->bindParam(':inventoryNum', $this->inventoryNum);

            // Execute Query
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

    }
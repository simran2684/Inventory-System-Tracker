<?php
    Class Store {
        private $connect;
        private $table = 'store';

        //Store properties/attributes

        public $storeNum;
        public $name;
        public $streetName;
        public $country;
        public $city;
        public $postalCode;


        // Constructor for the database
        public function __construct($db) {
            $this->connect = $db;
        }

        //Get all stores
        public function getStore() {
            // Create query
            $query = 'SELECT
                s.storeNum,
                s.name,
                s.streetName,
                s.country,
                s.city,
                s.postalCode
            FROM
                ' . $this->table . ' s';

            //Prepare statement
            $stmt = $this->connect->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        //Get one store
        public function getSingleStore() {
            $query = 'SELECT
                s.storeNum,
                s.name,
                s.streetName,
                s.country,
                s.city,
                s.postalCode
            FROM
                ' . $this->table . ' s
            WHERE
                s.storeNum = ?
            LIMIT 0,1';

            // Prepare statment
            $stmt = $this->connect->prepare($query);

            // Bind id
            $stmt->bindParam(1, $this->storeNum);

            // Execute Query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //Set properties
            $this->storeNum = $row['storeNum'];
            $this->name = $row['name'];
            $this->streetName = $row['streetName'];
            $this->country = $row['country'];
            $this->city = $row['city'];
            $this->postalCode = $row['postalCode'];
        }


        //Create a store
        public function createStore() {
            $query = 'INSERT INTO ' . $this->table . '
                SET
                    storeNum = :storeNum,
                    name = :name,
                    streetName = :streetName,
                    country = :country,
                    city = :city,
                    postalCode = :postalCode';

            // Prepare the statement
            $stmt = $this->connect->prepare($query);

            // Bind data to store
            $stmt->bindParam('storeNum', $this->storeNum);
            $stmt->bindParam('name', $this->name);
            $stmt->bindParam('streetName', $this->streetName);
            $stmt->bindParam('country', $this->country);
            $stmt->bindParam('city', $this->city);
            $stmt->bindParam('postalCode', $this->postalCode);

            // Execute the query
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Update a store
        public function updateStore() {
            $query = 'UPDATE ' . $this->table . '
                SET
                    name = :name,
                    streetName = :streetName,
                    country = :country,
                    city = :city,
                    postalCode = :postalCode
                WHERE
                    storeNum = :storeNum';

            // Prepare the statement
            $stmt = $this->connect->prepare($query);

            //Bind data
            $stmt->bindParam('storeNum', $this->storeNum);
            $stmt->bindParam('name', $this->name);
            $stmt->bindParam('streetName', $this->streetName);
            $stmt->bindParam('country', $this->country);
            $stmt->bindParam('city', $this->city);
            $stmt->bindParam('postalCode', $this->postalCode);

            // Execute the query
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        //Delete the store
        public function deleteStore() {
            // Create Query
            $query = 'DELETE FROM ' . $this->table . ' WHERE storeNum = :storeNum';

            // Prepare statement
            $stmt = $this->connect->prepare($query);

            // "Clean" data
            $this->storeNum = htmlspecialchars(strip_tags($this->storeNum));

            // Bind data
            $stmt->bindParam(':storeNum', $this->storeNum);

            // Execute Query
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }
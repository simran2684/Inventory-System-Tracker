<?php
    Class Supplier {
        private $connect;
        private $table = 'supplier';

        // Supplier properties/Attributes

        public $id;
        public $name;
        public $phoneNumber;
        public $streetName;
        public $country;
        public $city;
        public $postalCode;

        // Constructor for the database
        public function __construct($db) {
            $this->connect = $db;
        }

        // Get all suppliers
        public function getSupplier() {
            // Create query
            $query = 'SELECT
                s.id,
                s.name,
                s.phoneNumber,
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

        
        // Get single supplier
        public function getSingleSupplier() {
            $query = 'SELECT
                s.id,
                s.name,
                s.phoneNumber,
                s.streetName,
                s.country,
                s.city,
                s.postalCode
            FROM
                ' . $this->table . ' s
            WHERE
                s.id = ?
            LIMIT 0,1';

            // Prepare statment
            $stmt = $this->connect->prepare($query);

            // Bind id
            $stmt->bindParam(1, $this->id);

            // Execute Query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //Set properties
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->phoneNumber = $row['phoneNumber'];
            $this->streetName = $row['streetName'];
            $this->country = $row['country'];
            $this->city = $row['city'];
            $this->postalCode = $row['postalCode'];
        }


        // Function to 
        public function createSupplier() {
            $query = 'INSERT INTO ' . $this->table . '
                SET
                    id = :id,
                    name = :name,
                    phoneNumber = :phoneNumber,
                    streetName = :streetName,
                    country = :country,
                    city = :city,
                    postalCode = :postalCode';

            // Prepare the statement
            $stmt = $this->connect->prepare($query);

            // Bind data to store
            $stmt->bindParam('id', $this->id);
            $stmt->bindParam('name', $this->name);
            $stmt->bindParam('phoneNumber', $this->phoneNumber);
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


        //Update supplier
        public function updateSupplier() {
            $query = 'UPDATE ' . $this->table . '
                SET
                    name = :name,
                    phoneNumber = :phoneNumber,
                    streetName = :streetName,
                    country = :country,
                    city = :city,
                    postalCode = :postalCode
                WHERE
                    id = :id';

            // Prepare the statement
            $stmt = $this->connect->prepare($query);

            //Bind data
            $stmt->bindParam('id', $this->id);
            $stmt->bindParam('name', $this->name);
            $stmt->bindParam('phoneNumber', $this->phoneNumber);
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

        public function deleteSupplier() {
            // Create Query
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

            // Prepare statement
            $stmt = $this->connect->prepare($query);

            // "Clean" data
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind data
            $stmt->bindParam(':id', $this->id);

            // Execute Query
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

    }
<?php
    Class Employee {

        private $connect;
        private $table = 'Employee';

        //Employee Properties/Attributes
        public $id;
        public $name;
        public $country;
        public $city;
        public $postal_code;
        public $street_name;
        public $store_num;

        //Constructor with DB
        public function __construct($db) {
            $this->connect = $db;
        }

        // Get Employee
        public function readEmployee() {
            // Create query
            $query = 'SELECT 
                e.id,
                e.name,
                e.country,
                e.city,
                e.postal_code,
                e.street_name,
                e.store_num
            FROM
                ' . $this->table . ' e ';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute Query
            $stmt->execute();

            return $stmt;
        }
    }
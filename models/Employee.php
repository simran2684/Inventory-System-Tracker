<?php
    Class Employee {

        private $connect;
        private $table = 'employees';

        //Employee Properties/Attributes
        public $employeeid;
        public $name;
        public $country;
        public $city;
        public $postalCode;
        public $streetName;
        public $storeNum;

        //Constructor with DB
        public function __construct($db) {
            $this->connect = $db;
        }

        // Get Employee
        public function readEmployee() {
            // Create query
            $query = 'SELECT 
                e.employeeId,
                e.name,
                e.country,
                e.city,
                e.postalCode,
                e.streetName,
                e.storeNum
            FROM
                ' . $this->table . ' e';

            //Prepare statement
            $stmt = $this->connect->prepare($query);

            // Execute Query
            $stmt->execute();

            return $stmt;
        }
    }
<?php
    Class PhoneNumber {
        private $connect;
        private $table = 'phoneNumber';

        //Attributes
        public $employeeId;
        public $phoneNum;

        // construct database
        public function __construct($db) {
            $this->connect = $db;
        }

        //Get all phone numbers
        public function getNumber() {
            //Query
            $query = 'SELECT
                p.employeeId,
                p.phoneNum
            FROM
                ' . $this->table . ' p';

            //Prepare statment
            $stmt  = $this->connect->prepare($query);

            //Execute query
            $stmt->execute();
            //return
            return $stmt;
        }

        //Get one phone number
        public function getSingleNumber() {
            $query = 'SELECT
            p.employeeId,
            p.phoneNum
        FROM
            ' . $this->table . ' p
        WHERE
            p.employeeId = ?
        LIMIT 0,1';

        // Prepare statment
        $stmt = $this->connect->prepare($query);

        // Bind id
        $stmt->bindParam(1, $this->employeeId);

        // Execute Query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //Set properties
        $this->employeeId = $row['employeeId'];
        $this->phoneNum = $row['phoneNum'];
        }


        //Create phone Number
        public function createNumber() {
            $query = 'INSERT INTO ' . $this->table . '
                SET
                    employeeId = :employeeId,
                    phoneNum = :phoneNum';

            // Prepare the statement
            $stmt = $this->connect->prepare($query);

            // Bind data to store
            $stmt->bindParam('employeeId', $this->employeeId);
            $stmt->bindParam('phoneNum', $this->phoneNum);

            // Execute the query
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }


        //Update phone number
        public function updateNumber() {
            $query = 'UPDATE ' . $this->table . '
                SET
                    phoneNum = :phoneNum
                WHERE
                    employeeId = :employeeId';

            // Prepare the statement
            $stmt = $this->connect->prepare($query);

            // Bind data to store
            $stmt->bindParam('employeeId', $this->employeeId);
            $stmt->bindParam('phoneNum', $this->phoneNum);

            // Execute the query
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }


        //Delete phone number
        public function deleteNumber() {
            // Create Query
            $query = 'DELETE FROM ' . $this->table . ' WHERE employeeId = :employeeId';

            // Prepare statement
            $stmt = $this->connect->prepare($query);

            // "Clean" data
            $this->employeeId = htmlspecialchars(strip_tags($this->employeeId));

            // Bind data
            $stmt->bindParam(':employeeId', $this->employeeId);

            // Execute Query
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }
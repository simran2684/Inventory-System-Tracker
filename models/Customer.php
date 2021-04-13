<?php
    class Customer{
        private $connect;
        private $table = 'customer';

        //customer properties
        public $customerNum;
        public $paymentMethod;
        
        //DB constructor
        public function _constructor($db) {
            $this -> connect = $db;
        }

        //Get Customer
        public function read(){
            //Create query
            $query = 'Select
                c.customerNum,
                c.paymentMethod
                
            FROM
                ' . $this->table . ' c';

            //preparing statement
            $stmt = $this->connect->prepare($query);

            //Execute the query
            $stmt->execute();

            return $stmt; 
        }

    }

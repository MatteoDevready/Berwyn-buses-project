<?php
    
    class BookingDatabase {
        private static $instance = null;
        private $pdo;

        private function __construct()
        {
            if(DEBUG_MODE) {
                $this->pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            } else {
                $this->pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
            }            
            
        }
        
        public static function getInstance()
        {
            if(!self::$instance)
            {
                self::$instance = new BookingDatabase();
            }
            
            return self::$instance;
        }
        
        public function getPDO()
        {
            return $this->pdo;
        }        
    }    

    function getAllStudents() {
        $pdo = BookingDatabase::getInstance()->getPDO();
        $statement = $pdo->prepare("SELECT * FROM Students");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "Student");
        return $results;
    }    

?>
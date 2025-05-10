<?php
     class Database 
       {
           private $host = 'localhost';
           private $db_name = 'dbinventory';
           private $username = 'root';
           private $password = '';
           private $deal;

           public function connect()
           {
                $this->deal = null;
                try {
                    $dsn = 'mysql:host=" . $this->host . ";dbname=" . $this->db_name . "; charset=utf8mb4";
                    $this->deal = new PDO($dsn, $this->username, $this->password);
                    $this->deal->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  } catch (PDOException $e) {
                        echo "Connection error: " . $e->getMessage();
                  }
                  return $this->deal;
              }
          }
                      

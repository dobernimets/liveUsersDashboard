<?php
    class DataBase{
        public static $conn;
        public static $query;
        public static $close;
    

        private static function connect(){

            self::$conn = fopen("../../db/db.txt","w");
            return self::$conn;
        }

      public static function query($sql){
            
            self::connect();
            
            $result = self::$conn->query($sql);
            $rows = array();
            while ($row = $result->fetch_assoc()){
                $rows[] = $row;
            }

            self::close();

            return 1;
        }

        public static function insert($query) {
       
            $conn = self::connect();
            
            fwrite($conn, json_encode($query));
            self::close();
          
            return true;
         
        }
    
        public static function update($sql){
            self::connect();
            $result = self::$conn->query($sql);
            self::close();
            return $result;
        }
        public static function getAllUsers(){
            $content = file_get_contents("../../db/db.txt");
            $arrayAllUsers = $content == "" ? array():json_decode($content)  ;

            return $arrayAllUsers;
        }
        private static function close() {
            fclose(self::$conn);
        }
    }
?>
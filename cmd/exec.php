<?php
class ExecSQL{
    private $conn;
    public function __construct($str_conn){

        $this->conn =$str_conn;
     }

     public function readAll($tablename){
         $stmt =$this->conn->prepare(" SELECT * FROM $tablename" );
         $stmt ->execute();
         return $stmt;

    }
 
     public function insert($tablename,$field,$value){
        $stmt = $this->conn->prepare(" INSERT INTO $tablename ($field) VALUES ($value) ");
        return $this->checkExe($stmt);
     }

     public function update($tablename,$condition){
        $stmt= $this->conn->prepare(" UPDATE ".$tablename.$condition);
        return $this->checkExe($stmt);
     }

     public function delete($tablename,$condition,$id){
        $stmt = $this->conn->prepare(" DELETE FROM $tablename WHERE $condition = ".$id);               
        return $this->checkExe($stmt);
     }
    
     private function checkExe($stmt){  
     
        if($stmt->execute())
        {
            return true;
        }else{ 
            return false; 
        }

     }

    

}


?>
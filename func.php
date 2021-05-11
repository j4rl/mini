<?php

//Connect to db
function connect($db){
    $host="localhost";
    $user="root";
    $pass="";
    $conn=mysqli_connect($host,$user,$pass,$db) or die(mysqli_error);    
    return $conn;
}

function runQuery($conntmp, $sqlStr){
    if($result=mysql_query($conntmp,$sqlStr)){
        return $result;
    }else{
        return false;
    };

}


/* $host="localhost";
$user="root";
$pass="";
$db="";
$conn=mysqli_connect($host,$user,$pass,$db) or die(mysqli_error); */



class db {
    function __construct($db_name, $host="localhost", $username="root", $password="") {
        $this->mysqli = mysqli_connect($host, $username, $password, $db_name);
    }
    public function fix($strFix){
        return $this->mysqli->real_escape_string($strFix);
    }

    public function runQuery($strQuery){
        $strTemp=$this->fix($strQuery);
        return $this->mysqli->query($strQuery);
    }

    public function delRow($ID,$table){
        $strTable=strtolower(substr($table,3,strlen($table)));
        $tmpSTrID=$strTable."ID";
        $query=$this->fix("DELETE FROM $table WHERE $tmpSTrID=$ID");
        if($this->mysqli->query($query)){
            return false;
        }else{
            return true;
        };
    }


    public function getAll($table) //Returns an associated array
    {
        $query=$this->fix("SELECT * FROM $table");
        return $this->mysqli->query($query)->fetch_assoc();
    }

    public function close(){
        return $this->mysqli->close();
    }

}

?>

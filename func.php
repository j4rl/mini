<?php
session_start();
require_once './lang/en.php';
//Connect to db
function connect($db){
    $host="localhost";
    $user="root";
    $pass="";
    $conn=mysqli_connect($host,$user,$pass,$db) or die(mysqli_error);    
    return $conn;
}

function runQuery($conntmp, $sqlStr){
    if($result=mysqli_query($conntmp,$sqlStr)){
        return $result;
    }else{
        return false;
    };
}


function isLoggedIn(){
    if(!isLevel(10)){
        header("Location:logout.php");
    }else{
        return true;
    }
}

/* $host="localhost";
$user="root";
$pass="";
$db="";
$conn=mysqli_connect($host,$user,$pass,$db) or die(mysqli_error); */

function checklogin($usr, $pass){
    global $strMessLoginSuccess, $strMessUnknown, $strMessLoginFail;
    $dbobj=new db('dbsdata');
    $strQuery="SELECT * FROM tblUser WHERE username='$usr' AND password='$pass';";  
    if($result=$dbobj->runQuery($strQuery)){ //Was it possible to question the database for this?
        if(!mysqli_num_rows($result)==1){   //It was, now check if it didn't was just one row
           //echo "Inte inloggad!";  //Batty boy!
           //Now reset all session variables:
           $_SESSION['id']="";
           $_SESSION['level']="";
           $_SESSION['name']="";   
           $mess=$strMessLoginFail;                
        }else{  //You made it! you are authorized!
            $raden=mysqli_fetch_assoc($result);   //Get the row with data
            //Now set all our session variables. You could have secret names for these session variables 
            $_SESSION['id']=$raden['userID'];
            $_SESSION['level']=$raden['userlevel'];
            $_SESSION['name']=$raden['username'];
            $mess=$strMessLoginSuccess;
        }
    }else{
        $mess=$strMessUnknown;
    } 
    return $mess;
}

function isLevel($lvl){
    if(isset($_SESSION['level'])){
        if(intval($_SESSION['level'])>=$lvl){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

function getRealName($id){
    global $strMessUsernameFail, $strMessWrongID;
    if(isset($id)){
        $tempDB=new db('dbsdata');
        $sql="SELECT * FROM tblUser WHERE userID=$id";
        if($result=$tempDB->runQuery($sql)){ //Was it possible to question the database for this?
            if(!mysqli_num_rows($result)==1){
                return $strMessWrongID;
             }else{
                $raden=mysqli_fetch_assoc($result);
                return $raden['realname'];
             }
        }else{
            return $strMessUsernameFail;
        }
    }
}
function showLoginStatus(){
    global $strLogin, $strLogout,  $strMessDoLogin;
    $strRet="<div class='loginstatus'>";    
    if(isLevel(10)){
        $strRet=$strRet.getRealName($_SESSION['id'])."&nbsp;[".$_SESSION['name']."]&nbsp;".getlevel($_SESSION['level'])."&nbsp;&nbsp;<a href='logout.php' class='logstat'>".$strLogout."</a>";
    }else{
        $strRet=$strRet.$strMessDoLogin."&nbsp;<a href='index.php' class='logstat'>".$strLogin."</a>";
    }
    return $strRet."</div>";
}

function getLevel($level){
    global $strAdmin, $strExtended, $strUser, $strErrUser;
    switch($level){
        case ($level >= 1000):
            return $strAdmin;
            break;
        case ($level >= 100):
            return $strExtended;
            break;     
        case ($level >= 10):
            return $strUser;
            break;
        default:
            return $strErrUser;
    }
}

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

  //using countWords function, make a function that returns a specific number of words in a stringArray
    function countWords($str, $numWords){
        $strArray=explode(" ",$str);
        $strRet="";
        for($i=0;$i<$numWords;$i++){
            $strRet=$strRet.$strArray[$i]." ";
        }
        return $strRet;
    }

?>

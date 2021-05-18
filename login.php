<?php     
require_once 'func.php';
if(isset($_POST['login'])){
        echo checklogin($_POST['username'],$_POST['password']);
        header('Location:index.php');
    }?>
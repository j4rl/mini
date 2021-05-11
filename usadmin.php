<!DOCTYPE html>

    <?php
    //------------------------------Connect to database
    $host="localhost";
    $user="root";
    $pass="";
    $db ="dbsData";
    $conn=mysqli_connect($host, $user, $pass, $db);
    //------------------------------------------------

    //--------------------------------If FORM is sent, 
    //---take data from textbox and put it in database
    if(isset($_POST['btnNewUser'])){
        $txtUsername=$_POST['txtUsername'];
        $txtPassHash=md5($_POST['txtPassword']);
        $intUserlevel=intval($_POST['lstUserlevel']);
        $txtRealname=$_POST['txtRealname'];
        $sql="INSERT INTO tbluser (username, password, userlevel, realname) VALUES ('$txtUsername', '$txtPassHash', $intUserlevel, '$txtRealname')";
        $result=mysqli_query($conn, $sql);
    }
    //-----------------------------------------------
    
    if(isset($_GET['del'])){
        $delid=$_GET["del"];
        $sql="DELETE FROM `tbluser` WHERE userID=$delid";
        $result=mysqli_query($conn, $sql);
    }

    if(isset($_POST['btnEditUser'])){
        $editid=$_POST['userID'];
        $txtUsername=$_POST['txtUsername'];
        $txtPassHash=md5($_POST['txtPassword']);
        $intUserlevel=intval($_POST['txtUserlevel']);
        $txtRealname=$_POST['txtRealname'];
        $sql="UPDATE `tbluser` SET username='$txtUsername', password='$txtPassHash', userlevel=$intUserlevel, realname='$txtRealname' WHERE userID=$editid";
        $result=mysqli_query($conn, $sql);
    }

?>
<html>
<head>
<meta charset="UTF-8">
    <title>Administrera användare</title>
    <link rel="stylesheet" href="style.css">
    <script src="app.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
</head>
<body>
<?php  if(isset($_GET['edit'])){ 
        $editid=$_GET["edit"];
        $sql="SELECT * FROM `tbluser` WHERE userID=$editid";
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($result);
    ?>
    <form method="post" action="usadmin.php">
        <input type="text" name="txtRealname" id="txtRealname" value="<?=$row['realname'];?>" autocomplete="off">
        <input type="text" name="txtUsername" id="txtUsername" value="<?=$row['username'];?>" autocomplete="off">
        <input type="text" name="txtPassword" id="txtPassword" value="<?=$row['password'];?>" autocomplete="off">
        <input type="text" name="txtUserlevel" id="txtUserlevel" value="<?=$row['userlevel'];?>" autocomplete="off">
        <input type="hidden" name="userID" value="<?=$row['userID']?>">
        <button type="submit" name="btnEditUser" value=".">Ändra!</button>
    </form>
<?php }else{ ?>    
    <form method="post" action="usadmin.php">
        <input type="text" name="txtRealname" id="txtRealname" required autocomplete="off" placeholder="Full name">
        <input type="text" name="txtUsername" id="txtUsername" required autocomplete="off" placeholder="Username">
        <input type="text" name="txtPassword" id="txtPassword" required autocomplete="off" placeholder="Password">
        <label for="lstUserlevel">User level:</label>
            <select id="lstUserlevel" name="lstUserlevel" size="3">
                <option value="10" selected>User</option>
                <option value="100">Extended</option>
                <option value="1000">Admin</option>
            </select>
        <button type="submit" name="btnNewUser" value=".">Add&nbsp;user!</button>
    </form>
<?php } ?>    
    <div class="ruta">
    <?php 
        //-------------------Get all data from table, and print it
        $sql="SELECT * FROM tbluser";
        $result=mysqli_query($conn, $sql);
        while($row=mysqli_fetch_assoc($result)){
            echo $row['realname']."&nbsp;&nbsp;[".$row['username']."]<a href='usadmin.php?del=".$row['userID']."'><img class='icon' src='icons/del.png'></a><a href='usadmin.php?edit=".$row['userID']."'><img class='icon' src='icons/edit.png'></a><br>";
        }
        //--------------------------------------------------------
    ?>
    </div>

    
</body>
</html>
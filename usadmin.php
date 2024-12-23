<!DOCTYPE html>

    <?php
    require_once 'func.php';
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
        //$txtPassHash=md5($_POST['txtPassword']);
        $txtPassHash=$_POST['txtPassword'];
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
        //$txtPassHash=md5($_POST['txtPassword']);
        $txtPassHash=$_POST['txtPassword'];
        $intUserlevel=intval($_POST['txtUserlevel']);
        $txtRealname=$_POST['txtRealname'];
        $sql="UPDATE `tbluser` SET username='$txtUsername', password='$txtPassHash', userlevel=$intUserlevel, realname='$txtRealname' WHERE userID=$editid";
        $result=mysqli_query($conn, $sql);
    }

?>
<html>
<head>
<meta charset="UTF-8">
    <title><?=$strHomeTitle?></title>
    <link rel="stylesheet" href="style.css">
    <script src="app.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="userinfo">
        <?=showLoginStatus()?>
    </div>
<?php require_once 'menu.php'; ?>
<?php  if(isset($_GET['edit'])){ 
        $editid=$_GET["edit"];
        $sql="SELECT * FROM `tbluser` WHERE userID=$editid";
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($result);
    ?>
    <form method="post" action="usadmin.php" name="usadmin">
        <input type="text" name="txtRealname" id="txtRealname" value="<?=$row['realname'];?>" autocomplete="off">
        <input type="text" name="txtUsername" id="txtUsername" value="<?=$row['username'];?>" autocomplete="off">
        <input type="text" name="txtPassword" id="txtPassword" value="<?=$row['password'];?>" autocomplete="off">
        <input type="text" name="txtUserlevel" id="txtUserlevel" value="<?=$row['userlevel'];?>" autocomplete="off">
        <input type="hidden" name="userID" value="<?=$row['userID']?>">
        <button type="submit" name="btnEditUser" value="."><?=$strBtnEditUser?></button>
    </form>
<?php }else{ ?> 
    <?php if(isLevel(100)){ ?>
<details>
<summary><?=$strAddUser?></summary>      
    <form method="post" action="usadmin.php" name="usadmin">
        <label for="txtRealName" title="<?=$placeholderRealname?>"></label>
        <input type="text" name="txtRealname" id="txtRealname" required autocomplete="off" placeholder="<?=$placeholderRealname?>">
        <label for="txtUsername" title="<?=$placeholderUsername?>"></label>
        <input type="text" name="txtUsername" id="txtUsername" required autocomplete="off" placeholder="<?=$placeholderUsername?>">
        <label for="txtPassword" title="<?=$placeholderPassword?>"></label>
        <input type="text" name="txtPassword" id="txtPassword" required autocomplete="off" placeholder="<?=$placeholderPassword?>">
        <p><?=$strUserlevel?></p>
            <select id="lstUserlevel" name="lstUserlevel" size="3">
                <option value="10" selected><?=$strUser?></option>
                <?php if(isLevel(110)){ ?><option value="100"><?=$strExtended?></option><?php } ?>
                    <?php if(isLevel(1000)){ ?><option value="1000"><?=$strAdmin?></option><?php } ?>
            </select>
        <button type="submit" name="btnNewUser" value="."><?=$strBtnNewUser?></button>
    </form></details> <?php } ?>
<?php } ?>    
<?php if(isLevel(100)){ ?>
    <div class="ruta">
    <?php 
        //-------------------Get all data from table, and print it
        $sql="SELECT * FROM tbluser";
        $result=mysqli_query($conn, $sql);
        while($row=mysqli_fetch_assoc($result)){ ?>
            <div class="userbox">
                <h3><?=$row['realname']?>&nbsp;&nbsp;[<span class="level"><?=$row['userlevel']?></span>]</h3>
                <code class="username">[<?=$row['username']?>]</code>
                <?php if(isLevel(100)){ ?><code class="password"><?=$row['password']?></code><?php } ?>
                <?php if(isLevel(1000)){?><span class="toolicon"><a href='usadmin.php?del="<?=$row['userID']?>"'><img class='icon' src='icons/del.png'></a>&nbsp;&nbsp;<a href='usadmin.php?edit="<?=$row['userID']?>"'><img class='icon' src='icons/edit.png'></a></span><?php }?>
            </div>
       <?php }
        //--------------------------------------------------------
    ?>
    </div><?php } ?>
    
</body>
</html>
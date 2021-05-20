<!DOCTYPE html>
<?php 
    require_once 'func.php'; 
    if(isLoggedIn()){
        $result=runQuery(connect('dbsdata'), "SELECT * FROM tbluser WHERE userID=".$_SESSION['id']);
        $row=mysqli_fetch_assoc($result);
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
<div class="content">
    <?php if(isLevel(10)){ ?>
        <div class="box">
            <div class="rname"><?=$row['realname']?></div>
            <div class="uname"><?=$row['username']?></div>
            <div class="ulevel"><?=$row['userlevel']?></div>
        </div> 
        <div class="blogsByMe">
        <?php  
                if(isLoggedIn()){
                    $result=runQuery(connect('dbsdata'), "SELECT * FROM tblblog WHERE author=".$_SESSION['id']);
                    while($row=mysqli_fetch_assoc($result)){ ?>
                        <div class="myBlog"><?=$row['header']?></div>


                   <?php };
                }
                
        ?>
        </div>
    <?php } ?>
</div>    
</body>
</html>
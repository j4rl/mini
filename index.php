<!DOCTYPE html>
<?php require_once('func.php'); ?>
<?php 
    $host="localhost";
    $user="root";
    $pass="";
    $db ="dbsData";
    $conn=mysqli_connect($host, $user, $pass, $db);

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="userinfo">
    <?=showLoginStatus()?>
</div>
<nav id='menu'>
  <input type='checkbox' id='responsive-menu'><label></label>
  <ul>
    <li><a href='index.php'>Home</a></li>
    <?php if(isLevel(100)){ ?>
    <li><a>Admin</a>
      <ul class='sub-menus'>
        <li><a href='usadmin.php'>Users</a></li>
        <li><a href='bladmin.php'>Blogg</a></li>
      </ul>
    </li>
    <?php } ?>
    <li><a href='about.php'>About</a></li>
  </ul>
</nav>
    <div class="content">
    <?php     if(isset($_POST['login'])){
        echo checklogin($_POST['username'],$_POST['password'], $db);
    }else{ ?>
    <?php if(!isLevel(10)){ ?>
    <form method="post" action="index.php" name="frmLogin" autocomplete="off">
        <input type="text" name="username" placeholder="Användarnamn" required autocomplete="off">
        <input type="password" onblur="this.setAttribute('readonly', 'readonly');" onfocus="this.removeAttribute('readonly');" readonly name="password" required autocomplete="off" placeholder="Lösenord">
        <button type="submit" name="login" value=".">Logga in</button>
    </form><?php } ?>
<?php } ?>
    <?php 
    $sql="SELECT * FROM tblblog ORDER BY added DESC LIMIT 3";
    $result=mysqli_query($conn, $sql);
    while($row=mysqli_fetch_assoc($result)){ ?>
        <section>
            <h1><?=$row['header']?></h1>
            <p class="ingress"><?=$row['ingress']?></p>
            <p class="text"><?=$row['text']?></p>
            <div class="byline">- by <?=getRealName($row['author'])?></div>
        </section>
<?php } ?>
<?php 
    $sql="SELECT * FROM tblblog ORDER BY added DESC LIMIT 3,10";
    $result=mysqli_query($conn, $sql);
    while($row=mysqli_fetch_assoc($result)){ ?>
    <details>
            <summary><?=$row['header']?></summary>
            <div class="txtBox">
            <p class="ingress"><?=$row['ingress']?></p>
            <p class="text"><?=$row['text']?></p>
            <div class="byline">- by <?=getRealName($row['author'])?></div>    
            </div>
            
        </details>
<?php }  ?>

    </div>
</body>
</html>
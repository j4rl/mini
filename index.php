<!DOCTYPE html>
<?php require_once('func.php'); ?>
<?php 
    $host="localhost";
    $user="root";
    $pass="";
    $db ="dbsData";
    $conn=mysqli_connect($host, $user, $pass, $db);
    if(isset($_POST['btnComment'])){
        $comment=$_POST['txtComment'];
        $author=intval($_POST['commentID']);
        $blogID=intval($_POST['blogID']);
        $sql="INSERT INTO tbltext (text, author, blogID) VALUES ('$comment',$author, $blogID)";
        $result=mysqli_query($conn, $sql);
    }
    if(isset($_GET['delComment'])){
        $result=mysqli_query($conn, "DELETE FROM tbltext WHERE textID=".$_GET['delComment']);
    }

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
<?php require_once 'menu.php'; ?>
    <div class="content">
    <?php if(!isLevel(10)){ ?>
    <form method="post" action="login.php" name="frmLogin" autocomplete="off">
        <input type="text" name="username" placeholder="Användarnamn" required autocomplete="off">
        <input type="password" onblur="this.setAttribute('readonly', 'readonly');" onfocus="this.removeAttribute('readonly');" readonly name="password" required autocomplete="off" placeholder="Lösenord">
        <button type="submit" name="login" value="."><?=$strLogin?></button>
    </form><?php } ?>
    <?php 
    $sql="SELECT * FROM tblblog ORDER BY added DESC LIMIT 3";
    $result=mysqli_query($conn, $sql);
    while($row=mysqli_fetch_assoc($result)){ ?>
        <section>
            <h1><?=$row['header']?></h1>
            <p class="ingress"><?=$row['ingress']?></p>
            <p class="text"><?=$row['text']?></p>
            <div class="byline">- by <?=getRealName($row['author'])?></div>
            <?php if(isLevel(10)){ ?>
                <div class="frmComment">
                    <form method="post" action="index.php" name="frmComment">
                        <input type="text" name="txtComment" placeholder="<?=$strCommentPlaceholder?>">
                        <input type="hidden" name="blogID" value="<?=$row['blogID']?>">
                        <input type="hidden" name="commentID" value="<?=$_SESSION['id']?>">
                        <button type="submit" name="btnComment" value="."><?=$strBtnComment?></button>
                    </form>
                </div>
            <?php } 
            if(isLevel(10)){ ?>
                <div class="comments">
                    <?php 
                        $blogid=$row['blogID'];
                        $tsql="SELECT * FROM tbltext WHERE blogID=$blogid ORDER BY added DESC";
                        $tresult=mysqli_query($conn, $tsql);
                        if(mysqli_num_rows($tresult)){
                            while($trow=mysqli_fetch_assoc($tresult)){ ?>
                                <details>
                                     <summary><?=$trow['text']?>
                                        <?php  
                                            if(($trow['author']==intval($_SESSION['id'])) || isLevel(1000)){ ?>
                                                <span class="delComment"><a href="index.php?delComment=<?=$trow['textID']?>"><img class='icon' src='icons/del.png'></a></span>
                                        <?php } ?>
                                    </summary>
                                    <div class="txtBox">
                                        <div class="commentby"><?=getRealName($trow['author'])?></div>
                                        <div class="commentDate"><?=$trow['added']?></div>    
                                    </div>      
                                </details>
                            <?php } 
                        } ?>
                </div>
            <?php } } 
               /*
               
               */    
            
            
            ?>
        </section>



    </div>
</body>
</html>